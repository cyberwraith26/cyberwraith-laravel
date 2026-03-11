<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorController extends Controller
{
    // ── TOTP Setup ────────────────────────────────────────────

    public function totpSetup()
    {
        $user      = Auth::user();
        $google2fa = new Google2FA();
        $secret    = $google2fa->generateSecretKey();

        $user->update([
            'two_factor_secret'    => encrypt($secret),
            'two_factor_method'    => 'totp',
            'two_factor_confirmed' => false,
        ]);

        $qrUrl = $google2fa->getQRCodeUrl(config('app.name'), $user->email, $secret);

        return response()->json(['secret' => $secret, 'qr_url' => $qrUrl]);
    }

    public function totpConfirm(Request $request)
    {
        $request->validate(['code' => 'required|digits:6']);

        $user      = Auth::user();
        $google2fa = new Google2FA();

        try {
            $secret = decrypt($user->two_factor_secret);
        } catch (\Exception $e) {
            return back()->with('2fa_error', 'Setup expired. Please try again.');
        }

        if (!$google2fa->verifyKey($secret, $request->code)) {
            return back()->with('2fa_error', 'Invalid code. Please try again.');
        }

        $user->update(['two_factor_confirmed' => true]);
        return back()->with('2fa_success', 'Authenticator App 2FA is now enabled.');
    }

    // ── Email OTP Setup ───────────────────────────────────────

    public function emailSetup()
    {
        $user = Auth::user();
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'two_factor_method'     => 'email',
            'two_factor_code'       => Hash::make($code),
            'two_factor_expires_at' => now()->addMinutes(10),
            'two_factor_confirmed'  => false,
        ]);

        Mail::raw(
            "Your CyberWraith verification code is: {$code}\n\nThis code expires in 10 minutes.",
            fn($m) => $m->to($user->email)->subject('CyberWraith 2FA Verification Code')
        );

        return back()->with('2fa_success', 'A 6-digit code was sent to ' . $user->email . '. Enter it below to activate.');
    }

    public function emailConfirm(Request $request)
    {
        $request->validate(['code' => 'required|digits:6']);

        $user = Auth::user();

        if (!$user->two_factor_code || now()->isAfter($user->two_factor_expires_at)) {
            return back()->with('2fa_error', 'Code expired. Please request a new one.');
        }

        if (!Hash::check($request->code, $user->two_factor_code)) {
            return back()->with('2fa_error', 'Invalid code. Please try again.');
        }

        $user->update([
            'two_factor_confirmed'  => true,
            'two_factor_code'       => null,
            'two_factor_expires_at' => null,
        ]);

        return back()->with('2fa_success', 'Email OTP 2FA is now enabled.');
    }

    // ── SMS OTP Setup ─────────────────────────────────────────

    public function smsSetup(Request $request)
    {
        $request->validate(['phone' => 'required|string|min:10|max:20']);

        $user = Auth::user();
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'two_factor_method'     => 'sms',
            'two_factor_phone'      => $request->phone,
            'two_factor_code'       => Hash::make($code),
            'two_factor_expires_at' => now()->addMinutes(10),
            'two_factor_confirmed'  => false,
        ]);

        $this->sendSms($request->phone, "Your CyberWraith code: {$code}. Expires in 10 minutes.");

        return back()->with('2fa_success', 'A 6-digit code was sent to ' . $request->phone . '. Enter it below to activate.');
    }

    public function smsConfirm(Request $request)
    {
        $request->validate(['code' => 'required|digits:6']);

        $user = Auth::user();

        if (!$user->two_factor_code || now()->isAfter($user->two_factor_expires_at)) {
            return back()->with('2fa_error', 'Code expired. Please request a new one.');
        }

        if (!Hash::check($request->code, $user->two_factor_code)) {
            return back()->with('2fa_error', 'Invalid code. Please try again.');
        }

        $user->update([
            'two_factor_confirmed'  => true,
            'two_factor_code'       => null,
            'two_factor_expires_at' => null,
        ]);

        return back()->with('2fa_success', 'SMS OTP 2FA is now enabled.');
    }

    // ── Disable 2FA ───────────────────────────────────────────

    public function disable(Request $request)
    {
        $request->validate(['password' => 'required']);

        $user = Auth::user();

        if (!empty($user->provider)) {
            return back()->with('2fa_error', 'OAuth accounts cannot use password verification.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('2fa_error', 'Incorrect password. 2FA was not disabled.');
        }

        $user->update([
            'two_factor_method'     => null,
            'two_factor_secret'     => null,
            'two_factor_confirmed'  => false,
            'two_factor_phone'      => null,
            'two_factor_code'       => null,
            'two_factor_expires_at' => null,
        ]);

        return back()->with('2fa_success', 'Two-factor authentication has been disabled.');
    }

    // ── Login Challenge ───────────────────────────────────────

    public function challenge()
    {
        if (!session('2fa_user_id')) return redirect()->route('login');
        return view('auth.two-factor-challenge');
    }

    public function verify(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $userId = session('2fa_user_id');
        if (!$userId) return redirect()->route('login');

        $user = \App\Models\User::find($userId);
        if (!$user) return redirect()->route('login');

        $verified = false;

        if ($user->two_factor_method === 'totp') {
            $google2fa = new Google2FA();
            try {
                $verified = $google2fa->verifyKey(decrypt($user->two_factor_secret), $request->code);
            } catch (\Exception $e) {
                $verified = false;
            }
        } elseif (in_array($user->two_factor_method, ['email', 'sms'])) {
            if ($user->two_factor_code && now()->isBefore($user->two_factor_expires_at)) {
                $verified = Hash::check($request->code, $user->two_factor_code);
            }
        }

        if (!$verified) {
            return back()->withErrors(['code' => 'Invalid or expired code.']);
        }

        if (in_array($user->two_factor_method, ['email', 'sms'])) {
            $user->update(['two_factor_code' => null, 'two_factor_expires_at' => null]);
        }

        Auth::login($user);
        session()->forget('2fa_user_id');
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    public function resend()
    {
        $userId = session('2fa_user_id');
        if (!$userId) return redirect()->route('login');

        $user = \App\Models\User::find($userId);
        if (!$user || !in_array($user->two_factor_method, ['email', 'sms'])) {
            return redirect()->route('login');
        }

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->update([
            'two_factor_code'       => Hash::make($code),
            'two_factor_expires_at' => now()->addMinutes(10),
        ]);

        if ($user->two_factor_method === 'email') {
            Mail::raw(
                "Your new CyberWraith verification code is: {$code}\n\nThis code expires in 10 minutes.",
                fn($m) => $m->to($user->email)->subject('CyberWraith 2FA Verification Code')
            );
        } else {
            $this->sendSms($user->two_factor_phone, "Your new CyberWraith code: {$code}. Expires in 10 minutes.");
        }

        return back()->with('resent', 'A new code has been sent.');
    }

    // ── Twilio helper ─────────────────────────────────────────

    private function sendSms(string $to, string $message): void
    {
        try {
            $twilio = new \Twilio\Rest\Client(
                config('services.twilio.sid'),
                config('services.twilio.token')
            );
            $twilio->messages->create($to, [
                'from' => config('services.twilio.from'),
                'body' => $message,
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Twilio SMS failed: ' . $e->getMessage());
        }
    }
}
