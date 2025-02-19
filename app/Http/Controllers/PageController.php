<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\PageTranslation;
use Mail;
use App\Mail\EmailManager;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;


class PageController extends Controller
{
    public function __construct() {
        // Staff Permission Check
        $this->middleware(['permission:add_website_page'])->only('create');
        $this->middleware(['permission:edit_website_page'])->only('edit');
        $this->middleware(['permission:delete_website_page'])->only('destroy');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.website_settings.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page;
        $page->title = $request->title;
        if (Page::where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug)))->first() == null) {
            $page->slug             = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $page->type             = "custom_page";
            $page->content          = $request->content;
            $page->meta_title       = $request->meta_title;
            $page->meta_description = $request->meta_description;
            $page->keywords         = $request->keywords;
            $page->meta_image       = $request->meta_image;
            $page->save();

            $page_translation           = PageTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'page_id' => $page->id]);
            $page_translation->title    = $request->title;
            $page_translation->content  = $request->content;
            $page_translation->save();

            flash(translate('New page has been created successfully'))->success();
            return redirect()->route('website.pages');
        }

        flash(translate('Slug has been used already'))->warning();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit(Request $request, $id)
   {
        $lang = $request->lang;
        $page_name = $request->page;
        $page = Page::where('slug', $id)->first();
        if($page != null){
          if ($page_name == 'home') {
            return view('backend.website_settings.pages.home_page_edit', compact('page','lang'));
          }
          else{
            return view('backend.website_settings.pages.edit', compact('page','lang'));
          }
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        if (Page::where('id','!=', $id)->where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug)))->first() == null) {
            if($page->type == 'custom_page'){
              $page->slug           = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            }
            if($request->lang == env("DEFAULT_LANGUAGE")){
              $page->title          = $request->title;
              $page->content        = $request->content;
            }
            $page->meta_title       = $request->meta_title;
            $page->meta_description = $request->meta_description;
            $page->keywords         = $request->keywords;
            $page->meta_image       = $request->meta_image;
            $page->save();

            $page_translation           = PageTranslation::firstOrNew(['lang' => $request->lang, 'page_id' => $page->id]);
            $page_translation->title    = $request->title;
            $page_translation->content  = $request->content;
            $page_translation->save();

            flash(translate('Page has been updated successfully'))->success();
            return redirect()->route('website.pages');
        }

      flash(translate('Slug has been used already'))->warning();
      return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->page_translations()->delete();

        if(Page::destroy($id)){
            flash(translate('Page has been deleted successfully'))->success();
            return redirect()->back();
        }
        return back();
    }

    public function show_custom_page($slug){
        $page = Page::where('slug', $slug)->first();
        if($page != null){
            return view('frontend.custom_page', compact('page'));
        }
        abort(404);
    }
    public function mobile_custom_page($slug){
        $page = Page::where('slug', $slug)->first();
        if($page != null){
            return view('frontend.m_custom_page', compact('page'));
        }
        abort(404);
    }

    public function aboutpage(){
        return view('frontend.custom.about');
    }

    public function careerspage(){
        return view('frontend.custom.careers');
    }


     public function partnerspage(){
        return view('frontend.custom.partners');
    }


    public function servicespage(){
        return view('frontend.custom.services');
    }

    public function contactpage(){
        return view('frontend.custom.contact');
    }

/*
    public function sendEmail(Request $request){
        $fromAddress = env('MAIL_FROM_ADDRESS');
        $toAddress = $request->email;

        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $subject = $request->subject;
        $message = $request->message;

        $emailData = [
            'view' => 'emails.formdata',
            'from' => $toAddress,
            'to' => $fromAddress,
            'subject' => $subject, // Add this line
            'content' => [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'subject' => $subject, // Add this line
                'message' => $message,
            ],
        ];

        try {
            Mail::to($fromAddress)->send(new EmailManager($emailData));
        } catch (\Exception $e) {
            dd($e);
        }

        flash(translate('An email has been sent.'))->success();
        return back();
    }
*/

    public function sendEmail(Request $request)
    {
        $ip = $request->ip();
        $key = 'subscribe-form:' . $ip;
        $permanentBlockKey = 'blocked-ip:' . $ip;

        // 🚨 Check if IP is permanently blocked
        if (Cache::has($permanentBlockKey)) {
            Log::alert("🚨 Blocked IP tried accessing: $ip");
            flash('Your IP has been permanently blocked due to suspicious activity.')->error();
            return back();
        }

        // 🔹 Use Laravel Validator
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'nullable',
            'message' => 'nullable',
            'g-recaptcha-response' => 'required' // Ensure reCAPTCHA is checked
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'notification' => $validator->errors()->all()
            ], 200);
        }

        // 🔹 Check if validation fails
        // if ($validator->fails()) {
        //     return back()->withErrors($validator)->withInput();
        // }

        // 🔹 Verify reCAPTCHA with Google
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $secretKey = env('GOOGLE_RECAPTCHA_SECRET_KEY');

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secretKey,
            'response' => $recaptchaResponse,
            'remoteip' => $ip
        ]);

        $result = $response->json();

        if (!$result['success']) {
            // Increment failed attempt counter
            RateLimiter::hit($key, 120); // Set expiry to 120 seconds (2 minutes)
            $attempts = RateLimiter::attempts($key);

            // 🚨 Permanent block if exceeded max attempts
            if ($attempts >= 4) {
                Cache::put($permanentBlockKey, true, now()->addDays(30)); // Block permanently for 30 days
                Log::alert("🚨 Permanent block activated for IP: $ip");
                flash('Your IP has been permanently blocked.')->error();
                return back();
            }
            // ⏳ Temporary warning message
            elseif ($attempts == 3) {
                Log::warning("⚠️ Temporary block for repeated requests from IP: $ip");
                flash('Too many requests. Please try again later.')->warning();
                return back();
            }

            return back()->withErrors(['g-recaptcha-response' => 'reCAPTCHA verification failed.'])->withInput();
        }

        // ✅ reCAPTCHA passed, reset rate limiter
        RateLimiter::clear($key);

        // 🔹 Prepare email data
        $emailData = [
            'view' => 'emails.formdata',
            'from' => $request->email,
            'to' => env('MAIL_FROM_ADDRESS'),
            'subject' => $request->subject,
            'content' => [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
            ],
        ];

        // 🔹 Send email
        try {
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new EmailManager($emailData));
            flash('Your message has been sent successfully!')->success();
        } catch (\Exception $e) {
            flash('Failed to send email. Please try again later.')->error();
            return back()->withInput();
        }

        return back();
    }
    public function faqpage(){
        return view('frontend.custom.faq');
    }
}
