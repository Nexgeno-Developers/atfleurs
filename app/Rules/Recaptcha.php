<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check if Google reCAPTCHA is enabled in settings
        if (get_setting('google_recaptcha') != 1) {
            return true; // Skip validation if reCAPTCHA is disabled
        }

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('CAPTCHA_SECRET_KEY'), // Store secret key in .env
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        return $response->json()['success'] ?? false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'reCAPTCHA verification failed. Please try again.';
    }
}
