<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckGmailRedirect
{
    public function handle($request, Closure $next)
    {
        // Log the request referer and session status
        // Log::info('Session active: ', ['session' => $request->session()->all()]);
        // Log::info('Request Query: ', ['query' => $request->query()]);

        // Check if the 'source' query parameter is set to 'gmail'
        if ($request->query('source') === 'gmail') {
            Log::info('User is coming from Gmail.');

            // If user is authenticated, redirect to cart
            if (Auth::check()) {
                Log::info('User authenticated, redirecting to cart.');
                return redirect()->route('cart');
            }

            // If user is not authenticated, store the intended cart route in session
            $request->session()->put('redirect_to', route('cart')); // Store the cart route

            Log::info('User not authenticated, redirecting to login.');
            // Redirect to login page
            return redirect()->route('login');
        }

        return $next($request);
    }
}
