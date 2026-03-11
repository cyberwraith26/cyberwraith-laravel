<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PaystackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaystackWebhookController extends Controller
{
    public function __construct(protected PaystackService $paystack) {}

    public function handle(Request $request)
    {
        $payload   = $request->getContent();
        $signature = $request->header('x-paystack-signature');

        // Verify webhook authenticity
        if (!$this->paystack->verifyWebhook($payload, $signature)) {
            Log::warning('Paystack webhook signature mismatch');
            return response('Unauthorized', 401);
        }

        $event = $request->json('event');
        $data  = $request->json('data');

        Log::info('Paystack webhook received', ['event' => $event]);

        match($event) {
            'subscription.create'       => $this->handleSubscriptionCreate($data),
            'subscription.disable'      => $this->handleSubscriptionDisable($data),
            'subscription.not_renew'    => $this->handleSubscriptionNotRenew($data),
            'charge.success'            => $this->handleChargeSuccess($data),
            'invoice.payment_failed'    => $this->handlePaymentFailed($data),
            default                     => null,
        };

        return response('OK', 200);
    }

    /**
     * New subscription created
     */
    protected function handleSubscriptionCreate(array $data): void
    {
        $email = $data['customer']['email'] ?? null;
        if (!$email) return;

        $user = User::where('email', $email)->first();
        if (!$user) return;

        $planCode = $data['plan']['plan_code'] ?? null;
        $tier     = $this->paystack->planCodeToTier($planCode);

        $user->update([
            'tier'                       => $tier,
            'paystack_customer_code'     => $data['customer']['customer_code'] ?? $user->paystack_customer_code,
            'paystack_subscription_code' => $data['subscription_code'] ?? null,
            'paystack_email_token'       => $data['email_token'] ?? null,
            'subscription_status'        => 'active',
            'subscription_plan'          => $tier,
            'current_period_end'         => isset($data['next_payment_date'])
                ? \Carbon\Carbon::parse($data['next_payment_date'])
                : now()->addMonth(),
        ]);

        Log::info("Subscription created for {$email} on {$tier} plan");
    }

    /**
     * Subscription cancelled/disabled
     */
    protected function handleSubscriptionDisable(array $data): void
    {
        $subscriptionCode = $data['subscription_code'] ?? null;
        if (!$subscriptionCode) return;

        $user = User::where('paystack_subscription_code', $subscriptionCode)->first();
        if (!$user) return;

        $user->update([
            'subscription_status' => 'cancelled',
            'subscription_ends_at' => $user->current_period_end ?? now(),
        ]);

        Log::info("Subscription disabled for {$user->email}");
    }

    /**
     * Subscription set to not renew
     */
    protected function handleSubscriptionNotRenew(array $data): void
    {
        $subscriptionCode = $data['subscription_code'] ?? null;
        if (!$subscriptionCode) return;

        $user = User::where('paystack_subscription_code', $subscriptionCode)->first();
        if (!$user) return;

        $user->update([
            'subscription_status' => 'non-renewing',
        ]);

        Log::info("Subscription set to non-renewing for {$user->email}");
    }

    /**
     * Successful charge (renewal)
     */
    protected function handleChargeSuccess(array $data): void
    {
        $email = $data['customer']['email'] ?? null;
        if (!$email) return;

        $user = User::where('email', $email)->first();
        if (!$user || !$user->paystack_subscription_code) return;

        // Extend subscription period
        $user->update([
            'subscription_status' => 'active',
            'current_period_end'  => now()->addMonth(),
        ]);

        Log::info("Charge success / renewal for {$email}");
    }

    /**
     * Payment failed
     */
    protected function handlePaymentFailed(array $data): void
    {
        $subscriptionCode = $data['subscription']['subscription_code'] ?? null;
        if (!$subscriptionCode) return;

        $user = User::where('paystack_subscription_code', $subscriptionCode)->first();
        if (!$user) return;

        $user->update([
            'subscription_status' => 'past_due',
        ]);

        Log::warning("Payment failed for {$user->email}");
    }
}
