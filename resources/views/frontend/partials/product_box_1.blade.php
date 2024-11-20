<div class="aiz-card-box border border-light rounded hov-shadow-md mt-1 mb-2 has-transition balsamiq_font">
    <!--@if(discount_in_percentage($product) > 0)-->
    <!--    <span class="badge-custom">{{ translate('OFF') }}<span class="box ml-1 mr-0">&nbsp;{{discount_in_percentage($product)}}%</span></span>-->
    <!--@endif-->
    <div class="position-relative product_bg">
        @php
            $product_url = route('product', $product->slug);
            if($product->auction_product == 1) {
                $product_url = route('auction-product', $product->slug);
            }

            $product_tag = $product->product_tag_id;
            if ($product_tag != null) {
                $product_tag_name = DB::table('product_tag')
                    ->select('name')
                    ->where('status', 1)
                    ->where('id', $product_tag)
                    ->first();
            }else{
                $product_tag_name = null;
            }
        @endphp
        <a href="{{ $product_url }}" class="d-block">
            @if($product_tag_name != null)<p class="badges_box animationEffect" > {{$product_tag_name->name}} </p> @endif
            <img loading="lazy"
                class="img-fit lazyload mx-auto"
                src="{{ static_asset('assets/img/spinner.webp') }}"
                data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                alt="{{  $product->getTranslation('name')  }}"
                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/spinner.webp') }}';"
            >
        </a>
        
       
        
        @if ($product->wholesale_product)
            <span class="absolute-bottom-left fs-11 text-white fw-600 px-2 lh-1-8" style="background-color: #455a64">
                {{ translate('Wholesale') }}
            </span>
        @endif
        <div class="absolute-top-right aiz-p-hov-icon">
            @if(isset(auth()->user()->id))
            @php
              $isWishlist = DB::table('wishlists')
                  ->where('user_id', auth()->user()->id)
                  ->where('product_id', $product->id)
                  ->exists();
            @endphp

            <a hrer="#" onclick="addToWishList({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}" data-placement="left" data-id="{{ $product->id }}" class="wishlist @if($isWishlist) active @endif">
                <i class="la la-heart-o"></i>
            </a>
            @endif
            <a class="display_none" hrer="#" onclick="addToCompare({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to compare') }}" data-placement="left">
                <i class="las la-sync"></i>
            </a>
            <a class="display_none" hrer="#" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to cart') }}" data-placement="left">
                <i class="las la-shopping-cart"></i>
            </a>
        </div>
    </div>
    <div class="p-md-3 p-2 bg-white">
        
         <div class="text-center display_none">
            <a hrer="#" onclick="addToWishList({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}" data-placement="left">
                <i class="la la-heart-o"></i>
            </a>
            <a hrer="#" onclick="addToCompare({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to compare') }}" data-placement="left">
                <i class="las la-sync"></i>
            </a>
            <a hrer="#" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to cart') }}" data-placement="left">
                <i class="las la-shopping-cart"></i>
            </a>
        </div>
        
        
        <h3 class="fw-600 fs-14 text-truncate-2 lh-1-6 mb-2 leter_space">
            <a href="{{ $product_url }}" class="d-block text-reset">{{ ucwords($product->getTranslation('name')) }}</a>
            <!--<a href="{{ $product_url }}" class="d-block text-reset">{{  $product->getTranslation('name')  }}</a>-->
        </h3>
        
        @if (!empty($product->rating) )
            <div class="rating rating-sm mt-1">
                {{ renderStarRating($product->rating) }}
            </div>
        @endif
        
        <div class="fs-20 mt-1">
            <!--<span class="fw-700">{{ home_discounted_base_price($product) }}</span>-->
            <span class="fw-700">{{ home_discounted_price($product) }}</span> <!-- simple as well as varaint price (from / to) -->
            @if(home_base_price($product) != home_discounted_base_price($product))
                <del class="fw-600 fs-14 opacity-60 ml-2">{{ home_base_price($product) }}</del>
            <span class="text-center mx-1 discount_off"><span class="fs-14 fw-600 box" style="color:#f00;">&nbsp;{{discount_in_percentage($product)}}% Off</span></span>
            @endif
            
        </div>
       
        <!-- <div class="text-center buynow_button">
                <a href="{{ $product_url }}" class="d-block text-reset">Buy Now</a>
        </div>-->
        
        @if (addon_is_activated('club_point'))
            <div class="rounded px-2 mt-2 bg-soft-primary border-soft-primary border">
                {{ translate('Club Point') }}:
                <span class="fw-700 float-right">{{ $product->earn_point }}</span>
            </div>
        @endif
    </div>
</div>
