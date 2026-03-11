@extends('layouts.landing')

@section('title', 'Terms of Service — CyberWraith')
@section('description', 'The terms and conditions governing your use of the CyberWraith platform.')

@section('content')

@php $updated = 'March 11, 2026'; @endphp

{{-- Hero --}}
<section style="padding:5rem 2.5rem 3rem;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 60% 50% at 50% 0%,rgba(0,255,136,0.05) 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,#00ff88,transparent);opacity:0.3;"></div>
    <div style="position:relative;z-index:1;max-width:640px;margin:0 auto;">
        <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:1rem;">// LEGAL.terms()</div>
        <h1 style="font-size:clamp(2rem,4vw,2.75rem);font-weight:900;color:#fff;line-height:1.1;margin-bottom:1rem;">Terms of <span style="color:#00ff88;">Service</span></h1>
        <p class="font-mono" style="font-size:0.7rem;color:rgba(255,255,255,0.25);letter-spacing:0.1em;">Last updated: {{ $updated }}</p>
    </div>
</section>

{{-- Content --}}
<section style="padding:1rem 2.5rem 6rem;">
    <div style="max-width:760px;margin:0 auto;">

        {{-- Intro --}}
        <div style="background:#0a1520;border:1px solid rgba(0,255,136,0.12);padding:1.75rem;margin-bottom:2.5rem;position:relative;overflow:hidden;">
            <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#00ff88;opacity:0.3;"></div>
            <p style="font-size:0.85rem;color:rgba(255,255,255,0.45);line-height:1.85;margin:0;">Please read these Terms of Service ("Terms") carefully before using the CyberWraith platform. By accessing or using our services, you agree to be bound by these Terms. If you do not agree, you may not use the platform.</p>
        </div>

        @foreach([
            [
                'title' => '1. Acceptance of Terms',
                'content' => [
                    ['heading' => null, 'body' => 'By creating an account or using CyberWraith in any way, you confirm that you are at least 16 years of age, have read and understood these Terms, and agree to be bound by them along with our Privacy Policy and Cookie Policy.'],
                ],
            ],
            [
                'title' => '2. Description of Service',
                'content' => [
                    ['heading' => null, 'body' => 'CyberWraith is a SaaS platform providing 200+ AI-powered productivity tools for freelancers and agencies, powered by Anthropic\'s Claude AI. We also offer technical services including web development, security audits, Linux administration and SaaS consulting.'],
                    ['heading' => null, 'body' => 'We reserve the right to modify, suspend or discontinue any part of the service at any time with reasonable notice. We will not be liable to you or any third party for any modification, suspension or discontinuance.'],
                ],
            ],
            [
                'title' => '3. Account Registration',
                'content' => [
                    ['heading' => null, 'body' => 'You must provide accurate, current and complete information when creating your account. You are responsible for maintaining the confidentiality of your password and for all activity that occurs under your account. You must notify us immediately at TheCyberWraith@proton.me if you suspect any unauthorised access to your account.'],
                    ['heading' => null, 'body' => 'We reserve the right to terminate accounts that contain false information or that are used in violation of these Terms.'],
                ],
            ],
            [
                'title' => '4. Subscriptions and Billing',
                'content' => [
                    ['heading' => 'Plans and pricing', 'body' => 'CyberWraith offers free and paid subscription plans. Paid plans are billed on a monthly or annual basis as selected at checkout. All prices are displayed on our pricing page and are subject to change with 30 days\' notice.'],
                    ['heading' => 'Payment', 'body' => 'Payments are processed securely by Paystack. By subscribing to a paid plan, you authorise us to charge your selected payment method on a recurring basis. You must keep your billing information current and accurate.'],
                    ['heading' => 'Refunds', 'body' => 'We offer a 14-day money-back guarantee on all paid plans. If you are not satisfied within the first 14 days of a new paid subscription, contact us at TheCyberWraith@proton.me for a full refund. After 14 days, payments are non-refundable except where required by law.'],
                    ['heading' => 'Cancellation', 'body' => 'You may cancel your subscription at any time from your account settings. Cancellation takes effect at the end of the current billing period. You will retain access to paid features until that date.'],
                ],
            ],
            [
                'title' => '5. Acceptable Use',
                'content' => [
                    ['heading' => null, 'body' => 'You agree not to use CyberWraith to:'],
                    ['heading' => null, 'body' => '• Violate any applicable law or regulation
• Generate content that is illegal, harmful, threatening, abusive, defamatory, or otherwise objectionable
• Infringe the intellectual property rights of any third party
• Attempt to gain unauthorised access to any part of the platform or its infrastructure
• Transmit malware, viruses or any other malicious code
• Scrape, crawl or systematically extract data from the platform without written permission
• Resell or sublicense access to the platform without written permission
• Use the platform in a way that could damage, overburden or impair its operation'],
                    ['heading' => null, 'body' => 'We reserve the right to suspend or terminate your account immediately if you violate these restrictions.'],
                ],
            ],
            [
                'title' => '6. AI-Generated Content',
                'content' => [
                    ['heading' => null, 'body' => 'Our tools generate content using Anthropic\'s Claude AI. You acknowledge that:'],
                    ['heading' => null, 'body' => '• AI-generated outputs may contain errors, inaccuracies or outdated information
• You are solely responsible for reviewing and verifying any AI-generated content before use
• You are solely responsible for how you use AI-generated outputs
• We do not guarantee that AI outputs are fit for any particular purpose'],
                    ['heading' => null, 'body' => 'You retain ownership of the content you input into our tools. By using the platform, you grant us a limited licence to process your inputs solely for the purpose of generating the requested output.'],
                ],
            ],
            [
                'title' => '7. Intellectual Property',
                'content' => [
                    ['heading' => null, 'body' => 'The CyberWraith platform, including its design, code, branding, and all content created by us, is owned by CyberWraith and protected by applicable intellectual property laws. You may not copy, modify, distribute or create derivative works from our platform or content without our written permission.'],
                    ['heading' => null, 'body' => 'You retain ownership of any content you create using our tools. We claim no ownership over your inputs or outputs.'],
                ],
            ],
            [
                'title' => '8. Disclaimer of Warranties',
                'content' => [
                    ['heading' => null, 'body' => 'The platform is provided "as is" and "as available" without warranties of any kind, either express or implied, including but not limited to implied warranties of merchantability, fitness for a particular purpose, or non-infringement. We do not warrant that the platform will be uninterrupted, error-free or free of harmful components.'],
                ],
            ],
            [
                'title' => '9. Limitation of Liability',
                'content' => [
                    ['heading' => null, 'body' => 'To the fullest extent permitted by law, CyberWraith shall not be liable for any indirect, incidental, special, consequential or punitive damages, including loss of profits, data or goodwill, arising from your use of or inability to use the platform, even if we have been advised of the possibility of such damages.'],
                    ['heading' => null, 'body' => 'Our total liability to you for any claim arising from your use of the platform shall not exceed the amount you paid us in the three months prior to the claim.'],
                ],
            ],
            [
                'title' => '10. Indemnification',
                'content' => [
                    ['heading' => null, 'body' => 'You agree to indemnify and hold harmless CyberWraith and its team members from any claims, damages, losses or expenses (including legal fees) arising from your use of the platform, your violation of these Terms, or your violation of any third-party rights.'],
                ],
            ],
            [
                'title' => '11. Termination',
                'content' => [
                    ['heading' => null, 'body' => 'We may suspend or terminate your account at any time, with or without notice, for any violation of these Terms or for any other reason at our sole discretion. Upon termination, your right to use the platform ceases immediately. Provisions of these Terms that by their nature should survive termination shall survive, including ownership provisions, disclaimers and limitations of liability.'],
                ],
            ],
            [
                'title' => '12. Governing Law',
                'content' => [
                    ['heading' => null, 'body' => 'These Terms shall be governed by and construed in accordance with the laws of the Republic of Ghana, without regard to its conflict of law provisions. Any disputes arising under these Terms shall be subject to the exclusive jurisdiction of the courts located in Ghana.'],
                ],
            ],
            [
                'title' => '13. Changes to These Terms',
                'content' => [
                    ['heading' => null, 'body' => 'We reserve the right to update these Terms at any time. When we do, we will update the "Last updated" date at the top of this page. For material changes, we will notify registered users by email. Your continued use of the platform after changes take effect constitutes acceptance of the revised Terms.'],
                ],
            ],
            [
                'title' => '14. Contact',
                'content' => [
                    ['heading' => null, 'body' => 'If you have any questions about these Terms, please contact us at:'],
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
            <a href="/cookies" class="font-mono" style="font-size:0.63rem;color:rgba(255,255,255,0.25);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(255,255,255,0.25)'">Cookie Policy →</a>
        </div>

    </div>
</section>

@endsection
