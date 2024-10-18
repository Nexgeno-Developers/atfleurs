@extends('frontend.layouts.app')

@section('content')

<style>
    .right-20 {
    right: 20px;
}
    .top-15 {
    top: 15px;
}


</style>
    <section class="mb-4 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="row aiz-steps arrow-divider">
                        <div class="col done">
                            <div class="text-success text-center">
                                <i class="la-3x las la-shopping-cart mb-2"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('1. My Cart') }}</h3>
                            </div>
                        </div>
                        {{-- <div class="col done">
                            <div class="text-success text-center">
                                <i class="la-3x las la-map mb-2"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('2. Shipping info') }}</h3>
                            </div>
                        </div>
                        <div class="col done">
                            <div class="text-success text-center">
                                <i class="la-3x las la-truck mb-2"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('3. Delivery info') }}</h3>
                            </div>
                        </div> --}}
                        <div class="col active">
                            <div class="text-primary text-center">
                                <i class="la-3x las la-credit-card mb-2"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('3. Payment') }}</h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center">
                                <i class="la-3x las la-check-circle mb-2 opacity-50"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('4. Confirmation') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-4">
        <div class="container text-left">
            <div class="row">
                <div class="col-lg-8">
                    <div class="accordion" id="accordioncCheckoutInfo">

                        <!-- Shipping Info -->
                        <div class="card rounded-0 border shadow-none" style="margin-bottom: 1rem;">
                            <div class="card-header border-bottom-0 py-3 py-xl-4" id="headingShippingInfo" type="button"
                                data-toggle="collapse" data-target="#collapseShippingInfo" aria-expanded="true"
                                aria-controls="collapseShippingInfo">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 20 20">
                                        <path id="Path_42357" data-name="Path 42357"
                                            d="M58,48A10,10,0,1,0,68,58,10,10,0,0,0,58,48ZM56.457,61.543a.663.663,0,0,1-.423.212.693.693,0,0,1-.428-.216l-2.692-2.692.856-.856,2.269,2.269,6-6.043.841.87Z"
                                            transform="translate(-48 -48)" fill="#9d9da6" />
                                    </svg>
                                    <span class="ml-2 fs-19 fw-700">{{ translate('Shipping Info') }}</span>
                                </div>
                                <i class="las la-angle-down fs-18"></i>
                            </div>
                            <div id="collapseShippingInfo" class="collapse show" aria-labelledby="headingShippingInfo"
                                data-parent="#accordioncCheckoutInfo">
                                <div class="card-body py-0" id="shipping_info">
                                    <form class="form-default address-form" data-toggle="validator"
                                        action="{{ route('checkout.store_shipping_infostore') }}" role="form"
                                        method="POST">
                                        @csrf
                                        @if (Auth::check())
                                            <div class="shadow-sm bg-white rounded mb-4">
                                                <div class="row gutters-5">
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                    @if(Auth::user()->addresses != null)
                                                        @foreach (Auth::user()->addresses as $key => $address)
                                                            <div class="col-md-6 mb-0 p-2">
                                                                <label class="aiz-megabox d-block bg-white mb-0">
                                                                    <input type="radio" name="address_id"
                                                                        value="{{ $address->id }}"
                                                                        @if ($address->set_default || (isset($carts[0]->address_id) && $carts[0]->address_id == $address->id)) checked @endif
                                                                        required>
                                                                    <span class="d-flex p-3 aiz-megabox-elem">
                                                                        <span
                                                                            class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                        <span class="flex-grow-1 pl-2 text-left">
                                                                            <div>
                                                                                <span
                                                                                    class="opacity-60">{{ translate('Address') }}:</span>
                                                                                <span
                                                                                    class="fw-600 ml-2">{{ $address->address }}</span>
                                                                            </div>
                                                                            <div>
                                                                                <span
                                                                                    class="opacity-60">{{ translate('Postal Code') }}:</span>
                                                                                <span
                                                                                    class="fw-600 ml-2">{{ $address->postal_code }}</span>
                                                                            </div>
                                                                            <div>
                                                                                <span
                                                                                    class="opacity-60">{{ translate('City') }}:</span>
                                                                                <span
                                                                                    class="fw-600 ml-2">{{ optional($address->city)->name }}</span>
                                                                            </div>
                                                                            <div>
                                                                                <span
                                                                                    class="opacity-60">{{ translate('State') }}:</span>
                                                                                <span
                                                                                    class="fw-600 ml-2">{{ optional($address->state)->name }}</span>
                                                                            </div>
                                                                            <div>
                                                                                <span
                                                                                    class="opacity-60">{{ translate('Country') }}:</span>
                                                                                <span
                                                                                    class="fw-600 ml-2">{{ optional($address->country)->name }}</span>
                                                                            </div>
                                                                            <div>
                                                                                <span
                                                                                    class="opacity-60">{{ translate('Phone') }}:</span>
                                                                                <span
                                                                                    class="fw-600 ml-2">{{ $address->phone }}</span>
                                                                            </div>
                                                                        </span>
                                                                    </span>
                                                                </label>
                                                                <div class="dropdown position-absolute right-20 top-15">
                                                                    <button class="btn bg-gray px-2" type="button"
                                                                        data-toggle="dropdown">
                                                                        <i class="la la-ellipsis-v"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right"
                                                                        aria-labelledby="dropdownMenuButton">
                                                                        <a class="dropdown-item"
                                                                            onclick="edit_address('{{ $address->id }}')">
                                                                            {{ translate('Edit') }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                     </div>
                                                     </div>
                                                    <input type="hidden" name="checkout_type" value="logged">
                                                    <div class="col-md-2 pl-3 pt-2">
                                                        <div class="border p-3 rounded mb-3 c-pointer text-center bg-white"
                                                            onclick="add_new_address()">
                                                            <i class="las la-plus la-2x mb-3"></i>
                                                            <div class="alpha-7">{{ translate('Add More') }}</div>
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        {{--
                                        <div class="row align-items-center">
                                            <div class="col-md-6 text-center text-md-left order-1 order-md-0">
                                                <a href="{{ route('home') }}" class="btn btn-link">
                                                    <i class="las la-arrow-left"></i>
                                                    {{ translate('Return to shop')}}
                                                </a>
                                            </div>
                                            <div class="col-md-6 text-center text-md-right">
                                                <button type="submit" class="btn btn-primary fw-600">{{ translate('Continue to Delivery Info')}}</a>
                                            </div>
                                        </div>
                                        --}}
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delivery Info -->
                        <div class="card rounded-0 border shadow-none"
                            style="margin-bottom: 1rem; overflow: visible !important;">
                            <div class="card-header border-bottom-0 py-3 py-xl-4" id="headingDeliveryInfo" type="button"
                                data-toggle="collapse" data-target="#collapseDeliveryInfo" aria-expanded="true"
                                aria-controls="collapseDeliveryInfo">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 20 20">
                                        <path id="Path_42357" data-name="Path 42357"
                                            d="M58,48A10,10,0,1,0,68,58,10,10,0,0,0,58,48ZM56.457,61.543a.663.663,0,0,1-.423.212.693.693,0,0,1-.428-.216l-2.692-2.692.856-.856,2.269,2.269,6-6.043.841.87Z"
                                            transform="translate(-48 -48)" fill="#9d9da6" />
                                    </svg>
                                    <span class="ml-2 fs-19 fw-700">{{ translate('Delivery Info') }}</span>
                                </div>
                                <i class="las la-angle-down fs-18"></i>
                            </div>
                            <div id="collapseDeliveryInfo" class="collapse show" aria-labelledby="headingDeliveryInfo"
                                data-parent="#accordioncCheckoutInfo">
                                <div class="card-body py-0" id="delivery_info">
                                    <form class="form-default delivery-type-form"
                                        action="{{ route('checkout.store_delivery_info') }}" role="form"
                                        method="POST">
                                        @csrf
                                        @php
                                            $admin_products = [];
                                            $seller_products = [];
                                            foreach ($carts as $key => $cartItem) {
                                                $product = \App\Models\Product::find($cartItem['product_id']);

                                                if ($product->added_by == 'admin') {
                                                    array_push($admin_products, $cartItem['product_id']);
                                                } else {
                                                    $product_ids = [];
                                                    if (isset($seller_products[$product->user_id])) {
                                                        $product_ids = $seller_products[$product->user_id];
                                                    }
                                                    array_push($product_ids, $cartItem['product_id']);
                                                    $seller_products[$product->user_id] = $product_ids;
                                                }
                                            }

                                            $pickup_point_list = [];
                                            if (get_setting('pickup_point') == 1) {
                                                $pickup_point_list = \App\Models\PickupPoint::where(
                                                    'pick_up_status',
                                                    1,
                                                )->get();
                                            }
                                        @endphp
                                        @if (!empty($admin_products))
                                            <div class="card mb-3 shadow-sm border-0 rounded">
                                                {{-- <div class="card-header p-3">
                                                    <h5 class="fs-16 fw-600 mb-0">{{ get_setting('site_name') }}
                                                        {{ translate('Products') }}</h5>
                                                </div> --}}
                                                <div class="card-body py-0">
                                                    <ul class="list-group list-group-flush">
                                                        @php
                                                            $physical = false;
                                                        @endphp
                                                        @foreach ($admin_products as $key => $cartItem)
                                                            @php
                                                                $product = \App\Models\Product::find($cartItem);
                                                                if ($product->digital == 0) {
                                                                    $physical = true;
                                                                }
                                                            @endphp
                                                            {{-- <li class="list-group-item">
                                                                <div class="d-flex">
                                                                    <span class="mr-2">
                                                                        <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                                            class="img-fit size-60px rounded"
                                                                            alt="{{ $product->getTranslation('name') }}">
                                                                    </span>
                                                                    <span
                                                                        class="fs-14">{{ $product->getTranslation('name') }}</span>
                                                                </div>
                                                            </li> --}}
                                                        @endforeach
                                                    </ul>
                                                    @if ($physical)
                                                        <div class="row ">
                                                            <div class="col-md-6">
                                                                <h6 class="fs-15 fw-600 text-right pt-3">
                                                                    {{ translate('Choose Delivery Type') }}</h6>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row gutters-5">
                                                                    @if (get_setting('shipping_type') != 'carrier_wise_shipping')
                                                                        <div class="col-6">
                                                                            <label
                                                                                class="aiz-megabox d-block bg-white mb-0">
                                                                                <input type="radio"
                                                                                    name="shipping_type_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"
                                                                                    value="home_delivery"
                                                                                    data-owner"{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"
                                                                                    onchange="show_pickup_point(this, 'admin')"
                                                                                    data-target=".pickup_point_id_admin"
                                                                                    required
                                                                                    @if (isset($carts[0]->shipping_type) && $carts[0]->shipping_type == 'home_delivery') checked @endif>
                                                                                <span class="d-flex p-3 aiz-megabox-elem">
                                                                                    <span
                                                                                        class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                                    <span
                                                                                        class="flex-grow-1 pl-3 fw-600">{{ translate('Home Delivery') }}</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    @else
                                                                        <div class="col-6">
                                                                            <label
                                                                                class="aiz-megabox d-block bg-white mb-0">
                                                                                <input type="radio"
                                                                                    name="shipping_type_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"
                                                                                    value="carrier"
                                                                                    onchange="show_pickup_point(this, 'admin')"
                                                                                    data-target=".pickup_point_id_admin">
                                                                                <span class="d-flex p-3 aiz-megabox-elem">
                                                                                    <span
                                                                                        class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                                    <span
                                                                                        class="flex-grow-1 pl-3 fw-600">{{ translate('Carrier') }}</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    @endif

                                                                    @if ($pickup_point_list)
                                                                        <div class="col-6">
                                                                            <label
                                                                                class="aiz-megabox d-block bg-white mb-0">
                                                                                <input type="radio"
                                                                                    name="shipping_type_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"
                                                                                    value="pickup_point"
                                                                                    data-owner="{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"
                                                                                    onchange="show_pickup_point(this, 'admin')"
                                                                                    data-target=".pickup_point_id_admin"
                                                                                    required
                                                                                    @if (isset($carts[0]->shipping_type) && $carts[0]->shipping_type == 'pickup_point') checked @endif>
                                                                                <span class="d-flex p-3 aiz-megabox-elem">
                                                                                    <span
                                                                                        class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                                    <span
                                                                                        class="flex-grow-1 pl-3 fw-600">{{ translate('Local Pickup') }}</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    @endif

                                                                </div>
                                                                @if ($pickup_point_list)
                                                                    <div class="mt-4 pickup_point_id_admin d-none">
                                                                        <select class="form-control aiz-selectpicker"
                                                                            name="pickup_point_id_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"
                                                                            data-live-search="true">
                                                                            <option>
                                                                                {{ translate('Select your nearest pickup point') }}
                                                                            </option>
                                                                            @foreach ($pickup_point_list as $pick_up_point)
                                                                                <option value="{{ $pick_up_point->id }}"
                                                                                    data-content="<span class='d-block'>
                                                                                            <span class='d-block fs-16 fw-600 mb-2'>{{ $pick_up_point->getTranslation('name') }}</span>
                                                                                            <span class='d-block opacity-50 fs-12'><i class='las la-map-marker'></i> {{ $pick_up_point->getTranslation('address') }}</span>
                                                                                            <span class='d-block opacity-50 fs-12'><i class='las la-phone'></i>{{ $pick_up_point->phone }}</span>
                                                                                        </span>">
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @if (get_setting('shipping_type') == 'carrier_wise_shipping')
                                                            <div class="row pt-3 carrier_id_admin">
                                                                @foreach ($carrier_list as $carrier_key => $carrier)
                                                                    <div class="col-md-12 mb-2">
                                                                        <label class="aiz-megabox d-block bg-white mb-0">
                                                                            <input type="radio"
                                                                                name="carrier_id_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"
                                                                                value="{{ $carrier->id }}"
                                                                                @if ($carrier_key == 0) checked @endif>
                                                                            <span class="d-flex p-3 aiz-megabox-elem">
                                                                                <span
                                                                                    class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                                <span class="flex-grow-1 pl-3 fw-600">
                                                                                    <img src="{{ uploaded_asset($carrier->logo) }}"
                                                                                        alt="Image"
                                                                                        class="w-50px img-fit">
                                                                                </span>
                                                                                <span
                                                                                    class="flex-grow-1 pl-3 fw-700">{{ $carrier->name }}</span>
                                                                                <span
                                                                                    class="flex-grow-1 pl-3 fw-600">{{ translate('Transit in') . ' ' . $carrier->transit_time }}</span>
                                                                                {{-- <span class="flex-grow-1 pl-3 fw-600">{{ Str::headline($carrier->carrier_ranges->first()->billing_type) }}</span> --}}
                                                                                <span
                                                                                    class="flex-grow-1 pl-3 fw-600">{{ single_price(carrier_base_price($carts, $carrier->id, \App\Models\User::where('user_type', 'admin')->first()->id)) }}</span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        @if (!empty($seller_products))
                                            @foreach ($seller_products as $key => $seller_product)
                                                <div class="card mb-3 shadow-sm border-0 rounded">
                                                    <div class="card-header p-3">
                                                        <h5 class="fs-16 fw-600 mb-0">
                                                            {{ \App\Models\Shop::where('user_id', $key)->first()->name }}
                                                            {{ translate('Products') }}</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <ul class="list-group list-group-flush">
                                                            @php
                                                                $physical = false;
                                                            @endphp
                                                            @foreach ($seller_product as $cartItem)
                                                                @php
                                                                    $product = \App\Models\Product::find($cartItem);
                                                                    if ($product->digital == 0) {
                                                                        $physical = true;
                                                                    }
                                                                @endphp
                                                                <li class="list-group-item">
                                                                    <div class="d-flex">
                                                                        <span class="mr-2">
                                                                            <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                                                class="img-fit size-60px rounded"
                                                                                alt="{{ $product->getTranslation('name') }}">
                                                                        </span>
                                                                        <span
                                                                            class="fs-14">{{ $product->getTranslation('name') }}</span>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>

                                                        @if ($physical)
                                                            <div class="row border-top pt-3">
                                                                <div class="col-md-6">
                                                                    <h6 class="fs-15 fw-600">
                                                                        {{ translate('Choose Delivery Type') }}</h6>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row gutters-5">
                                                                        @if (get_setting('shipping_type') != 'carrier_wise_shipping')
                                                                            <div class="col-6">
                                                                                <label
                                                                                    class="aiz-megabox d-block bg-white mb-0">
                                                                                    <input type="radio"
                                                                                        name="shipping_type_{{ $key }}"
                                                                                        value="home_delivery"
                                                                                        onchange="show_pickup_point(this, {{ $key }})"
                                                                                        data-target=".pickup_point_id_{{ $key }}">
                                                                                    <span
                                                                                        class="d-flex p-3 aiz-megabox-elem">
                                                                                        <span
                                                                                            class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                                        <span
                                                                                            class="flex-grow-1 pl-3 fw-600">{{ translate('Home Delivery') }}</span>
                                                                                    </span>
                                                                                </label>
                                                                            </div>
                                                                        @else
                                                                            <div class="col-6">
                                                                                <label
                                                                                    class="aiz-megabox d-block bg-white mb-0">
                                                                                    <input type="radio"
                                                                                        name="shipping_type_{{ $key }}"
                                                                                        value="carrier"
                                                                                        onchange="show_pickup_point(this, {{ $key }})"
                                                                                        data-target=".pickup_point_id_{{ $key }}">
                                                                                    <span
                                                                                        class="d-flex p-3 aiz-megabox-elem">
                                                                                        <span
                                                                                            class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                                        <span
                                                                                            class="flex-grow-1 pl-3 fw-600">{{ translate('Carrier') }}</span>
                                                                                    </span>
                                                                                </label>
                                                                            </div>
                                                                        @endif

                                                                        @if ($pickup_point_list)
                                                                            <div class="col-6">
                                                                                <label
                                                                                    class="aiz-megabox d-block bg-white mb-0">
                                                                                    <input type="radio"
                                                                                        name="shipping_type_{{ $key }}"
                                                                                        value="pickup_point"
                                                                                        onchange="show_pickup_point(this, {{ $key }})"
                                                                                        data-target=".pickup_point_id_{{ $key }}">
                                                                                    <span
                                                                                        class="d-flex p-3 aiz-megabox-elem">
                                                                                        <span
                                                                                            class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                                        <span
                                                                                            class="flex-grow-1 pl-3 fw-600">{{ translate('Local Pickup') }}</span>
                                                                                    </span>
                                                                                </label>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    @if ($pickup_point_list)
                                                                        <div
                                                                            class="mt-4 pickup_point_id_{{ $key }} d-none">
                                                                            <select class="form-control aiz-selectpicker"
                                                                                name="pickup_point_id_{{ $key }}"
                                                                                data-live-search="true">
                                                                                <option>
                                                                                    {{ translate('Select your nearest pickup point') }}
                                                                                </option>
                                                                                @foreach ($pickup_point_list as $pick_up_point)
                                                                                    <option
                                                                                        value="{{ $pick_up_point->id }}"
                                                                                        data-content="<span class='d-block'>
                                                                                                        <span class='d-block fs-16 fw-600 mb-2'>{{ $pick_up_point->getTranslation('name') }}</span>
                                                                                                        <span class='d-block opacity-50 fs-12'><i class='las la-map-marker'></i> {{ $pick_up_point->getTranslation('address') }}</span>
                                                                                                        <span class='d-block opacity-50 fs-12'><i class='las la-phone'></i>{{ $pick_up_point->phone }}</span>
                                                                                                    </span>">
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            @if (get_setting('shipping_type') == 'carrier_wise_shipping')
                                                                <div class="row pt-3 carrier_id_{{ $key }}">
                                                                    @foreach ($carrier_list as $carrier_key => $carrier)
                                                                        <div class="col-md-12 mb-2">
                                                                            <label
                                                                                class="aiz-megabox d-block bg-white mb-0">
                                                                                <input type="radio"
                                                                                    name="carrier_id_{{ $key }}"
                                                                                    value="{{ $carrier->id }}"
                                                                                    @if ($carrier_key == 0) checked @endif>
                                                                                <span class="d-flex p-3 aiz-megabox-elem">
                                                                                    <span
                                                                                        class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                                    <span class="flex-grow-1 pl-3 fw-600">
                                                                                        <img src="{{ uploaded_asset($carrier->logo) }}"
                                                                                            alt="Image"
                                                                                            class="w-50px img-fit">
                                                                                    </span>
                                                                                    <span
                                                                                        class="flex-grow-1 pl-3 fw-600">{{ $carrier->name }}</span>
                                                                                    <span
                                                                                        class="flex-grow-1 pl-3 fw-600">{{ translate('Transit in') . ' ' . $carrier->transit_time }}</span>
                                                                                    {{-- <span class="flex-grow-1 pl-3 fw-600">{{ Str::headline($carrier->carrier_ranges->first()->billing_type) }}</span> --}}
                                                                                    <span
                                                                                        class="flex-grow-1 pl-3 fw-600">{{ single_price(carrier_base_price($carts, $carrier->id, $key)) }}</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        {{--
                                        <div class="pt-4 d-flex justify-content-between align-items-center">
                                            <a href="{{ route('home') }}" >
                                                <i class="la la-angle-left"></i>
                                                {{ translate('Return to shop')}}
                                            </a>
                                            <button type="submit" class="btn fw-600 btn-primary">{{ translate('Continue to Payment')}}</button>
                                        </div>
                                        --}}
                                    </form>
                                </div>
                            </div>
                        </div>


                        <!-- Payment Info -->
                        <div class="card rounded-0 mb-0 border shadow-none">
                            <div class="card-header border-bottom-0 py-3 py-xl-4" id="headingPaymentInfo" type="button"
                                data-toggle="collapse" data-target="#collapsePaymentInfo" aria-expanded="true"
                                aria-controls="collapsePaymentInfo">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 20 20">
                                        <path id="Path_42357" data-name="Path 42357"
                                            d="M58,48A10,10,0,1,0,68,58,10,10,0,0,0,58,48ZM56.457,61.543a.663.663,0,0,1-.423.212.693.693,0,0,1-.428-.216l-2.692-2.692.856-.856,2.269,2.269,6-6.043.841.87Z"
                                            transform="translate(-48 -48)" fill="#9d9da6" />
                                    </svg>
                                    <span class="ml-2 fs-19 fw-700">{{ translate('Payment') }}</span>
                                </div>
                                <i class="las la-angle-down fs-18"></i>
                            </div>
                            <div id="collapsePaymentInfo" class="collapse show" aria-labelledby="headingPaymentInfo"
                                data-parent="#accordioncCheckoutInfo">
                                <div class="card-body py-0" id="payment_info">
                                    <form action="{{ route('payment.checkout') }}" class="form-default checkout-form"
                                        role="form" method="POST" id="checkout-form">
                                        @csrf

                                        <input type="hidden" name="owner_id" value="{{ $carts[0]['owner_id'] }}">
                                        <div class="card rounded border-0 shadow-sm">
                                            <div class="card-header p-3">
                                                <h3 class="fs-16 fw-600 mb-0">
                                                    {{ translate('Choose Delivery Date And Time') }}
                                                </h3>
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-text">Select date and time</div>
                                                <?php
                                                // Set the timezone to India Standard Time
                                                date_default_timezone_set('Asia/Kolkata');
                                                
                                                // Get the current date and time
                                                $currentDateTime = new DateTime();
                                                
                                                // Create a DateInterval of 24 hours
                                                $interval = new DateInterval('PT24H');
                                                
                                                // Add the interval to the current date and time
                                                $minDateTime = $currentDateTime->add($interval)->format('Y-m-d\TH:i');
                                                ?>
                                                <input type="datetime-local" min="<?= $minDateTime ?>" id="datetime"
                                                    name="delivery_datetime" class="form-control">
                                            </div>
                                            <div class="card-header p-3">
                                                <h3 class="fs-16 fw-600 mb-0">
                                                    {{ translate('Any additional info?') }}
                                                </h3>
                                            </div>
                                            <div class="form-group pt-3">
                                                <textarea name="additional_info" rows="5" class="form-control"
                                                    placeholder="{{ translate('Type your text') }}"></textarea>
                                            </div>
                                            <div class="card-header p-3">
                                                <h3 class="fs-16 fw-600 mb-0">
                                                    {{ translate('Select a payment option') }}
                                                </h3>
                                            </div>
                                            <div class="card-body text-center">
                                                <div class="row">
                                                    <div class="col-xxl-8 col-xl-10 mx-auto">
                                                        <div class="row gutters-10">
                                                            @if (get_setting('ccavenue_payment') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="ccavenue" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/ccavenue.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('Ccavenue') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (get_setting('paypal_payment') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="paypal" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/paypal.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('Paypal') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (get_setting('stripe_payment') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="stripe" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/stripe.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('Stripe') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (get_setting('mercadopago_payment') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="mercadopago" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/mercadopago.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('Mercadopago') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (get_setting('sslcommerz_payment') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="sslcommerz" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/sslcommerz.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('sslcommerz') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (get_setting('instamojo_payment') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="instamojo" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/instamojo.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('Instamojo') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (get_setting('razorpay') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="razorpay" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/rozarpay.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('Razorpay') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (get_setting('paystack') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="paystack" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/paystack.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('Paystack') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (get_setting('voguepay') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="voguepay" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/vogue.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('VoguePay') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (get_setting('payhere') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="payhere" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/payhere.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('payhere') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (get_setting('ngenius') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="ngenius" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/ngenius.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('ngenius') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (get_setting('iyzico') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="iyzico" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/iyzico.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('Iyzico') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (get_setting('nagad') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="nagad" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/nagad.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('Nagad') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (get_setting('bkash') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="bkash" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/bkash.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('Bkash') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (get_setting('aamarpay') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="aamarpay" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/aamarpay.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('Aamarpay') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (get_setting('authorizenet') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="authorizenet" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/authorizenet.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('Authorize Net') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (get_setting('payku') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="payku" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/payku.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('Payku') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (addon_is_activated('african_pg'))
                                                                @if (get_setting('flutterwave') == 1)
                                                                    <div class="col-6 col-md-4">
                                                                        <label class="aiz-megabox d-block mb-3">
                                                                            <input value="flutterwave"
                                                                                class="online_payment" type="radio"
                                                                                name="payment_option" checked>
                                                                            <span class="d-block aiz-megabox-elem p-3">
                                                                                <img src="{{ static_asset('assets/img/cards/flutterwave.png') }}"
                                                                                    class="img-fluid mb-2">
                                                                                <span class="d-block text-center">
                                                                                    <span
                                                                                        class="d-block fw-600 fs-15">{{ translate('flutterwave') }}</span>
                                                                                </span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                                @if (get_setting('payfast') == 1)
                                                                    <div class="col-6 col-md-4">
                                                                        <label class="aiz-megabox d-block mb-3">
                                                                            <input value="payfast" class="online_payment"
                                                                                type="radio" name="payment_option"
                                                                                checked>
                                                                            <span class="d-block aiz-megabox-elem p-3">
                                                                                <img src="{{ static_asset('assets/img/cards/payfast.png') }}"
                                                                                    class="img-fluid mb-2">
                                                                                <span class="d-block text-center">
                                                                                    <span
                                                                                        class="d-block fw-600 fs-15">{{ translate('payfast') }}</span>
                                                                                </span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                            @if (addon_is_activated('paytm') && get_setting('paytm_payment') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="paytm" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/paytm.jpg') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('Paytm') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (addon_is_activated('paytm') && get_setting('toyyibpay_payment') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="toyyibpay" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/toyyibpay.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('ToyyibPay') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (addon_is_activated('paytm') && get_setting('myfatoorah') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="myfatoorah" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/myfatoorah.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('MyFatoorah') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (addon_is_activated('paytm') && get_setting('khalti_payment') == 1)
                                                                <div class="col-6 col-md-4">
                                                                    <label class="aiz-megabox d-block mb-3">
                                                                        <input value="Khalti" class="online_payment"
                                                                            type="radio" name="payment_option" checked>
                                                                        <span class="d-block aiz-megabox-elem p-3">
                                                                            <img src="{{ static_asset('assets/img/cards/khalti.png') }}"
                                                                                class="img-fluid mb-2">
                                                                            <span class="d-block text-center">
                                                                                <span
                                                                                    class="d-block fw-600 fs-15">{{ translate('Khalti') }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if (get_setting('cash_payment') == 1)
                                                                @php
                                                                    $digital = 0;
                                                                    $cod_on = 1;
                                                                    foreach ($carts as $cartItem) {
                                                                        $product = \App\Models\Product::find(
                                                                            $cartItem['product_id'],
                                                                        );
                                                                        if ($product['digital'] == 1) {
                                                                            $digital = 1;
                                                                        }
                                                                        if ($product['cash_on_delivery'] == 0) {
                                                                            $cod_on = 0;
                                                                        }
                                                                    }
                                                                @endphp
                                                                @if ($digital != 1 && $cod_on == 1)
                                                                    <div class="col-6 col-md-4">
                                                                        <label class="aiz-megabox d-block mb-3">
                                                                            <input value="cash_on_delivery"
                                                                                class="online_payment" type="radio"
                                                                                name="payment_option" checked>
                                                                            <span class="d-block aiz-megabox-elem p-3">
                                                                                <img src="{{ static_asset('assets/img/cards/cod.png') }}"
                                                                                    class="img-fluid mb-2">
                                                                                <span class="d-block text-center">
                                                                                    <span
                                                                                        class="d-block fw-600 fs-15">{{ translate('Cash on Delivery') }}</span>
                                                                                </span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                            @if (Auth::check())
                                                                @if (addon_is_activated('offline_payment'))
                                                                    @foreach (\App\Models\ManualPaymentMethod::all() as $method)
                                                                        <div class="col-6 col-md-4">
                                                                            <label class="aiz-megabox d-block mb-3">
                                                                                <input value="{{ $method->heading }}"
                                                                                    type="radio" name="payment_option"
                                                                                    class="offline_payment_option"
                                                                                    onchange="toggleManualPaymentData({{ $method->id }})"
                                                                                    data-id="{{ $method->id }}"
                                                                                    checked>
                                                                                <span class="d-block aiz-megabox-elem p-3">
                                                                                    <img src="{{ uploaded_asset($method->photo) }}"
                                                                                        class="img-fluid mb-2">
                                                                                    <span class="d-block text-center">
                                                                                        <span
                                                                                            class="d-block fw-600 fs-15">{{ $method->heading }}</span>
                                                                                    </span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    @endforeach

                                                                    @foreach (\App\Models\ManualPaymentMethod::all() as $method)
                                                                        <div id="manual_payment_info_{{ $method->id }}"
                                                                            class="d-none">
                                                                            @php echo $method->description @endphp
                                                                            @if ($method->bank_info != null)
                                                                                <ul>
                                                                                    @foreach (json_decode($method->bank_info) as $key => $info)
                                                                                        <li>{{ translate('Bank Name') }} -
                                                                                            {{ $info->bank_name }},
                                                                                            {{ translate('Account Name') }}
                                                                                            -
                                                                                            {{ $info->account_name }},
                                                                                            {{ translate('Account Number') }}
                                                                                            -
                                                                                            {{ $info->account_number }},
                                                                                            {{ translate('Routing Number') }}
                                                                                            -
                                                                                            {{ $info->routing_number }}
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            @endif
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                @if (addon_is_activated('offline_payment'))
                                                    <div class="d-none mb-3 rounded border bg-white p-3 text-left">
                                                        <div id="manual_payment_description">

                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label>{{ translate('Transaction ID') }} <span
                                                                        class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control mb-3"
                                                                    name="trx_id" id="trx_id"
                                                                    placeholder="{{ translate('Transaction ID') }}"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="col-md-3 col-form-label">{{ translate('Photo') }}</label>
                                                            <div class="col-md-9">
                                                                <div class="input-group" data-toggle="aizuploader"
                                                                    data-type="image">
                                                                    <div class="input-group-prepend">
                                                                        <div
                                                                            class="input-group-text bg-soft-secondary font-weight-medium">
                                                                            {{ translate('Browse') }}</div>
                                                                    </div>
                                                                    <div class="form-control file-amount">
                                                                        {{ translate('Choose image') }}
                                                                    </div>
                                                                    <input type="hidden" name="photo"
                                                                        class="selected-files">
                                                                </div>
                                                                <div class="file-preview box sm">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (Auth::check() && get_setting('wallet_system') == 1)
                                                    <div class="separator mb-3">
                                                        <span class="bg-white px-3">
                                                            <span class="opacity-60">{{ translate('Or') }}</span>
                                                        </span>
                                                    </div>
                                                    <div class="py-4 text-center">
                                                        <div class="h6 mb-3">
                                                            <span
                                                                class="opacity-80">{{ translate('Your wallet balance :') }}</span>
                                                            <span
                                                                class="fw-600">{{ single_price(Auth::user()->balance) }}</span>
                                                        </div>
                                                        @if (Auth::user()->balance < $total)
                                                            <button type="button" class="btn btn-secondary" disabled>
                                                                {{ translate('Insufficient balance') }}
                                                            </button>
                                                        @else
                                                            <button type="button" onclick="use_wallet()"
                                                                class="btn btn-primary fw-600">
                                                                {{ translate('Pay with wallet') }}
                                                            </button>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- <div class="pt-3">
                            <label class="aiz-checkbox">
                                <input type="checkbox" required id="agree_checkbox">
                                <span class="aiz-square-check"></span>
                                <span>{{ translate('I agree to the') }}</span>
                            </label>
                            <a href="{{ route('terms') }}">{{ translate('terms and conditions') }}</a>,
                            <a href="{{ route('returnpolicy') }}">{{ translate('return policy') }}</a> &
                            <a href="{{ route('privacypolicy') }}">{{ translate('privacy policy') }}</a>
                        </div>

                        <div class="row align-items-center pt-3">
                            <div class="col-6">
                                <a href="{{ route('home') }}" class="link link--style-3">
                                    <i class="las la-arrow-left"></i>
                                    {{ translate('Return to shop') }}
                                </a>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" onclick="submitOrder(this)"
                                    class="btn btn-primary fw-600">{{ translate('Complete Order') }}</button>
                            </div>
                        </div> --}}
                                    </form>

                                    <!-- Agree Box -->
                                    <div class="pt-2rem fs-14">
                                        <label class="aiz-checkbox">
                                            <input type="checkbox" required id="agree_checkbox"
                                                onchange="stepCompletionPaymentInfo()">
                                            <span class="aiz-square-check"></span>
                                            <span>{{ translate('I agree to the') }}</span>
                                        </label>
                                        <a href="{{ route('terms') }}"
                                            class="fw-700">{{ translate('terms and conditions') }}</a>,
                                        <a href="{{ route('returnpolicy') }}"
                                            class="fw-700">{{ translate('return policy') }}</a> &
                                        <a href="{{ route('privacypolicy') }}"
                                            class="fw-700">{{ translate('privacy policy') }}</a>
                                    </div>

                                    <div class="row align-items-center pt-3 mb-4">
                                        <!-- Return to shop -->
                                        <div class="col-6">
                                            <a href="{{ route('home') }}" class="btn btn-link fs-14 fw-700 px-0">
                                                <i class="las la-arrow-left fs-16"></i>
                                                {{ translate('Return to shop') }}
                                            </a>
                                        </div>
                                        <!-- Complete Ordert -->
                                        <div class="col-6 text-right">
                                            <button type="button" onclick="submitOrder(this)" id="submitOrderBtn"
                                                class="btn btn-primary fs-14 fw-700 rounded-0 px-4">{{ translate('Complete Order') }}</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>




                </div>

                <div class="col-lg-4 mt-lg-0 mt-4" id="cart_summary">
                    @include('frontend.partials.cart_summary2')
                </div>
            </div>
        </div>
    </section>


@endsection

@section('modal')
    @include('frontend.partials.address_modal2')
@endsection

@section('script')
    <script>
        function stepCompletionShippingInfo() {
            var headColor = '#9d9da6';
            var btnDisable = true;
            var allOk = false;
            @if (Auth::check())
                var length = $('input[name="address_id"]:checked').length;
                if (length > 0) {
                    headColor = '#15a405';
                    btnDisable = false;
                    allOk = true;
                }
            @else
                var count = 0;
                var length = $('#shipping_info [required]').length;
                $('#shipping_info [required]').each(function(i, el) {
                    if ($(el).val() != '' && $(el).val() != undefined && $(el).val() != null) {
                        count += 1;
                    }
                });
                if (count == length) {
                    headColor = '#15a405';
                    btnDisable = false;
                    allOk = true;
                }
            @endif

            $('#headingShippingInfo svg *').css('fill', headColor);
            $("#submitOrderBtn").prop('disabled', btnDisable);
            return allOk;
        }

        function stepCompletionDeliveryInfo() {
            var headColor = '#9d9da6';
            var btnDisable = true;
            var allOk = false;
            var content = $('#delivery_info [required]');
            if (content.length > 0) {
                var content_checked = $('#delivery_info [required]:checked');
                if (content_checked.length > 0) {
                    content_checked.each(function(i, el) {
                        allOk = false;
                        if ($(el).val() == 'carrier') {
                            var owner = $(el).attr('data-owner');
                            if ($('input[name=carrier_id_' + owner + ']:checked').length > 0) {
                                allOk = true;
                            }
                        } else if ($(el).val() == 'pickup_point') {
                            var owner = $(el).attr('data-owner');
                            if ($('select[name="pickup_point_id_' + owner + '"]').val() != '') {
                                allOk = true;
                            }
                        } else {
                            allOk = true;
                        }

                        if (allOk == false) {
                            return false;
                        }
                    });

                    if (allOk) {
                        headColor = '#15a405';
                        btnDisable = false;
                    }
                }
            } else {
                allOk = true
                headColor = '#15a405';
                btnDisable = false;
            }

            $('#headingDeliveryInfo svg *').css('fill', headColor);
            $("#submitOrderBtn").prop('disabled', btnDisable);
            return allOk;
        }

        function stepCompletionPaymentInfo() {
            var headColor = '#9d9da6';
            var btnDisable = true;
            var payment = false;
            var agree = false;
            var allOk = false;
            var length = $('input[name="payment_option"]:checked').length;
            if (length > 0) {
                if ($('input[name="payment_option"]:checked').hasClass('offline_payment_option')) {
                    if ($('#trx_id').val() != '' && $('#trx_id').val() != undefined && $('#trx_id').val() != null) {
                        payment = true;
                    }
                } else {
                    payment = true;
                }

                if ($('#agree_checkbox').is(":checked")) {
                    agree = true;
                }

                if (payment && agree) {
                    headColor = '#15a405';
                    btnDisable = false;
                    allOk = true;
                }
            }

            $('#headingPaymentInfo svg *').css('fill', headColor);
            $("#submitOrderBtn").prop('disabled', btnDisable);
            return allOk;
        }


        $('input[name="payment_option"]').change(function() {
            stepCompletionPaymentInfo();
        });

        $(document).ready(function() {
            stepCompletionShippingInfo();
            stepCompletionDeliveryInfo();
            stepCompletionPaymentInfo();

            // Function to handle form submission via AJAX for address form
            function addressForm(form) {
                var url = form.attr('action');
                var method = form.attr('method');
                var formData = new FormData(form[0]);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: method,
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // console.log(response);
                        if (response.success === true) {
                            // Update the cart summary with the response view
                            $('#cart_summary').html(response.view);
                            // $('.delivery-type-form').show();
                            stepCompletionShippingInfo();
                            location.reload();
                        } else if (response.success === false) {
                            // $('.delivery-type-form').hide();
                            // $('.checkout-form').hide();
                            // Display error messages
                            if (response.errors && Array.isArray(response.errors)) {
                                response.errors.forEach(function(error) {
                                    AIZ.plugins.notify('danger', error);
                                });
                            }
                        } else {
                            AIZ.plugins.notify('danger', 'An unknown error occurred.');
                        }
                    },
                    error: function(xhr) {
                        // console.log(xhr.responseText);
                        // Handle errors here
                        AIZ.plugins.notify('danger', 'An unexpected error occurred.');
                    }
                });
            }

            // Function to handle form submission via AJAX for delivery type form
            function delivery_typeForm(form) {
                var url = form.attr('action');
                var method = form.attr('method');
                var formData = new FormData(form[0]);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: method,
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // console.log(response);
                        if (response.success === true) {
                            // Update the cart summary with the response view
                            $('#cart_summary').html(response.view);
                            // $('.checkout-form').show();
                            stepCompletionDeliveryInfo();
                        } else if (response.success === false) {
                            // $('.checkout-form').hide();
                            // Display error messages
                            if (response.errors && Array.isArray(response.errors)) {
                                response.errors.forEach(function(error) {
                                    AIZ.plugins.notify('danger', error);
                                });
                            }
                        } else {
                            AIZ.plugins.notify('danger', 'An unknown error occurred.');
                        }
                    },
                    error: function(xhr) {
                        // console.log(xhr.responseText);
                        // Handle errors here
                        AIZ.plugins.notify('danger', 'An unexpected error occurred.');
                    }
                });
            }

            // Event listener for address form submission
            $('.address-form').on('submit', function(e) {
                e.preventDefault();
                addressForm($(this));
            });

            // Event listener for delivery type form submission
            $('.delivery-type-form').on('submit', function(e) {
                e.preventDefault();
                delivery_typeForm($(this));
            });

            // Event listener for input changes in address form
            $('.address-form').on('change', 'input, select, textarea', function() {
                addressForm($(this).closest('form'));
            });

            // Event listener for input changes in delivery type form
            $('.delivery-type-form').on('change', 'input, select, textarea', function() {
                delivery_typeForm($(this).closest('form'));
            });

            // Initially hide all forms
            // $('.form-default').hide();

            // Show Step 1 form initially
            // $('.address-form').show();
        });
        $(document).ready(function() {
            // Check if the shipping type is 'home_delivery'
            var isHomeDelivery =
                {{ isset($carts[0]->shipping_type) && $carts[0]->shipping_type == 'home_delivery' ? 'true' : 'false' }};

            // Check if the shipping type is 'pickup_point'
            var isPickupPoint =
                {{ isset($carts[0]->shipping_type) && $carts[0]->shipping_type == 'pickup_point' ? 'true' : 'false' }};

            if (isHomeDelivery) {
                // Trigger the click and change events for 'home_delivery'
                var $homeDeliveryRadio = $(
                    'input[name="shipping_type_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"][value="home_delivery"]'
                );

                $homeDeliveryRadio.trigger('click');
                $homeDeliveryRadio.trigger('change');
            } else if (isPickupPoint) {
                // Trigger the click and change events for 'pickup_point'
                var $pickupPointRadio = $(
                    'input[name="shipping_type_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"][value="pickup_point"]'
                );
                $pickupPointRadio.trigger('click');
                $pickupPointRadio.trigger('change');
            }

            // Function to show/hide pickup point select based on radio selection
            function handlePickupPointSelection() {
                var isPickupPoint = $(
                    'input[name="shipping_type_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"][value="pickup_point"]'
                ).is(':checked');
                if (isPickupPoint) {
                    $('.pickup_point_id_admin').removeClass('d-none');
                } else {
                    $('.pickup_point_id_admin').addClass('d-none');
                }
            }

            // Function to set selected pickup point
            function setSelectedPickupPoint() {
                var selectedPickupPointId = "{{ isset($carts[0]->pickup_point) ? $carts[0]->pickup_point : '' }}";
                if (selectedPickupPointId) {
                    var pickupPointSelect = $(
                        'select[name="pickup_point_id_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"]'
                    );
                    pickupPointSelect.val(selectedPickupPointId).trigger('change');
                }
            }

            // Run on page load
            handlePickupPointSelection();
            setSelectedPickupPoint();

            // Listen for changes in the radio button
            $('input[name="shipping_type_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"]').on(
                'change',
                function() {
                    handlePickupPointSelection();
                });
        });
    </script>

    <script type="text/javascript">
        function display_option(key) {

        }

        function show_pickup_point(el, type) {
            var value = $(el).val();
            var target = $(el).data('target');

            // console.log(value);

            if (value == 'home_delivery' || value == 'carrier') {
                if (!$(target).hasClass('d-none')) {
                    $(target).addClass('d-none');
                }
                $('.carrier_id_' + type).removeClass('d-none');
            } else {
                $(target).removeClass('d-none');
                $('.carrier_id_' + type).addClass('d-none');
            }
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".online_payment").click(function() {
                $('#manual_payment_description').parent().addClass('d-none');
            });
            toggleManualPaymentData($('input[name=payment_option]:checked').data('id'));
        });

        var minimum_order_amount_check = {{ get_setting('minimum_order_amount_check') == 1 ? 1 : 0 }};
        var minimum_order_amount =
            {{ get_setting('minimum_order_amount_check') == 1 ? get_setting('minimum_order_amount') : 0 }};

        function use_wallet() {
            $('input[name=payment_option]').val('wallet');
            if ($('#agree_checkbox').is(":checked")) {
                ;
                if (minimum_order_amount_check && $('#sub_total').val() < minimum_order_amount) {
                    AIZ.plugins.notify('danger',
                        '{{ translate('You order amount is less then the minimum order amount') }}');
                } else {
                    $('#checkout-form').submit();
                }
            } else {
                AIZ.plugins.notify('danger', '{{ translate('You need to agree with our policies') }}');
            }
        }

        function submitOrder(el) {
            $(el).prop('disabled', true);
            if ($('#agree_checkbox').is(":checked")) {
                if (minimum_order_amount_check && $('#sub_total').val() < minimum_order_amount) {
                    AIZ.plugins.notify('danger',
                        '{{ translate('You order amount is less then the minimum order amount') }}');
                } else {
                    var offline_payment_active = '{{ addon_is_activated('offline_payment') }}';
                    if (offline_payment_active == '1' && $('.offline_payment_option').is(":checked") && $('#trx_id')
                        .val() == '') {
                        AIZ.plugins.notify('danger', '{{ translate('You need to put Transaction id') }}');
                        $(el).prop('disabled', false);
                    } else {
                        var allIsOk = false;
                        var isOkShipping = stepCompletionShippingInfo();
                        var isOkDelivery = stepCompletionDeliveryInfo();
                        var isOkPayment = stepCompletionPaymentInfo();
                        if (isOkShipping && isOkDelivery && isOkPayment) {
                            allIsOk = true;
                        } else {
                            AIZ.plugins.notify('danger', '{{ translate('Please fill in all mandatory fields!') }}');
                            $('#checkout-form [required]').each(function(i, el) {
                                if ($(el).val() == '' || $(el).val() == undefined) {
                                    var is_trx_id = $('.d-none #trx_id').length;
                                    if (($(el).attr('name') != 'trx_id') || is_trx_id == 0) {
                                        $(el).focus();
                                        $(el).scrollIntoView({
                                            behavior: "smooth",
                                            block: "center"
                                        });
                                        return false;
                                    }
                                }
                            });
                        }

                        if (allIsOk) {
                            $('#checkout-form').submit();
                        }
                    }
                }
            } else {
                AIZ.plugins.notify('danger', '{{ translate('You need to agree with our policies') }}');
                $(el).prop('disabled', false);
            }
        }

        // function submitOrder(el) {
        //     $(el).prop('disabled', true);

        //     /*// Get the selected date and time from the input
        //         var selectedDateTime = document.getElementById('datetime').value;

        //         // Convert to Date objects for comparison
        //         var selectedDate = new Date(selectedDateTime);
        //         var minDate = new Date('<?= $minDateTime ?>');

        //         // Check if selected time is greater than the minimum allowed time
        //         if (selectedDate <= minDate) {
        //             // Format the minimum date and time for the error message with d/m/y format
        //             var minDateTimeFormatted = minDate.toLocaleDateString('en-GB', { day: 'numeric', month: 'numeric', year: 'numeric' }) + ' ' +
        //                                        minDate.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

        //             AIZ.plugins.notify('danger', '{{ translate('Please select a time greater than') }} ' + minDateTimeFormatted + '.');
        //             $(el).prop('disabled', false);  // Re-enable the button
        //             return false; // Prevent form submission
        //         }

        //         // If the date is cleared, prevent form submission
        //         if (!selectedDateTime) {
        //             AIZ.plugins.notify('danger', '{{ translate('Please select Date and Time.') }}');
        //             $(el).prop('disabled', false);  // Re-enable the button
        //             return false;
        //         }*/

        //     var selectedDateTime = document.getElementById('datetime').value;
        //     if (!selectedDateTime) {
        //         AIZ.plugins.notify('danger', '{{ translate('Please select delivery Date and Time.') }}');
        //         $(el).prop('disabled', false); // Re-enable the button
        //         return false;
        //     }

        //     if ($('#agree_checkbox').is(":checked")) {
        //         if (minimum_order_amount_check && $('#sub_total').val() < minimum_order_amount) {
        //             AIZ.plugins.notify('danger',
        //                 '{{ translate('You order amount is less then the minimum order amount') }}');
        //         } else {
        //             var offline_payment_active = '{{ addon_is_activated('offline_payment') }}';
        //             if (offline_payment_active == 'true' && $('.offline_payment_option').is(":checked") && $('#trx_id')
        //                 .val() == '') {
        //                 AIZ.plugins.notify('danger',
        //                     '{{ translate('You need to put Transaction id') }}');
        //                 $(el).prop('disabled', false);
        //             } else {
        //                 $('#checkout-form').submit();
        //             }
        //         }
        //     } else {
        //         AIZ.plugins.notify('danger', '{{ translate('You need to agree with our policies') }}');
        //         $(el).prop('disabled', false);
        //     }
        //     return true;
        // }

        function toggleManualPaymentData(id) {
            if (typeof id != 'undefined') {
                $('#manual_payment_description').parent().removeClass('d-none');
                $('#manual_payment_description').html($('#manual_payment_info_' + id).html());
            }
        }

        $(document).on("click", "#coupon-apply", function() {
            var data = new FormData($('#apply-coupon-form')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ route('checkout.apply_coupon_code') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data, textStatus, jqXHR) {
                    AIZ.plugins.notify(data.response_message.response, data.response_message.message);
                    $("#cart_summary").html(data.html);
                }
            })
        });

        $(document).on("click", "#coupon-remove", function() {
            var data = new FormData($('#remove-coupon-form')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ route('checkout.remove_coupon_code') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data, textStatus, jqXHR) {
                    $("#cart_summary").html(data);
                }
            })
        })
    </script>


    <script type="text/javascript">
        function add_new_address() {
            $('#new-address-modal').modal('show');
        }

        function edit_address(address) {
            var url = '{{ route('addresses.edit', ':id') }}';
            url = url.replace(':id', address);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#edit_modal_body').html(response.html);
                    $('#edit-address-modal').modal('show');
                    AIZ.plugins.bootstrapSelect('refresh');

                    @if (get_setting('google_map') == 1)
                        var lat = -33.8688;
                        var long = 151.2195;

                        if (response.data.address_data.latitude && response.data.address_data.longitude) {
                            lat = parseFloat(response.data.address_data.latitude);
                            long = parseFloat(response.data.address_data.longitude);
                        }

                        initialize(lat, long, 'edit_');
                    @endif
                }
            });
        }

        $(document).on('change', '[name=country_id]', function() {
            var country_id = $(this).val();
            get_states(country_id);
        });

        $(document).on('change', '[name=state_id]', function() {
            var state_id = $(this).val();
            get_city(state_id);
        });

        function get_states(country_id) {
            $('[name="state"]').html("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('get-state') }}",
                type: 'POST',
                data: {
                    country_id: country_id
                },
                success: function(response) {
                    var obj = JSON.parse(response);
                    if (obj != '') {
                        $('[name="state_id"]').html(obj);
                        AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }

        function get_city(state_id) {
            $('[name="city"]').html("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('get-city') }}",
                type: 'POST',
                data: {
                    state_id: state_id
                },
                success: function(response) {
                    var obj = JSON.parse(response);
                    if (obj != '') {
                        $('[name="city_id"]').html(obj);
                        AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }
    </script>


    @if (get_setting('google_map') == 1)
        @include('frontend.partials.google_map')
    @endif
@endsection
