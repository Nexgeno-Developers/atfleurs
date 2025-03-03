@if(get_setting('topbar_banner') != null)
<div class="position-relative top-banner removable-session z-1035 d-none" data-key="top-banner" data-value="removed">
    <a href="{{ get_setting('topbar_banner_link') }}" class="d-block text-reset">
        <img src="{{ uploaded_asset(get_setting('topbar_banner')) }}" class="w-100 mw-100 h-50px h-lg-auto img-fit">
    </a>
    <button class="btn text-white absolute-top-right set-session" data-key="top-banner" data-value="removed" data-toggle="remove-parent" data-parent=".top-banner">
        <i class="la la-close la-2x"></i>
    </button>
</div>
@endif
<!-- Top Bar -->
<div class="top-navbar bg-white border-bottom border-soft-secondary z-1035 h-35px h-sm-auto balsamiq_font">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col">
                <ul class="list-inline d-flex justify-content-between justify-content-lg-start mb-0">
                  
                    @if(get_setting('show_currency_switcher') == 'on')
                    <li class="list-inline-item dropdown ml-auto ml-lg-0 mr-0 display_none" id="currency-change">
                        @php
                            if(Session::has('currency_code')){
                                $currency_code = Session::get('currency_code');
                            }
                            else{
                                $currency_code = \App\Models\Currency::findOrFail(get_setting('system_default_currency'))->code;
                            }
                        @endphp
                        <a href="#" onclick="event.preventDefault();" class="dropdown-toggle text-reset py-2 opacity-90" data-toggle="dropdown" data-display="static">
                            {{ \App\Models\Currency::where('code', $currency_code)->first()->name }} {{ (\App\Models\Currency::where('code', $currency_code)->first()->symbol) }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                            @foreach (\App\Models\Currency::where('status', 1)->get() as $key => $currency)
                                <li>
                                    <a href="#" onclick="event.preventDefault();" class="dropdown-item @if($currency_code == $currency->code) active @endif" data-currency="{{ $currency->code }}">{{ $currency->name }} ({{ $currency->symbol }})</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- END Top Bar -->
{{--
<div class="top_br">
    <div class="container">
   <div class="col-lg-12">
          <div class="position_set">
              <ul>
                    <li>
                                <i class="las la-phone"></i> 
                                <a onclick="return gtag_report_conversion('tel:+91 7070070716');" href="tel:+91 7070070716">+91 7070070716</a> <span style="color:#000;">/</span>
                                <a onclick="return gtag_report_conversion('tel:+91 9808867777');" href="tel:+91 9808867777">+91 9808867777</a>
                                
                            </li>
                            
                             <li>
                               <i class="las la-envelope"></i> 
                               <a onclick="return gtag_report_conversion('mailto:atfleurss@gmail.com');" href="mailto:atfleurss@gmail.com">atfleurss@gmail.com </a>
                            
                              
                            </li>
                    </ul>
          </div>
          </div>
      </div>
      </div>
--}}     
      
<header class="@if(get_setting('header_stikcy') == 'on') sticky-top @endif z-1020 bg-white border-bottom shadow-sm balsamiq_font bg_wwhite">
    <div class="position-relative logo-bar-area z-1">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
    
  
   
     
      <div class="d-lg-none col-4 col-lg-2 mr-0 serach_mobile">
                    <button class="p-2 d-block text-reset" aria-labelledby="search" data-toggle="class-toggle" data-target=".front-header-search" style="background: transparent; border: 0;">
                        <i class="las la-search la-flip-horizontal la-2x"></i>
                    </button>
                </div>
                
                <div class="col-4 col-lg-3 col-xl-2 pl-0 align-items-left text-left logo">
                    <a class="d-block py-5px ml-0" href="{{ route('home') }}" aria-label="Logo Link">
                        @php
                            $header_logo = get_setting('header_logo');
                        @endphp
                        @if($header_logo != null)
                            <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-60px h-md-70px" height="70">
                        @else
                            <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px h-md-70px" height="70">
                        @endif
                    </a>

                    @if(Route::currentRouteName() != 'home')
                        <div class="d-none d-xl-block align-self-stretch category-menu-icon-box ml-auto mr-0">
                            <div class="h-100 d-flex align-items-center" id="category-menu-icon">
                                <div class="dropdown-toggle navbar-light bg-light h-40px w-50px pl-2 rounded border c-pointer">
                                    <span class="navbar-toggler-icon"></span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                
  
    
              

                <div class="col-auto col-xl-6 pl-0 flex-grow-1 front-header-search d-flex align-items-center bg-white serch_box">
                    <div class="position-relative flex-grow-1">
                        <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                            <div class="d-flex position-relative align-items-center">
                                <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                                    <button aria-labelledby="search" class="btn px-2" type="button"><i class="la la-2x la-long-arrow-left"></i></button>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="border-0 border-lg form-control" id="search" name="keyword" @isset($query)
                                        value="{{ $query }}"
                                    @endisset placeholder="{{translate('Search...')}}" autocomplete="off">
                                    <div class="input-group-append d-none d-lg-block">
                                        <button aria-label="Search" class="btn btn-primary" type="submit">
                                            <i class="la la-search la-flip-horizontal fs-18"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100" style="min-height: 200px">
                            <div class="search-preloader absolute-top-center">
                                <div class="dot-loader"><div></div><div></div><div></div></div>
                            </div>
                            <div class="search-nothing d-none p-3 text-center fs-16">

                            </div>
                            <div id="search-content" class="text-left">

                            </div>
                        </div>
                    </div>
                </div>
               

                <div class="col-xl-2 pl-0 col-3 text-right d-none d-lg-block login_regst">
                <ul class="list-inline mb-0 h-100 d-flex justify-content-end align-items-center">
                  
                    @auth
                        @if(isAdmin())
                        @else
 <li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0">
                                @if (Auth::user()->user_type == 'seller')
                                    <a href="{{ route('seller.dashboard') }}" class="text-reset d-inline-block py-2">{{ translate('My Panel')}}</a>
                                @else
                                    <a href="{{ route('dashboard') }}" class="text-reset d-inline-block py-2">{{ translate('My Panel')}}</a>
                                @endif
                            </li>
                        @endif
                        <li class="list-inline-item">
                            <a href="{{ route('logout') }}" class="text-reset d-inline-block py-2"> {{ translate('Logout')}}</a>
                        </li>
                    @else
                        <li class="list-inline-item mr-0 border-left-0 pr-0 pl-0">
                            <a href="{{ route('user.login') }}" class="text-reset d-inline-block py-2"> <i class="las la-user la-2x text-primary mb1 position_1"></i> {{ translate('Login')}}</a> <span class="pddleft">/</span> 
                            <a href="{{ route('user.registration') }}" class="text-reset d-inline-block py-2"> {{ translate('Registration')}}</a>
                        </li>
                    @endauth
                </ul>
            </div>
            
            
                <div class="col-xl-1 pl-0 col-3 col-lg-1  d-none d-lg-block  align-self-stretch ml-3 mr-0" data-hover="dropdown">
                    <div class="nav-cart-box dropdown h-100" id="cart_items">
                        @include('frontend.partials.cart')
                    </div>
                </div>
                

                <div class="col-md-1 col-4 pddright">
                     @include('frontend.partials.mega_menu_nav')
                </div>

                
            </div>
        </div>
        @if(Route::currentRouteName() != 'home')
        <div class="hover-category-menu position-absolute w-100 top-100 left-0 right-0 d-none z-3" id="hover-category-menu">
            <div class="container">
                <div class="row gutters-10 position-relative">
                    <div class="col-lg-3 position-static">
                        @include('frontend.partials.category_menu')
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    
     @if ( get_setting('header_menu_labels') !=  null )
        <div class="bg-white border-top border-gray-200 py-1 navingation_link d-none d-lg-block">
            <div class="container">
                <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center">
                    @foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)
                    <li class="list-inline-item mr-0">
                        <a href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}" class="opacity-90 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                            {{ translate($value) }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    
</header>

<div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div id="order-details-modal-body">

            </div>
        </div>
    </div>
</div>

@section('script')
<script type="text/javascript">
  function show_order_details(order_id) {
    $('#order-details-modal-body').html(null);

    if (!$('#modal-size').hasClass('modal-lg')) {
      $('#modal-size').addClass('modal-lg');
    }

    $.post('{{ route('orders.details') }}', {
      _token: AIZ.data.csrf,
      order_id: order_id
    }, function(data) {
      $('#order-details-modal-body').html(data);
      $('#order_details').modal();
      $('.c-preloader').hide();
      AIZ.plugins.bootstrapSelect('refresh');
    });
  }


</script>
@endsection
