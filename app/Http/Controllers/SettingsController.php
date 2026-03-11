<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    public function index()
    {
        return view('dashboard.settings');
    }

    public function update(Request $request)
    {
        $section = $request->input('section');
        $user    = Auth::user();

        if ($section === 'profile') {
            $request->validate([
                'name'   => ['required', 'string', 'max:255'],
                'email'  => ['required', 'email', 'unique:users,email,' . $user->id],
                'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            ]);
            $data = $request->only('name', 'email');
            if ($request->hasFile('avatar')) {
                if ($user->avatar) Storage::disk('public')->delete($user->avatar);
                $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
            }
            $user->update($data);
            return back()->with('success', 'Profile updated successfully.');
        }

        if ($section === 'password') {
            if (!empty($user->provider)) {
                return back()->with('error', 'Password is managed by ' . ucfirst($user->provider) . '.');
            }
            $request->validate([
                'current_password' => ['required'],
                'password'         => ['required', Password::min(8)->mixedCase()->numbers(), 'confirmed'],
            ]);
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
            $user->update(['password' => Hash::make($request->password)]);
            return back()->with('success', 'Password updated successfully.');
        }

        return back();
    }

    public function destroy()
    {
        $user = Auth::user();
        if ($user->paystack_subscription_code && $user->paystack_email_token) {
            try {
                app(\App\Services\PaystackService::class)->cancelSubscription(
                    $user->paystack_subscription_code,
                    $user->paystack_email_token
                );
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Paystack cancel failed: ' . $e->getMessage());
            }
        }
        if ($user->avatar) Storage::disk('public')->delete($user->avatar);
        Auth::logout();
        $user->delete();
        return redirect('/')->with('success', 'Your account has been permanently deleted.');
    }
}
