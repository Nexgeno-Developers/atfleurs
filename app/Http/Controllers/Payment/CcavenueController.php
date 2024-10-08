<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerPackageController;
use App\Http\Controllers\SellerPackageController;
use App\Http\Controllers\WalletController;
use Illuminate\Http\Request;
use App\Models\CombinedOrder;
use App\Models\Order;
use App\Models\CustomerPackage;
use App\Models\SellerPackage;
use Session;
use Redirect;
use Auth;
use Carbon\Carbon;
use DB;

class CcavenueController extends Controller
{

    public function pay()
    {
        if(Session::has('payment_type')) {
            if(Session::get('payment_type') == 'cart_payment') 
            {
                //payment gateway environment    
                $formUrl = (get_setting('ccavenue_sandbox') == 1) ? env('CCAVENUE_SANDBOX') : env('CCAVENUE_PRODUCTION');
                   
                //order details
                $order   = Order::where('combined_order_id', Session::get('combined_order_id'))->first();
                $shipping_address = json_decode($order->shipping_address);
                
                //ccavenue form data
                $params = 
                [
                    'tid'                 => time(),
                    'merchant_id'         => env('CCAVENUE_MERCHANT_ID'),
                    'order_id'            => $order->code,
                    'amount'              => $order->grand_total,
                    'currency'            => 'INR',
                    'redirect_url'        => route('ccavenue.response', $order->id),
                    'cancel_url'          => route('ccavenue.cancel', $order->id),
                    'language'            => 'EN',
                    'billing_name'        => $shipping_address->name,
                    'billing_address'     => $shipping_address->address,
                    'billing_city'        => $shipping_address->city,
                    'billing_state'       => $shipping_address->state,
                    'billing_zip'         => $shipping_address->postal_code,
                    'billing_country'     => $shipping_address->country,
                    'billing_tel'         => $shipping_address->phone ? $shipping_address->phone : env('APP_PHONE'),
                    'billing_email'       => $shipping_address->email ? $shipping_address->email : env('APP_EMAIL'),
                    'delivery_name'       => $shipping_address->name,
                    'delivery_address'    => $shipping_address->address,
                    'delivery_city'       => $shipping_address->city,
                    'delivery_state'      => $shipping_address->state,
                    'delivery_zip'        => $shipping_address->postal_code,
                    'delivery_country'    => $shipping_address->country,
                    'delivery_tel'        => $shipping_address->phone ? $shipping_address->phone : env('APP_PHONE'),
                    'merchant_param1'     => $order->id,
                    'merchant_param2'     => $order->user_id,
                    'merchant_param3'     => $order->combined_order_id,
                    'merchant_param4'     => 'cart_payment',
                    'merchant_param5'     => '-',
                    'promo_code'          => '',
                    'customer_identifier' => '',
                ];
                    
                $merchant_data = '';
            	foreach ($params as $key => $value){
            		$merchant_data.=$key.'='.$value.'&';
            	}
    
                $encrypted_data = $this->encrypt($merchant_data, env('CCAVENUE_KEY'));
                $access_code = env('CCAVENUE_CODE');
                    
                //pass all from data to view
                return view('frontend.ccavenue.order_payment_Ccavenue', compact('encrypted_data', 'formUrl', 'access_code'));
            }
            /*elseif (Session::get('payment_type') == 'wallet_payment') {
                $amount = Session::get('payment_data')['amount'];
            }
            elseif (Session::get('payment_type') == 'customer_package_payment') {
                $customer_package = CustomerPackage::findOrFail(Session::get('payment_data')['customer_package_id']);
                $amount = $customer_package->amount;
            }
            elseif (Session::get('payment_type') == 'seller_package_payment') {
                $seller_package = SellerPackage::findOrFail(Session::get('payment_data')['seller_package_id']);
                $amount = $seller_package->amount;
            }*/
        }
    }

    public function paymentResponse(Request $request)
    {
        $paymentDetails = $this->extractPaymentDetail($_POST);
        
        //return $paymentDetails;
    	
    	$orderId         = explode('=', $paymentDetails[0])[1];
    	$orderStatus     = explode('=', $paymentDetails[3])[1];
    	$paymentType     = explode('=', $paymentDetails[29])[1];
    	$combinedOrderId = explode('=', $paymentDetails[28])[1];
    	$userId          = explode('=', $paymentDetails[27])[1];
    	
    	//relogin if user session lost
    	if(!Auth::user()) {
    	    Auth::loginUsingId($userId);
    	}
    	
    	if($orderStatus==="Success")
    	{
            if($paymentType == 'cart_payment'){ //cart_payment
                return (new CheckoutController)->checkout_done($combinedOrderId, json_encode($paymentDetails));
            }		
    	}else{
    	    //return $this->paymentFailure($request, $orderStatus);
    	    return redirect(route('ccavenue.paymentFailure', ['orderStatus' => $orderStatus, 'orderId' => $orderId]));
    	}
    }
    
    public function paymentFailure($orderStatus, $orderId)
    {
        if($orderStatus === "Aborted") {
            $message = "Thank you for shopping with us.We will keep you posted regarding the status of your order through E-mail & SMS";
        }elseif($orderStatus === "Failure"){
            $message = "Thank you for shopping with us.However,the transaction has been declined.";
        }else{
            $message = "Security Error. Illegal access detected";
        }
        
        request()->session()->forget('order_id');
        request()->session()->forget('payment_data');        
        return view('frontend.ccavenue.failure', compact('message', 'orderId'));
    }   
    
    /*public function paymentFailure($request, $orderStatus)
    {
        if($orderStatus === "Aborted") {
            $message = "Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
        }elseif($orderStatus === "Failure"){
            $message = "Thank you for shopping with us.However,the transaction has been declined.";
        }else{
            $message = "Security Error. Illegal access detected";
        }
        $request->session()->forget('order_id');
        $request->session()->forget('payment_data');
        flash(translate($message))->warning();
    	return redirect()->route('home');        
    }*/

    public function paymentCancel(Request $request)
    {
    	$paymentDetails = $this->extractPaymentDetail($_POST);
    	$userId = explode('=', $paymentDetails[27])[1];
    	
    	//relogin if user session lost
    	if(!Auth::user()) {
    	    Auth::loginUsingId($userId);
    	}
    	
        $request->session()->forget('order_id');
        $request->session()->forget('payment_data');
        flash(translate('Payment cancelled'))->warning();
    	return redirect()->route('home');
    }
    
    public function paymentWebhook1(Request $request) {
        
        //here is my working code
        $paymentDetails  = $this->extractPaymentDetail($_POST);
    	$orderId         = explode('=', $paymentDetails[0])[1];
    	$orderStatus     = explode('=', $paymentDetails[3])[1];
    	$paymentType     = explode('=', $paymentDetails[29])[1];
    	$combinedOrderId = explode('=', $paymentDetails[28])[1];
    	$userId          = explode('=', $paymentDetails[27])[1];
    	
        //This code is just to check if webhook is working or not (it make .txt file in public HTML)
        $filename = "public/webhook/".$orderId.date('Y-m-d-H-i-s').".txt";
        $myfile = fopen($filename, "w") or die("Unable to open file!");
        $txt = json_encode($paymentDetails);
        fwrite($myfile, $txt);
        fclose($myfile);     	
    	
    	if($orderStatus==="Success")
    	{
            if($paymentType == 'cart_payment'){ //cart_payment
        	    $order = Order::where('combined_order_id', $combinedOrderId)->first();
        	    if(isset($order->payment_status)){
        	        if($order->payment_status == 'unpaid'){
        	            return (new CheckoutController)->checkout_done($combinedOrderId, json_encode($paymentDetails));
        	        }
        	    }                
            }    
    	}
    }
    
    public function statusCheck(Request $request) {
        error_reporting(0);
        $working_key = env('CCAVENUE_KEY');
        $access_code = env('CCAVENUE_CODE');
        
        $merchant_json_data =
        array(
        	'order_no'     => '20230715-11283178',
        	'reference_no' =>'1689420559506'
        );
        
        $merchant_data = json_encode($merchant_json_data);
        $encrypted_data = $this->encrypt($merchant_data, $working_key);
        $final_data = 'enc_request='.$encrypted_data.'&access_code='.$access_code.'&command=orderStatusTracker&request_type=JSON&response_type=JSON';
        
        //return $final_data;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://apitest.ccavenue.com/apis/servlet/DoWebTrans");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']) ;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $final_data);
        // Get server response ...
        $result = curl_exec($ch);
        curl_close($ch);
        $status = '';
        $information = explode('&', $result);
        
        $dataSize = sizeof($information);
        for ($i = 0; $i < $dataSize; $i++) {
        	$info_value = explode('=', $information[$i]);
        	if ($info_value[0] == 'enc_response') {
        		$status = $this->decrypt(trim('88ec5db5c38a2c1ed4bac22d1b9852985f63ca36fd453aceafa2ddbed73a7e988fdf77b48e677084cdc5bd5afae0bd0f7d0016e7f5916d7589fb04302ebbbe03588f8b14093e1ecf390cf76d8826dddf52bb3f2fb9fb50d27df302c247118ff20b49044a2ac6a1051c9c7f81bca9c2317ed41f62b022f183d1f97514906b8e49d28427e64fd6ed15e3f307ad995b7ae85c9c9db7e40ab50f29a6c2e8e8c388db5c311b8e8cb7fcaa72848ebc1365bdc41627fbe8501e52f0da5e4835e3b9de256ef80890e2375281ce528419b5106daf017beca4cfeaa70def9de9708662caf174ef8047caceb92554d0117c713d9992b1c5ae8cc5e85bfd8bee85d72a2189a3bd04c44ef8ecd1001f7faddfbeda8d2323b51b4b33360e573a60c96f28bc71c06691f4582ba0fb95185df004f815be39f4ac7738da2493f901d41375fe178807f7ab744914fb43f87d80b855eb7ed995d97bce72b664d994702a18cc0039b989ba040d174416b5faf5329d2fc755f8691696dfe1375a2465137cdbe4f62d3d7b4db2c487c36841833f73077df6dc1ab1a5aef5dbb93a1fd784bb0e95c27f96028dd58d85ca26da78b17fd0c00f9b71ff73689583070a282301d20ba9b37d881d6cb3ba8300029907f498ce06c9de8d1118bb219a4150e658350087d38fb634d5b33e007ca2158d650775ba6da5ca84b978f1afe415de2140078d897c1e38344edd03d4a447be8d70d407e606f1073fd857487608613741759f1b9704b2941052406e7c534afae3b1a87b40fd75ccd16b2ce289364f10deac86e3298cfc7a45a56b3a7fde1d1a6468da8cf0f93acb8b2c25260ccc9fa7c588e5012346da974a942d28ea8cfe3d9f4983ba7192baa5ba285615ba30adf0e90416fac46e35384500478258d3f13ff73a08c9ece481f2b4fbab6b4d4744f0ebb4fd1e0560d2c88d986bf075c5c2ea9aabcf8d84e157585d4a8741cbd3028512014bd58829da7abdd6ddaa3645a69cb28f6e889f7eee07236a34eb83c79d67d03301aa5439b3e34eef5b11d2b2c2782c9d8314f7abcbee1fd5c28f8beb0b4cf3408e0764201ff25e13aba1227b18fed55c92ef2ab3b9c8e454c1ca3e60d6c7066b2f96f65f1fc89d844080369497765efbac3d6d2105542fb9f9f62e90e8534505a7b88588cada4c74cf23435802689de46d2d87a5cbf64ab6487a4730b8ec731a07dc109b54809f232cf606400f21e1210eb6c2410112e36940b5cf59a1719f04a846a55726d286ad8d3076bd26f368b19c99ec775ac5090e6dac4e60173199e5230bd4211864f42732f5438c31c75fe1ce91ee75ccea4768d65dae4d80062f7a25f640eac14da057c7494d940598bd51c86d93b7247c05eb7a095d58505b9f65d8f87361c8d1a94753a033a8879d1b3bc6a01d5f9677b4eade057392f60d4e566f8ead8611e4b200751f4e2a759cca21a5aa0757a22a5b827be18a35c4e0e7617a7ee5add99609df133cacd660d2c87421cd0fe810f4eacdd3701e7047b5a70a284f83923bf3a56a2cf40d4cd8f8210eb34a864b614b65304eb518d68557a327a9a1d59d4ce695856347e021964092fae8491b59d94d50982731ae657a3ce0a5f050db2d8691d3895591f37d3d1d6b1c41a4322229c68cdd7f33cc9c398c7906a82a787daea518eead3c2dd218a5a76711b53b7962298db878d1bd562ebc9771a0eb11aef0f89f01fcad6b6f8ea7f9601ddd0a4b557e8d56281142d724513ba0aa351a9ee45e56b8b6168d21971d88829882b95816950798730047bebe0cb26e0f6fd2d1806ebdf90cb2c1bff48b7b30ba8b2700801c9dfd806377c15ea72fdc8b78437ab58de492'), $working_key);
        		
        	}
        }
        
        echo 'Status revert is: ' . $status.'<pre>';
        $obj = json_decode($status);
        //print_r($result);
        //print_r($obj);
    }
    
    public function extractPaymentDetail($post) {
    	$workingKey     = env('CCAVENUE_KEY'); //Working Key
    	$encResponse    = $post["encResp"]; //response sent by the CCAvenue Server
    	$rcvdString     = $this->decrypt($encResponse,$workingKey);	//Crypto Decryption used as per the specified working key.
    	$order_status   = "";
    	$decryptValues  = explode('&', $rcvdString);
    	$dataSize       = sizeof($decryptValues);
    	
    	$paymentDetails = [];
    	for($i = 0; $i < $dataSize; $i++): 
    		$paymentDetails[] = $decryptValues[$i];
        endfor; 
        
        return $paymentDetails;
    }
    
    /*
    * @param1 : Plain String
    * @param2 : Working key provided by CCAvenue
    * @return : Decrypted String
    */
    public function encrypt($plainText,$key)
    {
    	$key = $this->hextobin(md5($key));
    	$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    	$openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
    	$encryptedText = bin2hex($openMode);
    	return $encryptedText;
    }

    /*
    * @param1 : Encrypted String
    * @param2 : Working key provided by CCAvenue
    * @return : Plain String
    */
    public function decrypt($encryptedText,$key)
    {
    	$key = $this->hextobin(md5($key));
    	$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    	$encryptedText = $this->hextobin($encryptedText);
    	$decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
    	return $decryptedText;
    }

    public function hextobin($hexString) 
    { 
        $length = strlen($hexString); 
        $binString="";   
        $count=0; 
        
        while($count<$length) 
        {       
                $subString =substr($hexString,$count,2);           
                $packedString = pack("H*",$subString); 
            if ($count==0)
            {
                $binString=$packedString;
            } 
            else 
            {
                $binString.=$packedString;
            } 
            
            $count+=2; 
        } 
        return $binString; 
    }    
}
