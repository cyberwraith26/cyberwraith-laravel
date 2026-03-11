<?php

namespace App\Http\Controllers;

use App\Services\PaystackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BillingController extends Controller
{
    public function __construct(protected PaystackService $paystack) {}

    /**
     * Billing dashboard
     */
    public function index()
    {
        $user        = Auth::user();
        $plans       = config('plans');
        $currentPlan = $plans[$user->tier] ?? $plans['free'];
        $transactions = [];

        // Fetch live transaction history if customer exists
        if ($user->paystack_customer_code) {
            $transactions = $this->paystack->getTransactions($user->paystack_customer_code);
        }

        return view('dashboard.billing', compact('user', 'plans', 'currentPlan', 'transactions'));
    }

    /**
     * Redirect user to Paystack checkout
     */
    public function checkout(Request $request)
    {
        $request->validate(['plan' => 'required|in:pro,agency']);

        $user     = Auth::user();
        $plan     = $request->plan;
        $planCode = $plan === 'pro'
            ? config('paystack.proPlanCode')
            : config('paystack.agencyPlanCode');

        $callbackUrl = route('billing.callback', ['plan' => $plan]);

        $data = $this->paystack->initializeSubscription(
            $user->email,
            $planCode,
            $callbackUrl
        );

        if (!$data) {
            return back()->with('error', 'Could not initialize payment. Please try again.');
        }

        // Store reference in session for verification
        session(['paystack_reference' => $data['reference'], 'paystack_plan' => $plan]);

        return redirect($data['authorization_url']);
    }

    /**
     * Handle Paystack callback after payment
     */
    public function callback(Request $request)
    {
        $reference = $request->query('reference') ?? session('paystack_reference');

        if (!$reference) {
            return redirect()->route('billing.index')->with('error', 'Payment reference not found.');
        }

        $transaction = $this->paystack->verifyTransaction($reference);

        if (!$transaction || $transaction['status'] !== 'success') {
            return redirect()->route('billing.index')->with('error', 'Payment verification failed. Please contact support.');
        }

        $user = Auth::user();
        $plan = session('paystack_plan', $request->query('plan', 'pro'));

        // Extract subscription data from transaction
        $subscription = $transaction['subscription'] ?? null;
        $customer     = $transaction['customer'] ?? null;

        $user->update([
            'tier'                       => $plan,
            'paystack_customer_code'     => $customer['customer_code'] ?? $user->paystack_customer_code,
            'paystack_subscription_code' => $subscription['subscription_code'] ?? null,
            'paystack_email_token'       => $subscription['email_token'] ?? null,
            'subscription_status'        => 'active',
            'subscription_plan'          => $plan,
            'current_period_end'         => isset($subscription['next_payment_date'])
                ? \Carbon\Carbon::parse($subscription['next_payment_date'])
                : now()->addMonth(),
        ]);

        // Keep existing tool selections on upgrade — new slots open automatically
        // because allowedCount is derived from the new tier in real time.

        session()->forget(['paystack_reference', 'paystack_plan']);

        return redirect()->route('billing.index')
            ->with('success', 'Payment successful! You are now on the ' . ucfirst($plan) . ' plan.');
    }

    /**
     * Cancel subscription
     */
    public function cancel(Request $request)
    {
        $user = Auth::user();

        if (!$user->paystack_subscription_code || !$user->paystack_email_token) {
            return back()->with('error', 'No active subscription found.');
        }

        $cancelled = $this->paystack->cancelSubscription(
            $user->paystack_subscription_code,
            $user->paystack_email_token
        );

        if ($cancelled) {
            $user->update([
                'subscription_status' => 'non-renewing',
            ]);

            return back()->with('success', 'Subscription cancelled. You will retain access until ' . $user->current_period_end?->format('M d, Y') . '.');
        }

        return back()->with('error', 'Could not cancel subscription. Please contact support.');
    }
}
