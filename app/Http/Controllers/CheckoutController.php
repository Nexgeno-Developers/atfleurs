<?php

namespace App\Http\Controllers;

use App\Utility\PayfastUtility;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Address;
use App\Models\Carrier;
use App\Models\CombinedOrder;
use App\Models\Product;
use App\Utility\PayhereUtility;
use App\Utility\NotificationUtility;
use Session;
use Auth;
use DB;

class CheckoutController extends Controller
{

    public function __construct()
    {
        //
    }

    //check the selected payment gateway and redirect to that controller accordingly
    public function checkout(Request $request)
    {

        $carts = Cart::where('user_id', Auth::user()->id)->get();
        if($carts->isEmpty()) {
            flash(translate('Your Cart was empty'))->warning();
            return redirect()->route('home');
        }

        // Minumum order amount check
        if(get_setting('minimum_order_amount_check') == 1){
            $subtotal = 0;
            foreach (Cart::where('user_id', Auth::user()->id)->get() as $key => $cartItem){
                $product = Product::find($cartItem['product_id']);
                $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];
            }
            if ($subtotal < get_setting('minimum_order_amount')) {
                flash(translate('You order amount is less then the minimum order amount'))->warning();
                return redirect()->route('home');
            }
        }
        // Minumum order amount check end

        if ($request->payment_option != null) {
            (new OrderController)->store($request);

            $request->session()->put('payment_type', 'cart_payment');

            $data['combined_order_id'] = $request->session()->get('combined_order_id');
            $request->session()->put('payment_data', $data);

            if ($request->session()->get('combined_order_id') != null) {

                // If block for Online payment, wallet and cash on delivery. Else block for Offline payment
                $decorator = __NAMESPACE__ . '\\Payment\\' . str_replace(' ', '', ucwords(str_replace('_', ' ', $request->payment_option))) . "Controller";
                if (class_exists($decorator)) {
                    return (new $decorator)->pay($request);
                }
                else {
                    $combined_order = CombinedOrder::findOrFail($request->session()->get('combined_order_id'));
                    $manual_payment_data = array(
                        'name'   => $request->payment_option,
                        'amount' => $combined_order->grand_total,
                        'trx_id' => $request->trx_id,
                        'photo'  => $request->photo
                    );
                    foreach ($combined_order->orders as $order) {
                        $order->manual_payment = 1;
                        $order->manual_payment_data = json_encode($manual_payment_data);
                        $order->save();
                    }
                    flash(translate('Your order has been placed successfully. Please submit payment information from purchase history'))->success();
                    return redirect()->route('order_confirmed');
                }
            }
        } else {
            flash(translate('Select Payment Option.'))->warning();
            return back();
        }
    }

    //redirects to this method after a successfull checkout
    public function checkout_done($combined_order_id, $payment)
    {
        $combined_order = CombinedOrder::findOrFail($combined_order_id);

        foreach ($combined_order->orders as $key => $order) {
            $order = Order::findOrFail($order->id);
            $order->payment_status = 'paid';
            $order->payment_details = $payment;
            $order->save();

            calculateCommissionAffilationClubPoint($order);
        }
        Session::put('combined_order_id', $combined_order_id);
        return redirect()->route('order_confirmed');
    }

    public function get_shipping_info(Request $request)
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
//        if (Session::has('cart') && count(Session::get('cart')) > 0) {
        if ($carts && count($carts) > 0) {
            $categories = Category::all();
            return view('frontend.shipping_info', compact('categories', 'carts'));
        }
        flash(translate('Your cart is empty'))->success();
        return back();
    }

     public function store_shipping_info(Request $request)
    {
        // if ($request->address_id == null) {
        //     flash(translate("Please add shipping address"))->warning();
        //     return back();
        // }

        // $carts = Cart::where('user_id', Auth::user()->id)->get();
        // if($carts->isEmpty()) {
        //     flash(translate('Your cart is empty'))->warning();
        //     return redirect()->route('home');
        // }

        // //zipcode availibility check
        // if ($carts && count($carts) > 0 && !empty($request->address_id)) {
        //     $zp_error = [];
        //     $shipping_info = Address::where('id', $request->address_id)->first();

        //     foreach ($carts as $key => $cartItem) {
        //         $product = Product::find($cartItem['product_id']);
        //         // $zp = DB::table('zipcode_availibility')->where('id', $product->zipcode_availibility_id)->first();
        //         $zp = DB::table('zipcode_availibility')->where('id', json_decode($product->zipcode_availibility_id))->first();
        //         if (isset($zp->id)) {
        //             $type = $zp->type;
        //             $zipcodes = json_decode($zp->zipcode);

        //             if ($type == 'allow') {
        //                 if (!in_array($shipping_info->postal_code, $zipcodes)) {
        //                     $zp_error[] = $product->name . ' Not deliverable at ' . $shipping_info->postal_code;
        //                 }
        //             }
        //         }
        //     }

        //     if (!empty($zp_error)) {
        //         foreach ($zp_error as $error) {
        //             flash(translate($error))->error();
        //         }
        //         return redirect()->route('cart');
        //     }
        // }

        // foreach ($carts as $key => $cartItem) {
        //     $cartItem->address_id = $request->address_id;
        //     $cartItem->save();
        // }

        // $carrier_list = array();
        // if(get_setting('shipping_type') == 'carrier_wise_shipping'){
        //     $zone = \App\Models\Country::where('id',$carts[0]['address']['country_id'])->first()->zone_id;

        //     $carrier_query = Carrier::query();
        //     $carrier_query->whereIn('id',function ($query) use ($zone) {
        //         $query->select('carrier_id')->from('carrier_range_prices')
        //         ->where('zone_id', $zone);
        //     })->orWhere('free_shipping', 1);
        //     $carrier_list = $carrier_query->get();
        // }

        // return view('frontend.delivery_info', compact('carts','carrier_list'));


        if ($request->address_id == null) {
            return response()->json([
                'success' => false,
                'errors' => ['Please add shipping address']
            ]);
        }

        $carts = Cart::where('user_id', Auth::user()->id)->get();
        if($carts->isEmpty()) {
            return response()->json([
                'success' => false,
                'errors' => ['Your cart is empty']
            ]);
        }

        // Zipcode availability check
        $zp_error = [];
        if (!empty($request->address_id)) {
            $shipping_info = Address::where('id', $request->address_id)->first();

            foreach ($carts as $cartItem) {
                $product = Product::find($cartItem->product_id);
                $zp = DB::table('zipcode_availibility')->where('id', json_decode($product->zipcode_availibility_id))->first();

                if ($zp) {
                    $type = $zp->type;
                    $zipcodes = json_decode($zp->zipcode);

                    if ($type == 'allow' && !in_array($shipping_info->postal_code, $zipcodes)) {
                        $zp_error[] = $product->name . ' Not deliverable at ' . $shipping_info->postal_code;
                    }
                }
            }

            if (!empty($zp_error)) {
                return response()->json([
                    'success' => false,
                    'errors' => $zp_error
                ]);
            }
        }

        foreach ($carts as $cartItem) {
            $cartItem->address_id = $request->address_id;
            $cartItem->save();
        }

        $carrier_list = [];
        if (get_setting('shipping_type') == 'carrier_wise_shipping') {
            $zone = \App\Models\Country::where('id', $carts[0]->address->country_id)->first()->zone_id;

            $carrier_query = Carrier::query();
            $carrier_query->whereIn('id', function ($query) use ($zone) {
                $query->select('carrier_id')->from('carrier_range_prices')
                      ->where('zone_id', $zone);
            })->orWhere('free_shipping', 1);
            $carrier_list = $carrier_query->get();
        }

        return response()->json([
            'success' => true,
            'view' => view('frontend.partials.cart_summary2', compact('carts', 'carrier_list'))->render()
        ]);

    }

    public function store_delivery_info2(Request $request)
    {
        $carts = Cart::where('user_id', Auth::user()->id)
                ->get();

        if($carts->isEmpty()) {
            return response()->json([
                'success' => false,
                'errors' => ['Your cart is empty']
            ]);
        }

        $shipping_info = Address::where('id', $carts[0]['address_id'])->first();
        $total = 0;
        $tax = 0;
        $shipping = 0;
        $subtotal = 0;
        $charges = 0; // Initialize charges
        $a=0;


        if ($carts && count($carts) > 0) {


           /*$zipcode_availability = DB::table('zipcode_availibility')
            ->whereJsonContains('zipcode', ["$shipping_info->postal_code"])
            ->orderBy('charges', 'desc')
            ->select('charges')
            ->first();


            if ($zipcode_availability) {
                $charges = intval($zipcode_availability->charges);
                // Log the charges
                \Illuminate\Support\Facades\Log::info('Charges retrieved from zipcode_availibility: ' . $charges);

            } else {
                // Log if no charges found
                \Illuminate\Support\Facades\Log::info('No charges found for zipcode: ' . $shipping_info->postal_code);
            }*/
                // Add charges to shipping
                $shipping += $charges;

            foreach ($carts as $key => $cartItem) {
                $product = Product::find($cartItem['product_id']);
                $tax += cart_product_tax($cartItem, $product,false) * $cartItem['quantity'];
                $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];

                if(get_setting('shipping_type') != 'carrier_wise_shipping' || $request['shipping_type_' . $product->user_id] == 'pickup_point'){
                    if ($request['shipping_type_' . $product->user_id] == 'pickup_point') {
                        $cartItem['shipping_type'] = 'pickup_point';
                        $cartItem['pickup_point'] = $request['pickup_point_id_' . $product->user_id];
                    } else {
                        $cartItem['shipping_type'] = 'home_delivery';
                    }
                    $cartItem['shipping_cost'] = 0;
                    if ($cartItem['shipping_type'] == 'home_delivery') {

                        // $cartItem['shipping_cost'] = getShippingCost($carts, $key);
                        if($a == 0){
                            if($product->shipping_type != 'free'){
                                $cartItem['shipping_cost'] = getShippingCost($carts, $key) + $charges;
                                $a++;
                            }
                        }else{
                                $cartItem['shipping_cost'] = getShippingCost($carts, $key);
                        }
                    }
                }
                else{
                    $cartItem['shipping_type'] = 'carrier';
                    $cartItem['carrier_id'] = $request['carrier_id_' . $product->user_id];
                    $cartItem['shipping_cost'] = getShippingCost($carts, $key, $cartItem['carrier_id']);
                }

                $shipping += $cartItem['shipping_cost'];
                $cartItem->save();
            }
            $total = $subtotal + $tax + $shipping + $charges;

            return view('frontend.payment_select2', compact('carts', 'shipping_info', 'total'));

        } else {
            return response()->json([
                'success' => false,
                'errors' => ['Your cart is empty']
            ]);
        }
    }

    public function store_delivery_info(Request $request)
    {
        $carts = Cart::where('user_id', Auth::user()->id)
                ->get();

        if($carts->isEmpty()) {
            // flash(translate('Your cart is empty'))->warning();
            // return redirect()->route('home');
            return response()->json([
                'success' => false,
                'errors' => ['Your cart is empty']
            ]);
        }

        $shipping_info = Address::where('id', $carts[0]['address_id'])->first();
        $total = 0;
        $tax = 0;
        $shipping = 0;
        $subtotal = 0;
        $subtotal_offer = 0;
        $charges = 0; // Initialize charges
        $nightCharge = 0;
        $a=0;


        if ($carts && count($carts) > 0) {


           $zipcode_availability = DB::table('zipcode_availibility')
            ->whereJsonContains('zipcode', $shipping_info->postal_code ?? '')
            ->orderBy('charges', 'desc')
            ->select('charges')
            ->first();


            if ($zipcode_availability) {
                $charges = intval($zipcode_availability->charges);
                // Log the charges
                // \Illuminate\Support\Facades\Log::info('Charges retrieved from zipcode_availibility: ' . $charges);

            } else {
                // Log if no charges found
                // \Illuminate\Support\Facades\Log::info('No charges found for zipcode: ' . ($shipping_info->postal_code ?? ''));
            }
                // Retrieve night charges based on delivery time selected
                $selectedTimeSlot = $request->input('delivery_time');
                // Log the selected delivery time
                // \Illuminate\Support\Facades\Log::info('Selected delivery time: ' . $selectedTimeSlot);
                $nightChargeSlots = ['8:00 PM - 11:00 PM', '9:00 PM - 12:00 PM'];


                if (in_array($selectedTimeSlot, $nightChargeSlots)) {
                    // Log the selected delivery time
                    // \Illuminate\Support\Facades\Log::info('Selected delivery time2: ' . $selectedTimeSlot);
                    // \Illuminate\Support\Facades\Log::info('Night Charge slots: ' . json_encode($nightChargeSlots));
                    $nightCharge = $this->getNightCharge();
                    // \Illuminate\Support\Facades\Log::info('Night Charge: ' . $nightCharge);
                }


                // Add Night charges to shipping
                $shipping += $nightCharge;
                // Add charges to shipping
                \Illuminate\Support\Facades\Log::info('charges: ' . $charges);
                $shipping += $charges;
                \Illuminate\Support\Facades\Log::info('shipping cost after adding night + charges: ' . $shipping);
            foreach ($carts as $key => $cartItem) {
                $product = Product::find($cartItem['product_id']);
                $tax += cart_product_tax($cartItem, $product,false) * $cartItem['quantity'];
                $subtotal_offer += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];
            }

            foreach ($carts as $key => $cartItem) {
                $product = Product::find($cartItem['product_id']);
                $tax += cart_product_tax($cartItem, $product,false) * $cartItem['quantity'];
                $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];

                if(get_setting('shipping_type') != 'carrier_wise_shipping' || $request['shipping_type_' . $product->user_id] == 'pickup_point'){
                    if ($request['shipping_type_' . $product->user_id] == 'pickup_point') {
                        $cartItem['shipping_type'] = 'pickup_point';
                        $cartItem['pickup_point'] = $request['pickup_point_id_' . $product->user_id];
                    } else {
                        $cartItem['shipping_type'] = 'home_delivery';
                    }
                    $cartItem['shipping_cost'] = 0;
                    if ($cartItem['shipping_type'] == 'home_delivery') {

                        // $cartItem['shipping_cost'] = getShippingCost($carts, $key);

                        // if($a == 0){
                        //     if($product->shipping_type != 'free'){
                        //         $cartItem['shipping_cost'] = getShippingCost($carts, $key) + $charges;
                        //         $a++;
                        //     }
                        // }else{
                        //         $cartItem['shipping_cost'] = getShippingCost($carts, $key);
                        // }

                        if ($a == 0) {
                            if ($product->shipping_type != 'free') {

                                $current_date = time();
                                $offer_start_date = strtotime('2024-10-28 00:00:00');
                                $offer_end_date = strtotime('2024-11-03 23:59:59');

                                // var_dump($subtotal_offer);
                                // var_dump($current_date);
                                // var_dump($offer_start_date);
                                // var_dump($offer_end_date);

                                if ($subtotal_offer >= 10000 && $current_date >= $offer_start_date && $current_date <= $offer_end_date) {

                                    // var_dump('working');

                                    $cartItem['shipping_cost'] = getShippingCost($carts, $key);
                                    $a++;
                                } else {

                                    // var_dump('not working');
                                    $cartItem['shipping_cost'] = getShippingCost($carts, $key) + $charges + $nightCharge;
                                    $a++;
                                }

                            } else {
                                $cartItem['shipping_cost'] = getShippingCost($carts, $key);
                            }
                        } else {
                            $cartItem['shipping_cost'] = getShippingCost($carts, $key);
                        }

                    }
                }
                else{
                    $cartItem['shipping_type'] = 'carrier';
                    $cartItem['carrier_id'] = $request['carrier_id_' . $product->user_id];
                    $cartItem['shipping_cost'] = getShippingCost($carts, $key, $cartItem['carrier_id']);
                }

                $shipping += $cartItem['shipping_cost'];
                $cartItem->save();
            }
             $total = $subtotal + $tax + $shipping + $charges + $nightCharge;

            return response()->json([
                'success' => true,
                'view' => view('frontend.partials.cart_summary2', compact('carts'))->render()
            ]);

            // return view('frontend.payment_select', compact('carts', 'shipping_info', 'total'));

        } else {
            // flash(translate('Your Cart was empty'))->warning();
            // return redirect()->route('home');
            return response()->json([
                'success' => false,
                'errors' => ['Your cart is empty']
            ]);
        }
    }

    // Function to retrieve night charge from the database
    private function getNightCharge()
    {
        $nightChargeSetting = DB::table('business_settings')
            ->where('type', 'night_charge')
            ->first();

        return $nightChargeSetting ? intval($nightChargeSetting->value) : 0;
    }

    public function apply_coupon_code(Request $request)
    {
        $coupon = Coupon::where('code', $request->code)->first();
        $response_message = array();

        if ($coupon != null) {
            if (strtotime(date('d-m-Y')) >= $coupon->start_date && strtotime(date('d-m-Y')) <= $coupon->end_date) {
                if (CouponUsage::where('user_id', Auth::user()->id)->where('coupon_id', $coupon->id)->first() == null) {
                    $coupon_details = json_decode($coupon->details);

                    $carts = Cart::where('user_id', Auth::user()->id)
                                    ->where('owner_id', $coupon->user_id)
                                    ->get();

                    $coupon_discount = 0;

                    $subtotal = 0;

                    foreach ($carts as $key => $cartItem) {
                        $product = Product::find($cartItem['product_id']);
                        $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];
                    }

                    $sum = $subtotal;
                    $product = '';


                    if ($coupon->type == 'cart_base') {
                        $subtotal = 0;
                        $tax = 0;
                        $shipping = 0;
                        foreach ($carts as $key => $cartItem) {
                            $product = Product::find($cartItem['product_id']);
                            $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];
                            $tax += cart_product_tax($cartItem, $product,false) * $cartItem['quantity'];
                            $shipping += $cartItem['shipping_cost'];
                        }
                        $sum = $subtotal + $tax + $shipping;
                        if ($sum >= $coupon_details->min_buy) {
                            if ($coupon->discount_type == 'percent') {
                                $coupon_discount = ($sum * $coupon->discount) / 100;
                                if ($coupon_discount > $coupon_details->max_discount) {
                                    $coupon_discount = $coupon_details->max_discount;
                                }
                            } elseif ($coupon->discount_type == 'amount') {
                                $coupon_discount = $coupon->discount;
                            }

                        }
                    } elseif ($coupon->type == 'product_base') {
                        foreach ($carts as $key => $cartItem) {
                            $product = Product::find($cartItem['product_id']);
                            foreach ($coupon_details as $key => $coupon_detail) {
                                if ($coupon_detail->product_id == $cartItem['product_id']) {
                                    if ($coupon->discount_type == 'percent') {

                                        $current_date = time();
                                        $offer_start_date = strtotime('2024-10-28 00:00:00');
                                        $offer_end_date = strtotime('2024-11-03 23:59:59');

                                        if ($sum >= 10000 && $current_date >= $offer_start_date && $current_date <= $offer_end_date) {

                                            // var_dump('working 1');

                                            $coupon_discount += (cart_product_price($cartItem, $product, false, false) * 10 / 100) * $cartItem['quantity'];

                                        } elseif ( $sum <= 10000 && $current_date >= $offer_start_date && $current_date <= $offer_end_date ) {

                                            // var_dump('working 2');

                                            $coupon_discount += (cart_product_price($cartItem, $product, false, false) * 5 / 100) * $cartItem['quantity'];

                                        } else {

                                            // var_dump('working 3');

                                            $coupon_discount += (cart_product_price($cartItem, $product, false, false) * $coupon->discount / 100) * $cartItem['quantity'];

                                        }

                                        // $coupon_discount += (cart_product_price($cartItem, $product, false, false) * $coupon->discount / 100) * $cartItem['quantity'];

                                    } elseif ($coupon->discount_type == 'amount') {
                                        $coupon_discount += $coupon->discount * $cartItem['quantity'];
                                    }
                                }
                            }
                        }
                    }

                    // var_dump($coupon_discount);

                    if($coupon_discount > 0){
                        Cart::where('user_id', Auth::user()->id)
                            ->where('owner_id', $coupon->user_id)
                            ->update(
                                [
                                    'discount' => $coupon_discount / count($carts),
                                    'coupon_code' => $request->code,
                                    'coupon_applied' => 1
                                ]
                            );
                        $response_message['response'] = 'success';
                        $response_message['message'] = translate('Coupon has been applied');
                    }
                    else{
                        $response_message['response'] = 'warning';
                        $response_message['message'] = translate('This coupon is not applicable to your cart products!');
                    }

                } else {
                    $response_message['response'] = 'warning';
                    $response_message['message'] = translate('You already used this coupon!');
                }
            } else {
                $response_message['response'] = 'warning';
                $response_message['message'] = translate('Coupon expired!');
            }
        } else {
            $response_message['response'] = 'danger';
            $response_message['message'] = translate('Invalid coupon!');
        }

        $carts = Cart::where('user_id', Auth::user()->id)
                ->get();
        $shipping_info = Address::where('id', $carts[0]['address_id'])->first();

        $returnHTML = view('frontend.partials.cart_summary', compact('coupon', 'carts', 'shipping_info'))->render();
        return response()->json(array('response_message' => $response_message, 'html'=>$returnHTML));
    }

    public function remove_coupon_code(Request $request)
    {
        Cart::where('user_id', Auth::user()->id)
                ->update(
                        [
                            'discount' => 0.00,
                            'coupon_code' => '',
                            'coupon_applied' => 0
                        ]
        );

        $coupon = Coupon::where('code', $request->code)->first();
        $carts = Cart::where('user_id', Auth::user()->id)
                ->get();

        $shipping_info = Address::where('id', $carts[0]['address_id'])->first();

        return view('frontend.partials.cart_summary', compact('coupon', 'carts', 'shipping_info'));
    }

    public function apply_club_point(Request $request) {
        if (addon_is_activated('club_point')){

            $point = $request->point;

            if(Auth::user()->point_balance >= $point) {
                $request->session()->put('club_point', $point);
                flash(translate('Point has been redeemed'))->success();
            }
            else {
                flash(translate('Invalid point!'))->warning();
            }
        }
        return back();
    }

    public function remove_club_point(Request $request) {
        $request->session()->forget('club_point');
        return back();
    }

    public function order_confirmed()
    {
        $combined_order = CombinedOrder::findOrFail(Session::get('combined_order_id'));

        Cart::where('user_id', $combined_order->user_id)
                ->delete();

        //Session::forget('club_point');
        //Session::forget('combined_order_id');

        foreach($combined_order->orders as $order){
            NotificationUtility::sendOrderPlacedNotification($order);
        }

        return view('frontend.order_confirmed', compact('combined_order'));
    }
}

