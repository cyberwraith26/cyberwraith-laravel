@extends('layouts.landing')

@section('title', "What's New — CyberWraith Changelog")
@section('description', 'See every new tool, feature and fix shipped to CyberWraith. Updated regularly.')

@section('content')

<section style="padding:5rem 2.5rem 3rem;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 60% 50% at 50% 0%,rgba(168,85,247,0.06) 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(168,85,247,0.025) 1px,transparent 1px),linear-gradient(90deg,rgba(168,85,247,0.025) 1px,transparent 1px);background-size:48px 48px;pointer-events:none;"></div>
    <div style="max-width:720px;margin:0 auto;position:relative;z-index:1;text-align:center;">
        <div class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.6);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:1rem;">// CHANGELOG.getAll()</div>
        <h1 style="font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#fff;line-height:1.1;margin-bottom:1rem;">What's <span style="color:#a855f7;">New</span></h1>
        <p style="font-size:0.9rem;color:rgba(255,255,255,0.35);line-height:1.7;">Every tool, feature and fix — shipped and documented. We build in public.</p>
    </div>
</section>

<section style="padding:2rem 2.5rem 6rem;">
    <div style="max-width:720px;margin:0 auto;">

        @php
        $entries = [
            [
                'date'    => 'March 2026',
                'badge'   => 'Major Release',
                'color'   => '#a855f7',
                'title'   => 'v2.0 — 40 New Tools Shipped',
                'summary' => 'The biggest single batch of tools ever deployed to CyberWraith. 40 new tools across 8 categories, zero routing changes required thanks to our slug-based architecture.',
                'items'   => [
                    ['✦', 'Sales Scripts: Pitch Script Writer, Objection Handler, Discovery Call Script, Upsell Scripter, Break-Up Email Writer'],
                    ['✦', 'Client Intelligence: Client Dossier Builder, Meeting Prep Kit, Client Gift Recommender, Referral Script, Testimonial Template'],
                    ['✦', 'Finance: Freelance Salary Planner, Invoice Late Fee Calculator, Project Deposit Calculator, Annual Review Generator, Subscription Tracker'],
                    ['✦', 'Content: Podcast Outline Generator, YouTube SEO Optimizer, Email Subject Line Tester, Content Brief Builder, Microcopy Writer'],
                    ['✦', 'Technical SEO: Schema Markup Generator, Robots.txt Builder, Canonical Tag Fixer, Core Web Vitals Advisor, Redirect Mapper'],
                    ['✦', 'Social: Instagram Caption Writer, Twitter Bio Writer, YouTube About Writer, Social Proof Collector, Storyboard Generator'],
                    ['✦', 'Operations: Meeting Agenda Builder, SMART Goal Setter, Client Questionnaire, Project Kickoff Generator, Onboarding Checklist'],
                    ['✦', 'Strategy: Value Proposition Builder, Elevator Pitch Generator, Competitive Matrix, Pricing Strategy AI, Business Plan Writer'],
                ],
            ],
            [
                'date'    => 'February 2026',
                'badge'   => 'Bug Fix',
                'color'   => '#00ff88',
                'title'   => 'OAuth Token Column & Session Fix',
                'summary' => 'Two bugs squashed that were affecting login reliability for some users.',
                'items'   => [
                    ['🐛', 'Fixed: PostgreSQL provider_token column overflow on OAuth login — migrated to TEXT type'],
                    ['🐛', 'Fixed: 419 Page Expired on logout caused by misconfigured SESSION_DOMAIN in .env'],
                    ['✦',  'Improved: Session cookie handling now consistent across subdomains'],
                ],
            ],
            [
                'date'    => 'January 2026',
                'badge'   => 'Feature',
                'color'   => '#00d4ff',
                'title'   => 'Blog & Portfolio Launched',
                'summary' => 'Two major new public-facing sections added to the CyberWraith marketing site.',
                'items'   => [
                    ['✦', 'Blog: 20 articles published across Freelancing, SaaS, Productivity, Security and Business categories'],
                    ['✦', 'Portfolio: Full case study system with DB-driven content, slug routing and related work suggestions'],
                    ['✦', 'Custom pagination component replacing Laravel default — styled to match the CyberWraith design language'],
                    ['✦', 'Newsletter subscribe flow added to blog and portfolio pages'],
                ],
            ],
            [
                'date'    => 'December 2025',
                'badge'   => 'Launch',
                'color'   => '#a855f7',
                'title'   => 'v1.0 — CyberWraith Goes Live',
                'summary' => 'The initial launch of CyberWraith with 92 AI-powered tools across 6 core categories.',
                'items'   => [
                    ['✦', '92 tools live at launch across Copywriting, SEO, Business, Social Media, Freelancing and Productivity'],
                    ['✦', 'Google and GitHub OAuth login'],
                    ['✦', 'Slug-based tool router — new tools deployable with zero controller changes'],
                    ['✦', 'Claude Sonnet AI backend with tool-specific system prompts'],
                    ['✦', 'Dark mode only — because freelancers work at night'],
                ],
            ],
        ];
        @endphp

        {{-- Timeline --}}
        <div style="position:relative;">
            {{-- Vertical line --}}
            <div style="position:absolute;left:0;top:0;bottom:0;width:1px;background:linear-gradient(180deg,rgba(168,85,247,0.4),rgba(168,85,247,0.05));margin-left:0.5rem;"></div>

            <div style="display:flex;flex-direction:column;gap:3rem;padding-left:2.5rem;">
                @foreach($entries as $entry)
                <div style="position:relative;">
                    {{-- Timeline dot --}}
                    <div style="position:absolute;left:-2.5rem;top:0.35rem;width:10px;height:10px;border-radius:50%;background:{{ $entry['color'] }};border:2px solid #050a0f;box-shadow:0 0 8px {{ $entry['color'] }};flex-shrink:0;"></div>

                    {{-- Date + badge --}}
                    <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1rem;flex-wrap:wrap;">
                        <span class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.25);letter-spacing:0.1em;">{{ $entry['date'] }}</span>
                        <span class="font-mono" style="font-size:0.52rem;padding:0.15rem 0.55rem;border:1px solid;border-color:{{ $entry['color'] }};color:{{ $entry['color'] }};letter-spacing:0.1em;text-transform:uppercase;opacity:0.8;">{{ $entry['badge'] }}</span>
                    </div>

                    {{-- Card --}}
                    <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.5rem;position:relative;transition:border-color 0.2s;" onmouseover="this.style.borderColor='rgba(168,85,247,0.15)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)'">
                        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:{{ $entry['color'] }};opacity:0.35;"></div>
                        <h3 style="font-size:1rem;font-weight:800;color:#fff;margin-bottom:0.5rem;">{{ $entry['title'] }}</h3>
                        <p style="font-size:0.78rem;color:rgba(255,255,255,0.3);line-height:1.6;margin-bottom:1.25rem;">{{ $entry['summary'] }}</p>
                        <div style="display:flex;flex-direction:column;gap:0.45rem;">
                            @foreach($entry['items'] as $item)
                            <div style="display:flex;align-items:flex-start;gap:0.6rem;">
                                <span style="color:{{ $entry['color'] }};font-size:0.65rem;flex-shrink:0;margin-top:0.1rem;opacity:0.7;">{{ $item[0] }}</span>
                                <span class="font-mono" style="font-size:0.65rem;color:rgba(255,255,255,0.38);line-height:1.5;">{{ $item[1] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Subscribe nudge --}}
        <div style="margin-top:4rem;padding:2rem;background:#0a1520;border:1px solid rgba(168,85,247,0.12);text-align:center;position:relative;overflow:hidden;">
            <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,#a855f7,transparent);"></div>
            <div class="font-mono" style="font-size:0.58rem;color:rgba(168,85,247,0.5);letter-spacing:0.2em;text-transform:uppercase;margin-bottom:0.5rem;">// UPDATES.subscribe()</div>
            <p style="font-size:0.85rem;color:rgba(255,255,255,0.4);margin-bottom:1.25rem;">Get notified when new tools and features drop.</p>
            <a href="#newsletter" class="font-mono" style="font-size:0.65rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#a855f7;padding:0.55rem 1.5rem;text-decoration:none;transition:opacity 0.2s;display:inline-block;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">Subscribe to Newsletter →</a>
        </div>

    </div>
</section>

@endsection
