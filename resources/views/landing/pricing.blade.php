@extends('layouts.landing')

@section('title', 'Pricing — CyberWraith')
@section('description', 'Simple, transparent pricing for freelancers, individuals and agencies. Start free, upgrade when ready.')

@section('content')

{{-- Hero --}}
<section style="padding:5rem 2.5rem 3rem;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 60% 50% at 50% 0%,rgba(0,255,136,0.06) 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:relative;z-index:1;max-width:640px;margin:0 auto;">
        <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:1rem;">// PRICING.getPlans()</div>
        <h1 style="font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#fff;line-height:1.1;margin-bottom:1rem;">Simple, Transparent<br><span style="color:#00ff88;">Pricing</span></h1>
        <p style="font-size:0.9rem;color:rgba(255,255,255,0.4);line-height:1.7;">Start free. No credit card required. Upgrade when you are ready to unlock more tools.</p>
    </div>
</section>

{{-- Plans --}}
<section style="padding:2rem 2.5rem 6rem;">
    <div style="max-width:1100px;margin:0 auto;">
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem;align-items:center;">
            @foreach($plans as $key => $plan)
            @php $isPopular = $key === 'pro'; @endphp
            <div style="background:#0a1520;border:1px solid {{ $isPopular ? 'rgba(0,255,136,0.35)' : 'rgba(255,255,255,0.05)' }};padding:2.5rem;position:relative;{{ $isPopular ? 'box-shadow:0 0 60px rgba(0,255,136,0.08);transform:scale(1.03);' : '' }}">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:{{ $isPopular ? '#00ff88' : 'rgba(255,255,255,0.05)' }};"></div>
                @if($isPopular)
                    <div class="font-mono" style="position:absolute;top:0;left:50%;transform:translate(-50%,-50%);background:#00ff88;color:#000;font-size:0.55rem;font-weight:700;padding:0.2rem 1.5rem;letter-spacing:0.2em;white-space:nowrap;">MOST POPULAR</div>
                @endif

                <div class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.25);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:1rem;">{{ $plan['name'] }}</div>

                <div style="display:flex;align-items:baseline;gap:0.3rem;margin-bottom:0.4rem;">
                    <span style="font-size:3.5rem;font-weight:900;color:#fff;line-height:1;">${{ $plan['price'] }}</span>
                    <span style="color:rgba(255,255,255,0.2);font-size:0.8rem;">/month</span>
                </div>
                <p style="font-size:0.78rem;color:rgba(255,255,255,0.25);margin-bottom:1.5rem;padding-bottom:1.5rem;border-bottom:1px solid rgba(255,255,255,0.05);line-height:1.6;">{{ $plan['description'] }}</p>

                {{-- Tool access badge --}}
                <div style="display:flex;align-items:center;gap:0.6rem;padding:0.6rem 1rem;background:rgba(0,255,136,0.04);border:1px solid rgba(0,255,136,0.12);margin-bottom:1.5rem;">
                    <span style="color:#00ff88;font-size:1rem;">⚙</span>
                    <span class="font-mono" style="font-size:0.63rem;color:rgba(0,255,136,0.7);">
                        Access to <strong style="color:#00ff88;">{{ $plan['tools'] }}</strong> tool{{ $plan['tools'] > 1 ? 's' : '' }}
                        @if($key === 'agency') <span style="opacity:0.6;">(all tools)</span> @endif
                    </span>
                </div>

                <ul style="list-style:none;display:flex;flex-direction:column;gap:0.7rem;margin-bottom:2rem;">
                    @foreach($plan['features'] as $feature)
                        <li class="font-mono" style="font-size:0.63rem;color:rgba(255,255,255,0.4);display:flex;align-items:flex-start;gap:0.5rem;line-height:1.5;">
                            <span style="color:#00ff88;flex-shrink:0;margin-top:0.05rem;">✓</span> {{ $feature }}
                        </li>
                    @endforeach
                </ul>

                <a href="{{ route('register') }}" style="display:block;text-align:center;padding:0.8rem;text-decoration:none;font-family:'JetBrains Mono',monospace;font-size:0.7rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;transition:all 0.2s;{{ $isPopular ? 'background:#00ff88;color:#000;' : 'border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.4);' }}" onmouseover="{{ $isPopular ? "this.style.background='#00ffaa'" : "this.style.borderColor='rgba(0,255,136,0.4)';this.style.color='#00ff88'" }}" onmouseout="{{ $isPopular ? "this.style.background='#00ff88'" : "this.style.borderColor='rgba(255,255,255,0.1)';this.style.color='rgba(255,255,255,0.4)'" }}">
                    {{ $plan['price'] == 0 ? 'Start Free — No Card Needed →' : 'Get Started →' }}
                </a>
            </div>
            @endforeach
        </div>

        {{-- FAQ --}}
        <div style="margin-top:5rem;">
            <div style="text-align:center;margin-bottom:3rem;">
                <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:0.75rem;">// FAQ.getAll()</div>
                <h2 style="font-size:1.75rem;font-weight:800;color:#fff;">Common Questions</h2>
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(460px,1fr));gap:1.25rem;max-width:1000px;margin:0 auto;">
                @foreach([
                    ['Do I need a credit card to start?','No. The Free plan requires no credit card. Sign up and start using your first 4 tools immediately.'],
                    ['Can I upgrade or downgrade anytime?','Yes. You can change your plan at any time. Upgrades take effect immediately, downgrades at the end of the billing cycle.'],
                    ['What counts as a "tool"?','Each module in your dashboard — FollowStack, InvoicePro, ProposalGen etc. — counts as one tool. Your plan determines how many you can access.'],
                    ['Is there a free trial for paid plans?','All plans start with a 14-day free trial with no credit card required. You get access to Pro features before committing.'],
                    ['What payment methods do you accept?','We accept all major credit cards, debit cards and PayPal via our secure payment processor.'],
                    ['Can I cancel anytime?','Absolutely. Cancel your subscription at any time from your billing settings. No cancellation fees.'],
                ] as $faq)
                <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.5rem;">
                    <h3 style="font-size:0.88rem;font-weight:700;color:#fff;margin-bottom:0.5rem;">{{ $faq[0] }}</h3>
                    <p style="font-size:0.78rem;color:rgba(255,255,255,0.35);line-height:1.7;">{{ $faq[1] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- CTA --}}
        <div style="margin-top:5rem;text-align:center;padding:3rem;background:#0a1520;border:1px solid rgba(0,255,136,0.1);position:relative;overflow:hidden;">
            <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,#00ff88,transparent);"></div>
            <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.4);letter-spacing:0.25em;margin-bottom:1rem;">// READY TO START?</div>
            <h2 style="font-size:1.5rem;font-weight:800;color:#fff;margin-bottom:0.75rem;">Start Free Today</h2>
            <p style="font-size:0.85rem;color:rgba(255,255,255,0.35);margin-bottom:2rem;">4 tools, no credit card, no time limit on the free plan.</p>
            <a href="{{ route('register') }}" style="display:inline-flex;align-items:center;font-family:'JetBrains Mono',monospace;font-size:0.75rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#000;background:#00ff88;padding:0.85rem 2.5rem;text-decoration:none;clip-path:polygon(8px 0,100% 0,calc(100% - 8px) 100%,0 100%);transition:background 0.2s;" onmouseover="this.style.background='#00ffaa'" onmouseout="this.style.background='#00ff88'">
                Create Free Account →
            </a>
        </div>
    </div>
</section>

@endsection
