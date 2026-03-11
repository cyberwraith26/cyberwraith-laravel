<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaystackService
{
    protected string $secretKey;
    protected string $baseUrl = 'https://api.paystack.co';

    public function __construct()
    {
        $this->secretKey = config('paystack.secretKey');
    }

    protected function headers(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->secretKey,
            'Content-Type'  => 'application/json',
        ];
    }

    /**
     * Initialize a subscription transaction
     */
    public function initializeSubscription(string $email, string $planCode, string $callbackUrl): array|null
    {
        $response = Http::withHeaders($this->headers())
            ->post("{$this->baseUrl}/transaction/initialize", [
                'email'        => $email,
                'plan'         => $planCode,
                'callback_url' => $callbackUrl,
                'amount'       => 0, // amount is ignored when plan is set
            ]);

        if ($response->successful() && $response->json('status')) {
            return $response->json('data');
        }

        Log::error('Paystack initialize failed', $response->json());
        return null;
    }

    /**
     * Verify a transaction by reference
     */
    public function verifyTransaction(string $reference): array|null
    {
        $response = Http::withHeaders($this->headers())
            ->get("{$this->baseUrl}/transaction/verify/{$reference}");

        if ($response->successful() && $response->json('status')) {
            return $response->json('data');
        }

        Log::error('Paystack verify failed', $response->json());
        return null;
    }

    /**
     * Get subscription details
     */
    public function getSubscription(string $subscriptionCode): array|null
    {
        $response = Http::withHeaders($this->headers())
            ->get("{$this->baseUrl}/subscription/{$subscriptionCode}");

        if ($response->successful() && $response->json('status')) {
            return $response->json('data');
        }

        return null;
    }

    /**
     * Cancel a subscription
     */
    public function cancelSubscription(string $subscriptionCode, string $emailToken): bool
    {
        $response = Http::withHeaders($this->headers())
            ->post("{$this->baseUrl}/subscription/disable", [
                'code'  => $subscriptionCode,
                'token' => $emailToken,
            ]);

        return $response->successful() && $response->json('status');
    }

    /**
     * Get customer subscriptions
     */
    public function getCustomerSubscriptions(string $customerCode): array
    {
        $response = Http::withHeaders($this->headers())
            ->get("{$this->baseUrl}/subscription", [
                'customer' => $customerCode,
            ]);

        if ($response->successful() && $response->json('status')) {
            return $response->json('data') ?? [];
        }

        return [];
    }

    /**
     * Get transaction history for a customer
     */
    public function getTransactions(string $customerCode): array
    {
        $response = Http::withHeaders($this->headers())
            ->get("{$this->baseUrl}/transaction", [
                'customer' => $customerCode,
                'status'   => 'success',
                'perPage'  => 10,
            ]);

        if ($response->successful() && $response->json('status')) {
            return $response->json('data') ?? [];
        }

        return [];
    }

    /**
     * Verify webhook signature
     */
    public function verifyWebhook(string $payload, string $signature): bool
    {
        $computed = hash_hmac('sha512', $payload, $this->secretKey);
        return hash_equals($computed, $signature);
    }

    /**
     * Map plan code to tier name
     */
    public function planCodeToTier(string $planCode): string
    {
        return match($planCode) {
            config('paystack.proPlanCode')    => 'pro',
            config('paystack.agencyPlanCode') => 'agency',
            default                            => 'free',
        };
    }
}
