@extends('layouts.landing')

@section('title', 'Privacy Policy — CyberWraith')
@section('description', 'How CyberWraith collects, uses and protects your personal data.')

@section('content')

@php $updated = 'March 11, 2026'; @endphp

{{-- Hero --}}
<section style="padding:5rem 2.5rem 3rem;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 60% 50% at 50% 0%,rgba(0,255,136,0.05) 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,#00ff88,transparent);opacity:0.3;"></div>
    <div style="position:relative;z-index:1;max-width:640px;margin:0 auto;">
        <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:1rem;">// LEGAL.privacy()</div>
        <h1 style="font-size:clamp(2rem,4vw,2.75rem);font-weight:900;color:#fff;line-height:1.1;margin-bottom:1rem;">Privacy <span style="color:#00ff88;">Policy</span></h1>
        <p class="font-mono" style="font-size:0.7rem;color:rgba(255,255,255,0.25);letter-spacing:0.1em;">Last updated: {{ $updated }}</p>
    </div>
</section>

{{-- Content --}}
<section style="padding:1rem 2.5rem 6rem;">
    <div style="max-width:760px;margin:0 auto;">

        {{-- Intro --}}
        <div style="background:#0a1520;border:1px solid rgba(0,255,136,0.12);padding:1.75rem;margin-bottom:2.5rem;position:relative;overflow:hidden;">
            <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#00ff88;opacity:0.3;"></div>
            <p style="font-size:0.85rem;color:rgba(255,255,255,0.45);line-height:1.85;margin:0;">CyberWraith ("we", "us", or "our") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose and safeguard your information when you visit our platform and use our services. Please read this policy carefully. If you disagree with its terms, please discontinue use of the platform.</p>
        </div>

        @foreach([
            [
                'title' => '1. Information We Collect',
                'content' => [
                    ['heading' => 'Information you provide directly', 'body' => 'When you register for an account, we collect your name, email address and password. If you contact us, we collect the content of your message. If you subscribe to a paid plan, billing information is handled directly by our payment processor (Paystack) and we do not store your card details.'],
                    ['heading' => 'Information collected automatically', 'body' => 'When you use the platform, we automatically collect certain technical information including your IP address, browser type, operating system, referring URLs, pages visited and the date and time of your visit. This information is used to maintain and improve the platform.'],
                    ['heading' => 'Tool inputs and AI outputs', 'body' => 'When you use our AI-powered tools, the input you provide is sent to Anthropic\'s Claude API for processing. We do not permanently store your tool inputs or outputs on our servers beyond what is required to deliver the response. Anthropic\'s data handling is governed by their own privacy policy.'],
                ],
            ],
            [
                'title' => '2. How We Use Your Information',
                'content' => [
                    ['heading' => null, 'body' => 'We use the information we collect to:'],
                    ['heading' => null, 'body' => '• Provide, operate and maintain the CyberWraith platform
• Process your account registration and manage your subscription
• Respond to your enquiries and support requests
• Send transactional emails (account confirmation, password reset, billing receipts)
• Send product update emails if you have opted in — you can unsubscribe at any time
• Monitor and analyse usage to improve the platform
• Detect and prevent fraud, abuse and security incidents
• Comply with legal obligations'],
                ],
            ],
            [
                'title' => '3. Sharing Your Information',
                'content' => [
                    ['heading' => null, 'body' => 'We do not sell, trade or rent your personal information to third parties. We may share your information only in the following circumstances:'],
                    ['heading' => 'Service providers', 'body' => 'We share data with trusted third-party service providers who assist in operating the platform, including Anthropic (AI processing), Paystack (payment processing) and our hosting provider. These providers are contractually obligated to keep your data confidential and use it only for the services they provide to us.'],
                    ['heading' => 'Legal requirements', 'body' => 'We may disclose your information if required to do so by law or in response to valid requests by public authorities (e.g. a court or government agency).'],
                    ['heading' => 'Business transfers', 'body' => 'If CyberWraith is involved in a merger, acquisition or asset sale, your personal data may be transferred. We will provide notice before your data is transferred and becomes subject to a different privacy policy.'],
                ],
            ],
            [
                'title' => '4. Data Retention',
                'content' => [
                    ['heading' => null, 'body' => 'We retain your personal information for as long as your account is active or as needed to provide you services. If you delete your account, we will delete or anonymise your personal data within 30 days, except where we are required to retain it for legal or regulatory reasons.'],
                ],
            ],
            [
                'title' => '5. Data Security',
                'content' => [
                    ['heading' => null, 'body' => 'We implement appropriate technical and organisational security measures to protect your personal information against unauthorised access, alteration, disclosure or destruction. All data in transit is encrypted using SSL/TLS. However, no method of transmission over the Internet or electronic storage is 100% secure, and we cannot guarantee absolute security.'],
                ],
            ],
            [
                'title' => '6. Your Rights',
                'content' => [
                    ['heading' => null, 'body' => 'Depending on your location, you may have the following rights regarding your personal data:'],
                    ['heading' => null, 'body' => '• The right to access the personal data we hold about you
• The right to request correction of inaccurate data
• The right to request deletion of your personal data
• The right to object to or restrict processing of your data
• The right to data portability
• The right to withdraw consent at any time where processing is based on consent'],
                    ['heading' => null, 'body' => 'To exercise any of these rights, please contact us at TheCyberWraith@proton.me. We will respond within 30 days.'],
                ],
            ],
            [
                'title' => '7. Cookies',
                'content' => [
                    ['heading' => null, 'body' => 'We use cookies and similar tracking technologies to operate the platform, remember your preferences and analyse usage. For full details on the cookies we use and how to control them, please see our Cookie Policy.'],
                ],
            ],
            [
                'title' => '8. Third-Party Links',
                'content' => [
                    ['heading' => null, 'body' => 'Our platform may contain links to third-party websites. We are not responsible for the privacy practices of those sites and encourage you to review their privacy policies before providing any personal information.'],
                ],
            ],
            [
                'title' => '9. Children\'s Privacy',
                'content' => [
                    ['heading' => null, 'body' => 'CyberWraith is not directed at individuals under the age of 16. We do not knowingly collect personal information from children. If you believe we have inadvertently collected data from a child, please contact us immediately and we will delete it.'],
                ],
            ],
            [
                'title' => '10. Changes to This Policy',
                'content' => [
                    ['heading' => null, 'body' => 'We may update this Privacy Policy from time to time. When we do, we will update the "Last updated" date at the top of this page and, where appropriate, notify you by email. Your continued use of the platform after changes are posted constitutes your acceptance of the revised policy.'],
                ],
            ],
            [
                'title' => '11. Contact Us',
                'content' => [
                    ['heading' => null, 'body' => 'If you have any questions, concerns or requests regarding this Privacy Policy, please contact us at:'],
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
            <a href="/terms" class="font-mono" style="font-size:0.63rem;color:rgba(255,255,255,0.25);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(255,255,255,0.25)'">Terms of Service →</a>
            <a href="/cookies" class="font-mono" style="font-size:0.63rem;color:rgba(255,255,255,0.25);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(255,255,255,0.25)'">Cookie Policy →</a>
        </div>

    </div>
</section>

@endsection
