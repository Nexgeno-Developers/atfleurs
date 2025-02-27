<?php

namespace App\Http\Controllers\Auth;

use Nexmo;
use Cookie;
use Session;
use App\Models\Cart;
use App\Models\User;
use Twilio\Rest\Client;
use App\Models\Customer;
use App\Rules\Recaptcha;
use App\OtpConfiguration;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\OTPVerificationController;
use App\Notifications\EmailVerificationNotification;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    /*protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }*/
    // protected function validator(array $data)
    // {
    //     $rules = [
    //         'name'     => 'required|string|max:255',
    //         'password' => 'required|string|min:6|confirmed',
    //     ];

    //     if (isset($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    //         $rules['email'] = 'required|string|email|max:255|unique:users';
    //     } else {
    //         $rules['phone'] = 'required|string|unique:users,phone';
    //         $rules['country_code'] = 'required|string';
    //     }

    //     return Validator::make($data, $rules);
    // }
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name'         => 'required|string|max:255',
    //         'email'        => 'required|string|email|max:255|unique:users',
    //         'phone'        => 'required',
    //         'country_code' => 'required|string',
    //         'password'     => 'required|string|min:6|confirmed',
    //     ]);
    // }
    protected function validator(array $data)
    {
        $rules = [
            'name'     => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ];

        if (addon_is_activated('otp_system')) {
            $rules['email'] = 'required|string|email|max:255|unique:users';
            $rules['phone'] = 'required';
            $rules['country_code'] = 'required|string';
        }else{
            if (isset($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $rules['email'] = 'required|string|email|max:255|unique:users';
            } else {
                $rules['phone'] = 'required';
                $rules['country_code'] = 'required';
            }
        }

        return Validator::make($data, $rules);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        //     $user = User::create([
        //         'name' => $data['name'],
        //         'email' => $data['email'],
        //         'password' => Hash::make($data['password']),
        //     ]);
        // }else{
        //     if (addon_is_activated('otp_system')){
        //         $user = User::create([
        //             'name' => $data['name'],
        //             //'phone' => '+'.$data['country_code'].$data['phone'],
        //             'email' => $data['email'],
        //             'phone'             => $data['phone'],
        //             'dial_code'         => $data['country_code'],
        //             'password' => Hash::make($data['password']),
        //             'verification_code' => rand(100000, 999999)
        //         ]);

        //         $otpController = new OTPVerificationController;
        //         $otpController->send_code($user);
        //     }
        // }

        if (addon_is_activated('otp_system')){
            $user = User::create([
                'name' => $data['name'],
                //'phone' => '+'.$data['country_code'].$data['phone'],
                'email' => $data['email'],
                'phone'             => $data['phone'],
                'dial_code'         => $data['country_code'],
                'password' => Hash::make($data['password']),
                'verification_code' => rand(100000, 999999)
            ]);

            $otpController = new OTPVerificationController;
            $otpController->send_code($user);
        }else{
            if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);
            }
        }


        if(session('temp_user_id') != null){
            Cart::where('temp_user_id', session('temp_user_id'))
                    ->update([
                        'user_id' => $user->id,
                        'temp_user_id' => null
            ]);

            Session::forget('temp_user_id');
        }

        if(Cookie::has('referral_code')){
            $referral_code = Cookie::get('referral_code');
            $referred_by_user = User::where('referral_code', $referral_code)->first();
            if($referred_by_user != null){
                $user->referred_by = $referred_by_user->id;
                $user->save();
            }
        }

        return $user;
    }

    public function register(Request $request)
    {
        // Conditionally apply the reCAPTCHA rule
        if (get_setting('google_recaptcha') == 1) {
            $rules['g-recaptcha-response'] = ['required', new Recaptcha];
            $request->validate($rules);
        }

        $this->validator($request->all())->validate();

        $ip = $request->ip();
        $key = 'registration-form:' . $ip;
        $permanentBlockKey = 'blocked-ip:' . $ip;

        // 🚨 Check if IP is permanently blocked
        if (Cache::has($permanentBlockKey)) {
            Log::alert("🚨 Blocked IP tried accessing: $ip");
            flash(translate('Your IP has been permanently blocked due to suspicious activity.'))->error();
            return back();
        }

        // Increment the rate limiter counter for this request.
        // Here, the counter will expire after 120 seconds.
        RateLimiter::hit($key, 60);
        $attempts = RateLimiter::attempts($key);

        // 🔹 Check for permanent block threshold (e.g., 3 or more attempts)
        if ($attempts >= 5) {
            Cache::put($permanentBlockKey, true, now()->addDays(30)); // Block permanently for 30 days
            Log::alert("🚨 Permanent block activated for IP: $ip");
            flash(translate('Your IP has been permanently blocked.'))->error();
            return back();
        }
        // 🔸 Check for temporary block threshold (e.g., exactly 2 attempts)
        elseif ($attempts == 4) {
            Log::warning("⚠️ Temporary block for repeated requests from IP: $ip");
            flash(translate('Too many requests. Please try again later.'))->warning();
            return back();
        }

        $errors = [];

        // Validate email format
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = translate('Invalid email address.');
        } elseif (User::where('email', $request->email)->exists()) {
            $errors[] = translate('Email already exists.');
        }

        if (addon_is_activated('otp_system')) {
            if (User::where('phone', $request->phone)
                    ->where('dial_code', $request->country_code)
                    ->exists()) {
                $errors[] = translate('Phone already exists.');
            }
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                flash($error);
            }
            return back();
        }


        $user = $this->create($request->all());

        $this->guard()->login($user);

        /*if($user->email != null){
            if(BusinessSetting::where('type', 'email_verification')->first()->value != 1){
                $user->email_verified_at = date('Y-m-d H:i:s');
                $user->save();
                flash(translate('Registration successful.'))->success();
            }
            else {
                try {
                    $user->sendEmailVerificationNotification();
                    flash(translate('Registration successful. Please verify your email.'))->success();
                } catch (\Throwable $th) {
                    $user->delete();
                    flash(translate('Registration failed. Please try again later.'))->error();
                }
            }
        }*/

        if (addon_is_activated('otp_system')) {
            flash(translate('Registration successful. Please verify your phone number.'))->success();
        } else {
            if ($user->email != null) {
                if (BusinessSetting::where('type', 'email_verification')->first()->value != 1) {
                    $user->email_verified_at = date('Y-m-d H:i:s');
                    $user->save();
                    flash(translate('Registration successful.'))->success();
                } else {
                    try {
                        $user->sendEmailVerificationNotification();
                        flash(translate('Registration successful. Please verify your email.'))->success();
                    } catch (\Throwable $th) {
                        $user->delete();
                        flash(translate('Registration failed. Please try again later.'))->error();
                    }
                }
            }
        }

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /* old code*/
    /*
    public function register(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if(User::where('email', $request->email)->first() != null){
                flash(translate('Email or Phone already exists.'));
                return back();
            }
        }
        elseif (User::where('phone', $request->phone)->where('dial_code', $request->country_code)->first() != null) {
            flash(translate('Phone already exists.'));
            return back();
        }

        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        $this->guard()->login($user);

        if($user->email != null){
            if(BusinessSetting::where('type', 'email_verification')->first()->value != 1){
                $user->email_verified_at = date('Y-m-d H:i:s');
                $user->save();
                flash(translate('Registration successful.'))->success();
            }
            else {
                try {
                    $user->sendEmailVerificationNotification();
                    flash(translate('Registration successful. Please verify your email.'))->success();
                } catch (\Throwable $th) {
                    $user->delete();
                    flash(translate('Registration failed. Please try again later.'))->error();
                }
            }
        }

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }*/

    protected function registered(Request $request, $user)
    {
        if (addon_is_activated('otp_system')) {
            return redirect()->route('verification');
        }
        if ($user->email == null) {
            return redirect()->route('verification');
        }elseif(session('link') != null){
            return redirect(session('link'));
        }else {
            return redirect()->route('home');
        }
    }
}
