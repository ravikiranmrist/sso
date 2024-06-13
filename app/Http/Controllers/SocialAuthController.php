<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            \Log::error('Socialite error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Error authenticating with ' . ucfirst($provider));
        }

        \Log::info('Social User: ', ['id' => $socialUser->getId(), 'email' => $socialUser->getEmail()]);

        // Check if the user already exists in your database
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            // Create a new user if not exists
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(uniqid()), // You may not need to set a password if using social login
            ]);
            \Log::info('User created: ', ['id' => $user->id, 'email' => $user->email]);
        } else {
            \Log::info('User exists: ', ['id' => $user->id, 'email' => $user->email]);
        }

        // Log the user into the application
        Auth::login($user, true);

        return redirect()->route('dashboard');
    }

}

