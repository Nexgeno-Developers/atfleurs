<div class="aiz-card-box-1 mt-1 mb-2 has-transition balsamiq_font">
    <div class="position-relative product_bg border-radius30">
        @php
            $sub_category_url = route('products.category', $subCategory->slug);
        @endphp
        <a href="{{ $sub_category_url }}" class="d-block">
            <img
                class="img-fit lazyload mx-auto"
                src="{{ static_asset('assets/img/spinner.webp') }}"
                data-src="{{ uploaded_asset($subCategory->banner) }}"
                alt="{{  $subCategory->getTranslation('name')  }}"
                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/spinner.webp') }}';"
            >
        </a>
    </div>
    <div class="p-md-3 p-2 text-center bg-white">
        <h3 class="fw-600 fs-14 text-truncate-2 lh-1-6 mb-1 leter_space">
            <a href="{{ $sub_category_url }}" class="d-block text-reset">{{  $subCategory->getTranslation('name')  }}</a>
        </h3>
    </div>
</div>