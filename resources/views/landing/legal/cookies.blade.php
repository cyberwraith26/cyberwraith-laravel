@extends('layouts.landing')

@section('title', 'Cookie Policy — CyberWraith')
@section('description', 'How CyberWraith uses cookies and similar tracking technologies.')

@section('content')

@php $updated = 'March 11, 2026'; @endphp

{{-- Hero --}}
<section style="padding:5rem 2.5rem 3rem;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 60% 50% at 50% 0%,rgba(0,255,136,0.05) 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,#00ff88,transparent);opacity:0.3;"></div>
    <div style="position:relative;z-index:1;max-width:640px;margin:0 auto;">
        <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:1rem;">// LEGAL.cookies()</div>
        <h1 style="font-size:clamp(2rem,4vw,2.75rem);font-weight:900;color:#fff;line-height:1.1;margin-bottom:1rem;">Cookie <span style="color:#00ff88;">Policy</span></h1>
        <p class="font-mono" style="font-size:0.7rem;color:rgba(255,255,255,0.25);letter-spacing:0.1em;">Last updated: {{ $updated }}</p>
    </div>
</section>

{{-- Content --}}
<section style="padding:1rem 2.5rem 6rem;">
    <div style="max-width:760px;margin:0 auto;">

        {{-- Intro --}}
        <div style="background:#0a1520;border:1px solid rgba(0,255,136,0.12);padding:1.75rem;margin-bottom:2.5rem;position:relative;overflow:hidden;">
            <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#00ff88;opacity:0.3;"></div>
            <p style="font-size:0.85rem;color:rgba(255,255,255,0.45);line-height:1.85;margin:0;">This Cookie Policy explains how CyberWraith uses cookies and similar technologies when you visit our platform. It explains what these technologies are, why we use them, and your rights to control their use.</p>
        </div>

        @foreach([
            [
                'title' => '1. What Are Cookies?',
                'content' => [
                    ['heading' => null, 'body' => 'Cookies are small text files that are placed on your device when you visit a website. They are widely used to make websites work efficiently, remember your preferences, and provide information to website owners about how visitors use their site.'],
                    ['heading' => null, 'body' => 'Cookies can be "session cookies" (deleted when you close your browser) or "persistent cookies" (stored on your device for a set period or until you delete them). We use both types.'],
                ],
            ],
            [
                'title' => '2. How We Use Cookies',
                'content' => [
                    ['heading' => null, 'body' => 'We use cookies for the following purposes:'],
                ],
            ],
            [
                'title' => '3. Types of Cookies We Use',
                'content' => [
                    ['heading' => 'Strictly Necessary Cookies', 'body' => 'These cookies are essential for the platform to function and cannot be disabled. They include session cookies that maintain your login state, CSRF tokens that protect against cross-site request forgery attacks, and cookies that remember your cookie consent preference.'],
                    ['heading' => 'Functional Cookies', 'body' => 'These cookies allow the platform to remember choices you make (such as your preferred language or dashboard settings) and provide a more personalised experience. Disabling these cookies may affect how the platform functions.'],
                    ['heading' => 'Analytics Cookies', 'body' => 'We may use analytics cookies to understand how visitors interact with the platform — which pages are visited most often, how long sessions last, and where users come from. This helps us improve the platform over time. Analytics data is aggregated and anonymised where possible.'],
                    ['heading' => 'Payment Cookies', 'body' => 'When you make a payment through Paystack, Paystack may set its own cookies to process the transaction securely. These cookies are governed by Paystack\'s own cookie and privacy policies.'],
                ],
            ],
            [
                'title' => '4. Cookie Table',
                'content' => [
                    ['heading' => null, 'body' => 'The following are the primary cookies set by CyberWraith:

[cyberwraith_session] — Session — Strictly Necessary — Maintains your authenticated session while you are logged in. Deleted when you close your browser or log out.

[XSRF-TOKEN] — Session — Strictly Necessary — Laravel CSRF protection token. Prevents cross-site request forgery attacks on form submissions.

[cookie_consent] — 1 year — Functional — Stores your cookie consent preference so we do not show the banner on every visit.

[remember_web_*] — 30 days — Functional — Set when you choose "Remember me" at login. Keeps you logged in across sessions.'],
                ],
            ],
            [
                'title' => '5. Third-Party Cookies',
                'content' => [
                    ['heading' => null, 'body' => 'Some cookies on our platform are set by third parties. We do not control these cookies and they are subject to the respective third party\'s privacy and cookie policies.'],
                    ['heading' => 'Paystack', 'body' => 'Our payment processor may set cookies when you interact with the payment flow. See Paystack\'s Privacy Policy for details.'],
                    ['heading' => 'Anthropic', 'body' => 'AI processing requests are sent to the Anthropic API. Anthropic does not set cookies on your browser directly through our integration.'],
                ],
            ],
            [
                'title' => '6. Your Cookie Choices',
                'content' => [
                    ['heading' => 'Browser settings', 'body' => 'Most browsers allow you to control cookies through their settings. You can set your browser to refuse cookies, delete existing cookies, or notify you when a cookie is being set. Note that disabling strictly necessary cookies will prevent the platform from functioning correctly — you will not be able to log in or use the tools.'],
                    ['heading' => 'How to manage cookies in common browsers', 'body' => '• Chrome: Settings → Privacy and security → Cookies and other site data
• Firefox: Settings → Privacy & Security → Cookies and Site Data
• Safari: Preferences → Privacy → Manage Website Data
• Edge: Settings → Cookies and site permissions → Cookies and site data'],
                    ['heading' => 'Opt-out of analytics', 'body' => 'If we use third-party analytics tools in future, we will provide a specific opt-out mechanism. You can also install the Google Analytics Opt-out Browser Add-on if applicable.'],
                ],
            ],
            [
                'title' => '7. Do Not Track',
                'content' => [
                    ['heading' => null, 'body' => 'Some browsers include a "Do Not Track" (DNT) feature. Our platform does not currently respond to DNT signals. We will update this policy if our practices change.'],
                ],
            ],
            [
                'title' => '8. Changes to This Policy',
                'content' => [
                    ['heading' => null, 'body' => 'We may update this Cookie Policy from time to time to reflect changes in technology, regulation or our practices. When we do, we will update the "Last updated" date at the top. We encourage you to review this page periodically.'],
                ],
            ],
            [
                'title' => '9. Contact Us',
                'content' => [
                    ['heading' => null, 'body' => 'If you have any questions about our use of cookies, please contact us at:'],
                    ['heading' => null, 'body' => 'CyberWraith
Email: TheCyberWraith@proton.me'],
                ],
            ],
        ] as $section)
        <div style="margin-bottom:2.5rem;">
            <h2 style="font-size:1rem;font-weight:800;color:#fff;margin-bottom:1.25rem;padding-bottom:0.75rem;border-bottom:1px solid rgba(255,255,255,0.05);display:flex;align-items:center;gap:0.75rem;">
                <span style="color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.7rem;opacity:0.6;">//</span> {{ $section['title'] }}
            </h2>
            @foreach($section['content'] as $block)
                @if($block['heading'])
                    <h3 style="font-size:0.82rem;font-weight:700;color:rgba(255,255,255,0.6);margin-bottom:0.5rem;margin-top:1.25rem;">{{ $block['heading'] }}</h3>
                @endif
                <p style="font-size:0.83rem;color:rgba(255,255,255,0.38);line-height:1.9;margin-bottom:0.75rem;white-space:pre-line;">{{ $block['body'] }}</p>
            @endforeach
        </div>
        @endforeach

        {{-- Footer nav --}}
        <div style="margin-top:3rem;padding-top:2rem;border-top:1px solid rgba(255,255,255,0.05);display:flex;gap:1.5rem;flex-wrap:wrap;">
            <a href="/privacy" class="font-mono" style="font-size:0.63rem;color:rgba(255,255,255,0.25);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(255,255,255,0.25)'">Privacy Policy →</a>
            <a href="/terms" class="font-mono" style="font-size:0.63rem;color:rgba(255,255,255,0.25);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(255,255,255,0.25)'">Terms of Service →</a>
        </div>

    </div>
</section>

@endsection
