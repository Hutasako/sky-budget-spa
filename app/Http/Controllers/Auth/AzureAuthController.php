<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AzureAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('azure')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('azure')->user();

            // Authenticate the user and store the necessary information
            // ...

            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'An error occurred while authenticating with Azure.']);
        }
    }
}
