@extends('frontend.layouts.app')

@section('content')
    <section class="gry-bg py-5">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 mx-auto">
                        <div class="card">
                            <div class="text-center pt-4">
                                <h1 class="h4 fw-600">
                                    {{ translate('Login to your account.')}}
                                </h1>
                            </div>

                            <div class="px-4 py-3 py-lg-4">
                                <div class="">
                                    <form class="form-default" id="login-form-customer" role="form" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{url()->previous()}}" name="redirect">
                                        @if (addon_is_activated('otp_system') && env("DEMO_MODE") != "On")
                                            <div class="form-group phone-form-group mb-1">
                                                <input autocomplete="off" type="tel" id="phone-code" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" name="phone" autocomplete="off" pattern="[1-9]{1}[0-9]{9}" minlength="10" maxlength="10" placeholder="Enter 10 digit phone number" title="Enter 10 digit phone number">
                                            </div>

                                            <input type="hidden" name="country_code" value="">

                                            <div class="form-group email-form-group mb-1 d-none">
                                                <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email" id="email" autocomplete="off">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group text-right">
                                                <button class="btn btn-link p-0 opacity-50 text-reset" type="button" onclick="toggleEmailPhone(this)">{{ translate('Use Email Instead') }}</button>
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email" id="email" autocomplete="off">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }} d-none" placeholder="{{ translate('Password')}}" name="password" id="password">
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <label class="aiz-checkbox">
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <span class=opacity-60>{{  translate('Remember Me') }}</span>
                                                    <span class="aiz-square-check"></span>
                                                </label>
                                            </div>
                                            <div class="col-6 text-right">
                                                <a href="{{ route('password.request') }}" class="text-reset opacity-60 fs-14">{{ translate('Forgot password?')}}</a>
                                            </div>
                                        </div>

                                        <div class="mb-5">
                                            <button type="submit" class="btn btn-primary btn-block fw-600">{{  translate('Login') }}</button>
                                        </div>
                                    </form>

                                    @if (env("DEMO_MODE") == "On")
                                        <div class="mb-5">
                                            <table class="table table-bordered mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>{{ translate('Seller Account')}}</td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm" onclick="autoFillSeller()">{{ translate('Copy credentials') }}</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ translate('Customer Account')}}</td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm" onclick="autoFillCustomer()">{{ translate('Copy credentials') }}</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ translate('Delivery Boy Account')}}</td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm" onclick="autoFillDeliveryBoy()">{{ translate('Copy credentials') }}</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                    @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1 || get_setting('apple_login') == 1)
                                        <div class="separator mb-3">
                                            <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                                        </div>
                                        <ul class="list-inline social colored text-center mb-4">
                                            @if (get_setting('facebook_login') == 1)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                                        <i class="lab la-facebook-f"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if(get_setting('google_login') == 1)
                                                <li class="list-inline-item login_with_google">
                                                    <a href="{{ route('social.login', ['provider' => 'google']) }}?redirect={{url()->previous()}}" class="google">
                                                        <img src="/public/assets/img/google_icon.webp" alt="google icon"> 
                                                        Login with Google
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
                                                    <a href="{{ route('social.login', ['provider' => 'apple']) }}"
                                                        class="apple">
                                                        <i class="lab la-apple"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <p class="text-muted mb-0">{{ translate('Dont have an account?')}}</p>
                                    <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    {{--/* otp popup  */ --}}
    
        <div class="modal" id="otp-modal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Mobile OTP Verify</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form class="form-default" id="otp-login-customer" role="form" action="{{ route('user.login.via.otp.verify') }}" method="POST">
                @csrf
                    <div class="modal-body">
                        <div class="form-group mt-4 adhar_field">
                            <label class="pb-2">Verify OTP *</label>
                            <input type="text" class="form-control" name="otp" pattern="[0-9]+" minlength="6"
                                maxlength="6" placeholder="Please Enter OTP" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Proceed</button>
                        <button type="button" class="btn btn-secondary" onclick="closeOtpModal()">Close</button>
                    </div>
                </form>
              
            </div>
          </div>
        </div>
    
    {{--/* otp popup  */ --}}
    
    
@endsection

@section('script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    
    <script type="text/javascript">
        var isPhoneShown = true,
            countryData = window.intlTelInputGlobals.getCountryData(),
            input = document.querySelector("#phone-code");

        for (var i = 0; i < countryData.length; i++) {
            var country = countryData[i];
            if(country.iso2 == 'bd'){
                country.dialCode = '88';
            }
        }

        var iti = intlTelInput(input, {
            separateDialCode: true,
            utilsScript: "{{ static_asset('assets/js/intlTelutils.js') }}?1590403638580",
            onlyCountries: @php echo json_encode(\App\Models\Country::where('status', 1)->pluck('code')->toArray()) @endphp,
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                if(selectedCountryData.iso2 == 'bd'){
                    return "01xxxxxxxxx";
                }
                return selectedCountryPlaceholder;
            }
        });

        var country = iti.getSelectedCountryData();
        $('input[name=country_code]').val(country.dialCode);

        input.addEventListener("countrychange", function(e) {
            // var currentMask = e.currentTarget.placeholder;

            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);

        });
        
        
        /*-----------------New CODE-------------------------------------- */
        
        function closeOtpModal() {
            $('#otp-modal').modal('hide');
        }
        
        function ajax_form_Submit(){
            if (isPhoneShown) {
                
                $('#login-form-customer').off('submit');
                
                $('#login-form-customer').on('submit', function(e) {
                    e.preventDefault(); // Prevent the default form submission
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.status == true) {
                                toastr.success(response.notification);
                                if(response.otp == true){
                                    $('#otp-modal').modal('show');
                                } else {
                                    toastr.error('Somthing Went Wrong!');
                                }
                
                            } else {
                                toastr.error(response.notification);
                            }
                        },
                        error: function(error) {
                            toastr.error('An error occurred while processing your request.');
                        }
                    });
                });
            } 
        }
        
        $('#login-form-customer').attr('action', "{{ route('user.login.via.otp') }}");

        function toggleEmailPhone(el){
            if(isPhoneShown){
                $('#login-form-customer').on('submit');
                $('.phone-form-group').addClass('d-none');
                $('#password').removeClass('d-none');
                $('#login-form-customer').attr('action', "{{ route('login') }}");
                $('.email-form-group').removeClass('d-none');
                $('input[name=phone]').val(null);
                isPhoneShown = false;
                $(el).html('{{ translate('Use Phone Instead') }}');
                
                $('#login-form-customer').off('submit');
            
            }
            else{
                $('.phone-form-group').removeClass('d-none');
                $('#password').addClass('d-none');
                $('#login-form-customer').attr('action', "{{ route('user.login.via.otp') }}");
                $('.email-form-group').addClass('d-none');
                $('input[name=email]').val(null);
                isPhoneShown = true;
                $(el).html('{{ translate('Use Email Instead') }}');
                
                ajax_form_Submit();
            }
        }
        
        ajax_form_Submit();
        

        
        
        $('#otp-login-customer').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status == true) {
                        toastr.success(response.notification);

                        setTimeout(function() {
                            location.reload();
                        }, 1000);
        
                    } else {
                        toastr.error(response.notification);
                    }
                },
                error: function(error) {
                    toastr.error('An error occurred while processing your request.');
                }
            });
        });

        /*-----------------New CODE-------------------------------------- */
        
        

        // function toggleEmailPhone(el){
        //     if(isPhoneShown){
        //         $('.phone-form-group').addClass('d-none');
        //         $('.email-form-group').removeClass('d-none');
        //         $('input[name=phone]').val(null);
        //         isPhoneShown = false;
        //         $(el).html('{{ translate('Use Phone Instead') }}');
        //     }
        //     else{
        //         $('.phone-form-group').removeClass('d-none');
        //         $('.email-form-group').addClass('d-none');
        //         $('input[name=email]').val(null);
        //         isPhoneShown = true;
        //         $(el).html('{{ translate('Use Email Instead') }}');
        //     }
        // }



        function autoFillSeller(){
            $('#email').val('seller@example.com');
            $('#password').val('123456');
        }
        function autoFillCustomer(){
            $('#email').val('customer@example.com');
            $('#password').val('123456');
        }
        function autoFillDeliveryBoy(){
            $('#email').val('deliveryboy@example.com');
            $('#password').val('123456');
        }
    </script>
@endsection
