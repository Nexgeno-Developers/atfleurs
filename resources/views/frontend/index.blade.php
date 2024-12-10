
@extends('frontend.layouts.app')

@section('content')

<style>
    .aiz-main-wrapper {
    min-height: 100vh;
    max-width: 100vw;
    background: #fff !important;
}
.handwriting_img img {
    border-radius: 31px;
}
</style>
    <!-- {{-- Categories , Sliders . Today's deal --}}
    <div class="home-banner-area">
        <div class="row gutters-10 position-relative">
               
                @php
                    $num_todays_deal = count($todays_deal_products);
                @endphp

                <div class="@if($num_todays_deal > 0) col-lg-12 @else col-lg-12 @endif">
                    @if (get_setting('home_slider_images') != null)
                        <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-arrows="true" data-dots="true" data-autoplay="true">
                            @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
                            @foreach ($slider_images as $key => $value)
                                <div class="carousel-box">
                                    <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
                                        <img @if($key > 0) loading="lazy" @endif class="d-block mw-100 img-fit shadow-sm overflow-hidden" src="{{ uploaded_asset($slider_images[$key]) }}" alt="Slider Banner" @if(count($featured_categories) == 0) height="457" @else height="315" @endif onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';" >
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                 
                </div>


            </div>
    </div> -->
  
<div class="main_banner_slider">
    <div class="slick-banner-mian">
    <div class="slide" style="background-image: url('{{ static_asset('assets/img/banner_main_1.webp ') }}');">
      <div class="slide-content">
        <h4>Astronomia & Lily <span class="d-md-block">Flower Bouquets</span> </h4>
        <p>Shop collections you can live in</p>
        <div class=" button_effects mt-5">
                <a class="green_color fs-bold" href="#">Discover More <i class="fa-solid fa-arrow-right"></i></a>
         </div>
      </div>
    </div>
    <div class="slide" style="background-image: url('{{ static_asset('assets/img/banner_main_2.webp ') }}');">
      <div class="slide-content">
        <h4>Artificial Tulips  <span class="d-md-block">Flower With Dry Stick</span> </h4>
        <p>Shop collections you can live in</p>
        <div class=" button_effects mt-5">
                <a class="green_color fs-bold" href="#">Discover More <i class="fa-solid fa-arrow-right"></i></a>
         </div>
      </div>
    </div>
     <div class="slide" style="background-image: url('{{ static_asset('assets/img/banner_main_3.webp ') }}');">
      <div class="slide-content">
        <h4>Pink Rose Flower <span class="d-md-block">Arrangement</span> </h4>
        <p>Shop collections you can live in</p>
        <div class=" button_effects mt-5">
                <a class="green_color fs-bold" href="#">Discover More <i class="fa-solid fa-arrow-right"></i></a>
         </div>
      </div>
    </div>

  </div>

  <!-- <div class="custom-pagination">
  <span class="current-slide">01</span>
  <div class="pagination-line"></div>
  <span class="total-slides">04</span>
</div> -->
  </div>



<section class="pt-5 pb-5">
    <div class="container ">
        <div class="row">
            <div class="col-md-12 ">

            <div class="mx-auto text-center mb-3">
                <img src="{{ static_asset('assets/img/flower_icon.svg ') }}" />
            </div>
                <h4 class="heading_one heading_font1 green_color text-capitalize text-center">Welcome to <span class="yellow_color">our colourful world.</span></h4>
           
                <p class="text-center">Floral greetings from At Fleurs, a boutique flower studio in suburban Mumbai! <span class="d-block">
Our skilled team of passionate floral designers create exquisite arrangements with buds and blossoms for all occasions. Our collective </span>years in the industry allow us the luxury of acquired expertise, an eye for detail and, most importantly, impeccable service.</p>

<div class="text-center">
    <a class="green_color fs-bold" href="#"><b><u>Read Story</u></b></a>
</div>
            </div>
        </div>
    </div>
</section>


<section class="elegant_blooms_sec orange_light_bg">
        <div class="row align-items-center">
            <div class="col-md-6 ">
                <div class="mx-auto text-center mb-3">
                <img src="{{ static_asset('assets/img/flower_icon.svg ') }}" />
                </div>

                <h4 class="heading_one1 heading_font1 yellow_color text-capitalize text-center pb-3">Elegant Blooms, <span class="green_color d-lg-block">Artfully Curated for</span>Unique <span class="green_color">Moments</span></h4>
                <p class="text-center body_text_vw width_70 mx-auto">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                <div class="text-center button_effects mt-5">
                <a class="green_color fs-bold" href="#">Discover More <i class="fa-solid fa-arrow-right"></i></a>
               </div>
           </div>

            <div class="col-md-6 ">
               <div class="blooms_video">
                <video class="embed-responsive embed-responsive-16by9" autoplay="" muted="" loop="" id="myVideo2">
                        <source src="{{ static_asset('assets/img/elegant_blooms.mp4 ') }}" type="video/mp4">
                    </video>
                </div>
           </div>
        </div>
</section>

     <div class="product_category shop_collection pt-xl-6 pt-lg-6 pt-md-6 pt-5 pb-5 ">
        <div class="container">
             <h4 class="heading_one heading_font1  green_color text-capitalize text-center pb-3">Discover our <span class="yellow_color">exquisite array</span></h4>
            <div class="row gutters-10 position-relative">
                

                @php
                    $num_todays_deal = count($todays_deal_products);
                @endphp

                <div class="@if($num_todays_deal > 0) col-lg-12 @else col-lg-12 @endif">
                    @if (count($featured_categories) > 0)
                         <div class="row gutters-10 position-relative">
                         @foreach ($featured_categories as $key => $category)
                                <div class="minw-0 col-lg-4 col-6 mt-3 border_radius_ct position-relative">
                                    <a href="{{ route('products.category', $category->slug) }}" class="d-block rounded text-reset ">
                                        
                                        <div class="main_category">
                                        <img loading="lazy"
                                            src="{{ static_asset('assets/img/spinner.webp') }}"
                                            data-src="{{ uploaded_asset($category->banner) }}"
                                            alt="{{ $category->getTranslation('name') }} - Category Image"
                                            class="lazyload img-fit category_image" 
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/spinner.webp') }}';"
                                        >
                                        </div>
                                        
                                        <div class="category_content_sec">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <h4 class="text-truncate text-white text-start fw-400 fs-20 text-uppercase mt-3 mt-lg-4 pb-0">{{ $category->getTranslation('name') }}</h4>
                                               <p class="text-white fs-12">Lorem ipsum dolor sit amet</p>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="arrow_category"><img src="{{ static_asset('assets/img/left_arrow_1.svg ') }}" /></div>
                                               
                                            </div>

                                        </div>
                                        </div>
                                        



                                    </a>
                                </div>
                            @endforeach
                            </div>
                    @endif
                </div>

                <!--<div class="col-md-12 text-center">
                     <a href="/categories" class="btn btn-primary balsamiq_font allcateogry mt-3">View All Category</a>
                </div>-->
               
               
                

            </div>
        </div>
    </div>
    
    <!-- <div class="pb-4 today_deals">
        <div class="container">
            <div class="anniversary_bg"></div>
    @if($num_todays_deal > 0)
                <div class="order-3 mt-3 mt-lg-0">
                    <div class="rounded">
                      
                          <div class="pt-5 text-center position_relative align-items-baseline">
                   <h3 class="h2 fw-700 mb-0 heading_font1">
                            <span class="border-bottom border-primary border-width-2 pb-2 d-inline-block">{{ translate('Deal of the Day') }}</span>
                        </h3>
                    
                            
                </div>
                
                <div class="aiz-carousel d-flex gutters-10 half-outside-arrow" data-items="5" data-xl-items="5" data-lg-items="5"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
                                   
                            @foreach ($todays_deal_products as $key => $product)
                                @if ($product != null)
                                
                                @php
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
            
                                 <a href="{{ route('product', $product->slug) }}" class="d-block p-2 text-reset rounded">
                                        <div class="gutters-5 align-items-center">
                                            <div class="col-xxl">
                                                <div class="img image_box_shadow">
                                                    @if($product_tag_name != null)<p class="badges_box animationEffect" > {{$product_tag_name->name}} </p> @endif
                                                    <img loading="lazy"
                                                        class="lazyload img-fit"
                                                        src="{{ static_asset('assets/img/spinner.webp') }}"
                                                        data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                        alt="{{ $product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/spinner.webp') }}';"
                                                    >
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <h4 class="mt-3 fw-600 fs-13 text-truncate-2 lh-1-5 mb-1 leter_space today_hed">{{ $product->name }}
                        </h4>
                        
                        <div class="rating rating-sm mt-0">
            {{ renderStarRating($product->rating) }}
        </div>
                                                    <span class="d-block text-primary fw-700 fs-20 mt-1">{{ home_discounted_base_price($product) }}</span>
                                                    @if(home_base_price($product) != home_discounted_base_price($product))
                                                        <del class="d-block opacity-70">{{ home_base_price($product) }}</del>
                                                    @endif
                                            </div>
                                        </div>
                                    </a>
                               
                                @endif
                            @endforeach
                             </div>
                    </div>
                </div>
                @endif
                
                </div>
</div>
 -->


              
    
    

    {{-- Banner section 1 --}}
    @if (get_setting('home_banner1_images') != null)
    <div class="">
        <div class="container">
            <div class="row gutters-10">
                @php $banner_1_imags = json_decode(get_setting('home_banner1_images')); @endphp
                @foreach ($banner_1_imags as $key => $value)
                    <div class="col-xl col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}" class="d-block text-reset">
                                <img loading="lazy" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_1_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif


    {{-- Flash Deal --}}
    @php
        $flash_deal = \App\Models\FlashDeal::where('status', 1)->where('featured', 1)->first();
    @endphp
    @if($flash_deal != null && strtotime(date('Y-m-d H:i:s')) >= $flash_deal->start_date && strtotime(date('Y-m-d H:i:s')) <= $flash_deal->end_date)
    <section>
        <div class="container">
            <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">

                <div class="d-flex flex-wrap mb-3 align-items-baseline border-bottom">
                    <h3 class="h5 fw-700 mb-0">
                        <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Flash Sale') }}</span>
                    </h3>
                    <div class="aiz-count-down ml-auto ml-lg-3 align-items-center" data-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                    <a href="{{ route('flash-deal-details', $flash_deal->slug) }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md w-100 w-md-auto">{{ translate('View More') }}</a>
                </div>

                <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'>
                    @foreach ($flash_deal->flash_deal_products->take(20) as $key => $flash_deal_product)
                        @php
                            $product = \App\Models\Product::find($flash_deal_product->product_id);
                        @endphp
                        @if ($product != null && $product->published != 0)
                            <div class="carousel-box best_selling_img">
                                @include('frontend.partials.product_box_1',['product' => $product])
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif




    <div id="section_newest">
        @if (count($newest_products) > 0)
            <section class="section-padding pb-0 pt-4">
                <div class="container">
                    <div class="">
                        <div class="mb-4 align-items-baseline">
                         
                            <h4 class="heading_one heading_font1 green_color text-capitalize text-center">New <span class="yellow_color">In</span></h4>
           
                        </div>
                        
                        <!--<div class="anniversary_bg"></div>-->
                        <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="4" data-xl-items="4" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'>
                            @foreach ($newest_products as $key => $new_product)
                            <div class="carousel-box">
                                @include('frontend.partials.product_box_1',['product' => $new_product])
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                </div>
            </section>   
        @endif
    </div>


    
<section class="ocasssion_video">
        <div class="row align-items-center">
          <div class="video-background">
  <video class="embed-responsive embed-responsive-16by9" autoplay="" muted="" loop="" id="myVideo2">
                        <source src="{{ static_asset('assets/img/occassion_video.mp4 ') }}" type="video/mp4">
                    </video>
  <div class="content">
     <div class="mx-auto text-center mb-3">
                <img src="{{ static_asset('assets/img/flower_icon.svg ') }}" />
                </div>

   <h4 class="heading_one heading_font1 green_color text-capitalize">Artful Floral Creations <span class="yellow_color d-lg-block ml-50">for Every Occasion</span></h4>
   <div class="text-center button_effects mt-4 ml-5">
                <a class="green_color fs-bold" href="#">Discover More <i class="fa-solid fa-arrow-right"></i></a>
               </div>  
</div>
</div>
        </div>
</section>







    <section class="elegant_blooms_sec pt-5 ">
        <div class="row align-items-center">


        <div class="col-md-12">
             <div class="mx-auto text-center mb-3">
                <img src="{{ static_asset('assets/img/flower_icon.svg ') }}" />
                </div>
            <h4 class="heading_one heading_font1 green_color text-capitalize text-center pb-3"> In petals’ grace, <span class="yellow_color">stories bloom,</span><span class="d-lg-block">Nature’s whispers fill the room. </span><span class="d-lg-block">Crafted beauty, a heartfelt art,</span>Floral wonders, soul and heart.</h4>
           



        </div>
            <div class="col-md-6 ">
                <div class="">
                <img class="w-100" src="{{ static_asset('assets/img/bloomin_img2.svg ') }}" />
                </div>
           </div>
            <div class="col-md-6 ">
                <div class="mx-auto text-center mb-3">
                <img src="{{ static_asset('assets/img/flower_icon.svg ') }}" />
                </div>

                <h4 class="heading_one heading_font1 green_color text-capitalize text-center pb-3">Blossoming Tradition:  <span class="d-lg-block">Honoring Nature’s </span>Timeless Art Moments</h4>
                <p class="text-center body_text_vw width_70 mx-auto">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

</p>
               
           </div>

            
        </div>
</section>

<section class="elegant_blooms_sec">
        <div class="row align-items-center">
            <div class="col-md-6 ">
                <div class="mx-auto text-center mb-3">
                <img src="{{ static_asset('assets/img/flower_icon.svg ') }}" />
                </div>

                <h4 class="heading_one heading_font1 green_color text-capitalize text-center pb-3">Artistry in Bloom: Where<span class=" d-lg-block">Creativity Meets Craft</span></h4>
                <p class="text-center body_text_vw width_70 mx-auto">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
       
           </div>

            <div class="col-md-6 ">
                <div class="">
                <img class="w-100" src="{{ static_asset('assets/img/bloomin_img3.svg ') }}" />
                </div>
           </div>
        </div>
</section>



    {{-- Featured Section --}}
    <div id="section_featured" class="display_none">

    </div>

{{-- Category wise Products --}}
    <div id="section_home_categories" class="mb-5">

    </div>

{{-- Best Selling  --}}
    <div id="section_best_selling">

    </div>
    
    
   <!-- @if(addon_is_activated('auction'))
        <div id="auction_products">

        </div>
    @endif-->



    <!--{{-- Banner Section 2 --}}
    @if (get_setting('home_banner2_images') != null)
    <div class="mb-4">
        <div class="container">
            <div class="row gutters-10">
                @php $banner_2_imags = json_decode(get_setting('home_banner2_images')); @endphp
                @foreach ($banner_2_imags as $key => $value)
                    <div class="col-xl col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}" class="d-block text-reset">
                                <img loading="lazy" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_2_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif-->



    {{-- Classified Product --}}
    @if(get_setting('classified_product') == 1)
        @php
            $classified_products = \App\Models\CustomerProduct::where('status', '1')->where('published', '1')->take(10)->get();
        @endphp
           @if (count($classified_products) > 0)
               <section class="mb-4">
                   <div class="container">
                       <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
                            <div class="d-flex mb-3 align-items-baseline border-bottom">
                                <h3 class="h5 fw-700 mb-0">
                                    <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Classified Ads') }}</span>
                                </h3>
                                <a href="{{ route('customer.products') }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View More') }}</a>
                            </div>
                           <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'>
                               @foreach ($classified_products as $key => $classified_product)
                                   <div class="carousel-box">
                                        <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                            <div class="position-relative">
                                                <a href="{{ route('customer.product', $classified_product->slug) }}" class="d-block">
                                                    <img loading="lazy"
                                                        class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($classified_product->thumbnail_img) }}"
                                                        alt="{{ $classified_product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                    >
                                                </a>
                                                <div class="absolute-top-left pt-2 pl-2">
                                                    @if($classified_product->conditon == 'new')
                                                       <span class="badge badge-inline badge-success">{{translate('new')}}</span>
                                                    @elseif($classified_product->conditon == 'used')
                                                       <span class="badge badge-inline badge-danger">{{translate('Used')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="p-md-3 p-2 text-left">
                                                <div class="fs-15 mb-1">
                                                    <span class="fw-700 text-primary">{{ single_price($classified_product->unit_price) }}</span>
                                                </div>
                                                <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                    <a href="{{ route('customer.product', $classified_product->slug) }}" class="d-block text-reset">{{ $classified_product->getTranslation('name') }}</a>
                                                </h3>
                                            </div>
                                       </div>
                                   </div>
                               @endforeach
                           </div>
                       </div>
                   </div>
               </section>
           @endif
       @endif

    {{-- Banner Section 2 --}}
    @if (get_setting('home_banner3_images') != null)
    <div class="mb-4">
        <div class="container">
            <div class="row gutters-10">
                @php $banner_3_imags = json_decode(get_setting('home_banner3_images')); @endphp
                @foreach ($banner_3_imags as $key => $value)
                    <div class="col-xl col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="{{ json_decode(get_setting('home_banner3_links'), true)[$key] }}" class="d-block text-reset">
                                <img loading="lazy" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_3_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!--{{-- Best Seller --}}
    <div id="section_best_sellers">

    </div>-->

    <!--{{-- Top 10 categories and Brands --}}
    @if (get_setting('top10_categories') != null || get_setting('top10_brands') != null)
    @php
        $col_section = (get_setting('top10_categories') != null && get_setting('top10_brands') != null) ? 'col-lg-6' : 'col-lg-12';
        $col_block = (get_setting('top10_categories') != null && get_setting('top10_brands') != null) ? 'col-sm-6' : 'col-xl-3 col-lg-4 col-sm-6';
    @endphp
    <section class="mb-4">
        <div class="container">
            <div class="row gutters-10">
                @if (get_setting('top10_categories') != null)
                    <div class="{{ $col_section }}">
                        <div class="d-flex mb-3 align-items-baseline border-bottom">
                            <h3 class="h5 fw-700 mb-0">
                                <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Top 10 Categories') }}</span>
                            </h3>
                            <a href="{{ route('categories.all') }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View All Categories') }}</a>
                        </div>
                        <div class="row gutters-5">
                            @php $top10_categories = json_decode(get_setting('top10_categories')); @endphp
                            @foreach ($top10_categories as $key => $value)
                                @php $category = \App\Models\Category::find($value); @endphp
                                @if ($category != null)
                                    <div class="{{ $col_block }}">
                                        <a href="{{ route('products.category', $category->slug) }}" class="bg-white border d-block text-reset rounded p-2 hov-shadow-md mb-2">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col-3 text-center">
                                                    <img loading="lazy"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($category->banner) }}"
                                                        alt="{{ $category->getTranslation('name') }}"
                                                        class="img-fluid img lazyload h-60px"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                    >
                                                </div>
                                                <div class="col-7">
                                                    <div class="text-truncat-2 pl-3 fs-14 fw-600 text-left">{{ $category->getTranslation('name') }}</div>
                                                </div>
                                                <div class="col-2 text-center">
                                                    <i class="la la-angle-right text-primary"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
                @if (get_setting('top10_brands') != null)
                    <div class="{{ $col_section }}">
                        <div class="d-flex mb-3 align-items-baseline border-bottom">
                            <h3 class="h5 fw-700 mb-0">
                                <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Top 10 Brands') }}</span>
                            </h3>
                            <a href="{{ route('brands.all') }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View All Brands') }}</a>
                        </div>
                        <div class="row gutters-5">
                            @php $top10_brands = json_decode(get_setting('top10_brands')); @endphp
                            @foreach ($top10_brands as $key => $value)
                                @php $brand = \App\Models\Brand::find($value); @endphp
                                @if ($brand != null)
                                    <div class="{{ $col_block }}">
                                        <a href="{{ route('products.brand', $brand->slug) }}" class="bg-white border d-block text-reset rounded p-2 hov-shadow-md mb-2">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col-4 text-center">
                                                    <img loading="lazy"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($brand->logo) }}"
                                                        alt="{{ $brand->getTranslation('name') }}"
                                                        class="img-fluid img lazyload h-60px"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                    >
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-truncate-2 pl-3 fs-14 fw-600 text-left">{{ $brand->getTranslation('name') }}</div>
                                                </div>
                                                <div class="col-2 text-center">
                                                    <i class="la la-angle-right text-primary"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    @endif-->
    

<!-- 
<div class="about-us-section pt-5">
    <div class="container">
        <div class="row gutters-10 position-relative">
            
             <div class="col-lg-6">
                  <div class="about_content_box">
<h3 class="heading_font1">Don’t miss your 
change Just express 
your feelings</h3>

<a href="/" class="btn btn-primary balsamiq_font">Do It Now</a>


</div>
            </div>
            
            <div class="col-lg-6">
                <div class="abt_image_box">
                   <img loading="lazy" class="img-fit" src="{{ static_asset('assets/img/about_us.webp') }}" alt="about us image">
               </div>
            </div>
            
           
        </div>
    </div>
</div> -->

    
    
    <section class="reviews_section">
        <div class="container">
            
             <div class="mb-4 pt-2 text-center position_relative align-items-baseline">
                   
                         <h4 class="heading_one heading_font1 green_color text-capitalize text-center pb-3"> Our <span class="yellow_color">Testimonials</span></h4>
           
                    
                            
                </div>
                
  <div id="owl-carousel" class="owl-carousel owl-theme">
    <div class="item">
      <img loading="lazy" class="imgss" src="https://www.atfleurs.com/public/uploads/all/S0IKTuNSOGzaaq5VG4puI5GKjHLkDwXXg8ZODDC3.webp" alt="David">
      <h3>Sarah T</h3>
      <div class="rating1">
         <i class="las la-star"></i>
       <i class="las la-star"></i>
       <i class="las la-star"></i>
       <i class="las la-star"></i>
       <i class="las la-star"></i>
    </div>
      <p>I recently ordered a bouquet of flowers from this amazing flower website, and I was blown away by the beauty and freshness of the arrangement. The flowers were absolutely stunning and brought so much joy to the recipient. I highly recommend their services for any occasion!</p>
    </div>
    <div class="item">
      <img loading="lazy" class="imgss" src="https://www.atfleurs.com/public/uploads/all/bjcAqrjq5LwhNkjfL8laP8FuY6V8ArkChTGy1bgM.webp" alt="David">
      <h3>David M</h3>
      <div class="rating1">
        <i class="las la-star"></i>
       <i class="las la-star"></i>
       <i class="las la-star"></i>
       <i class="las la-star"></i>
       <i class="las la-star"></i>
    </div>
      <p>If you're looking for a reliable and talented florist, look no further. I have ordered multiple bouquets from this flower shop, and each one has been a work of art. The attention to detail and the selection of unique flowers sets them apart. Their arrangements have always brought smiles and happiness to the recipients. I highly recommend their services!</p>
    </div>
    <div class="item">
    
       <img loading="lazy" class="imgss" src="https://www.atfleurs.com/public/uploads/all/HmLwo8YVlRegthlQCiaHFmhNOsvlp7vUCKwc1yVd.webp" alt="Jennifer">
      <h3>Jennifer L</h3>
      <div class="rating1">
         <i class="las la-star"></i>
       <i class="las la-star"></i>
       <i class="las la-star"></i>
       <i class="las la-star"></i>
       <i class="las la-star"></i>
    </div>
      <p>I wanted to surprise my mother on her birthday, so I decided to order a bouquet from this flower shop. The entire experience was seamless, from browsing their website to placing the order. When the flowers arrived, they were absolutely breathtaking. My mother was overjoyed and couldn't stop raving about how beautiful they were. Thank you for making her day so special!</p>
    </div>
    <div class="item">
      <img loading="lazy" class="imgss" src="https://www.atfleurs.com/public/uploads/all/Mq0Pec2Lnh71G0jZV6wWIFR3pLdAZBA33AD20SB0.webp" alt="Mark">
      <h3>Mark S</h3>
      <div class="rating1">
        <i class="las la-star"></i>
       <i class="las la-star"></i>
       <i class="las la-star"></i>
       <i class="las la-star"></i>
       <i class="las la-star"></i>
    </div>
      <p>I recently received a bouquet of flowers from this flower website, and I was amazed by the quality and freshness of the arrangement. The colors were vibrant, and the fragrance filled the room. It was evident that great care had been taken in creating the bouquet. I will definitely be recommending this flower shop to all my friends and family.</p>
    </div>
     <div class="item">
      <img loading="lazy" class="imgss" src="https://www.atfleurs.com/public/uploads/all/646IMIsuUbqhruHQgsRHM7bKsY3tDmWeZKBQrZEI.webp" alt="Andrew">
      <h3>Andrew W</h3>
      <div class="rating1">
        <i class="las la-star"></i>
       <i class="las la-star"></i>
       <i class="las la-star"></i>
       <i class="las la-star"></i>
       <i class="las la-star"></i>
    </div>
      <p>I was searching for a unique bouquet for my wife's anniversary gift, and this flower shop delivered beyond my expectations. The arrangement was absolutely gorgeous, with a perfect blend of colors and textures. My wife was thrilled and couldn't stop gushing about the flowers. Thank you for helping me make our anniversary even more special!</p>
    </div>
    <div class="item">
      <img loading="lazy" class="imgss" src="https://www.atfleurs.com/public/uploads/all/olofBD9m8Sev79MagnS0rSM8cgtih71UsZ3Zr9zS.webp" alt="Rachel">
      <h3>Rachel K.</h3>
      <div class="rating1">
       <i class="las la-star"></i>
       <i class="las la-star"></i>
       <i class="las la-star"></i>
       <i class="las la-star"></i>
       <i class="las la-star"></i>
    </div>
      <p>I wanted to send flowers to a friend who was feeling down, and this flower shop created the most uplifting bouquet. The vibrant colors and the thoughtful combination of flowers brought a smile to her face. The ordering process was easy, and the delivery was prompt. I appreciate the excellent service and the positive impact these flowers had on my friend's mood. Highly recommended!</p>
    </div>
  </div>
</div>
</section>
<!-- 
<section class="texture_section pt-5">
		<div class="container">
			<div class="mb-5 pt-2 text-center position_relative align-items-baseline">
				 
                 <h4 class="heading_one heading_font1 green_color text-capitalize text-center pb-3"> What Our Customers <span class="yellow_color">Are Saying</span></h4>
           
                    
			</div>
			
			<div id="testiminials-texture" class="owl-carousel owl-theme">
				<div class="item">
					<div class="handwriting_img">
					<img class="w-100 rounded-3" src="/public/assets/img/testi_handwriting1.webp" alt="certificate of appreciation"/>
					</div>
				</div>
				
				<div class="item">
					<div class="handwriting_img">
					<img class="w-100 b" src="/public/assets/img/testi_handwriting2.webp" alt="certificate of appreciation" />
					</div>
				</div>
			</div>
		</div>
</section> -->



<section class="blog_section pb-0">
   <div class="container">
      <div class="mb-4 pt-2 text-center position_relative align-items-baseline">
       
          <h4 class="heading_one heading_font1 green_color text-capitalize text-center pb-3"> News & <span class="yellow_color">Blog</span></h4>
           
                    
      </div>
      <div class="row">
        @php DB::table('blogs')->orderBy('created_at', 'desc')->limit(3)->get(); @endphp
        @foreach($blogs as $blog)          
         <div class="col-md-4">
            <div class="blog_box">
               <div class="blog_img">
                  <a aria-label="Read More About Blog" href="{{ url("blog").'/'. $blog->slug }}">
                      {{--
                        <img loading="lazy"
                            src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                            data-src="{{ uploaded_asset($blog->banner) }}"
                            alt="{{ $blog->title }}"
                            class="img-fluid-1 lazyload "
                        > --}}
                    </a>
               </div>
               <div class="blog_content">
                  <h4>{{ $blog->title }}</h4>
                  <p class="two-lines">{{ $blog->short_description }}</p>
                  <a aria-label="Read More About Blog" class="read-color" href="{{ url("blog").'/'. $blog->slug }}">Read More...</a>
               </div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</section>

<!--<section class="pb-4">
    <div class="container">
        <div class="mb-5 pt-2 text-center position_relative align-items-baseline">
            <h3 class="h2 fw-700 mb-0 heading_font1">
                <span class="border-bottom border-primary border-width-2 pb-2 d-inline-block">{{ translate('Blog') }}</span>
            </h3>
        </div>        
        <div class="card-columns">
            @php DB::table('blogs')->orderBy('created_at', 'desc')->limit(3)->get(); @endphp
            @foreach($blogs as $blog)
                <div class="card mb-3 overflow-hidden shadow-sm">
                    <a href="{{ url("blog").'/'. $blog->slug }}" class="text-reset d-block">
                        <img loading="lazy"
                            src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                            data-src="{{ uploaded_asset($blog->banner) }}"
                            alt="{{ $blog->title }}"
                            class="img-fluid lazyload "
                        >
                    </a>
                    <div class="p-4">
                        <h2 class="fs-18 fw-600 mb-1">
                            <a href="{{ url("blog").'/'. $blog->slug }}" class="text-reset">
                                {{ $blog->title }}
                            </a>
                        </h2>
                        @if($blog->category != null)
                        <div class="mb-2 opacity-50">
                            <i>{{ $blog->category->category_name }}</i>
                        </div>
                        @endif
                        <p class="opacity-70 mb-4">
                            {{ $blog->short_description }}
                        </p>
                        <a href="{{ url("blog").'/'. $blog->slug }}" class="btn btn-soft-primary">
                            {{ translate('View More') }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>-->
   <div class="section-padding">
<div class="container">
   
     <div class="mb-4 text-center position_relative align-items-baseline">
                 
                        <h4 class="heading_one heading_font1 green_color text-capitalize text-center">Why<span class="yellow_color">Atfleurs</span></h4>
                    
                            
                </div>
<div class="row gutters-10 position-relative pt-2">

<div class="col-lg-3 col-6">
    <div class="free-delivery-box bg-light-orange ">
         <div class="mx-auto text-center mb-1">
        <img loading="lazy" class="img-fit" src="{{ static_asset('assets/img/delivery_icon.png') }}" alt="Free Delivery">
        </div>
        <h4 class="heading_font1 green_color">Free Delivery</h4>
        <p>Free shipping around the world for all orders on select products.</p>
    </div>
</div>

<div class="col-lg-3 col-6">
    <div class="free-delivery-box bg-light-orange ">
         <div class="mx-auto text-center mb-1">
       <img loading="lazy" class="img-fit" src="{{ static_asset('assets/img/cart_icon.png') }}" alt="Online Order">
       </div>
        <h4 class="heading_font1 green_color">Online Order</h4>
        <p>Don’t worry you can order Online by our Site</p>
    </div>
</div>

<div class="col-lg-3 col-6">
    <div class="free-delivery-box bg-light-orange ">
        <div class="mx-auto text-center mb-1">
                 <img loading="lazy" class="img-fit" src="{{ static_asset('assets/img/flowers_icon.png') }}" alt="Freshness">
                 
                </div>
       
        <h4 class="heading_font1 green_color">Freshness</h4>
        <p>You have freshness flowers every single order</p>
    </div>
</div>

<div class="col-lg-3 col-6">
    <div class="free-delivery-box bg-light-orange ">
         <div class="mx-auto text-center mb-1">
        <img loading="lazy" class="img-fit" src="{{ static_asset('assets/img/men_icon.png') }}" alt="Made By Artists">
        </div>
        <h4 class="heading_font1 green_color">Made By Indian Artists</h4>
        <p>World for all made by artists orders over now</p>
    </div>
</div>


</div>
</div>
</div>
    
    <section class="instagram_section pb-5 ">
          <h4 class="heading_one heading_font1 green_color text-capitalize text-center pb-3"> Check Our <span class="yellow_color">instagram</span></h4>
        
        <div class="container">
            <img src="{{ static_asset('assets/img/instagraan_img.png ') }}" class="w-100"/>
        </div>
    </section>
    
<!-- <section class="seosection pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="seo_heading">Flower Bouquets From Atfleurs Mumbai Making Every Occasion Special</h1><br><br>
                <b>Birthday:</b>
                <p>Celebrate another trip around the sun with the vibrant hues and sweet fragrances of a flower bouquet from Atfleurs Mumbai! Whether it's a milestone birthday or simply another year of joy and growth, our carefully curated arrangements will add an extra layer of happiness to the occasion. Brighten their day and make them feel truly special with a burst of colorful blooms, hand-picked and expertly arranged to convey your warmest wishes.</p>
                
                <b>Wedding:</b>
                <p>As two souls unite in love and commitment, let Atfleurs Mumbai be a part of your journey with our exquisite wedding flower bouquets. From breathtaking bridal bouquets to elegant centerpieces, our floral creations will enhance the beauty and romance of your special day. Let every petal speak of your love story and adorn your celebration with timeless elegance and natural beauty.</p>
                
                <b>Anniversary:</b>
                <p>Celebrate the journey of love and companionship with a stunning flower bouquet from Atfleurs Mumbai. Whether you're celebrating your first anniversary or a milestone year, our luxurious arrangements will capture the essence of your enduring bond. Let the beauty of flowers express your love and admiration, creating unforgettable moments to cherish for years to come.</p>
                
                <b>Special Occasion:</b>
                <p>Mark life's extraordinary moments with the extraordinary beauty of flowers from Atfleurs Mumbai. Whether it's a graduation, promotion, or any other achievement worth celebrating, our bespoke bouquets will add a touch of elegance and joy to the occasion. Let our exquisite arrangements be the perfect expression of your heartfelt congratulations and best wishes.</p>
                
                <b>Housewarming:</b>
                <p>Turn a new house into a warm and welcoming home with a stunning flower bouquet from Atfleurs Mumbai. Our handcrafted arrangements will infuse every corner with freshness and charm, creating an inviting atmosphere for new beginnings. Welcome your loved ones to their new abode with the timeless beauty of flowers, symbolizing growth, prosperity, and happiness.</p>
                
                <b>Engagements:</b>
                <p>Celebrate the beginning of a beautiful journey together with a romantic flower bouquet from Atfleurs Mumbai. Whether you're popping the question or announcing your engagement to loved ones, our enchanting arrangements will capture the excitement and promise of this special moment. Let the language of flowers convey your love and commitment as you embark on this new chapter in life.</p>
                
                <b>Corporate Events:</b>
                <p>Make a lasting impression at your corporate events with sophisticated flower arrangements from Atfleurs Mumbai. Whether it's a conference, gala dinner, or corporate retreat, our elegant bouquets will add a touch of refinement and style to any setting. Enhance your brand's image and create a memorable experience for clients, partners, and employees with the exquisite beauty of fresh flowers.</p>
                
                <b>Festivals:</b>
                <p>Embrace the spirit of joy and celebration with festive flower bouquets from Atfleurs Mumbai. Whether it's Diwali, Christmas, Eid, or any other special occasion, our vibrant arrangements will brighten up your festivities and spread cheer to all. Let the colors and fragrances of our seasonal blooms add an extra layer of magic to your holiday gatherings and traditions.</p>
            </div>
            
             <div class="col-md-6">
                <h2 class="seo_heading">Atfleurs Gift Hamper collection, curated to add a touch of delight and luxury to every occasion.</h2>
                <b>Birthday Cake Gift:</b>
                <p>Make their birthday extra special with our Happy Birthday Cake Gift. Indulge their sweet tooth with a delectable Birthday cake adorned with colorful frosting and sprinkles, accompanied by candles to make their wishes come true. It's the perfect way to celebrate another trip around the sun in delicious style!</p>
                
                <b>Chocolates Gift Hamper:</b>
                <p>For the chocolate lovers in your life, treat them to our Chocolates Gift Hamper. Overflowing with an assortment of premium chocolates, from rich dark chocolate truffles to creamy milk chocolate bars, this hamper is a decadent delight that will satisfy even the most discerning palate. It's a sweet gesture guaranteed to bring smiles and joy.</p>
                
                <b>Perfume Gift Hamper:</b>
                <p>Elevate their senses with our Perfume Gift Hamper, featuring a selection of luxurious fragrances that captivate and enchant. From floral and fruity notes to woody and oriental scents, this hamper offers an olfactory journey of sophistication and allure. Let them indulge in the art of scent and leave a lasting impression wherever they go.</p>
                
                <b>Gift Hamper:</b>
                <p>Our classic Gift Hamper is the perfect choice for any occasion, whether it's a celebration, a gesture of appreciation, or simply to brighten someone's day. With a variety of carefully curated items such as gourmet treats, scented candles, spa essentials, and more, this versatile hamper is sure to please any recipient. It's a thoughtful way to express your sentiments and spread happiness.</p>
                
                <b>Balloons Gift Hamper:</b>
                <p>Add a pop of fun and color to any celebration with our Balloons Gift Hamper. Filled with an assortment of vibrant balloons in assorted shapes and sizes, this hamper is guaranteed to uplift spirits and create a festive atmosphere. Whether it's a birthday, anniversary, or special milestone, let the joyous presence of balloons make the occasion truly memorable.</p>
                
                <b>Atfleurs Gift Hampers – because every moment deserves to be celebrated in style.</b>
            </div>
        </div>
    </div>
</section> -->

@endsection

@section('script')
    <script>
    
    $(document).ready(function(){
    // Function to load section content via AJAX
    function loadSection(sectionId, routeName) {
        // console.log('Loading section:', sectionId); // Debugging: Log when a section is loading
        $.post(routeName, {_token:'{{ csrf_token() }}'}, function(data){
            $(sectionId).html(data);
            AIZ.plugins.slickCarousel();
            // console.log('Loaded section:', sectionId); // Debugging: Log when the section has been loaded
        });
    }

    // Options for the Intersection Observer
    let observerOptions = {
        root: null, // relative to the viewport
        rootMargin: '20%',
        threshold: 0 // trigger when 0% of the section is visible
    };

    // Create an Intersection Observer
    let observer = new IntersectionObserver(function(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                let sectionId = `#${entry.target.id}`;
                let routeName;

                // Determine the route based on the section ID
                switch(entry.target.id) {
                    case 'section_featured':
                        routeName = '{{ route('home.section.featured') }}';
                        break;
                    case 'section_best_selling':
                        routeName = '{{ route('home.section.best_selling') }}';
                        break;
                    case 'auction_products':
                        routeName = '{{ route('home.section.auction_products') }}';
                        break;
                    case 'section_home_categories':
                        routeName = '{{ route('home.section.home_categories') }}';
                        break;
                    case 'section_best_sellers':
                        routeName = '{{ route('home.section.best_sellers') }}';
                        break;
                }

                if (routeName) {
                    loadSection(sectionId, routeName);
                    observer.unobserve(entry.target); // Stop observing once the section is loaded
                }
            }
        });
    }, observerOptions);

    // Observe each section
    let sections = [
        'section_featured',
        'section_best_selling',
        'auction_products',
        'section_home_categories',
        'section_best_sellers'
    ];

    sections.forEach(sectionId => {
        let section = document.getElementById(sectionId);
        if (section) {
            observer.observe(section);
            // console.log('Observing section:', sectionId); // Debugging: Log when a section is being observed
        }
    });
});
document.addEventListener("DOMContentLoaded", function() {
    // Create a Set to keep track of processed images
    const processedImages = new Set();

    // Get all images with 'src' or 'data-src'
    const images = Array.from(document.querySelectorAll('img[src], img[data-src]'));

    // Function to load image and log its src
    function loadImage(img) {
        if (!processedImages.has(img.src)) {
            // If 'data-src' attribute is present, set the 'src' from 'data-src'
            if (img.hasAttribute('data-src')) {
                img.src = img.getAttribute('data-src');
                img.removeAttribute('data-src');
            }

            // Log the 'src' of the image being loaded
            // console.log('Image loaded:', img.src);

            // Mark this image as processed
            processedImages.add(img.src);
        }
    }

    // Create an Intersection Observer
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;

                // Load the image and stop observing it
                loadImage(img);
                observer.unobserve(img);
            }
        });
    }, {
        rootMargin: '0px 0px 50px 0px', // Adjust this as needed
        threshold: 0.1
    });

    // Initialize by immediately processing the first 8 images
    for (let i = 0; i < Math.min(images.length, 8); i++) {
        loadImage(images[i]);
    }

    // Observe the remaining images
    images.slice(8).forEach(img => {
        // Observe images with 'data-src' attribute or 'loading="lazy"'
        if (img.hasAttribute('data-src') || img.getAttribute('loading') === 'lazy') {
            observer.observe(img);
        } else {
            // Force load images with 'src' that are not lazy-loaded
            loadImage(img);
        }
    });
});

        // $(document).ready(function(){
        //     $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
        //         $('#section_featured').html(data);
        //         AIZ.plugins.slickCarousel();
        //     });
        //     $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
        //         $('#section_best_selling').html(data);
        //         AIZ.plugins.slickCarousel();
        //     });
        //     $.post('{{ route('home.section.auction_products') }}', {_token:'{{ csrf_token() }}'}, function(data){
        //         $('#auction_products').html(data);
        //         AIZ.plugins.slickCarousel();
        //     });
        //     $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
        //         $('#section_home_categories').html(data);
        //         AIZ.plugins.slickCarousel();
        //     });
        //     $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
        //         $('#section_best_sellers').html(data);
        //         AIZ.plugins.slickCarousel();
        //     });
        // });
        
//   var swiper = new Swiper('.myswiper', {
//   slidesPerView: 3,
//   spaceBetween: 50,
//   pagination: {
//     el: '.swiper-pagination',
//     clickable: true,
//   },
// });

        
        $(document).ready(function () {
            var owl = $("#owl-carousel");
            owl.owlCarousel({
              margin: 25,
              nav: false,
              dots: false,
              loop: true,
              autoplay: true,
              autoplayTimeout: 3000,
              stagePadding: 22,
              responsive: {
                0: {
                  items: 1,
                },
                600: {
                  items: 2,
                },
                1000: {
                  items: 1,
                },
              },
            });
      });
      
      
      $(document).ready(function () {
        var owl = $("#testiminials-texture");
        owl.owlCarousel({
          margin: 25,
          nav: false,
          loop: true,
          autoplay: true,
          autoplayTimeout: 5000,
          stagePadding: 0,
          responsive: {
            0: {
              items: 1.2,
            },
            600: {
              items: 2,
            },
            1000: {
              items: 2,
            },
          },
        });
      });
      
    </script>
    
@endsection
