<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect(string $provider)
    {
        abort_unless(in_array($provider, ['google', 'github']), 404);
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        abort_unless(in_array($provider, ['google', 'github']), 404);

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->withErrors(['email' => 'OAuth authentication failed. Please try again.']);
        }

        // Find existing user by provider ID or email
        $user = User::where('provider', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        if (! $user) {
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                // Link provider to existing account
                $user->update([
                    'provider'       => $provider,
                    'provider_id'    => $socialUser->getId(),
                    'provider_token' => $socialUser->token,
                ]);
            } else {
                // Create new account
                $user = User::create([
                    'name'           => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User',
                    'email'          => $socialUser->getEmail(),
                    'provider'       => $provider,
                    'provider_id'    => $socialUser->getId(),
                    'provider_token' => $socialUser->token,
                    'password'       => null,
                    'role'           => 'user',
                    'tier'           => 'free',
                ]);
            }
        }

        Auth::login($user, remember: true);

        return redirect()->intended(route('dashboard'));
    }
}
