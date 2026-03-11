@extends('layouts.app')

@section('title', 'Billing')

@section('breadcrumb')
    <span>CyberWraith</span>
    <span style="color:rgba(255,255,255,0.1);">/</span>
    <span class="current">Billing</span>
@endsection

@section('content')

@php
    $user         = auth()->user();
    $isActive     = $user->subscription_status === 'active';
    $isCancelling = $user->subscription_status === 'non-renewing';
    $isPastDue    = $user->subscription_status === 'past_due';
    $isPaid       = in_array($user->tier, ['pro', 'agency']);
@endphp

<div style="margin-bottom:2rem;">
    <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.2em;text-transform:uppercase;margin-bottom:0.4rem;">// BILLING.getPlans()</div>
    <h1 style="font-size:1.5rem;font-weight:800;color:#fff;">Billing & Plans</h1>
    <p style="font-size:0.82rem;color:rgba(255,255,255,0.3);margin-top:0.25rem;">Manage your subscription and payment details.</p>
</div>

{{-- Current Plan Banner --}}
<div style="background:#0a1520;border:1px solid {{ $isPastDue ? 'rgba(239,68,68,0.2)' : ($isActive && $isPaid ? 'rgba(0,255,136,0.2)' : 'rgba(255,255,255,0.06)') }};padding:1.5rem 2rem;margin-bottom:2.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:0;left:0;right:0;height:2px;background:{{ $isPastDue ? '#ef4444' : 'linear-gradient(90deg,#00ff88,#00d4ff)' }};opacity:0.5;"></div>
    <div>
        <div class="font-mono" style="font-size:0.58rem;color:rgba(0,255,136,0.5);letter-spacing:0.2em;text-transform:uppercase;margin-bottom:0.35rem;">// CURRENT PLAN</div>
        <div style="display:flex;align-items:baseline;gap:0.75rem;margin-bottom:0.4rem;flex-wrap:wrap;">
            <span style="font-size:1.5rem;font-weight:900;color:#fff;">{{ ucfirst($user->tier) }}</span>
            @if($isPastDue)
                <span class="font-mono" style="font-size:0.6rem;color:#ef4444;padding:0.15rem 0.6rem;border:1px solid rgba(239,68,68,0.3);letter-spacing:0.1em;">&#9888; PAST DUE</span>
            @elseif($isCancelling)
                <span class="font-mono" style="font-size:0.6rem;color:#f59e0b;padding:0.15rem 0.6rem;border:1px solid rgba(245,158,11,0.3);letter-spacing:0.1em;">&#9676; CANCELLING</span>
            @elseif($isActive && $isPaid)
                <span class="font-mono" style="font-size:0.6rem;color:#00ff88;padding:0.15rem 0.6rem;border:1px solid rgba(0,255,136,0.2);letter-spacing:0.1em;">&#9679; ACTIVE</span>
            @else
                <span class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.3);padding:0.15rem 0.6rem;border:1px solid rgba(255,255,255,0.08);letter-spacing:0.1em;">&#9676; FREE</span>
            @endif
        </div>
        <p style="font-size:0.78rem;color:rgba(255,255,255,0.3);">
            @if($user->tier === 'free')
                Free plan · {{ config('plans.free.tools') }} tools · No payment required
            @elseif($user->tier === 'pro')
                Pro plan · GHS {{ config('plans.pro.price') }}/month · {{ config('plans.pro.tools') }} tools
                @if($user->current_period_end)
                    · {{ $isCancelling ? 'Access until' : 'Renews' }} {{ $user->current_period_end->format('M d, Y') }}
                @endif
            @else
                Agency plan · GHS {{ config('plans.agency.price') }}/month · All {{ config('plans.agency.tools') }} tools
                @if($user->current_period_end)
                    · {{ $isCancelling ? 'Access until' : 'Renews' }} {{ $user->current_period_end->format('M d, Y') }}
                @endif
            @endif
        </p>
    </div>
    <div style="display:flex;align-items:center;gap:0.75rem;flex-wrap:wrap;">
        @if($isPaid && $isActive && !$isCancelling)
            <form method="POST" action="{{ route('billing.cancel') }}" onsubmit="return confirm('Are you sure? You will retain access until your billing period ends.')">
                @csrf
                <button type="submit" style="font-family:'JetBrains Mono',monospace;font-size:0.65rem;letter-spacing:0.1em;text-transform:uppercase;color:rgba(239,68,68,0.6);background:transparent;border:1px solid rgba(239,68,68,0.15);padding:0.55rem 1.1rem;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.color='#ef4444';this.style.borderColor='rgba(239,68,68,0.4)'" onmouseout="this.style.color='rgba(239,68,68,0.6)';this.style.borderColor='rgba(239,68,68,0.15)'">
                    Cancel Subscription
                </button>
            </form>
        @endif
        @if($user->tier !== 'agency')
            <a href="#plans" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#00ff88;padding:0.65rem 1.5rem;text-decoration:none;display:inline-flex;align-items:center;gap:0.5rem;transition:background 0.2s;" onmouseover="this.style.background='#00ffaa'" onmouseout="this.style.background='#00ff88'">
                {{ $isPaid ? 'Upgrade Plan' : 'Upgrade Now' }} &#8594;
            </a>
        @endif
    </div>
</div>

{{-- Plans Grid --}}
<div id="plans" style="margin-bottom:2.5rem;">
    <h2 style="font-size:0.78rem;font-weight:700;color:rgba(255,255,255,0.3);margin-bottom:1.25rem;font-family:'JetBrains Mono',monospace;letter-spacing:0.15em;text-transform:uppercase;">// AVAILABLE PLANS</h2>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem;">
        @foreach(config('plans') as $key => $plan)
        @php
            $isCurrent = $user->tier === $key;
            $isPopular = $key === 'pro';
            $isUpgrade = !$isCurrent && (
                ($user->tier === 'free') ||
                ($user->tier === 'pro' && $key === 'agency')
            );
        @endphp
        <div style="background:#0a1520;border:1px solid {{ $isCurrent ? 'rgba(0,255,136,0.35)' : ($isPopular ? 'rgba(0,255,136,0.1)' : 'rgba(255,255,255,0.05)') }};padding:2rem;position:relative;">
            <div style="position:absolute;top:0;left:0;right:0;height:2px;background:{{ $isCurrent ? '#00ff88' : ($isPopular ? '#00ff88' : 'rgba(255,255,255,0.06)') }};opacity:{{ $isCurrent ? '0.6' : '0.2' }};"></div>

            @if($isCurrent)
                <div class="font-mono" style="position:absolute;top:0;left:50%;transform:translate(-50%,-50%);background:rgba(0,20,12,1);border:1px solid rgba(0,255,136,0.3);color:#00ff88;font-size:0.5rem;font-weight:700;padding:0.2rem 0.875rem;letter-spacing:0.2em;white-space:nowrap;">CURRENT PLAN</div>
            @elseif($isPopular)
                <div class="font-mono" style="position:absolute;top:0;left:50%;transform:translate(-50%,-50%);background:#00ff88;color:#000;font-size:0.5rem;font-weight:700;padding:0.2rem 0.875rem;letter-spacing:0.2em;white-space:nowrap;">MOST POPULAR</div>
            @endif

            <div class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.2);letter-spacing:0.25em;text-transform:uppercase;margin-bottom:0.75rem;">{{ $plan['name'] }}</div>
            <div style="display:flex;align-items:baseline;gap:0.3rem;margin-bottom:0.4rem;">
                <span style="font-size:2.5rem;font-weight:900;color:#fff;line-height:1;">GHS {{ $plan['price'] }}</span>
                <span style="color:rgba(255,255,255,0.2);font-size:0.75rem;">/month</span>
            </div>
            <p style="font-size:0.75rem;color:rgba(255,255,255,0.25);margin-bottom:1rem;padding-bottom:1rem;border-bottom:1px solid rgba(255,255,255,0.05);">{{ $plan['description'] }}</p>

            <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:1rem;padding:0.45rem 0.75rem;background:rgba(0,255,136,0.04);border:1px solid rgba(0,255,136,0.08);">
                <span>&#9881;</span>
                <span class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.55);">
                    Access to <strong style="color:#00ff88;">{{ $plan['tools'] }}</strong> tool{{ $plan['tools'] > 1 ? 's' : '' }}
                </span>
            </div>

            <ul style="list-style:none;display:flex;flex-direction:column;gap:0.5rem;margin-bottom:1.75rem;">
                @foreach($plan['features'] as $feature)
                    <li class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.32);display:flex;align-items:flex-start;gap:0.4rem;line-height:1.4;">
                        <span style="color:#00ff88;flex-shrink:0;">&#10003;</span> {{ $feature }}
                    </li>
                @endforeach
            </ul>

            @if($isCurrent)
                <div style="width:100%;text-align:center;padding:0.65rem;font-family:'JetBrains Mono',monospace;font-size:0.63rem;letter-spacing:0.12em;text-transform:uppercase;color:rgba(0,255,136,0.4);border:1px solid rgba(0,255,136,0.12);">&#10003; Current Plan</div>
            @elseif($plan['price'] == 0)
                <div style="width:100%;text-align:center;padding:0.65rem;font-family:'JetBrains Mono',monospace;font-size:0.63rem;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.05);">Free Forever</div>
            @elseif($isUpgrade)
                <form method="POST" action="{{ route('billing.checkout') }}">
                    @csrf
                    <input type="hidden" name="plan" value="{{ $key }}">
                    <button type="submit" style="width:100%;text-align:center;padding:0.65rem;font-family:'JetBrains Mono',monospace;font-size:0.63rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#00ff88;border:none;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.background='#00ffaa'" onmouseout="this.style.background='#00ff88'">
                        Upgrade to {{ $plan['name'] }} &#8594;
                    </button>
                </form>
            @else
                <div style="width:100%;text-align:center;padding:0.65rem;font-family:'JetBrains Mono',monospace;font-size:0.63rem;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.04);">Downgrade not available</div>
            @endif
        </div>
        @endforeach
    </div>
</div>

{{-- Subscription Info + Billing History --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
    <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.75rem;position:relative;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#00d4ff;opacity:0.2;"></div>
        <h3 style="font-size:0.78rem;font-weight:700;color:rgba(255,255,255,0.3);margin-bottom:1.25rem;font-family:'JetBrains Mono',monospace;letter-spacing:0.1em;text-transform:uppercase;">// SUBSCRIPTION INFO</h3>
        @if($isPaid)
            <div style="display:flex;flex-direction:column;gap:0.75rem;">
                @foreach([
                    ['Plan', ucfirst($user->subscription_plan ?? $user->tier)],
                    ['Status', ucfirst(str_replace('_', ' ', $user->subscription_status ?? 'active'))],
                    ['Next Billing', $user->current_period_end?->format('M d, Y') ?? '—'],
                    ['Customer Code', $user->paystack_customer_code ?? '—'],
                ] as $row)
                <div style="display:flex;justify-content:space-between;align-items:center;padding-bottom:0.6rem;border-bottom:1px solid rgba(255,255,255,0.04);">
                    <span class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.25);">{{ $row[0] }}</span>
                    <span class="font-mono" style="font-size:0.63rem;color:rgba(255,255,255,0.6);">{{ $row[1] }}</span>
                </div>
                @endforeach
            </div>
        @else
            <div style="padding:1.5rem;border:1px dashed rgba(255,255,255,0.06);text-align:center;">
                <p class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.18);letter-spacing:0.1em;margin-bottom:0.35rem;">NO ACTIVE SUBSCRIPTION</p>
                <p style="font-size:0.72rem;color:rgba(255,255,255,0.2);line-height:1.5;">Upgrade to a paid plan to unlock more tools.</p>
            </div>
        @endif
    </div>

    <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.75rem;position:relative;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#a855f7;opacity:0.2;"></div>
        <h3 style="font-size:0.78rem;font-weight:700;color:rgba(255,255,255,0.3);margin-bottom:1.25rem;font-family:'JetBrains Mono',monospace;letter-spacing:0.1em;text-transform:uppercase;">// BILLING HISTORY</h3>
        @if(!empty($transactions))
            <div style="display:flex;flex-direction:column;gap:0.6rem;">
                @foreach($transactions as $tx)
                <div style="display:flex;justify-content:space-between;align-items:center;padding:0.6rem 0.75rem;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.04);">
                    <div>
                        <div class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.5);">GHS {{ number_format($tx['amount'] / 100, 2) }}</div>
                        <div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.2);margin-top:0.15rem;">{{ \Carbon\Carbon::parse($tx['paid_at'])->format('M d, Y') }}</div>
                    </div>
                    <span class="font-mono" style="font-size:0.55rem;color:#00ff88;padding:0.1rem 0.4rem;border:1px solid rgba(0,255,136,0.2);">PAID</span>
                </div>
                @endforeach
            </div>
        @else
            <div style="padding:1.5rem;border:1px dashed rgba(255,255,255,0.06);text-align:center;">
                <p class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.18);letter-spacing:0.1em;margin-bottom:0.35rem;">NO INVOICES YET</p>
                <p style="font-size:0.72rem;color:rgba(255,255,255,0.2);line-height:1.5;">Your invoices will appear here after your first payment.</p>
            </div>
        @endif
    </div>
</div>

@endsection
