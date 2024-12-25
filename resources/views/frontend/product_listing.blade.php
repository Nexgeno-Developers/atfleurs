@extends('frontend.layouts.app')

@if (isset($category_id))
    @php
        $meta_title = \App\Models\Category::find($category_id)->meta_title;
        $meta_description = \App\Models\Category::find($category_id)->meta_description;
        $faq = DB::table('categories')
        ->where('id', $category_id)
        ->value('faq');
    @endphp
@elseif (isset($brand_id))
    @php
        $meta_title = \App\Models\Brand::find($brand_id)->meta_title;
        $meta_description = \App\Models\Brand::find($brand_id)->meta_description;
    @endphp
@else
    @php
        $meta_title         = get_setting('meta_title');
        $meta_description   = get_setting('meta_description');
    @endphp
@endif

@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $meta_title }}">
    <meta itemprop="description" content="{{ $meta_description }}">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="{{ $meta_title }}">
    <meta name="twitter:description" content="{{ $meta_description }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
    
    <style>
        .aiz-main-wrapper {
    background-color: #fff !important;
}
    </style>
@endsection

@section('content')

    <section class="mb-4 pt-md-5 pt-2">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-12 ">
                    @if(isset($category_id))
                                <h3>
                                    <a class="d-inline-block text-dark fw-600 breadcrumb-item heading_font1 p-0 green_color" href="{{ route('products.category', \App\Models\Category::find($category_id)->slug) }}">{{ \App\Models\Category::find($category_id)->getTranslation('name') }}</a>
                                </h3>
                            @endif

                        <ul class="breadcrumb bg-transparent p-0 mb-0">
                            <li class="breadcrumb-item opacity-90">
                                <a class="text-reset" href="{{ route('home') }}">{{ translate('Home')}}</a>
                            </li>
                            @if(!isset($category_id))
                                <li class="breadcrumb-item fw-600  text-dark">
                                    <a class="text-reset" href="{{ route('search') }}">"{{ translate('All Categories')}}"</a>
                                </li>
                            @else
                                <li class="breadcrumb-item opacity-90">
                                    <a class="text-reset" href="{{ route('search') }}">{{ translate('All Categories')}}</a>
                                </li>
                            @endif
                            @if(isset($category_id))
                                <li class="text-dark fw-600 breadcrumb-item">
                                    <a class="text-reset" href="{{ route('products.category', \App\Models\Category::find($category_id)->slug) }}">"{{ \App\Models\Category::find($category_id)->getTranslation('name') }}"</a>
                                </li>
                            @endif
                        </ul>
                        
                        </div>
                        @if($products->count() > 0)
                            <div class="col-md-7 col-12 d-flex justify-content-md-end align-items-center">
                             <div class="d-flex align-items-center rounded mb-lg-3 mb-2">
                                    <div class="fs-15 fw-600 p-md-1 p-0"> Sort By: </div>
                                        <div class="p-1">
                                            <div class="sortbar_tabs-container">
                                                <div class="btn-group" role="group" aria-label="Sorting Options">
                                                    <select onchange="window.location.href=this.value" class="form-select">
                                                        <option value="{{ request()->fullUrlWithQuery(['sort_by' => 'featured']) }}" {{ request('sort_by') == 'featured' || !request('sort_by') ? 'selected' : '' }}>
                                                            Recommended
                                                        </option>
                                                        <option value="{{ request()->fullUrlWithQuery(['sort_by' => 'newest']) }}" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>
                                                            Newest
                                                        </option>
                                                        <option value="{{ request()->fullUrlWithQuery(['sort_by' => 'price-asc']) }}" {{ request('sort_by') == 'price-asc' ? 'selected' : '' }}>
                                                            Price Low to High
                                                        </option>
                                                        <option value="{{ request()->fullUrlWithQuery(['sort_by' => 'price-desc']) }}" {{ request('sort_by') == 'price-desc' ? 'selected' : '' }}>
                                                            Price High to Low
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                @foreach ($attributes as $attribute)
                                    <div class="bg-white shadow-sm rounded mb-3 d-none">
                                        <div class="fs-15 fw-600 p-3 border-bottom">
                                            <a href="#" class="dropdown-toggle text-dark filter-section collapsed" data-toggle="collapse" data-target="#collapse_{{ str_replace(' ', '_', $attribute->name) }}">
                                                {{ translate('Filter by') }} {{ $attribute->getTranslation('name') }}
                                            </a>
                                        </div>
                                        <div class="collapse" id="collapse_{{ str_replace(' ', '_', $attribute->name) }}">
                                            <div class="p-2  aiz-checkbox-list">
                                                @foreach ($attribute->attribute_values as $attribute_value)
                                                    <label class="aiz-checkbox">
                                                        <input
                                                            type="checkbox"
                                                            name="selected_attribute_values[]"
                                                            value="{{ $attribute_value->value }}" @if (in_array($attribute_value->value, $selected_attribute_values)) checked @endif
                                                            onchange="filter()"
                                                        >
                                                        <span class="aiz-square-check"></span>
                                                        <span>{{ $attribute_value->value }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @if (get_setting('color_filter_activation'))
                                    <div class="bg-white shadow-sm rounded mb-3">
                                        <div class="fs-15 fw-600 p-3 border-bottom">
                                            <a href="#" class="dropdown-toggle text-dark filter-section collapsed" data-toggle="collapse" data-target="#collapse_color">
                                                {{ translate('Filter by color')}}
                                            </a>
                                        </div>
                                        <div class="collapse" id="collapse_color">
                                            <div class="p-2 aiz-radio-inline">
                                                @foreach ($colors as $key => $color)
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="{{ $color->name }}">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="{{ $color->code }}"
                                                        onchange="filter()"
                                                        @if(isset($selected_color) && $selected_color == $color->code) checked @endif
                                                    >
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: {{ $color->code }};"></span>
                                                    </span>
                                                </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                </div>
                                @endif
                          </div>
                    </div>
        <div class="container sm-px-0">
            <form class="" id="search-form" action="" method="GET">
                <div class="row">
                    <div class="col-xl-12">
                        <input type="hidden" name="min_price" value="">
                        <input type="hidden" name="max_price" value="">
                        @if($products->count() > 0)
                        <div class="row gutters-5 row-cols-xxl-4 row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-2" id="product-boxes">
                            {{--
                            @foreach ($products as $key => $product)
                                <div class="col">
                                    @include('frontend.partials.product_box_1',['product' => $product])
                                </div>
                            @endforeach
                            --}}
                            @include('frontend.partials.product_items')
                        </div>
                        @else
                           <h4 class="text-center">No Products Available!</h4>
                        @endif
                        <div class="d-none aiz-pagination aiz-pagination-center mt-4">
                            {{ $products->appends(request()->input())->links() }}
                        </div>
                        <div id="loading" class="text-center mt-4" style="display:none;">
                            <img style="width: 4vw;" src="{{ static_asset('assets/img/loader.gif') }}" alt="Loading...">
                        </div>
                        <br>
                         
                      @if(isset($category_id))
                            @php
                                $title = \App\Models\Category::find($category_id)->title;
                                $description = \App\Models\Category::find($category_id)->description;
                            @endphp
                            @if(!empty($title) && !empty($description))
                              <div class="card">
                                  <div class="card-body category_main">
                                        
                                        @if($title)
                                            <h1 class="card-title">{{ucwords ($title) }}</h1>
                                        @endif
                                        
                                        @if($description)
                                        @php echo html_entity_decode($description) @endphp
                                        @endif                            
                                   
                                    </div>
                                                                
                            </div>

                            @endif
                                                        
                        @endif
                        @if(isset($category_id))
                             @php 
                                $faq = json_decode($faq, true);
                            @endphp 
                            @if(!empty($faq))
                                <div class="card">
                                  <div class="card-body category_main_faq">
                                    <h4 class="card-title">FAQs</h4>
                                    
                                    
                                        @php
                                            $counter = 1;
                                        @endphp

                                        @foreach ($faq as $question => $answer)
                                            <div>
                                                <p class="mb-1 card-text"><b>{{ $counter }}. {{ $question }}</b></p>   
                                                <p class="card-text">{{ $answer }}</p> 
                                            </div>
                                            <br>
                                            @php
                                                $counter++;
                                            @endphp
                                        @endforeach


                                  </div>
                                </div>
                                @endif
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    var loading = false; // Prevent multiple AJAX requests
    var hasMorePages = true; // Flag to check if there are more pages
    var currentPage = 1; // Keep track of the current page

    function loadMoreProducts(url) {
        if (loading || !hasMorePages) return;
        loading = true;

        // Ensure the URL uses HTTPS and preserve the 'sort_by' parameter if exists
        var httpsUrl = url.replace(/^http:/, 'https:');
        var sortBy = '{{ request('sort_by') }}'; // Get the current 'sort_by' value from the request

        // Only append 'sort_by' if it isn't already in the URL
        if (sortBy && !httpsUrl.includes('sort_by=')) {
            httpsUrl += (httpsUrl.indexOf('?') !== -1 ? '&' : '?') + 'sort_by=' + sortBy;
        }

        $.ajax({
            url: httpsUrl,
            type: 'GET',
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(response) {
                // Append the new products
                $('#product-boxes').append(response.products);

                // Update the next page URL
                if (response.nextPage) {
                    var nextPageUrl = response.nextPage;
                    // Only append 'sort_by' if it isn't already in the nextPageUrl
                    if (sortBy && !nextPageUrl.includes('sort_by=')) {
                        nextPageUrl += (nextPageUrl.indexOf('?') !== -1 ? '&' : '?') + 'sort_by=' + sortBy;
                    }
                    $('.aiz-pagination').html('<a href="' + nextPageUrl + '" class="load-more">Load More</a>');
                    currentPage++;
                } else {
                    $('.aiz-pagination').empty(); // No more pages
                    hasMorePages = false; // No more pages to load
                }

                $('#loading').hide();
                loading = false;
            },
            error: function() {
                $('#loading').hide();
                loading = false;
            }
        });
    }

    // Function to check if the user has scrolled to the bottom
    function checkScroll() {
        var element = $('#product-boxes');
        var scrollTop = $(window).scrollTop();
        var windowHeight = $(window).height();
        var elementOffset = element.offset().top;
        var elementHeight = element.height();

        if (scrollTop + windowHeight > elementOffset + elementHeight - 100) {
            var nextPageUrl = $('.aiz-pagination a').attr('href');
            if (nextPageUrl) {
                loadMoreProducts(nextPageUrl);
            }
        }
    }

    // Check scroll position on load and on scroll
    $(window).on('scroll', checkScroll);
    checkScroll(); // Initial check

    // Optional: load more products when clicking 'Load More' button
    $(document).on('click', '.aiz-pagination a.load-more', function(e) {
        e.preventDefault();
        loadMoreProducts($(this).attr('href'));
    });
});
    function filter(){
        $('#search-form').submit();
    }
    function rangefilter(arg){
        $('input[name=min_price]').val(arg[0]);
        $('input[name=max_price]').val(arg[1]);
        filter();
    }
</script>
@endsection
