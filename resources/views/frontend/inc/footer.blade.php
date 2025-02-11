<section class="bg-white border-top mt-auto display_none">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left text-center p-4 d-block" href="{{ route('terms') }}">
                    <i class="la la-file-text la-3x text-primary mb-2"></i>
                    <h4 class="h6">{{ translate('Terms & conditions') }}</h4>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left text-center p-4 d-block" href="{{ route('returnpolicy') }}">
                    <i class="la la-mail-reply la-3x text-primary mb-2"></i>
                    <h4 class="h6">{{ translate('Return Policy') }}</h4>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left text-center p-4 d-block" href="{{ route('supportpolicy') }}">
                    <i class="la la-support la-3x text-primary mb-2"></i>
                    <h4 class="h6">{{ translate('Support Policy') }}</h4>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left border-right text-center p-4 d-block" href="{{ route('privacypolicy') }}">
                    <i class="las la-exclamation-circle la-3x text-primary mb-2"></i>
                    <h4 class="h6">{{ translate('Privacy Policy') }}</h4>
                </a>
            </div>
        </div>
    </div>
</section>

                    
<section class="greenbg pt-5 pb-4 text-light footer-widget footer_links1">
    <div class="container">
        
        <div class="row">

          <div class="col-lg-3 col-md-6">
                <div class="contact_footer">
                     <h4 class="footer_headings pb-2">Quick Contact Now</h4>
                    <ul>
                    <li>
                                <i class="las la-phone"></i> 
                                
                                <a class="text-white" onclick="return gtag_report_conversion('tel:+91 7070070716');" href="tel:+91 7070070716">+91 7070070716</a> <span style="color:#fff;">/</span> 
                                <a class="text-white" onclick="return gtag_report_conversion('tel:+91 9808867777');" href="tel:+91 9808867777">+91 9808867777</a>
                              
                            </li>
                            
                             <li>
                               <i class="las la-envelope"></i>
                               <a class="text-white" onclick="return gtag_report_conversion('mailto:atfleurss@gmail.com');" href="mailto:atfleurss@gmail.com">atfleurss@gmail.com </a>
                            
                            </li>
                    </ul>
                 
                </div>

                 <div class="social_icons">
                    
                   
                     <ul class="list-inline my-3 my-md-0 text-left">
                    
                    <li class="list-inline-item">
                        <a href="https://www.facebook.com/atfleurs" aria-label="Facebook Link" target="_blank" class="facebook"><i class="fa fa-facebook text-white" class=""></i></a>
                    </li>
                    
                    <li class="list-inline-item">
                        <a href="https://instagram.com/atfleurs?igshid=MzNlNGNkZWQ4Mg==" aria-label="Instagram Link" target="_blank" class="instagram "><i class="fa fa-instagram text-white"></i></a>
                    </li>
                    
                    <li class="list-inline-item">
                        <a href="https://x.com/Atfleurss" aria-label="Twitter X Link" target="_blank" class="twitter-x"><i class="fa fa-x-twitter text-white"></i></a>
                    </li>

                    <li class="list-inline-item">
                        <a href="https://www.linkedin.com/in/at-fleurs-39749b273/" aria-label="Linkedin Link" target="_blank" class="linkedin "><i class="fa fa-linkedin text-white"></i></a>
                    </li>
                    
                    
                </ul>
            </div>
            </div>


            <div class="col-lg-6 text-left text-md-left display_none">
                <div class="mt-4">
                    <a href="{{ route('home') }}" class="d-block">
                        @if(get_setting('footer_logo') != null)
                            <img class="lazyload" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="{{ env('APP_NAME') }}" height="90">
                        @else
                            <img class="lazyload" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" height="90">
                        @endif
                    </a>
                    <div class="my-3 text-white pd-right-60">
                        {!! get_setting('about_us_description',null,App::getLocale()) !!}
                    </div>
                    
                    @if ( get_setting('show_social_links') )
                <ul class="list-inline my-3 my-md-0 social colored text-left">
                    @if ( get_setting('facebook_link') !=  null )
                    <li class="list-inline-item">
                        <a href="{{ get_setting('facebook_link') }}" target="_blank" class="facebook"><i class="lab la-facebook-f"></i></a>
                    </li>
                    @endif
                    @if ( get_setting('twitter_link') !=  null )
                    <li class="list-inline-item">
                        <a href="{{ get_setting('twitter_link') }}" target="_blank" class="twitter"><i class="lab la-twitter"></i></a>
                    </li>
                    @endif
                    @if ( get_setting('instagram_link') !=  null )
                    <li class="list-inline-item">
                        <a href="{{ get_setting('instagram_link') }}" target="_blank" class="instagram"><i class="lab la-instagram"></i></a>
                    </li>
                    @endif
                    @if ( get_setting('youtube_link') !=  null )
                    <li class="list-inline-item">
                        <a href="{{ get_setting('youtube_link') }}" target="_blank" class="youtube"><i class="lab la-youtube"></i></a>
                    </li>
                    @endif
                    @if ( get_setting('linkedin_link') !=  null )
                    <li class="list-inline-item">
                        <a href="{{ get_setting('linkedin_link') }}" target="_blank" class="linkedin"><i class="lab la-linkedin-in"></i></a>
                    </li>
                    @endif
                </ul>
                @endif
                
                    
                    <div class="w-300px mw-100 mx-auto mx-md-0">
                        @if(get_setting('play_store_link') != null)
                            <a href="{{ get_setting('play_store_link') }}" target="_blank" class="d-inline-block mr-3 ml-0">
                                <img src="{{ static_asset('assets/img/play.png') }}" class="mx-100 h-40px">
                            </a>
                        @endif
                        @if(get_setting('app_store_link') != null)
                            <a href="{{ get_setting('app_store_link') }}" target="_blank" class="d-inline-block">
                                <img src="{{ static_asset('assets/img/app.png') }}" class="mx-100 h-40px">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4 ml-xl-auto col-md-4 mr-0 display_none">
                <div class="text-left text-md-left mt-4">
                    <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                        {{ translate('Contact Info') }}
                    </h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                           <span class="d-block opacity-30">{{ translate('Address') }}:</span>
                           <span class="d-block opacity-70">{{ get_setting('contact_address',null,App::getLocale()) }}</span>
                        </li>
                        <li class="mb-2">
                           <span class="d-block opacity-30">{{translate('Phone')}}:</span>
                           <span class="d-block opacity-70">{{ get_setting('contact_phone') }}</span>
                        </li>
                        <li class="mb-2">
                           <span class="d-block opacity-30">{{translate('Email')}}:</span>
                           <span class="d-block opacity-70">
                               <a href="mailto:{{ get_setting('contact_email') }}" class="text-reset">{{ get_setting('contact_email')  }}</a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            
            
            <div class="col-lg-3 col-md-3 col-6">
                <div class="text-left text-md-left">
                    <h4 class="footer_headings pb-2">
                       About Us
                    </h4>
                    <ul class="list-unstyled">
                        @if ( get_setting('widget_one_labels',null,App::getLocale()) !=  null )
                            @foreach (json_decode( get_setting('widget_one_labels',null,App::getLocale()), true) as $key => $value)
                            <li class="mb-2">
                                <a href="{{ json_decode( get_setting('widget_one_links'), true)[$key] }}" class="text-white hov-opacity-100 text-reset">
                                    {{ $value }}
                                </a>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                    
                   
                
                </div>
            </div>
            
           <div class="col-lg-3 col-md-3 col-6">
                <div class="text-left text-md-left">
                    <h4 class="footer_headings pb-2">Customer Service</h4>
                    <ul class="list-unstyled">
                         <li class="mb-2"><a href="/faq" class="text-white hov-opacity-100 text-reset">FAQs</a></li>
                         <li class="mb-2"><a href="/terms" class="text-white hov-opacity-100 text-reset">Terms & Conditions </a></li>  
                       
                         <li class="mb-2"><a href="/return-policy" class="text-white hov-opacity-100 text-reset">Returns & Refunds</a></li> 
                         <li class="mb-2"><a href="/privacy-policy" class="text-white hov-opacity-100 text-reset">Privacy Policy</a></li>
                         
                    </ul>
                    
                </div>
            </div>

            <div class="col-lg-3 col-md-12">
        <div class="newsletter_box">
        <div class="row">
             <div class="col-lg-12 pl-0">
               <!-- <h4 class="footer_headings pb-2">Unlock 10% off </h4> -->
               <h4 class="footer_headings pb-2">Newsletter </h4>
               <!-- <p>Your first order when you sign up to our newsletter</p> -->
               <p>Sign up to our mailing list to stay updated on the latest special offers!</p>
            </div>
                <form class="form-inline" method="POST" action="{{ route('subscribers.store') }}">
                @csrf
                <div class="col-md-8 pr-0 pl-0">
                <div class="form-group mb-0">
                <input type="email" class="form-control" placeholder="{{ translate('Your Email here...') }}" name="email" required>
                </div>
                </div>
                <div class="col-md-4 pl-md-2">
                    <button type="submit" class="btn btn-primary">
                    {{ translate('Subscribe') }}
                    </button>
                </div>
                </form>
        </div>
        </div>
            
            </div>
            
              <div class="col-lg-4 col-md-4 col-12 d-none">
                
                 @if (get_setting('vendor_system_activation') == 1)
                    <div class="text-left text-md-left mt-4 mb-4">
                        <h4 class="fs-16 text-white fw-600 pb-2 mb-1">
                            {{ translate('Be a Seller') }}
                        </h4>
                        <a href="{{ route('shops.create') }}" class="btn btn-primary btn-sm shadow-md">
                            {{ translate('Apply Now') }}
                        </a>
                    </div>
                @endif
            </div>
            

        <div class="col-md-4 col-lg-2 display_none">
                <div class="text-left text-md-left mt-4">
                    <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                        {{ translate('My Account') }}
                    </h4>
                    <ul class="list-unstyled">
                        @if (Auth::check())
                            <li class="mb-2">
                                <a class="opacity-50 hov-opacity-100 text-reset" href="{{ route('logout') }}">
                                    {{ translate('Logout') }}
                                </a>
                            </li>
                        @else
                            <li class="mb-2">
                                <a class="opacity-50 hov-opacity-100 text-reset" href="{{ route('user.login') }}">
                                    {{ translate('Login') }}
                                </a>
                            </li>
                        @endif
                        <li class="mb-2">
                            <a class="opacity-50 hov-opacity-100 text-reset" href="{{ route('purchase_history.index') }}">
                                {{ translate('Order History') }}
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="opacity-50 hov-opacity-100 text-reset" href="{{ route('wishlists.index') }}">
                                {{ translate('My Wishlist') }}
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="opacity-50 hov-opacity-100 text-reset" href="{{ route('orders.track') }}">
                                {{ translate('Track Order') }}
                            </a>
                        </li>
                        @if (addon_is_activated('affiliate_system'))
                            <li class="mb-2">
                                <a class="opacity-50 hov-opacity-100 text-light" href="{{ route('affiliate.apply') }}">{{ translate('Be an affiliate partner')}}</a>
                            </li>
                        @endif
                    </ul>
                </div>
                @if (get_setting('vendor_system_activation') == 1)
                    <div class="text-left text-md-left mt-4">
                        <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                            {{ translate('Be a Seller') }}
                        </h4>
                        <a href="{{ route('shops.create') }}" class="btn btn-primary btn-sm shadow-md">
                            {{ translate('Apply Now') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
            
        <!--categories and its sub-categories-->
        <div class="text-left text-md-left border-top-dark pt-3 mt-3 our_category">
            <h5 class="footer_headings mt-4 pb-2">Our Category</h5>
            <ul class="list-unstyled">
                
                @php
                    $main_Catg = DB::table('categories')->where('parent_id', 0)->orderBy('id', 'asc')->get(['id', 'name', 'slug']);
                @endphp
                
                <ul class="p-0 category_lisitngs">
                    @foreach($main_Catg as $row)
                        <li class="mb-2">
                            @php
                                $sub_Catg = DB::table('categories')->where('parent_id', $row->id)->orderBy('id', 'asc')->get(['id', 'name', 'slug']);
                            @endphp
                            <a href="/category/{{ $row->slug }}" class="text-white opacity-90 hov-opacity-90 text-reset">
                               {{ ucfirst($row->name) }}{{ $sub_Catg->count() > 0 ? ':' : '' }}
                            </a>
                            @foreach($sub_Catg as $item)
                                <a href="/category/{{ $item->slug }}" class="text-white hov-opacity-100 text-reset fw-200 fs-14">
                                    {{ ucfirst($item->name) }}
                                </a>
                            @endforeach
                        </li>
                    @endforeach
                </ul>
                
                <!--<li class="mb-2">-->
                <!--    <a href="/category/floral-arrangements" class="text-white hov-opacity-100 text-reset"><b>Floral Arrangements: </b></a>-->
                <!--    <a href="/category/birthday-floral-arrangments-events-mumbai" class="text-white hov-opacity-100 text-reset">Birthday</a>-->
                <!--    <a href="/category/engagement-flower-bouquet-mumbai" class="text-white hov-opacity-100 text-reset">Engagement</a>-->
                <!--    <a href="/category/wedding-flower-bouquet-mumbai" class="text-white hov-opacity-100 text-reset">Wedding</a>-->
                <!--    <a href="/category/anniversary-floral-arrangments-mumbai" class="text-white hov-opacity-100 text-reset">Anniversary</a>-->
                <!--    <a href="/category/corporate-flower-bouquet-mumbai" class="text-white hov-opacity-100 text-reset">Corporate Flower Bouquet</a>-->
                <!--    <a href="/category/festivals-gifts-flowers-bouquet-mumbai" class="text-white hov-opacity-100 text-reset">Festivals</a>-->
                <!--    <a href="/category/flower-arrangements-every-occasion-mumbai" class="text-white hov-opacity-100 text-reset">Events</a>-->

                <!--</li> -->
                <!--<li class="mb-2">-->
                <!--    <a href="/category/gifts" class="text-white hov-opacity-100 text-reset"><b>Gifts: </b></a>-->
                <!--    <a href="/category/order-cake-online-mumbai" class="text-white hov-opacity-100 text-reset">Birthday Cake</a>-->
                <!--    <a href="/category/chocolate-gift-hamper-mumbai" class="text-white hov-opacity-100 text-reset">Chocolates Gift Hamper</a>-->
                <!--    <a href="/category/perfume-gift-hamper-mumbai" class="text-white hov-opacity-100 text-reset">Perfume Gift Hamper</a>-->
                <!--    <a href="/category/gifts-hamper" class="text-white hov-opacity-100 text-reset">Gift Hamper</a>-->
                <!--    <a href="/category/ballons-gift-hamper-mumbai" class="text-white hov-opacity-100 text-reset">Balloons Gift Hamper</a>-->
                <!--</li> -->
                <!--<li class="mb-2">-->
                <!--    <a href="/category/fresh-flower-bouquet-mumbai" class="text-white hov-opacity-100 text-reset"><b>Flowers: </b></a>-->
                <!--    <a href="/category/roses-flower-bouquet-mumbai" class="text-white hov-opacity-100 text-reset">Roses</a>-->
                <!--    <a href="/category/red-roses-flower-bouquet-mumbai" class="text-white hov-opacity-100 text-reset">Red Roses</a>-->
                <!--    <a href="/category/pink-roses-flower-bouquet-mumbai" class="text-white hov-opacity-100 text-reset">Pink Roses</a>-->
                <!--    <a href="/category/white-roses-flower-bouquet" class="text-white hov-opacity-100 text-reset">White Roses</a>-->
                <!--    <a href="/category/carnation-flower-bouquet-mumbai" class="text-white hov-opacity-100 text-reset">Carnations</a>-->
                <!--    <a href="/category/orchids-flower-bouquet-mumbai" class="text-white hov-opacity-100 text-reset">Orchids</a>-->
                <!--    <a href="/category/lilies-flower-bouquet-mumbai" class="text-white hov-opacity-100 text-reset">Lilies</a>-->
                <!--    <a href="/category/gerberas-flower-bouquet-mumbai" class="text-white hov-opacity-100 text-reset">Gerberas</a>-->
                <!--    <a href="/category/mixed-flower-bouquet-mumbai" class="text-white hov-opacity-100 text-reset">Mixed Flowers</a>-->
                <!--    <a href="/category/exotic-flowers-bouquets-mumbai" class="text-white hov-opacity-100 text-reset">Exotic Flowers</a>-->
                <!--    <a href="/category/Sunflower-oIgtb" class="text-white hov-opacity-100 text-reset">Sunflower</a>-->
                <!--</li> -->
                <!--<li class="mb-2">-->
                <!--    <a href="/category/artificial-flower-bouquet-mumbai" class="text-white hov-opacity-100 text-reset"><b>Artificial Flowers</b></a>-->
                <!--</li> -->
            <!--</ul>-->
        </div>
    
       

     
	 <div class="row">

     <div class="col-md-12">
        <div class="border-top-dark mt-3"></div>
     </div>

    @if ( get_setting('header_menu_labels') !=  null )
        <div class="col-md-12 footer_location">
           <div class="footer_nav pt-2 pb-2">
            <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center">
                                        @foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)
                    <li class="list-inline-item mr-0">
                        <a href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}" class="opacity-90 fs-14 px-4 text-uppercase py-2 d-inline-block fw-200 hov-opacity-100 text-reset">
                            {{ translate($value) }}
                        </a>
                    </li>
                    @endforeach
                                    </ul>
        </div>
		
		</div>

        @endif

         <div class="col-md-12">
        <div class="border-top-dark"></div>
     </div>


        <div class="col-md-12"><h5 class="footer_headings mt-4 pb-2">Mumbai Location</h5></div>
        <div class="col-md-3 col-6">
<ul class="list-group list-group-horizontal list-style-footer">
                <li class="list-group-item text-white">Florist in Churchgate</li>
                <li class="list-group-item text-white">Florist in Mumbai Central</li>
                <li class="list-group-item text-white">Florist in Marine Lines</li>
                <li class="list-group-item text-white">Florist in Charni Road</li>
                <li class="list-group-item text-white">Florist in Tardeo</li>
                <li class="list-group-item text-white">Florist in Colaba</li>
                <li class="list-group-item text-white">Florist in Fort</li>
                <li class="list-group-item text-white">Florist in Malhabar Hills</li>
                <li class="list-group-item text-white">Florist in Breach Candy</li>
                
            </ul>
        </div>

         <div class="col-md-3 col-6">
<ul class="list-group list-group-horizontal list-style-footer">
                <li class="list-group-item text-white">Florist in Mahalaxmi</li>
                <li class="list-group-item text-white">Florist in Lower Parel</li>
                <li class="list-group-item text-white">Florist in Matunga Road</li>
                <li class="list-group-item text-white">Florist in Mahim</li>
                <li class="list-group-item text-white">Florist in Bandra</li>
                <li class="list-group-item text-white">Florist in Andheri</li>
                <li class="list-group-item text-white">Florist in Borivali</li>
                <li class="list-group-item text-white">Florist in Khar</li>
                <li class="list-group-item text-white">Florist in Santacruz</li>
                
            </ul>
        </div>

         <div class="col-md-3 col-6">
<ul class="list-group list-group-horizontal list-style-footer">
                <li class="list-group-item text-white">Florist in Vile Parle</li>
                <li class="list-group-item text-white">Florist in Jogeshwari</li>
                <li class="list-group-item text-white">Florist in Ram Mandir</li>
                <li class="list-group-item text-white">Florist in Goregaon</li>
                <li class="list-group-item text-white">Florist in Malad</li>
                <li class="list-group-item text-white">Florist in Kandivali</li>
                <li class="list-group-item text-white">Florist in Hiranandani Powai</li>
                <li class="list-group-item text-white">Florist in Lokhandwala</li>
                <li class="list-group-item text-white">Florist in Versova</li>
                
            </ul>
        </div>

         <div class="col-md-3 col-6">
<ul class="list-group list-group-horizontal list-style-footer">
               <li class="list-group-item text-white">Florist in Juhu</li>
                <li class="list-group-item text-white">Florist in Worli</li>
                <li class="list-group-item text-white">Florist in Sakinaka</li>
                <li class="list-group-item text-white">Florist in Marol</li>
                <li class="list-group-item text-white">Florist in Shivaji Park Dadar West</li>
            </ul>
        </div>
            
            

        </div>
        </div>
        
    </div>
</section>

<!-- FOOTER -->
<footer class="pt-2 pb-0 pb-xl-0 dark_greenbg text-light copyright">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="text-center text-white footer_bottom" current-verison="{{get_setting("current_version")}}">
                    {!! get_setting('frontend_copyright_text',null,App::getLocale()) !!}
                </div>
            </div>
        
            <div class="col-lg-4 display_none">
                <div class="text-center text-md-right">
                    <ul class="list-inline mb-0">
                        @if ( get_setting('payment_method_images') !=  null )
                            @foreach (explode(',', get_setting('payment_method_images')) as $key => $value)
                                <li class="list-inline-item">
                                    <img src="{{ uploaded_asset($value) }}" height="30" class="mw-100 h-auto" style="max-height: 30px">
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>


<div class="aiz-mobile-bottom-nav d-xl-none fixed-bottom bg-white shadow-lg border-top rounded-top" style="box-shadow: 0px -1px 10px rgb(0 0 0 / 15%)!important; ">
    <div class="row align-items-center gutters-5">
        <div class="col">
            <a href="{{ route('home') }}" class="text-reset d-block text-center pb-2 pt-3">
                <i class="las la-home fs-20 opacity-60 {{ areActiveRoutes(['home'],'opacity-100 text-primary')}}"></i>
                <span class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['home'],'opacity-100 fw-600')}}">{{ translate('Home') }}</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('categories.all') }}" class="text-reset d-block text-center pb-2 pt-3">
                <i class="las la-list-ul fs-20 opacity-60 {{ areActiveRoutes(['categories.all'],'opacity-100 text-primary')}}"></i>
                <span class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['categories.all'],'opacity-100 fw-600')}}">{{ translate('Categories') }}</span>
            </a>
        </div>
        @php
            if(auth()->user() != null) {
                $user_id = Auth::user()->id;
                $cart = \App\Models\Cart::where('user_id', $user_id)->get();
            } else {
                $temp_user_id = Session()->get('temp_user_id');
                if($temp_user_id) {
                    $cart = \App\Models\Cart::where('temp_user_id', $temp_user_id)->get();
                }
            }
        @endphp
        <div class="col-auto">
            <a href="{{ route('cart') }}" class="text-reset d-block text-center pb-2 pt-3">
                <span class="align-items-center bg-primary border border-white border-width-4 d-flex justify-content-center position-relative rounded-circle size-50px" style="background-color: #f48fa2 !important; margin-top: -33px;box-shadow: 0px -5px 10px rgb(0 0 0 / 15%);border-color: #fff !important;">
                    <i class="las la-shopping-bag la-2x text-white"></i>
                </span>
                <span class="d-block mt-1 fs-10 fw-600 opacity-60 {{ areActiveRoutes(['cart'],'opacity-100 fw-600')}}">
                    {{ translate('Cart') }}
                    @php
                        $count = (isset($cart) && count($cart)) ? count($cart) : 0;
                    @endphp
                    (<span class="cart-count">{{$count}}</span>)
                </span>
            </a>
        </div>
        <div class="col">
            <a href="tel:+91 7070070716" class="text-reset d-block text-center pb-2 pt-3">
                <span class="d-inline-block position-relative px-2">
                    <i class="las la-phone fs-20 opacity-60 {{ areActiveRoutes(['all-notifications'],'opacity-100 text-primary')}}"></i>
                    <!-- @if(Auth::check() && count(Auth::user()->unreadNotifications) > 0)
                        <span class="badge badge-sm badge-dot badge-circle badge-primary position-absolute absolute-top-right" style="right: 7px;top: -2px;"></span>
                    @endif -->
                </span>
                <span class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['all-notifications'],'opacity-100 fw-600')}}">{{ translate('Talk to Expert') }}</span>
            </a>
        </div>
        <div class="col">
        @if (Auth::check())
            @if(isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="text-reset d-block text-center pb-2 pt-3">
                    <span class="d-block mx-auto">
                        @if(Auth::user()->photo != null)
                            <img src="{{ custom_asset(Auth::user()->avatar_original)}}" class="rounded-circle size-20px">
                        @else
                            <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="rounded-circle size-20px">
                        @endif
                    </span>
                    <span class="d-block fs-10 fw-600 opacity-60">{{ translate('Account') }}</span>
                </a>
            @else
                <a href="#" onclick="event.preventDefault();" class="text-reset d-block text-center pb-2 pt-3 mobile-side-nav-thumb" data-toggle="class-toggle" data-backdrop="static" data-target=".aiz-mobile-side-nav">
                    <span class="d-block mx-auto">
                        @if(Auth::user()->photo != null)
                            <img src="{{ custom_asset(Auth::user()->avatar_original)}}" class="rounded-circle size-20px">
                        @else
                            <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="rounded-circle size-20px">
                        @endif
                    </span>
                    <span class="d-block fs-10 fw-600 opacity-60">{{ translate('Account') }}</span>
                </a>
            @endif
        @else
            <a href="{{ route('user.login') }}" class="text-reset d-block text-center pb-2 pt-3">
                <span class="d-block mx-auto">
                    <img src="{{ static_asset('assets/img/avatar-place.png') }}" alt="user" class="rounded-circle size-20px">
                </span>
                <span class="d-block fs-10 fw-600 opacity-60">{{ translate('Account') }}</span>
            </a>
        @endif
        </div>
    </div> 
</div>
@if (Auth::check() && !isAdmin())
    <div class="aiz-mobile-side-nav collapse-sidebar-wrap sidebar-xl d-xl-none z-1035">
        <div class="overlay dark c-pointer overlay-fixed" data-toggle="class-toggle" data-backdrop="static" data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb"></div>
        <div class="collapse-sidebar bg-white">
            @include('frontend.inc.user_side_nav')
        </div>
    </div>
@endif
<!--<div class="whatsapp_icon">
<a target="_blank" href="https://api.whatsapp.com/send?phone=+917506073706&text=Hi,%20I%20am%20contacting%20you%20through%20your%20website%20https://atfleurs.com/">
    <img src="{{ static_asset('assets/img/whatsapp-icon-png-17.png') }}" alt="Whatsapp"></a>
</div>-->



 <!-- whatsapp -->
 <div class="">
                <div class="whatsapp_chat_support wcs_fixed_right" id="example_1">

                    <div class="wcs_button wcs_button_circle">
                        <div class="whatsapp_blink">
                            <span href="" class="btn-whatsapp-pulse">
                                <i class="lab la-whatsapp whatspicon_sz"></i>
                            </span>
                        </div>
                    </div>
                    <div class="wcs_button_label">
                        Need Help? Chat with us
                    </div>

                    <div class="wcs_popup">
                        <div class="wcs_popup_close">
                            <i class="las la-times"></i>
                        </div>
                        <div class="wcs_popup_header">
                            <strong>Need Help? Chat with us</strong>
                            <br>
                            <div class="wcs_popup_header_description">Click one of our representatives below</div>
                        </div>
                        <div class="wcs_popup_person_container">
                            <div class="wcs_popup_person" data-number="+917070070716">
                                <div class="wcs_popup_person_img"><img src="/public/assets/img/whatsapp_icons_ft.png"
                                        alt="" /></div>
                                <div class="wcs_popup_person_content">
                                    <div class="wcs_popup_person_name">At Fleurs</div>
                                    <div class="wcs_popup_person_description">At Fleurs</div>
                                    <div class="wcs_popup_person_status">I'm Online</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 <!-- whatsapp -->
 
 <section class="call-buton d-lg-block d-none"><a aria-label="Click to call executive" class="cc-calto-action-ripple" onclick="return gtag_report_conversion('tel:+91 7070070716');" href="tel:+91 7070070716"><i class="las la-phone"></i></a>
 <p>Talk to Expert</p>
 <span class="num"></span>
</a>
</section>

<script>
    document.addEventListener("click", function (e) {
      if (e.target.innerText == "Continue to Shipping") {
        gtag("event", "conversion", {
          send_to: "AW-11362608793/GKEFCOyboYQaEJnNjqoq",
        })
      }
    })
  </script>
