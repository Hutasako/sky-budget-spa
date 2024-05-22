<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
class AzureAuthController extends Controller
{
    public function redirectToProvider()
    {
        Log::channel('stdout')->info('Redirecting to Azure.');
        return Socialite::driver('azure')->redirect();
    }

    public function handleProviderCallback()
    {
        Log::channel('stdout')->info('Callback accessed.');
        try {
            Log::channel('stdout')->info('Trying.');
            $azure_user = Socialite::driver('azure')->user();

            // Authenticate the user and store the necessary information
            $user = User::UpdateOrCreate(
                [
                    'azure_id' =>  $azure_user->getId(),
                ],
                [

                    'name' =>  $azure_user->getName(),
                    'email' =>  $azure_user->getEmail(),
                ]
            );

            // event(new Registered($user));

            Auth::login($user);
            Log::channel('stdout')->info($azure_user->getName());
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            Log::channel('stdout')->info($e);
            return redirect()->route('welcome')->withErrors(['error' => 'An error occurred while authenticating with Azure.']);
        }
    }
}
