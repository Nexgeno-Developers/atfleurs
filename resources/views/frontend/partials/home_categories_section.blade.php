@if(get_setting('home_categories') != null) 
    @php $home_categories = json_decode(get_setting('home_categories')); @endphp
    @foreach ($home_categories as $key => $value)
        @php $category = \App\Models\Category::find($value); @endphp
        <section class="main-cat-sec">
            <div class="container">
                <div class="pt-5">
                    <div class="mb-4 align-items-baseline text-center">
                        <h3 class="h2 fw-700 mb-0 heading_font1 ">
                            <span class="border-bottom border-primary border-width-2 pb-2 d-inline-block">{{ $category->getTranslation('name') }}</span>
                        </h3>
                    </div>
                    <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="5" data-xl-items="5" data-lg-items="5"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'>
                        @foreach (\App\Models\Category::where('parent_id', $category->id)->get() as $key => $subCategory)
                            <div class="carousel-box">
                                @include('frontend.partials.category_box_1',['subCategory' => $subCategory])
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('products.category', $category->slug) }}">
                     <img class="category_banner" src="{{uploaded_asset($category->full_width_banner)}}" alt="Category Banner">
                    </a>
                </div>
            </div>
        </section>
    @endforeach
@endif

