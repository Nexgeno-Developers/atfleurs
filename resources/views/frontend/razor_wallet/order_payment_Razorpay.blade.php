@extends('frontend.layouts.app')

@section('content')

    <form action="{!!route('payment.rozer')!!}" method="POST" id='rozer-pay' style="display: none;">
        <!-- Note that the amount is in paise = 50 INR -->
        <!--amount need to be in paisa-->
        <script src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="{{ env('RAZOR_KEY') }}"
                data-amount={{round($combined_order->grand_total) * 100}}
                data-buttontext=""
                data-name="{{ env('APP_NAME') }}"
                data-description="Cart Payment"
                data-image="{{ uploaded_asset(get_setting('header_logo')) }}"
                data-prefill.name="{{ Auth::user()->name}}"
                data-prefill.email="{{ Auth::user()->email ?? ''}}"
                data-notes.combined_order_id="{{ $combined_order->id }}"
                data-notes.user_id="{{ Auth::id() }}"
                data-notes.payment_type="{{ $paymentType }}"
                data-theme.color="#ff7529">
        </script>
        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
    </form>

    {{-- <section class="mb-4"> 
        <div class="container"> 
            <div class="p-4 bg-white rounded shadow-sm overflow-hidden mw-100 text-left" style="margin-top: 20px; display: flex; justify-content: center; align-items: center;"> 
                <a href="{{ route('cart') }}" class="btn btn-primary" style="padding: 10px 20px; font-size: 14px;">Back To Cart</a> 
            </div> 
        </div> 
    </section> --}}

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#rozer-pay').submit()
        });
    </script>
@endsection
