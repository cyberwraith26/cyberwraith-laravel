<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PaystackWebhookController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ChangelogController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\LegalController;

Route::get('/privacy', [LegalController::class, 'privacy'])->name('privacy');
Route::get('/terms',   [LegalController::class, 'terms'])->name('terms');
Route::get('/cookies', [LegalController::class, 'cookies'])->name('cookies');

Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/services/{slug}', [ServicesController::class, 'show'])->name('services.show');

// ── Paystack Webhook (outside auth, CSRF exempt) ────────────
Route::post('/webhook/paystack', [PaystackWebhookController::class, 'handle'])
    ->name('webhook.paystack');

// ── Public / Landing routes ──────────────────────────────────
Route::get('/', [LandingController::class, 'home'])->name('home');
Route::get('/pricing', [LandingController::class, 'pricing'])->name('pricing');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

Route::get('/changelog', [ChangelogController::class, 'index'])->name('changelog');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// ── OAuth routes ─────────────────────────────────────────────
Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])
    ->name('auth.social.redirect');
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])
    ->name('auth.social.callback');

// ── 2FA Challenge (session-guarded, no auth required yet) ───────
Route::get('/2fa/challenge', [TwoFactorController::class, 'challenge'])->name('2fa.challenge');
Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify');
Route::post('/2fa/resend', [TwoFactorController::class, 'resend'])->name('2fa.resend');

// ── Guest-only routes ─────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/signup', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/signup', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class, 'forgotForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'resetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ── Authenticated routes ──────────────────────────────────────
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tools — select MUST come before {slug}
    Route::get('/tools', [ToolController::class, 'index'])->name('tools.index');
    Route::get('/tools/select', [ToolController::class, 'select'])->name('tools.select');
    Route::post('/tools/select', [ToolController::class, 'saveSelection'])->name('tools.saveSelection');
    Route::get('/tools/{slug}', [ToolController::class, 'show'])->name('tools.show');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::delete('/settings', [SettingsController::class, 'destroy'])->name('settings.destroy');

    // Billing
    Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');
    Route::post('/billing/checkout', [BillingController::class, 'checkout'])->name('billing.checkout');
    Route::get('/billing/callback', [BillingController::class, 'callback'])->name('billing.callback');
    Route::post('/billing/cancel', [BillingController::class, 'cancel'])->name('billing.cancel');

    // 2FA Settings
    Route::post('/settings/2fa/totp/setup',    [TwoFactorController::class, 'totpSetup'])->name('2fa.totp.setup');
    Route::post('/settings/2fa/totp/confirm',  [TwoFactorController::class, 'totpConfirm'])->name('2fa.totp.confirm');
    Route::post('/settings/2fa/email/setup',   [TwoFactorController::class, 'emailSetup'])->name('2fa.email.setup');
    Route::post('/settings/2fa/email/confirm', [TwoFactorController::class, 'emailConfirm'])->name('2fa.email.confirm');
    Route::post('/settings/2fa/sms/setup',     [TwoFactorController::class, 'smsSetup'])->name('2fa.sms.setup');
    Route::post('/settings/2fa/sms/confirm',   [TwoFactorController::class, 'smsConfirm'])->name('2fa.sms.confirm');
    Route::post('/settings/2fa/disable',       [TwoFactorController::class, 'disable'])->name('2fa.disable');
});
