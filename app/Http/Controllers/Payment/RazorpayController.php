<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CombinedOrder;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerPackageController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\SellerPackageController;
use Razorpay\Api\Api;
use Session;


class RazorpayController extends Controller
{
    public function pay(Request $request)
    {
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
        if (Session::has('payment_type')) {
            $paymentType = Session::get('payment_type');
            $paymentData = Session::get('payment_data');
            $combinedOrderId = Session::get('combined_order_id'); // Get combined order ID from session

            if ($paymentType) {
                $combined_order = CombinedOrder::findOrFail($combinedOrderId);
                $res = $api->order->create([
                    'receipt' => $combinedOrderId, // Use combined order ID as receipt
                    'amount' => round($combined_order->grand_total) * 100,
                    'currency' => 'INR',
                ]);
                return view('frontend.razor_wallet.order_payment_Razorpay', compact('combined_order', 'res', 'paymentType'));
            }
        }
    }

    public function payment(Request $request)
    {
        //Input items of form
        $input = $request->all();
        //get API Configuration
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

        //Fetch payment information by razorpay_payment_id
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        $notes = $payment['notes'] ?? [];
        $payment_detalis = json_encode($input);
        $userId = $notes['user_id'] ?? null;
        $combinedOrderId = $notes['combined_order_id'] ?? null;
        $paymentType = $notes['payment_type'] ?? null;

        if (!Auth::check()) {
            $user = \App\Models\User::find($userId);
            if ($user) {
                Auth::login($user);
                $request->session()->regenerate();
            }
        }

        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                //$payment_detalis = json_encode(array('id' => $response['id'],'method' => $response['method'],'amount' => $response['amount'],'currency' => $response['currency']));
            } catch (\Exception $e) {
                $request->session()->forget('order_id');
                $request->session()->forget('payment_data');
                flash(translate('Payment cancelled'))->warning();
                return redirect()->route('home');
                // return $e->getMessage();
                // \Session::put('error', $e->getMessage());
                // return redirect()->back();
            }

            // Do something here for store payment details in database...
            if ($paymentType === 'cart_payment') {
                return (new CheckoutController)->checkout_done($combinedOrderId, $payment_detalis);
            }
        } else {
            $request->session()->forget('order_id');
            $request->session()->forget('payment_data');
            flash(translate('Payment cancelled'))->warning();
            return redirect()->route('home');
        }
    }

    public function handleWebhook(Request $request)
    {
        \Log::info('Razorpay Webhook: ', $request->all());
        $event = $request->event;

        $directoryPath = public_path('webhook_logs');
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }

        $filePath = $directoryPath . '/webhook_' . date('Y-m-d_H-i-s') . '.log';
        file_put_contents($filePath, json_encode($request->all(), JSON_PRETTY_PRINT), FILE_APPEND);

        if ($event === 'payment.captured' /** || $event === 'payment.authorized'*/) {
            if (isset($request->data['payment']['entity'])) {
                $payment_detalis = json_encode($request->all());
                $entity = $request->data['payment']['entity'];
                $combinedOrderId = $entity['notes']['combined_order_id'] ?? null;

                if ($combinedOrderId) {
                    $order = CombinedOrder::where('combined_order_id', $combinedOrderId)->first();
                    if ($order && $order->payment_status === 'unpaid') {
                        return (new CheckoutController)->checkout_done($combinedOrderId, $payment_detalis);
                    }
                }
            }
            return response()->json(['status' => 'success'], 200);
        }
    }
}