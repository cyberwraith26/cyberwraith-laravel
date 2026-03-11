<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;
use App\Mail\WelcomeMail;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::validate($credentials)) {
            return back()->withErrors([
                'email' => 'Invalid email or password.',
            ])->onlyInput('email');
        }

        $user = User::where('email', $credentials['email'])->first();

        // If 2FA is active, redirect to challenge page
        if ($user->hasTwoFactorEnabled()) {
            return $this->handleTwoFactorAuth($user);
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    private function handleTwoFactorAuth($user)
    {
        if (in_array($user->two_factor_method, ['email', 'sms'])) {
            $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $user->update([
                'two_factor_code'       => Hash::make($code),
                'two_factor_expires_at' => now()->addMinutes(10),
            ]);

            if ($user->two_factor_method === 'email') {
                $this->send2FAEmailCode($user, $code);
            } elseif ($user->two_factor_method === 'sms') {
                $this->send2FASmsCode($user, $code);
            }
        }

        session(['2fa_user_id' => $user->id]);
        return redirect()->route('2fa.challenge');
    }

    private function send2FAEmailCode($user, $code)
    {
        try {
            Mail::raw(
                "Your CyberWraith verification code is: {$code}\n\nThis code expires in 10 minutes.",
                fn($m) => $m->to($user->email)->subject('CyberWraith 2FA Verification Code')
            );
        } catch (\Exception $e) {
            Log::error('2FA email failed: ' . $e->getMessage());
        }
    }

    private function send2FASmsCode($user, $code)
    {
        try {
            $twilio = new \Twilio\Rest\Client(
                config('services.twilio.sid'),
                config('services.twilio.token')
            );
            $twilio->messages->create($user->two_factor_phone, [
                'from' => config('services.twilio.from'),
                'body' => "Your CyberWraith code: {$code}. Expires in 10 minutes.",
            ]);
        } catch (\Exception $e) {
            Log::error('2FA SMS failed: ' . $e->getMessage());
        }
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => ['required', 'confirmed', PasswordRule::min(8)->mixedCase()->numbers()],
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'user',
            'tier'     => 'free',
        ]);

        try {
            Mail::to($user->email)->send(new WelcomeMail($user));
        } catch (\Exception $e) {
            Log::error('Welcome email failed: ' . $e->getMessage());
        }

        Subscription::create([
            'user_id' => $user->id,
            'tier'    => 'free',
            'status'  => 'active',
        ]);

        Auth::login($user);
        return redirect('/dashboard');
    }

    public function forgotForm()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        try {
            Password::sendResetLink($request->only('email'));
        } catch (\Exception $e) {
            Log::error('Password reset email failed: ' . $e->getMessage());
            // Still show success message — don't reveal if email exists or mail failed
        }

        return back()->with('status', 'If that email exists, a reset link has been sent.');
    }

    public function resetForm(Request $request)
    {
        return view('auth.reset-password', [
            'token' => $request->route('token'),
            'email' => $request->email,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => ['required', 'confirmed', PasswordRule::min(8)->mixedCase()->numbers()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password'       => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Password reset successfully. Please log in.');
        }

        return back()->withErrors(['email' => __($status)]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
