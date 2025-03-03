<!DOCTYPE html>
@if(\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif
<head>
    <meta name="google-site-verification" content="Ekx-Vi22j53LW2ZfngtMNdp8stklRucN-CSc4xiGzCA" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">

    <title>@yield('meta_title', get_setting('website_name').' | '.get_setting('site_motto'))</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', get_setting('meta_description') )" />
    <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords') )">
    @yield('meta')
    @if(!isset($detailedProduct) && !isset($customer_product) && !isset($shop) && !isset($page) && !isset($blog))
        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="{{ get_setting('meta_title') }}">
        <meta itemprop="description" content="{{ get_setting('meta_description') }}">
        <meta itemprop="image" content="{{ uploaded_asset(get_setting('meta_image')) }}">

        <!-- Twitter Card data -->
        <meta name="twitter:card" content="product">
        <meta name="twitter:site" content="@publisher_handle">
        <meta name="twitter:title" content="{{ get_setting('meta_title') }}">
        <meta name="twitter:description" content="{{ get_setting('meta_description') }}">
        <meta name="twitter:creator" content="@author_handle">
        <meta name="twitter:image" content="{{ uploaded_asset(get_setting('meta_image')) }}">

        <!-- Open Graph data -->
        <meta property="og:title" content="{{ get_setting('meta_title') }}" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ route('home') }}" />
        <meta property="og:image" content="{{ uploaded_asset(get_setting('meta_image')) }}" />
        <meta property="og:description" content="{{ get_setting('meta_description') }}" />
        <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
        <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
    @endif

    <!-- Favicon -->
    <link rel="icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">
    
    <!----------------- canonical ------------------->
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Google Fonts 
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:wght@400;700&display=swap" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Domine:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">
    @if(\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
    <link rel="stylesheet" href="{{ static_asset('assets/css/bootstrap-rtl.min.css') }}">
    @endif
    
    <!--<link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css') }}">-->
    <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/custom-style.css?v-1.2.6') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/fancybox.min.css') }}">

    <link rel="preload" href="{{ static_asset('assets/css/owl.carousel.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ static_asset('assets/css/whatsapp-chat-support.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <!--<link rel="stylesheet" href="{{ static_asset('assets/css/owl.carousel.min.css') }}">-->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">-->
    <!--<link rel="stylesheet" href="{{ static_asset('assets/css/whatsapp-chat-support.css') }}" />-->
    

    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: '{!! translate('Nothing selected', null, true) !!}',
            nothing_found: '{!! translate('Nothing found', null, true) !!}',
            choose_file: '{{ translate('Choose file') }}',
            file_selected: '{{ translate('File selected') }}',
            files_selected: '{{ translate('Files selected') }}',
            add_more_files: '{{ translate('Add more files') }}',
            adding_more_files: '{{ translate('Adding more files') }}',
            drop_files_here_paste_or: '{{ translate('Drop files here, paste or') }}',
            browse: '{{ translate('Browse') }}',
            upload_complete: '{{ translate('Upload complete') }}',
            upload_paused: '{{ translate('Upload paused') }}',
            resume_upload: '{{ translate('Resume upload') }}',
            pause_upload: '{{ translate('Pause upload') }}',
            retry_upload: '{{ translate('Retry upload') }}',
            cancel_upload: '{{ translate('Cancel upload') }}',
            uploading: '{{ translate('Uploading') }}',
            processing: '{{ translate('Processing') }}',
            complete: '{{ translate('Complete') }}',
            file: '{{ translate('File') }}',
            files: '{{ translate('Files') }}',
        }
    </script>

    <style>
        body{
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
        }
        .heading_font1
        {
            font-family: 'Domine', serif;
        }
        :root{
            --primary: {{ get_setting('base_color', '#e62d04') }};
            --hov-primary: {{ get_setting('base_hov_color', '#c52907') }};
            --soft-primary: {{ hex2rgba(get_setting('base_color','#e62d04'),.15) }};
        }

        #map{
            width: 100%;
            height: 250px;
        }
        #edit_map{
            width: 100%;
            height: 250px;
        }

        .pac-container { z-index: 100000; }
    </style>
    
    <style>
        div#welcomeModal .modal-content {
            background-image: url(/public/assets/img/login_bg_image.png);
            background-size: cover;
            height: 234px;
            border: 0;
            border-radius: 0;
        }
        
        div#welcomeModal .modal-dialog {
            max-width: 345px;
        }
        
        div#welcomeModal h4 {
            text-align: center;
            font-size: 34px;
            font-family: ui-serif;
            padding-top: 0;
            font-weight: bold;
            color: #e18a14b3;
        }
        
        div#welcomeModal p {
            text-align: center;
            font-size: 16px;
        }
        
        div#welcomeModal  .modal-header {
            border: 0;
        }
        
        div#welcomeModal button.close {
            opacity: 1;
            z-index: 99;
            margin: -3rem -2rem 1rem auto;
            background: #eaac59;
            color: #fff;
            padding: 5px 5px;
            border-radius: 100%;
        }
        div#welcomeModal {
            padding-top: 12%;
    position: absolute !important;
        }
        
        div#welcomeModal .modal-header .close:before {
            font-size: 12px;
        }
        
        @keyframes confetti-slow {
                    0% {
                        transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
                    }
                    100% {
                        transform: translate3d(25px, 105vh, 0) rotateX(360deg) rotateY(180deg);
                    }
                }
                @keyframes confetti-medium {
                    0% {
                        transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
                    }
                    100% {
                        transform: translate3d(100px, 105vh, 0) rotateX(100deg) rotateY(360deg);
                    }
                }
                @keyframes confetti-fast {
                    0% {
                        transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
                    }
                    100% {
                        transform: translate3d(-50px, 105vh, 0) rotateX(10deg) rotateY(250deg);
                    }
                }
                .confetti-container {
                    perspective: 700px;
                    position: absolute;
                    overflow: hidden;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    left: 0;
                }
                .confetti {
                    position: absolute;
                    z-index: 1;
                    top: -10px;
                    border-radius: 0;
                }
                .confetti--animation-slow {
                    animation: confetti-slow 2.25s linear 1 forwards;
                }
                .confetti--animation-medium {
                    animation: confetti-medium 1.75s linear 1 forwards;
                }
                .confetti--animation-fast {
                    animation: confetti-fast 1.25s linear 1 forwards;
                }
        
        
                 @media(max-width:767px)
                 {
                    div#welcomeModal .modal-dialog {
                        max-width: 100%;
                        margin: 20px;
                    }
                 }


                 

                  @keyframes  confetti-slow {
                    0% {
                        transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
                    }
                    100% {
                        transform: translate3d(25px, 105vh, 0) rotateX(360deg) rotateY(180deg);
                    }
                }
                @keyframes  confetti-medium {
                    0% {
                        transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
                    }
                    100% {
                        transform: translate3d(100px, 105vh, 0) rotateX(100deg) rotateY(360deg);
                    }
                }
                @keyframes  confetti-fast {
                    0% {
                        transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
                    }
                    100% {
                        transform: translate3d(-50px, 105vh, 0) rotateX(10deg) rotateY(250deg);
                    }
                }
                .confetti-container {
                    perspective: 700px;
                    position: absolute;
                    overflow: hidden;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    left: 0;
                }
                .confetti {
                    position: absolute;
                    z-index: 1;
                    top: -10px;
                    border-radius: 0;
                }
                .confetti--animation-slow {
                    animation: confetti-slow 2.25s linear 1 forwards;
                }
                .confetti--animation-medium {
                    animation: confetti-medium 1.75s linear 1 forwards;
                }
                .confetti--animation-fast {
                    animation: confetti-fast 1.25s linear 1 forwards;
                }
#once-popup {
        position: fixed;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.65);
        text-align: center;
        z-index: 10000;
    }

    div#once-popup img {
    width: 100%;
}
    #once-popup .offer_popup {
        background: #ffffff;
    padding: 0px;
    width: 530px;
    max-width: 80%;
    margin: 50px auto;
    position: relative;
    }
    #once-popup #popup-close {
    position: absolute;
    right: -16px;
    background: #84253b;
    z-index: 99;
    opacity: 1 !important;
    border-radius: 50px;
    height: 34px;
    width: 34px;
    line-height: 34px;
    font-size: 34px;
    text-shadow: none;
    top: -16px;
    color: #fff;
    }

                
    </style>
    
 <!-- Google tag (gtag.js) -->
<!--<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11362608793"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-11362608793');
</script>--> 

<!-- Google tag (gtag.js) -->
<!--<script async src="https://www.googletagmanager.com/gtag/js?id=G-YEF663KSEP"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-YEF663KSEP');
</script>-->

<!--New google tag-->
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11362608793"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-11362608793');
</script>
<!-- Event snippet for Begin checkout conversion page -->
<!--<script>-->
<!--  gtag('event', 'conversion', {'send_to': 'AW-11362608793/kop8CKaxgf0YEJnNjqoq'});-->
<!--</script>-->
<!-- Event snippet for Product purchased conversion page -->
<!--<script>-->
<!--  gtag('event', 'conversion', {-->
<!--      'send_to': 'AW-11362608793/6TBdCLucgf0YEJnNjqoq',-->
<!--      'transaction_id': ''-->
<!--  });-->
<!--</script>-->
<!-- Event snippet for Add to cart conversion page -->
<!--<script>-->
<!--  gtag('event', 'conversion', {'send_to': 'AW-11362608793/1FlmCMa3g_0YEJnNjqoq'});-->
<!--</script>-->
<!-- Event snippet for Lead Form Submission conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-11362608793/gaC-CLnIpZsZEJnNjqoq'});
</script>

<script>
  gtag('config', 'AW-11362608793/GtKTCKjZ0KwZEJnNjqoq', {
    'phone_conversion_number': '7070070716'
  });
</script>






<!-- Event snippet for Add to cart conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> 
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
  <script>
    // Define the function
    function gtag_report_conversion2(url) {
      var callback = function () {
        if (typeof(url) != 'undefined') {
          //window.location = url;
        }
      };
      gtag('event', 'conversion', {
        'send_to': 'AW-11362608793/1FlmCMa3g_0YEJnNjqoq',
        'event_callback': callback
      });
      return false;
    }
    
    // Plain JavaScript click event handler
    document.addEventListener('DOMContentLoaded', function () {
      // Select all elements with the class 'gtagaddtocart'
      var elements = document.querySelectorAll('.gtagaddtocart');
    
      // Loop through each element and attach a click event listener
      elements.forEach(function(element) {
        element.addEventListener('click', function () {
          // Get the value of the 'data-url' attribute
          var url = element.getAttribute('data-url');
          // Call the function with the URL
          gtag_report_conversion2(url);
        });
      });
    });

    // jQuery click event handler
    // $(document).ready(function () {
    //   $('.gtagaddtocart').on('click', function () {
    //     var url = $(this).attr('data-url');
    //     gtag_report_conversion2(url);
    //   });
    // });
  </script>
  
  
<!-- Event snippet for Contact us conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
<script>
   function gtag_report_conversion(url) {
      var callback = function () {
         if (typeof(url) != 'undefined') {
            //window.location = url;
         }
      };
      gtag('event', 'conversion', {
         'send_to': 'AW-11362608793/SphSCICNhf0YEJnNjqoq',
         'event_callback': callback
      });
      return false;
   }
</script>



@if (get_setting('facebook_pixel') == 1)
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{{ env('FACEBOOK_PIXEL_ID') }}');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ env('FACEBOOK_PIXEL_ID') }}&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
@endif

@php
    echo get_setting('header_script');
@endphp

</head>
<body>
    
    <!-- aiz-main-wrapper -->
    <div class="aiz-main-wrapper d-flex flex-column">

        <!-- Header -->
        @include('frontend.inc.nav')
        
        @if(session('welcome_message'))
            <!-- Modal HTML structure -->
            <div id="welcomeModal" class="modal fade js-container" tabindex="-1" role="dialog" aria-labelledby="welcomeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                           
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4>Welcome</h4>
                            <p>{{  Auth::user()->name . '!' }}</p>
                        </div>
                        
                    </div>
                </div>
            </div>
            @php session()->forget('welcome_message'); @endphp
        @endif
        
        @yield('content')
        
        @include('frontend.inc.footer')

    </div>

    @if (get_setting('show_cookies_agreement') == 'on')
        <div class="aiz-cookie-alert shadow-xl">
            <div class="p-3 bg-dark rounded">
                <div class="text-white mb-3">
                    @php
                        echo get_setting('cookies_agreement_text');
                    @endphp
                </div>
                <button class="btn btn-primary aiz-cookie-accept">
                    {{ translate('Ok. I Understood') }}
                </button>
            </div>
        </div>
    @endif

    @if (get_setting('show_website_popup') == 'on')
        <div class="modal website-popup removable-session d-none" data-key="website-popup" data-value="removed">
            <div class="absolute-full bg-black opacity-60"></div>
            <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-md">
                <div class="modal-content position-relative border-0 rounded-0">
                    <div class="aiz-editor-data">
                        {!! get_setting('website_popup_content') !!}
                    </div>
                    @if (get_setting('show_subscribe_form') == 'on')
                        <div class="pb-5 pt-4 px-5">
                            <form class="" method="POST" action="{{ route('subscribers.store') }}">
                                @csrf
                                <div class="form-group mb-0">
                                    <input type="email" class="form-control" placeholder="{{ translate('Your Email Address') }}" name="email" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block mt-3">
                                    {{ translate('Subscribe Now') }}
                                </button>
                            </form>
                        </div>
                    @endif
                    <button class="absolute-top-right bg-white shadow-lg btn btn-circle btn-icon mr-n3 mt-n3 set-session" data-key="website-popup" data-value="removed" data-toggle="remove-parent" data-parent=".website-popup">
                        <i class="la la-close fs-20"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif
    
    @include('frontend.partials.modal')
    
    @include('frontend.partials.account_delete_modal')

    <div class="modal fade" id="addToCart">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader text-center p-3">
                    <i class="las la-spinner la-spin la-3x"></i>
                </div>
                <button type="button" class="close absolute-top-right btn-icon close z-1" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la-2x">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>

    @yield('modal')
    
    <!-- SCRIPTS -->
    <script src="{{ static_asset('assets/js/vendors.js') }}"></script> 
    <script src="{{ static_asset('assets/js/aiz-core.min.js') }}" defer></script>
    <!--<script src="{{ static_asset('assets/js/aiz-core.js') }}" defer></script>-->
    <!--<script src="{{ static_asset('assets/js/owl.carousel.js') }}"></script>-->
    <script src="{{ static_asset('assets/js/owl.carousel.min.js') }}" defer></script>
    <!--<script src="{{ static_asset('assets/js/custom.js') }}" defer></script>-->
   <script src="{{ static_asset('assets/js/moment.min.js') }}" defer></script>
   <script src="{{ static_asset('assets/js/whatsapp-chat-support.js') }}" defer></script>
   <script src="{{ static_asset('assets/js/fancybox.min.js') }}" defer></script>
<script>
jQuery(document).ready(function($){
		$('#example_1').whatsappChatSupport();
});
	</script>
    @if (get_setting('facebook_chat') == 1)
        <script type="text/javascript">
            window.fbAsyncInit = function() {
                FB.init({
                  xfbml            : true,
                  version          : 'v3.3'
                });
              };

              (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <div id="fb-root"></div>
        <!-- Your customer chat code -->
        <div class="fb-customerchat"
          attribution=setup_tool
          page_id="{{ env('FACEBOOK_PAGE_ID') }}">
        </div>
    @endif
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof AIZ !== 'undefined' && typeof AIZ.plugins !== 'undefined' && typeof AIZ.plugins.notify === 'function') {
                @foreach (session('flash_notification', collect())->toArray() as $message)
                    AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
                @endforeach
            } else {
                console.log('AIZ.plugins.notify is not defined or not loaded yet.');
            }
        });
        
            // @foreach (session('flash_notification', collect())->toArray() as $message)
            //     AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
            // @endforeach
    </script>

    <script>

        $(document).ready(function() {
            $('.category-nav-element').each(function(i, el) {
                $(el).on('mouseover', function(){
                    if(!$(el).find('.sub-cat-menu').hasClass('loaded')){
                        $.post('{{ route('category.elements') }}', {_token: AIZ.data.csrf, id:$(el).data('id')}, function(data){
                            $(el).find('.sub-cat-menu').addClass('loaded').html(data);
                        });
                    }
                });
            });
            if ($('#lang-change').length > 0) {
                $('#lang-change .dropdown-menu a').each(function() {
                    $(this).on('click', function(e){
                        e.preventDefault();
                        var $this = $(this);
                        var locale = $this.data('flag');
                        $.post('{{ route('language.change') }}',{_token: AIZ.data.csrf, locale:locale}, function(data){
                            location.reload();
                        });

                    });
                });
            }

            if ($('#currency-change').length > 0) {
                $('#currency-change .dropdown-menu a').each(function() {
                    $(this).on('click', function(e){
                        e.preventDefault();
                        var $this = $(this);
                        var currency_code = $this.data('currency');
                        $.post('{{ route('currency.change') }}',{_token: AIZ.data.csrf, currency_code:currency_code}, function(data){
                            location.reload();
                        });

                    });
                });
            }
        });

        $('#search').on('keyup', function(){
            search();
        });

        $('#search').on('focus', function(){
            search();
        });

        function search(){
            var searchKey = $('#search').val();
            if(searchKey.length > 0){
                $('body').addClass("typed-search-box-shown");

                $('.typed-search-box').removeClass('d-none');
                $('.search-preloader').removeClass('d-none');
                $.post('{{ route('search.ajax') }}', { _token: AIZ.data.csrf, search:searchKey}, function(data){
                    if(data == '0'){
                        // $('.typed-search-box').addClass('d-none');
                        $('#search-content').html(null);
                        $('.typed-search-box .search-nothing').removeClass('d-none').html('{{ translate('Sorry, nothing found for') }} <strong>"'+searchKey+'"</strong>');
                        $('.search-preloader').addClass('d-none');

                    }
                    else{
                        $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                        $('#search-content').html(data);
                        $('.search-preloader').addClass('d-none');
                    }
                });
            }
            else {
                $('.typed-search-box').addClass('d-none');
                $('body').removeClass("typed-search-box-shown");
            }
        }

        function updateNavCart(view,count){
            $('.cart-count').html(count);
            $('#cart_items').html(view);
        }

        let cart_page_url = "{{ route('cart') }}";

        function flushDeliverableSession_app() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url(route('flush-deliverable-session')) }}", // Route to flush the session
                method: 'POST',
                success: function(response) {
                    // if (response.status === 'success') {
                    //     AIZ.plugins.notify('success', '{{ translate("Session cleared successfully.") }}');
                    // } else {
                    //     AIZ.plugins.notify('danger', '{{ translate("Failed to clear session.") }}');
                    // }
                },
                error: function() {
                    AIZ.plugins.notify('danger', '{{ translate("An error occurred. Please try again.") }}');
                }
            });
        }

        function removeFromCart(key){
            $.post('{{ route('cart.removeFromCart') }}', {
                _token  : AIZ.data.csrf,
                id      :  key
            }, function(data){
                updateNavCart(data.nav_cart_view,data.cart_count);
                $('#cart-summary').html(data.cart_view);
                AIZ.plugins.notify('success', "{{ translate('Item has been removed from cart') }}");
                $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())-1);

                setTimeout(function() {
                    flushDeliverableSession_app()
                    window.location.href = cart_page_url; // Reload the page after 10 sec
                }, 1000); // 10000 ms = 10 sec

            });
        }

        function addToCompare(id){
            $.post('{{ route('compare.addToCompare') }}', {_token: AIZ.data.csrf, id:id}, function(data){
                $('#compare').html(data);
                AIZ.plugins.notify('success', "{{ translate('Item has been added to compare list') }}");
                $('#compare_items_sidenav').html(parseInt($('#compare_items_sidenav').html())+1);
            });
        }

        function addToWishList(id){
            @if (Auth::check() && Auth::user()->user_type == 'customer')
                $.post('{{ route('wishlists.store') }}', {_token: AIZ.data.csrf, id:id}, function(data){
                const wishlistButton = $(`[data-id="${id}"]`);
                    if(data != 0){
                        $('#wishlist').html(data);
                        AIZ.plugins.notify('success', "{{ translate('Item has been added to wishlist') }}");
                        wishlistButton.addClass("active");
                    }
                    else{
                        AIZ.plugins.notify('warning', "{{ translate('Please login first') }}");
                    }
                });
            @elseif(Auth::check() && Auth::user()->user_type != 'customer')
                AIZ.plugins.notify('warning', "{{ translate('Please Login as a customer to add products to the WishList.') }}");
            @else
                AIZ.plugins.notify('warning', "{{ translate('Please login first') }}");
            @endif
        }

        function showAddToCartModal(id){
            if(!$('#modal-size').hasClass('modal-lg')){
                $('#modal-size').addClass('modal-lg');
            }
            $('#addToCart-modal-body').html(null);
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.post('{{ route('cart.showCartModal') }}', {_token: AIZ.data.csrf, id:id}, function(data){
                $('.c-preloader').hide();
                $('#addToCart-modal-body').html(data);
                AIZ.plugins.slickCarousel();
                AIZ.plugins.zoom();
                AIZ.extra.plusMinus();
                getVariantPrice();
            });
        }

        $('#option-choice-form input').on('change', function(){
            getVariantPrice();
        });

        function getVariantPrice(){
            if($('#option-choice-form input[name=quantity]').val() > 0 && checkAddToCartValidity()){
                $.ajax({
                   type:"POST",
                   url: '{{ route('products.variant_price') }}',
                   data: $('#option-choice-form').serializeArray(),
                   success: function(data){

                        $('.product-gallery-thumb .carousel-box').each(function (i) {
                            if($(this).data('variation') && data.variation == $(this).data('variation')){
                                $('.product-gallery-thumb').slick('slickGoTo', i);
                            }
                        })
                        $('#base_price').html(data.price);
                        $('#regular_price').html(data.regular_price);
                        $('#discounted_price').html(data.discount_in_percentage + '% OFF');
                        $('#option-choice-form #chosen_price_div').removeClass('d-none');
                        $('#option-choice-form #chosen_price_div #chosen_price').html(data.price);
                        $('#available-quantity').html(data.quantity);
                        $('.input-number').prop('max', data.max_limit);
                        if(parseInt(data.in_stock) == 0 && data.digital  == 0){
                           $('.buy-now').addClass('d-none');
                           $('.add-to-cart').addClass('d-none');
                           $('.out-of-stock').removeClass('d-none');
                        }
                        else{
                           $('.buy-now').removeClass('d-none');
                           $('.add-to-cart').removeClass('d-none');
                           $('.out-of-stock').addClass('d-none');
                        }

                        AIZ.extra.plusMinus();
                   }
               });
            }
        }

        function checkAddToCartValidity(){
            var names = {};
            $('#option-choice-form input:radio').each(function() { // find unique names
                names[$(this).attr('name')] = true;
            });
            var count = 0;
            $.each(names, function() { // then count them
                count++;
            });

            if($('#option-choice-form input:radio:checked').length == count){
                return true;
            }

            return false;
        }

        function addToCart(){
            @if(Auth::check() && Auth::user()->user_type != 'customer')
                AIZ.plugins.notify('warning', "{{ translate('Please Login as a customer to add products to the Cart.') }}");
                return false;
            @endif

            if(checkAddToCartValidity()) {
                $('#addToCart').modal();
                $('.c-preloader').show();
                $.ajax({
                    type:"POST",
                    url: '{{ route('cart.addToCart') }}',
                    data: $('#option-choice-form').serializeArray(),
                    success: function(data){

                       $('#addToCart-modal-body').html(null);
                       $('.c-preloader').hide();
                       $('#modal-size').removeClass('modal-lg');
                       $('#addToCart-modal-body').html(data.modal_view);
                       AIZ.extra.plusMinus();
                       AIZ.plugins.slickCarousel();
                       updateNavCart(data.nav_cart_view,data.cart_count);
                    }
                });
            }
            else{
                AIZ.plugins.notify('warning', "{{ translate('Please choose all the options') }}");
            }
        }

        function buyNow(){
            @if(Auth::check() && Auth::user()->user_type != 'customer')
                AIZ.plugins.notify('warning', "{{ translate('Please Login as a customer to add products to the Cart.') }}");
                return false;
            @endif
            
            if(checkAddToCartValidity()) {
                $('#addToCart-modal-body').html(null);
                $('#addToCart').modal();
                $('.c-preloader').show();
                $.ajax({
                   type:"POST",
                   url: '{{ route('cart.addToCart') }}',
                   data: $('#option-choice-form').serializeArray(),
                   success: function(data){
                       if(data.status == 1){

                            $('#addToCart-modal-body').html(data.modal_view);
                            updateNavCart(data.nav_cart_view,data.cart_count);

                            window.location.replace("{{ route('cart') }}");
                       }
                       else{
                            $('#addToCart-modal-body').html(null);
                            $('.c-preloader').hide();
                            $('#modal-size').removeClass('modal-lg');
                            $('#addToCart-modal-body').html(data.modal_view);
                       }
                   }
               });
            }
            else{
                AIZ.plugins.notify('warning', "{{ translate('Please choose all the options') }}");
            }
        }

    </script>

    @yield('script')

    @php
        echo get_setting('footer_script');
    @endphp
<script>
  window.addEventListener('mousedown', function(e) {
    if(e.target.closest('.add-to-cart')){
      gtag('event', 'conversion', {'send_to': 'AW-11362608793/ESVoCOTtn9UZEJnNjqoq'});
    }
    if(e.target.closest('[href="https://www.atfleurs.com/cart"]')){
      gtag('event', 'conversion', {'send_to': 'AW-11362608793/bjmPCOftn9UZEJnNjqoq'});
    }
  });
</script>

<!-- Trigger the modal using JavaScript -->
<script>
    $(document).ready(function() {
        $('#welcomeModal').modal('show');
    });
</script>

 <script>
    const Confettiful = function (el) {
        this.el = el;
        this.containerEl = null;

        this.confettiFrequency = 3;
        this.confettiColors = ["#fce18a", "#ff726d", "#b48def", "#f4306d"];
        this.confettiAnimations = ["slow", "medium", "fast"];

        this._setupElements();
        this._renderConfetti();
    };

    Confettiful.prototype._setupElements = function () {
        const containerEl = document.createElement("div");
        const elPosition = this.el.style.position;

        if (elPosition !== "relative" && elPosition !== "absolute") {
            this.el.style.position = "relative";
        }

        containerEl.classList.add("confetti-container");
        this.el.appendChild(containerEl);
        this.containerEl = containerEl;
    };

    Confettiful.prototype._renderConfetti = function () {
        this.confettiInterval = setInterval(() => {
            const confettiEl = document.createElement("div");
            const confettiSize = Math.floor(Math.random() * 3) + 7 + "px";
            const confettiBackground = this.confettiColors[
                Math.floor(Math.random() * this.confettiColors.length)
            ];
            const confettiLeft = Math.floor(Math.random() * this.el.offsetWidth) + "px";
            const confettiAnimation = this.confettiAnimations[
                Math.floor(Math.random() * this.confettiAnimations.length)
            ];

            confettiEl.classList.add(
                "confetti",
                "confetti--animation-" + confettiAnimation
            );
            confettiEl.style.left = confettiLeft;
            confettiEl.style.width = confettiSize;
            confettiEl.style.height = confettiSize;
            confettiEl.style.backgroundColor = confettiBackground;

            confettiEl.removeTimeout = setTimeout(function () {
                confettiEl.parentNode.removeChild(confettiEl);
            }, 3000);

            this.containerEl.appendChild(confettiEl);
        }, 25);
		  // Stop the confetti after 5 seconds
        setTimeout(() => {
            clearInterval(this.confettiInterval);
        }, 10000);
    };

    window.confettiful = new Confettiful(document.querySelector(".js-container"));
</script>


<!-- <div style="display:none" id="once-popup">
    <div class="offer_popup">
        <div id="popup-close" role="button">×</div>
        <img src="public/assets/img/diwali_offer.jpg" 
             data-coupon="DIWALI24" 
             id="coupon-image" 
             style="cursor: pointer;" 
             alt="Offer Image" />
    </div>
</div>

<div id="copy-notification" style="    position: fixed;
    top: 1%;
    padding: 10px 20px;
    background-color: rgb(76, 175, 80);
    color: rgb(255, 255, 255);
    border-radius: 5px;
    font-size: 16px;
    z-index: 99999;
    right: 7px;
    display:none;
}">
    Coupon copied!
</div>
<script>
    $(document).ready(function() {
        // Show popup on home page only
        if (window.location.pathname === "/") {
            $("#once-popup").delay(2000).fadeIn();
        }

        // Close popup on clicking close button
        $('#popup-close').click(function(e) {
            e.stopPropagation();
            $('#once-popup').fadeOut();
        });

        // Close popup on clicking outside popup content
        $('#once-popup').click(function(e) {
            if (e.target === this) {
                $(this).fadeOut();
            }
        });

        // Copy coupon code when image is clicked
        $('#coupon-image').click(function() {
            var couponCode = $(this).data('coupon');
            navigator.clipboard.writeText(couponCode).then(function() {
                // Show notification
                $('#copy-notification').fadeIn().delay(2000).fadeOut();
            }).catch(function(error) {
                console.error("Failed to copy text: ", error);
            });
        });
    });
</script> -->




</body>
</html>
