@extends('frontend.layouts.app')

@section('meta_title'){{ $detailedProduct->meta_title }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('meta')
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
<meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
<meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">

<!-- Twitter Card data -->
<meta name="twitter:card" content="product">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
<meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
<meta name="twitter:creator" content="@author_handle">
<meta name="twitter:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
<meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
<meta name="twitter:label1" content="Price">

<!-- Open Graph data -->
<meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
<meta property="og:type" content="og:product" />
<meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
<meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />
<meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
<meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
<meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
<meta property="product:price:currency"
    content="{{ \App\Models\Currency::findOrFail(get_setting('system_default_currency'))->code }}" />
<meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endsection

<style>
    .aiz-mobile-bottom-nav.d-xl-none.fixed-bottom.bg-white.shadow-lg.border-top.rounded-top {
    display: none;
}
.button_colors_1 i {
    font-size: 18px !important;
}
@media(max-width:767px)
{
    .whatsapp_chat_support {
    display: none !important;
}
}

@media (max-width: 767px) {
    .footer-widget,
     .aiz-mobile-bottom-nav,
    footer,
    .section.call-buton,
    .whatsapp_chat_support {
        display: none !important;
    }

    .related_boxex_12 .slick-slide {
    height: auto !important;
}
.related_boxex_12 {
    display: block;
    padding-bottom: 50px;
}
.question_mark p {
    background: #f48fa2;
    width: 20px;
    text-align: center;
    color: #fff;
    height: 20px;
    line-height: 20px;
    border-radius: 50px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
    top: 6px;
}

.question_mark {
    width: 32px;
    background: #fff;
    height: 32px;
    text-align: center;
    line-height: 32px;
    border-radius: 100px;
    margin-left: auto;
    position: relative;
    top: -40px;
    right: 6px;
}
    html {
        scroll-behavior: smooth;
    }
}
</style>
@section('content')


<section class="mb-4 pt-md-4 pt-2">
    <div class="container">

        <ul class="breadcrumb bg-transparent p-0 display_m_none">
            <li class="breadcrumb-item opacity-90">
                <a class="text-reset" href="{{ route('home') }}">{{ translate('Home')}}</a>
            </li>
            @if($category_id1 != 'null')
            <li class="text-dark fw-600 breadcrumb-item">
                <a class="text-reset" href="{{ route('products.category', $category_id1->slug) }}">
                    {{ $category_id1->name }}
                </a>
            </li>
            @endif
            <li class="breadcrumb-item fw-600 opacity-90">
                <a class="text-reset" href="#"> {{ $detailedProduct->getTranslation('name') }}</a>
            </li>


        </ul>

        <div class="bg-white">
            <div class="row">
                <div class="col-xl-6 col-lg-6 mb-md-4 mb-2">
                    <div class="sticky-top z-3 row gutters-10">
                        @php
                        $photos = explode(',', $detailedProduct->photos);
                        @endphp
                        <div class="col-9 order-1 order-md-2 mb-right-0">
                            <div class="aiz-carousel product-gallery" data-nav-for='.product-gallery-thumb'
                                data-fade='true' data-auto-height='true'>
                                @foreach ($photos as $key => $photo)
                                <div class="carousel-box img-zoom rounded pointer_none">
                                    <img class="img-fluid lazyload"
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ uploaded_asset($photo) }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                </div>
                                @endforeach
                                @foreach ($detailedProduct->stocks as $key => $stock)
                                @if ($stock->image != null)
                                <div class="carousel-box img-zoom rounded">
                                    <img class="img-fluid lazyload"
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ uploaded_asset($stock->image) }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                </div>
                                @endif
                                @endforeach
                            </div>

                            <div class="question_mark d-md-none d-block">
                                   <a href="#tab_default_1"><p>i</p></a>
                            </div>
                        </div>


                        <div class="col-3 col-md-auto w-md-140px order-2 order-md-1 mt-1 mt-md-0">
                            <div class="aiz-carousel product-gallery-thumb" data-items='4'
                                data-nav-for='.product-gallery' data-vertical='true'
                                data-focus-select='true' data-arrows='true'>
                                @foreach ($photos as $key => $photo)
                                <div class="carousel-box c-pointer border p-1 rounded">
                                    <img class="lazyload mw-160 size-100px width_766 mx-auto"
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ uploaded_asset($photo) }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                </div>
                                @endforeach
                                @foreach ($detailedProduct->stocks as $key => $stock)
                                @if ($stock->image != null)
                                <div class="carousel-box c-pointer border p-1 rounded"
                                    data-variation="{{ $stock->variant }}">
                                    <img class="lazyload mw-160 size-80px mx-auto"
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ uploaded_asset($stock->image) }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6">
                    <div class="text-left pl-md-2">
                        <h1 class="mb-2 dthead product-dt-head heading_font1  green_color ">
                            {{ $detailedProduct->getTranslation('name') }}
                        </h1>


                        <div class="row align-items-center">
                            @php
                                $total = $detailedProduct->reviews->count(); // Directly count the reviews
                                // Alternatively, if you want to ensure $total is always set to 0 if no reviews exist:
                                $total = $total ?: 0; // If $total is empty (falsey value), set it to 0
                            @endphp
                            @if($total > 0 || $detailedProduct->rating > 0)
                            <div class="col-12">
                                <span class="rating">
                                    {{ renderStarRating($detailedProduct->rating) }}
                                </span>
                                <span class="ml-1 opacity-90">({{ $total }}
                                    {{ translate('reviews') }})</span>
                            </div>
                            @endif
                            @if ($detailedProduct->est_shipping_days)
                            <div class="col-auto ml pt-md-2 pt-0">
                                <small class="mr-2 opacity-90">{{ translate('Estimate Shipping Time') }}:
                                </small>{{ $detailedProduct->est_shipping_days }} {{ translate('Days') }}
                            </div>
                            @endif
                        </div>

                        <!--<div class="row align-items-center">
                                <div class="col-auto">
                                    <small class="mr-2 opacity-90">{{ translate('Sold by') }}: </small><br>
                                    @if ($detailedProduct->added_by == 'seller' && get_setting('vendor_system_activation') == 1)
                                        <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}"
                                            class="text-reset">{{ $detailedProduct->user->shop->name }}</a>
                                    @else
                                        {{ translate('Inhouse product') }}
                                    @endif
                                </div>
                                @if (get_setting('conversation_system') == 1)
                                    <div class="col-auto">
                                        <button class="btn btn-sm btn-soft-primary"
                                            onclick="show_chat_modal()">{{ translate('Message Seller') }}</button>
                                    </div>
                                @endif

                                @if ($detailedProduct->brand != null)
                                    <div class="col-auto">
                                        <a href="{{ route('products.brand', $detailedProduct->brand->slug) }}">
                                            <img src="{{ uploaded_asset($detailedProduct->brand->logo) }}"
                                                alt="{{ $detailedProduct->brand->getTranslation('name') }}"
                                                height="30">
                                        </a>
                                    </div>
                                @endif
                            </div>-->

                        <!--<hr>-->

                        @if ($detailedProduct->wholesale_product)
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>{{ translate('Min Qty') }}</th>
                                    <th>{{ translate('Max Qty') }}</th>
                                    <th>{{ translate('Unit Price') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detailedProduct->stocks->first()->wholesalePrices as $wholesalePrice)
                                <tr>
                                    <td>{{ $wholesalePrice->min_qty }}</td>
                                    <td>{{ $wholesalePrice->max_qty }}</td>
                                    <td>{{ single_price($wholesalePrice->price) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        @if (home_price($detailedProduct) != home_discounted_price($detailedProduct))

                        <div class="row no-gutters mt-3">
                           <div class="col-sm-2 col-3">
                                <div class="opacity-90 my-2">Price:</div>
                            </div>

                            <div class="">
                                <div class="fs-16 fw-500 text-primary price-size gray_green_clr pt-2">
                                    <strong class="gray_green_clr">{{ home_discounted_price($detailedProduct) }}</strong>
                                </div>
                            </div>
                            <div class="pl-3">
                                <div class="fs-16 opacity-90 pt-2">
                                    <del>
                                        <p class="mb-0">{{ home_base_price($detailedProduct) }}</p>

                                        <!--@if ($detailedProduct->unit != null)-->
                                        <!--<span>/{{ $detailedProduct->getTranslation('unit') }}</span>-->
                                        <!--@endif-->
                                    </del>
                                </div>
                            </div>
                            <div class="pl-2 pt-2">
                                <strong class="fs-16 fw-500 text-primary">
                                    <!--<span class="box ml-1 mr-0">&nbsp;{{discount_in_percentage($detailedProduct)}}% OFF</span>-->
                                    <p id="discounted_price" class="mb-0" style="color: #f00;"></p>
                                    {{-- discount_in_percentage($detailedProduct) --}}
                                </strong>
                                @if ($detailedProduct->unit != null)
                                <span
                                    class="opacity-90 display_none">/{{ $detailedProduct->getTranslation('unit') }}</span>
                                @endif
                            </div>

                        </div>

                        <!--<div class="row no-gutters mt-3">-->
                        <!--    <div class="col-sm-2">-->
                        <!--        <div class="opacity-90 my-2">{{ translate('Price') }}:</div>-->
                        <!--    </div>-->
                        <!--    <div class="col-sm-10">-->
                        <!--        <div class="fs-20 opacity-60">-->
                        <!--            <del>-->
                        <!--                {{ home_price($detailedProduct) }}-->
                        <!--                @if ($detailedProduct->unit != null)-->
                        <!--                    <span>/{{ $detailedProduct->getTranslation('unit') }}</span>-->
                        <!--                @endif-->
                        <!--            </del>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->

                        <!--<div class="row no-gutters my-2">-->
                        <!--    <div class="col-sm-2">-->
                        <!--        <div class="opacity-90">{{ translate('Discount Price') }}:</div>-->
                        <!--    </div>-->
                        <!--    <div class="col-sm-10">-->
                        <!--        <div class="">-->
                        <!--            <strong class="h2 fw-600 text-primary">-->
                        <!--                {{ home_discounted_price($detailedProduct) }}-->
                        <!--            </strong>-->
                        <!--            @if ($detailedProduct->unit != null)-->
                        <!--                <span-->
                        <!--                    class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>-->
                        <!--            @endif-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        @else
                        <!-- <div class="row no-gutters mt-3">
                            <div class="col-sm-2">
                                <div class="opacity-90 my-2">{{ translate('Price') }}:</div>
                            </div>
                            <div class="col-sm-10">
                                <div class="">
                                    <strong class="h2 fw-600 text-primary">
                                        {{ home_discounted_price($detailedProduct) }}
                                    </strong>
                                  @if ($detailedProduct->unit != null)
                                       <span
                                        class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div> -->
                        @endif
                        @endif

                        @if (addon_is_activated('club_point') && $detailedProduct->earn_point > 0)
                        <div class="row no-gutters mt-4">
                            <div class="col-sm-2">
                                <div class="opacity-90 my-2">{{ translate('Club Point') }}:</div>
                            </div>
                            <div class="col-sm-10">
                                <div class="d-inline-block rounded px-2 bg-soft-primary border-soft-primary border">
                                    <span class="strong-700">{{ $detailedProduct->earn_point }}</span>
                                </div>
                            </div>
                        </div>
                        @endif

                        <form id="option-choice-form">
                            @csrf
                            <input type="hidden" name="id" value="{{ $detailedProduct->id }}">

                            @if ($detailedProduct->choice_options != null)
                            @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)
                            <div class="row no-gutters">
                                <div class="col-sm-2">
                                    <div class="opacity-90 my-2">
                                        {{ \App\Models\Attribute::find($choice->attribute_id)->getTranslation('name') }}:
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="aiz-radio-inline">
                                        @foreach ($choice->values as $key => $value)
                                        <label class="aiz-megabox pl-0 mr-2">
                                            <input type="radio" name="attribute_id_{{ $choice->attribute_id }}"
                                                value="{{ $value }}" @if ($key==0) checked @endif>
                                            <span
                                                class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center py-2 px-3 mb-2">
                                                {{ $value }}
                                            </span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif

                            @if (count(json_decode($detailedProduct->colors)) > 0)
                            <div class="row no-gutters">
                                <div class="col-sm-2">
                                    <div class="opacity-90 my-2">{{ translate('Color') }}:</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="aiz-radio-inline">
                                        @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                        <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip"
                                            data-title="{{ \App\Models\Color::where('code', $color)->first()->name }}">
                                            <input type="radio" name="color"
                                                value="{{ \App\Models\Color::where('code', $color)->first()->name }}"
                                                @if ($key==0) checked @endif>
                                            <span
                                                class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                <span class="size-30px d-inline-block rounded"
                                                    style="background: {{ $color }};"></span>
                                            </span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <hr>
                            @endif


                            <div class="row no-gutters pb-md-3 pb-1 mt-md-3 mt-2" id="chosen_price_div">
                                <div class="col-sm-2 col-3">
                                    <div class="opacity-90 my-1">{{ translate('Total  Price') }}:</div>
                                </div>
                                <div class="col-sm-10 col-9">
                                    <div class="product-price">
                                        <strong id="chosen_price" class="h4 fw-700 gray_green_clr">

                                        </strong>
                                    </div>
                                </div>
                            </div>

                             <!-- Quantity + Add to cart -->
                            <div class="row no-gutters pb-md-3 pb-2">
                                <div class="col-sm-12">
                                    <div class="opacity-90 my-2">{{ translate('Quantity') }}:</div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="product-quantity d-flex align-items-center">
                                        <div class="row no-gutters quantity_bg align-items-center aiz-plus-minus mr-3"
                                            style="width: 130px;">
                                            <button class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                type="button" data-type="minus" data-field="quantity" disabled="">
                                                <i class="las la-minus"></i>
                                            </button>
                                            <input readonly type="number" name="quantity"
                                                class="cursor-auto col border-0 text-center flex-grow-1 fs-16 input-number"
                                                placeholder="1" value="{{ $detailedProduct->min_qty }}"
                                                min="{{ $detailedProduct->min_qty }}" max="10" lang="en">
                                            <button class="btn  col-auto btn-icon btn-sm btn-circle btn-light"
                                                type="button" data-type="plus" data-field="quantity">
                                                <i class="las la-plus"></i>
                                            </button>
                                        </div>
                                        @php
                                        $qty = 0;
                                        foreach ($detailedProduct->stocks as $key => $stock) {
                                        $qty += $stock->qty;
                                        }
                                        @endphp
                                        <!--<div class="avialable-amount opacity-60">
                                                @if ($detailedProduct->stock_visibility_state == 'quantity')
                                                    (<span id="available-quantity">{{ $qty }}</span>
                                                    {{ translate('available') }})
                                                @elseif($detailedProduct->stock_visibility_state == 'text' && $qty >= 1)
                                                    (<span id="available-quantity">{{ translate('In Stock') }}</span>)
                                                @endif
                                            </div>-->
                                    </div>
                                </div>
                            </div>

                            @include('frontend.components.pincode-checker')
                        </form>

                         <!-- Countdown Timer Display -->
                        <div id="countdown-container" class="d-none mt-0 mb-4">
                            <div class="countdown_class d-flex align-items-center gap-5">
                            <i class="fa-regular fa-clock"></i><div id="countdown">Loading countdown...</div>
                            </div>
                        </div>

                        <div class="mt-3 button_dt_buy_cart">
                            @if ($detailedProduct->external_link != null)
                            <a type="button" class="btn btn-primary buy-now fw-600"
                                href="{{ $detailedProduct->external_link }}">
                                <i class="la la-share"></i> {{ translate($detailedProduct->external_link_btn) }}
                            </a>
                            @else

                            <button type="button" class="btn btn-primary buy-now button_colors_1 greenbg fw-600 mb-md-0 mb-3" onclick="buyNow()">
                                <i class="la la-shopping-cart"></i> {{ translate('Buy Now') }}
                            </button>
                              <button type="button" class="btn btn-soft-primary ml-2 add-to-cart button_colors_1 darkgray_bg fw-600 gtagaddtocart mb-md-0 mb-3"
                                data-url="{{ url()->current() }}" onclick="addToCart()">
                                <i class="las la-shopping-bag"></i>
                                <span class="d-md-inline-block"> {{ translate('Add to cart') }}</span>
                            </button>
                            @endif
                            <button type="button" class="btn btn-secondary out-of-stock fw-600 d-none" disabled>
                                <i class="la la-cart-arrow-down"></i> {{ translate('Out of Stock') }}
                            </button>
                        </div>



                        <div class="d-table width-100 mt-3">
                            <div class="d-table-cell">
                                <!-- Add to wishlist button
                                    <button type="button" class="btn pl-0 btn-link fw-600"
                                        onclick="addToWishList({{ $detailedProduct->id }})">
                                        {{ translate('Add to wishlist') }}
                                    </button>-->
                                <!-- Add to compare button
                                    <button type="button" class="btn btn-link btn-icon-left fw-600"
                                        onclick="addToCompare({{ $detailedProduct->id }})">
                                        {{ translate('Add to compare') }}
                                    </button>-->
                                @if (Auth::check() && addon_is_activated('affiliate_system') &&
                                (\App\Models\AffiliateOption::where('type', 'product_sharing')->first()->status ||
                                \App\Models\AffiliateOption::where('type', 'category_wise_affiliate')->first()->status)
                                && Auth::user()->affiliate_user != null && Auth::user()->affiliate_user->status)
                                @php
                                if (Auth::check()) {
                                if (Auth::user()->referral_code == null) {
                                Auth::user()->referral_code = substr(Auth::user()->id . Str::random(10), 0, 10);
                                Auth::user()->save();
                                }
                                $referral_code = Auth::user()->referral_code;
                                $referral_code_url = URL::to('/product') . '/' . $detailedProduct->slug .
                                "?product_referral_code=$referral_code";
                                }
                                @endphp
                                <div>
                                    <button type=button id="ref-cpurl-btn" class="btn btn-sm btn-secondary"
                                        data-attrcpy="{{ translate('Copied') }}" onclick="CopyToClipboard(this)"
                                        data-url="{{ $referral_code_url }}">{{ translate('Copy the Promote Link') }}</button>
                                </div>
                                @endif
                            </div>
                        </div>
                        <?php  if(!empty($detailedProduct->short_description)){?>
                        <div class="fs-14 my-2 my-md-4">
                            <?php echo $detailedProduct->short_description; ?>
                        </div>
                        <?php } ?>
                        @php
                        $refund_sticker = get_setting('refund_sticker');
                        @endphp
                        @if (addon_is_activated('refund_request'))
                        <div class="row no-gutters mt-md-3">





                            <div class="col-12 guarantee_main_div">
                                <div class="guarantee_img_div">
                                    <img class="guarantee_img"
                                        src="{{ static_asset('assets/img/guarantee_shield.png')}}">
                                </div>
                                <div class="satisfaction_text_div">
                                    <p class="satisfaction_text gray_green_clr">We guarantee a 100% safe and secure payment experience
                                    </p>
                                </div>
                            </div>


                            @if(str_contains(strtolower($detailedProduct->getTranslation('name')), 'chocolate'))

                            @else
                            <div class="col-12 guarantee_main_div mb-md-2 mb-1">
                                <div class="guarantee_img_div">
                                    <img class="guarantee_img" src="{{ static_asset('assets/img/flower_icon.png')}}">
                                </div>
                                <div class="satisfaction_text_div">
                                    <p class="satisfaction_text gray_green_clr">Freshness Guarantee for Every Bloom</p>
                                </div>
                            </div>
                            @endif




                            <div class="mt-2">
                                <div class="opacity-90">{{ translate('Refund') }}:</div>
                            </div>
                            <div class=" mt-2">
                                <a href="{{ route('returnpolicy') }}" target="_blank" class="d-none">
                                    @if ($refund_sticker != null)
                                    <img src="{{ uploaded_asset($refund_sticker) }}" height="36">
                                    @else
                                    <img src="{{ static_asset('assets/img/refund-sticker2.png') }}" height="36">
                                    @endif
                                </a>
                                <a href="{{ route('returnpolicy') }}" class="ml-1 fw-600 gray_green_clr"
                                    target="_blank">{{ translate('View Policy') }}</a>
                            </div>
                        </div>
                        @endif
                        <div class="row no-gutters mt-1">
                            <div class="col-md-12">
                                <div class="opacity-90 my-2">{{ translate('Visit Us') }}:</div>
                            </div>
                            <div class="col-md-12">
                                <!-- <div class="aiz-share"></div> -->
                                <div class="social-media-links">
                                    <a target="_blank" href="https://www.instagram.com/atfleurs/"
                                        class="social-icon">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                    <a target="_blank" href="https://x.com/Atfleurss" class="social-icon">
                                        <i class="fa fa-x-twitter"></i>
                                    </a>
                                    <a target="_blank" href="https://m.facebook.com/atfleurs/"
                                        class="social-icon">
                                        <i class="fa fa-facebook-f"></i>
                                    </a>
                                    <a target="_blank" href="https://www.linkedin.com/in/at-fleurs-39749b273/"
                                        class="social-icon">
                                        <i class="fa fa-linkedin-in"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb-4">
    <div class="container">
        <div class="row gutters-10">
            <div class="col-xl-3 order-1 order-xl-0 d-none">
                @if ($detailedProduct->added_by == 'seller' && $detailedProduct->user->shop != null)
                <div class="bg-white shadow-sm mb-3">
                    <div class="position-relative p-3 text-left">
                        @if ($detailedProduct->user->shop->verification_status)
                        <div class="absolute-top-right p-2 bg-white z-1">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve"
                                viewBox="0 0 287.5 442.2" width="22" height="34">
                                <polygon style="fill:#F8B517;"
                                    points="223.4,442.2 143.8,376.7 64.1,442.2 64.1,215.3 223.4,215.3 " />
                                <circle style="fill:#FBD303;" cx="143.8" cy="143.8" r="143.8" />
                                <circle style="fill:#F8B517;" cx="143.8" cy="143.8" r="93.6" />
                                <polygon style="fill:#FCFCFD;" points="143.8,55.9 163.4,116.6 227.5,116.6 175.6,154.3 195.6,215.3 143.8,177.7 91.9,215.3 111.9,154.3
                                            60,116.6 124.1,116.6 " />
                            </svg>
                        </div>
                        @endif
                        <div class="opacity-90 fs-12 border-bottom">{{ translate('Sold by') }}</div>
                        <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}"
                            class="text-reset d-block fw-600">
                            {{ $detailedProduct->user->shop->name }}
                            @if ($detailedProduct->user->shop->verification_status == 1)
                            <span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span>
                            @else
                            <span class="ml-2"><i class="fa fa-times-circle" style="color:red"></i></span>
                            @endif
                        </a>
                        <div class="location opacity-70">{{ $detailedProduct->user->shop->address }}</div>
                        <div class="text-center border rounded p-2 mt-3">
                            <div class="rating">
                                @if ($total > 0)
                                {{ renderStarRating($detailedProduct->user->shop->rating) }}
                                @else
                                {{ renderStarRating(0) }}
                                @endif
                            </div>
                            <div class="opacity-60 fs-12">({{ $total }}
                                {{ translate('customer reviews') }})</div>
                        </div>
                    </div>
                    <div class="row no-gutters align-items-center border-top">
                        <div class="col">
                            <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}"
                                class="d-block btn btn-soft-primary rounded-0">{{ translate('Visit Store') }}</a>
                        </div>
                        <div class="col">
                            <ul class="social list-inline mb-0">
                                <li class="list-inline-item mr-0">
                                    <a href="{{ $detailedProduct->user->shop->facebook }}" class="facebook"
                                        target="_blank">
                                        <i class="lab la-facebook-f opacity-60"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <a href="{{ $detailedProduct->user->shop->google }}" class="google" target="_blank">
                                        <i class="lab la-google opacity-60"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <a href="{{ $detailedProduct->user->shop->twitter }}" class="twitter"
                                        target="_blank">
                                        <i class="lab la-twitter opacity-60"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ $detailedProduct->user->shop->youtube }}" class="youtube"
                                        target="_blank">
                                        <i class="lab la-youtube opacity-60"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                <div class="bg-white rounded shadow-sm mb-3 d-none">
                    <div class="p-3 border-bottom fs-16 fw-600">
                        {{ translate('Top Selling Products') }}
                    </div>
                    <div class="p-3">
                        <ul class="list-group list-group-flush">
                            @foreach (filter_products(\App\Models\Product::where('user_id',
                            $detailedProduct->user_id)->orderBy('num_of_sale', 'desc'))->limit(6)->get()
                            as $key => $top_product)
                            <li class="py-3 px-0 list-group-item border-light">
                                <div class="row gutters-10 align-items-center">
                                    <div class="col-5">
                                        <a href="{{ route('product', $top_product->slug) }}" class="d-block text-reset">
                                            <img class="img-fit lazyload h-xxl-110px h-xl-80px h-120px"
                                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                data-src="{{ uploaded_asset($top_product->thumbnail_img) }}"
                                                alt="{{ $top_product->getTranslation('name') }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                        </a>
                                    </div>
                                    <div class="col-7 text-left">
                                        <h4 class="fs-13 text-truncate-2">
                                            <a href="{{ route('product', $top_product->slug) }}"
                                                class="d-block text-reset">{{ $top_product->getTranslation('name') }}</a>
                                        </h4>
                                        <!--<div class="rating rating-sm mt-1">
                                                    {{ renderStarRating($top_product->rating) }}
                                                </div>-->
                                        <div class="mt-2">
                                            <span
                                                class="fs-17 fw-600 text-primary">{{ home_discounted_base_price($top_product) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 order-0 order-xl-1 related_boxex_12">
                <div class="bg-md-white mb-3 ">
                    <!--<div class="nav border-bottom aiz-nav-tabs">-->
                    <!--    <a href="#tab_default_1" data-toggle="tab"-->
                    <!--        class="p-3 fs-16 fw-600 text-reset active show">{{ translate('Description') }}</a>-->
                    <!--    @if ($detailedProduct->video_link != null)-->
                    <!--        <a href="#tab_default_2" data-toggle="tab"-->
                    <!--            class="p-3 fs-16 fw-600 text-reset">{{ translate('Video') }}</a>-->
                    <!--    @endif-->
                    <!--    @if ($detailedProduct->pdf != null)-->
                    <!--        <a href="#tab_default_3" data-toggle="tab"-->
                    <!--            class="p-3 fs-16 fw-600 text-reset">{{ translate('Downloads') }}</a>-->
                    <!--    @endif-->
                    <!--    <a href="#tab_default_4" data-toggle="tab"-->
                    <!--        class="p-3 fs-16 fw-600 text-reset">{{ translate('Reviews') }}</a>-->
                    <!--</div>-->

                    <div class="tab-content pt-0">
                        <div class="tab-pane fade active show" id="tab_default_1">
                            <div class="">
                                <div class="mw-100 overflow-auto text-left aiz-editor-data">
                                    <h5 class="fw-500 pb-1 heading_font1 green_color related_hed">{{ translate('Description') }}</h5>
                                    <?php echo $detailedProduct->getTranslation('description'); ?>
                                </div>
                            </div>


                            <div class="pt-4">
                                <h5 class="fw-500 pb-1 heading_font1 green_color related_hed text-capitalize">{{ translate('Reviews') }}</h5>
                                <ul class="list-group list-group-flush">
                                    @foreach ($detailedProduct->reviews as $key => $review)
                                    @if ($review->user != null)
                                    <li class="media list-group-item d-flex">
                                        <span class="avatar avatar-md mr-3">
                                            <img class="lazyload" src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                @if ($review->user->avatar_original != null)
                                            data-src="{{ uploaded_asset($review->user->avatar_original) }}"
                                            @else
                                            data-src="{{ static_asset('assets/img/placeholder.jpg') }}" @endif>
                                        </span>
                                        <div class="media-body text-left">
                                            <div class="d-flex justify-content-between">
                                                <h3 class="fs-15 fw-600 mb-0">{{ $review->user->name }}
                                                </h3>
                                                <span class="rating rating-sm">
                                                    @for ($i = 0; $i < $review->rating; $i++)
                                                        <i class="las la-star active"></i>
                                                        @endfor
                                                        @for ($i = 0; $i < 5 - $review->rating; $i++)
                                                            <i class="las la-star"></i>
                                                            @endfor
                                                </span>
                                            </div>
                                            <div class="opacity-60 mb-2">
                                                {{ date('d-m-Y', strtotime($review->created_at)) }}</div>
                                            <p class="comment-text">
                                                {{ $review->comment }}
                                            </p>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>

                                @if (count($detailedProduct->reviews) <= 0) <div class="text-left fs-14 opacity-70">
                                    {{ translate('There have been no reviews for this product yet.') }}
                            </div>
                            @endif
                        </div>


                    </div>

                    <div class="tab-pane fade d-none" id="tab_default_2">
                        <div class="p-4">
                            <div class="embed-responsive embed-responsive-16by9">
                                @if ($detailedProduct->video_provider == 'youtube' && isset(explode('=',
                                $detailedProduct->video_link)[1]))
                                <iframe class="embed-responsive-item"
                                    src="https://www.youtube.com/embed/{{ get_url_params($detailedProduct->video_link, 'v') }}"></iframe>
                                @elseif ($detailedProduct->video_provider == 'dailymotion' && isset(explode('video/',
                                $detailedProduct->video_link)[1]))
                                <iframe class="embed-responsive-item"
                                    src="https://www.dailymotion.com/embed/video/{{ explode('video/', $detailedProduct->video_link)[1] }}"></iframe>
                                @elseif ($detailedProduct->video_provider == 'vimeo' && isset(explode('vimeo.com/',
                                $detailedProduct->video_link)[1]))
                                <iframe
                                    src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $detailedProduct->video_link)[1] }}"
                                    width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen
                                    allowfullscreen></iframe>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="d-none tab-pane fade" id="tab_default_3">
                        <div class="p-4 text-center ">
                            <a href="{{ uploaded_asset($detailedProduct->pdf) }}"
                                class="btn btn-primary">{{ translate('Download') }}</a>
                        </div>
                    </div>
                    <div class="d-none tab-pane fade" id="tab_default_4">

                    </div>
                </div>
            </div>
            @php
            $cat_id = json_decode($detailedProduct->category_id, true);
            if (is_array($cat_id)) {
            $related_products = \App\Models\Product::where(function($query) use ($cat_id, $detailedProduct) {
            foreach ($cat_id as $category_id) {
            $query->orWhere('category_id', 'LIKE', "%\"$category_id\"%");
            }
            })
            ->where('id', '!=', $detailedProduct->id)
            ->where('published', 1)
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();
            } else {
            $related_products = collect(); // Empty collection
            }
            @endphp
            @if ($related_products->isNotEmpty())
            <div class="bg-md-white">
                <div class="pt-3">
                    <h5 class="fw-500 pb-0 mb-1 heading_font1 green_color related_hed">Related <span class="yellow_color">Products</span></h5>
                </div>
                <div class="">
                    <div class="aiz-carousel gutters-5 half-outside-arrow" data-items="5" data-xl-items="5"
                        data-lg-items="4" data-md-items="5" data-sm-items="2" data-xs-items="2" data-arrows='true'
                        data-infinite='true'>
                        {{--
                                @foreach (filter_products(\App\Models\Product::where('category_id', $detailedProduct->category_id)->where('id', '!=', $detailedProduct->id))->limit(10)->get() as $key => $related_product)
                                --}}
                        @foreach ($related_products as $key => $related_product)
                        <div class="carousel-box">
                            <div class="aiz-card-box my-2 has-transition">
                                <div class="">
                                    <a href="{{ route('product', $related_product->slug) }}" class="d-block">
                                        <img class="img-fit lazyload mx-auto"
                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            data-src="{{ uploaded_asset($related_product->thumbnail_img) }}"
                                            alt="{{ $related_product->getTranslation('name') }}"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                    </a>
                                </div>

  <div class="row align-items-center">
     <div class="col-md-10 col-10 p-md-3 bg-white">
                                <div class="text-left">
                                    <h3 class="fw-500 fs-14 text-truncate-2 lh-1-7 mb-0 h-43px pt-md-0 pt-2">
                                        <a href="{{ route('product', $related_product->slug) }}"
                                            class="d-block text-reset fs-16 green_color">{{ $related_product->getTranslation('name') }}</a>
                                    </h3>
                                    <div class="text-left">
                                        @if (home_base_price($related_product) !=
                                        home_discounted_base_price($related_product))
                                        <del
                                            class="fw-600 mobile-16 fs-20 green_color mr-1">{{ home_base_price($related_product) }}</del>
                                        @endif
                                        <span
                                            class="fw-600 mobile-16 fs-20 green_color">{{ home_discounted_base_price($related_product) }}</span>
                                    </div>
                                    <!--<div class="rating rating-sm mt-1">-->
                                    <!--    {{ renderStarRating($related_product->rating) }}-->
                                    <!--</div>-->
                                    @if (addon_is_activated('club_point'))
                                    <div class="rounded px-2 mt-2 bg-soft-primary border-soft-primary border">
                                        {{ translate('Club Point') }}:
                                        <span class="fw-900 green_color fs-20 float-right">{{ $related_product->earn_point }}</span>
                                    </div>
                                    @endif
                                </div>
                                </div>

                                   <div class="col-md-2 col-2 d-lg-block d-none">
<div class="arrow_area related_arrow">
      <a href="{{ route('product', $related_product->slug) }}" class="d-block text-reset fs-16 green_color"><img src="{{ static_asset('assets/img/green_arrow_left.svg') }}" /></a>
   </div>
    </div>


                                </div>



                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            {{-- Product Query --}}
            @if(get_setting('product_query_activation') == 1)
            <div class="bg-white rounded shadow-sm mt-3">
                <div class="border-bottom p-3">
                    <h3 class="fs-18 fw-600 mb-0">
                        <span>{{ translate(' Product Queries ') }} ({{ $total_query }})</span>
                    </h3>
                </div>
                @guest
                <p class="fs-14 fw-400 mb-0 ml-3 mt-2"><a href="{{ route('user.login') }}">{{ translate('Login') }}</a>
                    or <a class="mr-1"
                        href="{{ route('user.registration') }}">{{ translate('Register ') }}</a>{{ translate(' to submit your questions to seller') }}
                </p>
                @endguest
                @auth
                <div class="query form p-3">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('product-queries.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product" value="{{ $detailedProduct->id }}">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" cols="40" name="question"
                                placeholder="{{ translate('Write your question here...') }}"
                                style="resize: none;"></textarea>

                        </div>
                        <button type="submit" class="btn btn-primary">{{ translate('Submit') }}</button>
                    </form>
                </div>
                @php
                $own_product_queries = Auth::user()->product_queries->where('product_id',$detailedProduct->id);
                @endphp
                @if ($own_product_queries->count() > 0)

                <div class="question-area my-4   mb-0 ml-3">

                    <div class="border-bottom py-3">
                        <h3 class="fs-18 fw-600 mb-0">
                            <span class="mr-4">{{ translate('My Questions') }}</span>
                        </h3>
                    </div>
                    @foreach ($own_product_queries as $product_query)
                    <div class="produc-queries border-bottom">
                        <div class="query d-flex my-4">
                            <span class="mt-1"><svg xmlns="http://www.w3.org/2000/svg" width="24.994" height="24.981"
                                    viewBox="0 0 24.994 24.981">
                                    <g id="Group_23909" data-name="Group 23909"
                                        transform="translate(18392.496 11044.037)">
                                        <path id="Subtraction_90" data-name="Subtraction 90"
                                            d="M1830.569-117.742a.4.4,0,0,1-.158-.035.423.423,0,0,1-.252-.446c0-.84,0-1.692,0-2.516v-2.2a5.481,5.481,0,0,1-2.391-.745,5.331,5.331,0,0,1-2.749-4.711c-.034-2.365-.018-4.769,0-7.094l0-.649a5.539,5.539,0,0,1,4.694-5.513,5.842,5.842,0,0,1,.921-.065q3.865,0,7.73,0l5.035,0a5.539,5.539,0,0,1,5.591,5.57c.01,2.577.01,5.166,0,7.693a5.54,5.54,0,0,1-4.842,5.506,6.5,6.5,0,0,1-.823.046l-3.225,0c-1.454,0-2.753,0-3.97,0a.555.555,0,0,0-.435.182c-1.205,1.214-2.435,2.445-3.623,3.636l-.062.062-1.005,1.007-.037.037-.069.069A.464.464,0,0,1,1830.569-117.742Zm7.37-11.235h0l1.914,1.521.817-.754-1.621-1.273a3.517,3.517,0,0,0,1.172-1.487,5.633,5.633,0,0,0,.418-2.267v-.58a5.629,5.629,0,0,0-.448-2.323,3.443,3.443,0,0,0-1.282-1.525,3.538,3.538,0,0,0-1.93-.53,3.473,3.473,0,0,0-1.905.534,3.482,3.482,0,0,0-1.288,1.537,5.582,5.582,0,0,0-.454,2.314v.654a5.405,5.405,0,0,0,.471,2.261,3.492,3.492,0,0,0,1.287,1.5,3.492,3.492,0,0,0,1.9.527,3.911,3.911,0,0,0,.947-.112Zm-.948-.9a2.122,2.122,0,0,1-1.812-.9,4.125,4.125,0,0,1-.652-2.457v-.667a4.008,4.008,0,0,1,.671-2.4,2.118,2.118,0,0,1,1.78-.863,2.138,2.138,0,0,1,1.824.869,4.145,4.145,0,0,1,.639,2.473v.673a4.07,4.07,0,0,1-.655,2.423A2.125,2.125,0,0,1,1836.991-129.881Z"
                                            transform="translate(-20217 -10901.814)" fill="#e62e04"
                                            stroke="rgba(0,0,0,0)" stroke-miterlimit="10" stroke-width="1" />
                                    </g>
                                </svg></span>

                            <div class="ml-3">
                                <div class="fs-14">{{ strip_tags($product_query->question) }}</div>
                                <span class="text-secondary">{{ $product_query->user->name }} </span>
                            </div>
                        </div>
                        <div class="answer d-flex my-4">
                            <span class="mt-1"> <svg xmlns="http://www.w3.org/2000/svg" width="24.99" height="24.98"
                                    viewBox="0 0 24.99 24.98">
                                    <g id="Group_23908" data-name="Group 23908"
                                        transform="translate(17952.169 11072.5)">
                                        <path id="Subtraction_89" data-name="Subtraction 89"
                                            d="M2162.9-146.2a.4.4,0,0,1-.159-.035.423.423,0,0,1-.251-.446q0-.979,0-1.958V-151.4a5.478,5.478,0,0,1-2.39-.744,5.335,5.335,0,0,1-2.75-4.712c-.034-2.355-.018-4.75,0-7.065l0-.678a5.54,5.54,0,0,1,4.7-5.513,5.639,5.639,0,0,1,.92-.064c2.527,0,5.029,0,7.437,0l5.329,0a5.538,5.538,0,0,1,5.591,5.57c.01,2.708.01,5.224,0,7.692a5.539,5.539,0,0,1-4.843,5.506,6,6,0,0,1-.822.046l-3.234,0c-1.358,0-2.691,0-3.96,0a.556.556,0,0,0-.436.182c-1.173,1.182-2.357,2.367-3.5,3.514l-1.189,1.192-.047.048-.058.059A.462.462,0,0,1,2162.9-146.2Zm5.115-12.835h3.559l.812,2.223h1.149l-3.25-8.494h-.98l-3.244,8.494h1.155l.8-2.222Zm3.226-.915h-2.888l1.441-3.974,1.447,3.972Z"
                                            transform="translate(-20109 -10901.815)" fill="#f7941d"
                                            stroke="rgba(0,0,0,0)" stroke-miterlimit="10" stroke-width="1" />
                                    </g>
                                </svg></span>

                            <div class="ml-3">
                                <div class="fs-14">
                                    {{ strip_tags($product_query->reply ? $product_query->reply : translate('Seller did not respond yet')) }}
                                </div>
                                <span class=" text-secondary">
                                    {{ $product_query->product->user->name }} </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @endif
                @endauth

                <div class="pagination-area my-4 mb-0 ml-3">
                    @include('frontend.partials.product_query_pagination')
                </div>
            </div>
            @endif
            {{-- End of Product Query --}}
        </div>
    </div>
    </div>
</section>

@endsection

@section('modal')
<div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title fw-600 h5">{{ translate('Any query about this product') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                <div class="modal-body gry-bg px-3 pt-3">
                    <div class="form-group">
                        <input type="text" class="form-control mb-3" name="title" value="{{ $detailedProduct->name }}"
                            placeholder="{{ translate('Product Name') }}" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="8" name="message" required
                            placeholder="{{ translate('Your Question') }}">{{ route('product', $detailedProduct->slug) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary fw-600"
                        data-dismiss="modal">{{ translate('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary fw-600">{{ translate('Send') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Image Modal -->
<!-- <div class="modal fade product_dt_image_modal" id="imagezoommodal" tabindex="-1" role="dialog" aria-labelledby="imagezoommodalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-body">
        <img src="http://127.0.0.1:8000/uploads/all/VNFKMo0UuIuZsFEIgBCpFC5fTB0Wz1xkxdVIwweF.jpg" class="w-full w-100">
      </div>

    </div>
  </div>
</div> -->


<!-- Modal -->
<div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600">{{ translate('Login') }}</h6>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            @if (addon_is_activated('otp_system'))
                            <input type="text"
                                class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone') }}" name="email"
                                id="email">
                            @else
                            <input type="email"
                                class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                value="{{ old('email') }}" placeholder="{{ translate('Email') }}" name="email">
                            @endif
                            @if (addon_is_activated('otp_system'))
                            <span class="opacity-60">{{ translate('Use country code before number') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" class="form-control h-auto form-control-lg"
                                placeholder="{{ translate('Password') }}">
                        </div>

                        <div class="row mb-2">
                            <div class="col-6">
                                <label class="aiz-checkbox">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class=opacity-60>{{ translate('Remember Me') }}</span>
                                    <span class="aiz-square-check"></span>
                                </label>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('password.request') }}"
                                    class="text-reset opacity-60 fs-14">{{ translate('Forgot password?') }}</a>
                            </div>
                        </div>

                        <div class="mb-5">
                            <button type="submit"
                                class="btn btn-primary btn-block fw-600">{{ translate('Login') }}</button>
                        </div>
                    </form>

                    <div class="text-center mb-3">
                        <p class="text-muted mb-0">{{ translate('Dont have an account?') }}</p>
                        <a href="{{ route('user.registration') }}">{{ translate('Register Now') }}</a>
                    </div>
                    @if (get_setting('google_login') == 1 || get_setting('facebook_login') == 1 ||
                    get_setting('twitter_login') == 1 || get_setting('apple_login') == 1)
                    <div class="separator mb-3">
                        <span class="bg-white px-3 opacity-60">{{ translate('Or Login With') }}</span>
                    </div>
                    <ul class="list-inline social colored text-center mb-5">
                        @if (get_setting('facebook_login') == 1)
                        <li class="list-inline-item">
                            <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                <i class="lab la-facebook-f"></i>
                            </a>
                        </li>
                        @endif
                        @if (get_setting('google_login') == 1)
                        <li class="list-inline-item">
                            <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                <i class="lab la-google"></i>
                            </a>
                        </li>
                        @endif
                        @if (get_setting('twitter_login') == 1)
                        <li class="list-inline-item">
                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                <i class="lab la-twitter"></i>
                            </a>
                        </li>
                        @endif
                        @if (get_setting('apple_login') == 1)
                        <li class="list-inline-item">
                            <a href="{{ route('social.login', ['provider' => 'apple']) }}" class="apple">
                                <i class="lab la-apple"></i>
                            </a>
                        </li>
                        @endif
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection





@section('script')
<script type="text/javascript">

    // Variable to store the interval ID of the countdown
    let countdownInterval;
    function startCountdown(officeStart, officeEnd, deliveryIntervalHour) {
        // Clear any existing countdown interval
        if (countdownInterval) {
            clearInterval(countdownInterval);
        }

        // Set the current time and extract current hour
        const now = new Date();
        const currentHour = now.getHours();
        const deliveryIntervalMinutes = deliveryIntervalHour * 60;
        let targetTime;
        let targetMessage = "Get Today!";

        if (currentHour >= officeStart && currentHour < officeEnd) {
            // Case 1: Order placed during office hours (e.g., 8AM to 9PM)
            // console.log("Case 1: Order placed in office hours");
            targetTime = new Date(now.getTime() + deliveryIntervalMinutes * 60000);
            targetMessage = "Get Today!";
        } else {
            let targetDate = new Date(now);
            if (currentHour >= officeEnd) {
                // Case 2: Order placed after office hours (e.g., 9PM to 11:59PM)
                // console.log("Office End Hour:", officeEnd);
                // console.log("Case 2: Order placed after office hours");
                targetDate.setDate(targetDate.getDate() + 1); // Move to next day
                targetMessage = "Get Tomorrow!";
            } else {
                // Case 3: Order placed before office hours (e.g., 12:00AM to 7:59AM)
                // console.log("Case 3: Order placed before office hours");
                targetMessage = "Get Today!";
            }
            // Set targetDate to the office start hour while preserving current minutes
            targetDate.setHours(officeStart, now.getMinutes(), 0, 0);
            // Then add the delivery interval (in hours)
            targetTime = new Date(targetDate.getTime() + deliveryIntervalHour * 60 * 60000);
        }

        // Define the updateCountdown function to update the countdown display every second
        function updateCountdown() {
            const now = new Date();
            const timeDiff = targetTime - now;

            if (timeDiff <= 0) {
                $("#countdown").text("Time's up!");
                clearInterval(countdownInterval);
                return;
            }

            const hours = String(Math.floor(timeDiff / (1000 * 60 * 60))).padStart(2, "0");
            const minutes = String(Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, "0");
            const seconds = String(Math.floor((timeDiff % (1000 * 60)) / 1000)).padStart(2, "0");
            const countdownText = `${hours}:${minutes}:${seconds}`;

            $("#countdown").text(`${targetMessage} Order within ${countdownText} Hrs.`);
        }

        // Run the updateCountdown function every second
        countdownInterval = setInterval(updateCountdown, 1000);
    }


/*
    // Variable to store the interval ID of the countdown
    let countdownInterval;
function startCountdown(officeStart, officeEnd, deliveryIntervalHour) {
    // Clear any existing countdown interval
    if (countdownInterval) {
        clearInterval(countdownInterval);
    }

    // Set the current time and extract current hour
    const now = new Date();
    const currentHour = now.getHours();
    const deliveryIntervalMinutes = deliveryIntervalHour * 60;
    let targetTime;
    let targetMessage = "Get Today!";

    if (currentHour >= officeStart && currentHour < officeEnd) {
        // Case 1: Order placed during office hours (e.g., 8AM to 9PM)
        console.log("Case 1: Order placed in office hours");
        targetTime = new Date(now.getTime() + deliveryIntervalMinutes * 60000);
        targetMessage = "Get Today!";
    } else {
        let targetDate = new Date(now);
        if (currentHour >= officeEnd) {
            // Case 2: Order placed after office hours (e.g., 9PM to 11:59PM)
            console.log("Office End Hour:", officeEnd);
            console.log("Case 2: Order placed after office hours");
            targetDate.setDate(targetDate.getDate() + 1); // Move to next day
            targetMessage = "Get Tomorrow!";
        } else {
            // Case 3: Order placed before office hours (e.g., 12:00AM to 7:59AM)
            console.log("Case 3: Order placed before office hours");
            targetMessage = "Get Today!";
        }
        // Set targetDate to the office start hour while preserving current minutes
        targetDate.setHours(officeStart, now.getMinutes(), 0, 0);
        // Then add the delivery interval (in hours)
        targetTime = new Date(targetDate.getTime() + deliveryIntervalHour * 60 * 60000);
    }

    // Define the updateCountdown function to update the countdown display every second
    function updateCountdown() {
        const now = new Date();
        const timeDiff = targetTime - now;

        if (timeDiff <= 0) {
            $("#countdown").text("Time's up!");
            clearInterval(countdownInterval);
            return;
        }

        const hours = String(Math.floor(timeDiff / (1000 * 60 * 60))).padStart(2, "0");
        const minutes = String(Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, "0");
        const seconds = String(Math.floor((timeDiff % (1000 * 60)) / 1000)).padStart(2, "0");
        const countdownText = `${hours}:${minutes}:${seconds}`;

        $("#countdown").text(`${targetMessage} Order within ${countdownText} Hrs.`);
    }

    // Run the updateCountdown function every second
    countdownInterval = setInterval(updateCountdown, 1000);
}
*/

/*
 // Global variable for static testing: initial manual "current" time.
 let staticNow = new Date('2025-02-21T22:00:00');

// Global variable to store the interval ID of the countdown
let countdownInterval;

function startCountdown(officeStart, officeEnd, deliveryIntervalHour) {
    // Clear any existing countdown interval
    if (countdownInterval) {
        clearInterval(countdownInterval);
    }

    // For static testing, use the manual time (staticNow) instead of live time.
    // In a live scenario, you would use: const now = new Date();
    // const now = staticNow;

    const now = new Date();

    const currentHour = now.getHours();
    let targetTime;
    let targetMessage;
    const deliveryIntervalMinutes = 3 * 60; // Convert delivery interval to minutes

    if (currentHour >= officeStart && currentHour < officeEnd) {
        // Case 1: Order placed during office hours (8AM to 9PM)
        targetTime = new Date(now.getTime() + deliveryIntervalMinutes * 60000);
        targetMessage = "Get Today!";
    } else {
        let targetDate = new Date(now);
        if (currentHour >= officeEnd) {
            // Case 2: Order placed after office hours (9PM to 11:59PM)
            console.log("Office End Hour:", officeEnd);
            console.log("Case 2: Order placed after office hours");
            targetDate.setDate(targetDate.getDate() + 1); // Move to next day
            targetMessage = "Get Tomorrow!";
        } else {
            // Case 3: Order placed before office hours (12:00AM to 7:59AM)
            console.log("Case 3: Order placed 12 baje");
            targetMessage = "Get Today!";
        }
        // Set targetDate to the office start hour, preserving the minutes from the current time
        targetDate.setHours(officeStart, now.getMinutes(), 0, 0);
        // Then add the delivery interval (3 hours)
        targetTime = new Date(targetDate.getTime() + 3 * 60 * 60000);
    }

    console.log("Static Current Time:", now);
    console.log("Target Time:", targetTime);

    // Define the updateCountdown function for static testing
    function updateCountdown() {
        // Increment the staticNow by one second on each update
        staticNow = new Date(staticNow.getTime() + 1000);

        // Use the manually updated staticNow for our countdown calculation
        const timeDiff = targetTime - staticNow;

        if (timeDiff <= 0) {
            $("#countdown").text("Time's up!");
            return;
        }

        const hours = String(Math.floor(timeDiff / (1000 * 60 * 60))).padStart(2, "0");
        const minutes = String(Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, "0");
        const seconds = String(Math.floor((timeDiff % (1000 * 60)) / 1000)).padStart(2, "0");

        const countdownText = `${hours}:${minutes}:${seconds}`;
        $("#countdown").text(`${targetMessage} Order within ${countdownText} Hrs.`);
    }

    // Run the updateCountdown function every second (using static time increments)
    countdownInterval = setInterval(updateCountdown, 1000);
}
*/

    // $(document).on('click', '#check-pincode-btn', function() {
    //     var pincode = $('#pincode').val().trim();
    //     var productId = $('#product_id').val();

    //     if (pincode === '' || pincode.length !== 6) {
    //         $('#pincode-result').html('<span class="error">Please enter a valid 6-digit pincode.</span>');
    //         return;
    //     }

    //     $.ajax({
    //         url: "{{ route('check.pincode') }}",
    //         method: "POST",
    //         data: {
    //             _token: "{{ csrf_token() }}",
    //             pincode: pincode,
    //             product_id: productId
    //         },
    //         success: function(response) {
    //             if (response.status === 'success') {
    //                 $('#pincode').prop('readonly', true);
    //                 // $('#check-pincode-btn').text('Recheck');
    //                 $('#check-pincode-btn').prop('disabled', true);
    //                 $('#pincode-result').html(`<span class="success">${response.message}</span>`);
    //                 // Call the function with delivery interval from the response
    //                 startCountdown(
    //                     {{ getBusinessSettingValue("office_start") }} ?? 8,
    //                     {{ getBusinessSettingValue("office_end") }} ?? 21,
    //                     response.delivery_interval
    //                 );

    //                 // $('#delivery_interval').html(`<span class="success">${response.delivery_interval}</span>`);
    //                 // Enable "Buy Now" and "Add to Cart" buttons
    //                 $('.buy-now, .add-to-cart').prop('disabled', false);
    //                 if (!$('#edit-pincode-btn').length) {
    //                     $('<button>', {
    //                         id: 'edit-pincode-btn',
    //                         type: 'button',
    //                         class: 'btn btn-link ms-2',
    //                         html: '<i class="fa fa-edit"></i>'
    //                     }).insertAfter('#check-pincode-btn');
    //                 }
    //             } else {
    //                 $('#pincode-result').html(`<span class="error">${response.message}</span>`);
    //                 // Disable "Buy Now" and "Add to Cart" buttons
    //                 $('.buy-now, .add-to-cart').prop('disabled', true);
    //             }
    //         },
    //         error: function() {
    //             $('#pincode-result').html(
    //                 '<span class="error">An error occurred. Please try again.</span>');
    //                 // Disable "Buy Now" and "Add to Cart" buttons
    //                 $('.buy-now, .add-to-cart').prop('disabled', true);
    //         }
    //     });
    // });
    // Define the function to handle the pincode check
    function checkPincode() {
        var pincode = $('#pincode').val().trim();
        var productId = $('#product_id').val();
        var isValid = false;

        if (pincode === '' || pincode.length !== 6) {
            $('#pincode-result').html('<span class="error">Please enter a valid 6-digit pincode.</span>');
            return false;
        }

        if ($('#pincode').hasClass('error')) {
            $('#pincode').removeClass('error'); // Remove the error class if it was previously applied
        }

        $.ajax({
            url: "{{ route('check.pincode') }}",
            method: "POST",
            async: false, // ✅ Make it synchronous so it returns true/false directly
            data: {
                _token: "{{ csrf_token() }}",
                pincode: pincode,
                product_id: productId
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#pincode').prop('readonly', true);
                    $('#check-pincode-btn').prop('disabled', true);
                    $('#pincode-result').html(`<span class="success">${response.message}</span>`);
                    $('#countdown-container').removeClass('d-none');

                    // startCountdown(
                    //     {{ getBusinessSettingValue("office_start") }} ?? 8,
                    //     {{ getBusinessSettingValue("office_end") }} ?? 21,
                    //     response.delivery_interval
                    // );
                    let officeStart2 = parseInt(`{{ getBusinessSettingValue("office_start") }}`) || 8;
                    let officeEnd2 = parseInt(`{{ getBusinessSettingValue("office_end") }}`) || 21;
                    let deliveryIntervalHour2 = parseInt(response.delivery_interval) || 3;

                    startCountdown(officeStart2, officeEnd2, deliveryIntervalHour2);


                    // $('.buy-now, .add-to-cart').prop('disabled', false);
                    if (!$('#edit-pincode-btn').length) {
                        $('<button>', {
                            id: 'edit-pincode-btn',
                            type: 'button',
                            class: 'btn btn-link ms-2',
                            html: '<i class="fa fa-edit"></i>'
                        }).insertAfter('#check-pincode-btn');
                    }
                    isValid = true; // ✅ Mark as valid
                } else {
                    $('#pincode-result').html(`<span class="error">${response.message}</span>`);
                    $('#pincode').addClass('error'); // Add the error class to apply the red border
                    // $('.buy-now, .add-to-cart').prop('disabled', true);
                    $('#countdown-container').addClass('d-none');
                }
            },
            error: function() {
                $('#pincode-result').html('<span class="error">An error occurred. Please try again.</span>');
                $('#pincode').addClass('error'); // Add the error class to apply the red border
                // $('.buy-now, .add-to-cart').prop('disabled', true);
                $('#countdown-container').addClass('d-none');
            }
        });

        return isValid; // ✅ Return the final validation result
    }


    $(document).on('click', '#check-pincode-btn', function(e) {
        e.preventDefault(); // Prevent the default button behavior if needed (like form submit)
        // checkPincode();  // Call the checkPincode function when the button is clicked
        if(checkPincode()){
            $('#edit-pincode-btn').removeClass('d-none');
        }
    });

    // $(document).on('keyup', '#pincode', function(e) {
    //     var pincode = $(this).val().trim();
    //     if (pincode.length === 6) {
    //         $('#check-pincode-btn').click();

    //         // Check if the edit button has the class 'd-none'
    //         // and if #pincode-result does not contain the text 'Product is not deliverable'
    //         if ($('#edit-pincode-btn').hasClass('d-none') && !$('#pincode-result').text().includes('Sorry, product is not deliverable to this pincode.')) {
    //             console.log('product is not deliverable');
    //             $('#edit-pincode-btn').removeClass('d-none');
    //         }
    //     }
    // });

    $(document).on('keyup', '#pincode', function(e) {
        var pincode = $(this).val().trim();
        if (pincode.length === 6) {
            $('#check-pincode-btn').click();

            // Check if the edit button has the class 'd-none'
            // and if #pincode-result does not exactly match the text
            // 'Sorry, product is not deliverable to this pincode.'
            if ($('#edit-pincode-btn').hasClass('d-none') && $('#pincode-result').text().trim() !== 'Sorry, product is not deliverable to this pincode.') {
                console.log('Product is not deliverable');
                $('#edit-pincode-btn').removeClass('d-none');
            }
        }
    });



    // // Trigger check button when pincode length reaches 6
    // $(document).on('input', '#pincode', function(e) {
    //     var pincode = $(this).val().trim();
    //     if (pincode.length === 6) {
    //         $('#check-pincode-btn').click();
    //     }
    // });

    // Call the function on document ready (if necessary)
    $(document).ready(function() {
        var pinCode = $('#pincode').val().trim();

        if (pinCode !== '' && pinCode.length == 6) {
            checkPincode();
        }
    });

    $(document).on('click', '#edit-pincode-btn', function() {
        // $('#pincode').prop('readonly', false).focus();
        var pincodeInput = $('#pincode');
        pincodeInput.prop('readonly', false);

        // Focus on the input and set the cursor to the end
        pincodeInput.focus();
        var len = pincodeInput.val().length;
        pincodeInput[0].setSelectionRange(len, len);
        $('#check-pincode-btn').prop('disabled', false);
        $('#check-pincode-btn').text('Check');
        if ($('#pincode').hasClass('error')) {
            $('#pincode').removeClass('error'); // Remove the error class if it was previously applied
        }
        $('#pincode-result').empty();
        // Disable "Buy Now" and "Add to Cart" buttons
        // $('.buy-now, .add-to-cart').prop('disabled', true);
        // $(this).remove();
        $(this).addClass('d-none');
    });

    // On page load, disable the buttons
    // $('.buy-now, .add-to-cart').prop('disabled', true);


    // // Check session product availability
    // @if (session('pincode_result') && session('pincode_result')['status'] === 'success')
    //     $('.buy-now, .add-to-cart').prop('disabled', false);
    // @endif
</script>
<script type="text/javascript">
$(document).ready(function() {
    getVariantPrice();
});

function CopyToClipboard(e) {
    var url = $(e).data('url');
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(url).select();
    try {
        document.execCommand("copy");
        AIZ.plugins.notify('success', '{{ translate('
            Link copied to clipboard ') }}');
    } catch (err) {
        AIZ.plugins.notify('danger', '{{ translate('
            Oops, unable to copy ') }}');
    }
    $temp.remove();
    // if (document.selection) {
    //     var range = document.body.createTextRange();
    //     range.moveToElementText(document.getElementById(containerid));
    //     range.select().createTextRange();
    //     document.execCommand("Copy");

    // } else if (window.getSelection) {
    //     var range = document.createRange();
    //     document.getElementById(containerid).style.display = "block";
    //     range.selectNode(document.getElementById(containerid));
    //     window.getSelection().addRange(range);
    //     document.execCommand("Copy");
    //     document.getElementById(containerid).style.display = "none";

    // }
    // AIZ.plugins.notify('success', 'Copied');
}

function show_chat_modal() {
    @if(Auth::check())
    $('#chat_modal').modal('show');
    @else
    $('#login_modal').modal('show');
    @endif
}

// Pagination using ajax
$(window).on('hashchange', function() {
    if (window.location.hash) {
        var page = window.location.hash.replace('#', '');
        if (page == Number.NaN || page <= 0) {
            return false;
        } else {
            getQuestions(page);
        }
    }
});

$(document).ready(function() {
    $(document).on('click', '.pagination a', function(e) {
        getQuestions($(this).attr('href').split('page=')[1]);
        e.preventDefault();
    });
});

function getQuestions(page) {
    $.ajax({
        url: '?page=' + page,
        dataType: 'json',
    }).done(function(data) {
        $('.pagination-area').html(data);
        location.hash = page;
    }).fail(function() {
        alert('Something went worng! Questions could not be loaded.');
    });
}
// Pagination end
</script>
@endsection
