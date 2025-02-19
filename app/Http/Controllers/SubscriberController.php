<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Cache;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    public function __construct() {
        // Staff Permission Check
        $this->middleware(['permission:view_all_subscribers'])->only('index');
        $this->middleware(['permission:delete_subscriber'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $subscribers = Subscriber::orderBy('created_at', 'desc')->paginate(15);
        return view('backend.marketing.subscribers.index', compact('subscribers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    /*
    public function store(Request $request)
    {
        $subscriber = Subscriber::where('email', $request->email)->first();
        if($subscriber == null){
            $subscriber = new Subscriber;
            $subscriber->email = $request->email;
            $subscriber->save();
            flash(translate('You have subscribed successfully'))->success();
        }
        else{
            flash(translate('You are  already a subscriber'))->success();
        }
        return back();
    }*/

    public function store(Request $request)
    {
        $ip = $request->ip();
        $key = 'subscribe-form:' . $ip;
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

        // ✅ Process the subscription
        $subscriber = Subscriber::where('email', $request->email)->first();
        if ($subscriber === null) {
            $subscriber = new Subscriber;
            $subscriber->email = $request->email;
            $subscriber->save();
            flash(translate('You have subscribed successfully!'))->success();
        } else {
            flash(translate('You are already a subscriber.'))->info();
        }

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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subscriber::destroy($id);
        flash(translate('Subscriber has been deleted successfully'))->success();
        return redirect()->route('subscribers.index');
    }
}
