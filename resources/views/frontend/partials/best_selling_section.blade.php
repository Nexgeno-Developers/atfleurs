@php
    $best_selling_products = Cache::remember('best_selling_products', 86400, function () {
        return filter_products(\App\Models\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(20)->get();
    });   
@endphp

@if (get_setting('best_selling') == 1)
    <section class="section-padding">
        <div class="container">
            <div class="px-2 rounded hadow-sm rounded">
                <div class="mb-4 pt-5 align-items-baseline text-center">
                   
                         <h4 class="heading_one heading_font1 green_color text-capitalize text-center">Best <span class="yellow_color">Selling</span></h4>
           
                            
                </div>
                
                
                <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="4" data-xl-items="4" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
                    @foreach ($best_selling_products as $key => $product)
                        <div class="carousel-box best_selling_img">
                            @include('frontend.partials.product_box_1',['product' => $product])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
