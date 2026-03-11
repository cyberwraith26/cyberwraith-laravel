@extends('layouts.landing')

@section('title', 'Services — CyberWraith')
@section('description', 'Expert technical services including web development, security audits, Linux administration and SaaS consulting.')

@section('content')

{{-- Hero --}}
<section style="padding:5rem 2.5rem 3rem;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 60% 50% at 50% 0%,rgba(0,212,255,0.06) 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:relative;z-index:1;max-width:640px;margin:0 auto;">
        <div class="font-mono" style="font-size:0.6rem;color:rgba(0,212,255,0.5);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:1rem;">// SERVICES.getAll()</div>
        <h1 style="font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#fff;line-height:1.1;margin-bottom:1rem;">Technical Services for<br><span style="color:#00d4ff;">Serious Businesses</span></h1>
        <p style="font-size:0.9rem;color:rgba(255,255,255,0.4);line-height:1.7;max-width:480px;margin:0 auto 2rem;">Expert solutions from a team that has built, secured and scaled dozens of applications and infrastructure systems.</p>
        <a href="/#contact" style="display:inline-flex;align-items:center;gap:0.5rem;font-family:'JetBrains Mono',monospace;font-size:0.72rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#000;background:#00d4ff;padding:0.8rem 2rem;text-decoration:none;clip-path:polygon(8px 0,100% 0,calc(100% - 8px) 100%,0 100%);transition:background 0.2s;" onmouseover="this.style.background='#33ddff'" onmouseout="this.style.background='#00d4ff'">
            Request a Consultation →
        </a>
    </div>
</section>

{{-- Services Grid --}}
<section style="padding:2rem 2.5rem 6rem;">
    <div style="max-width:1200px;margin:0 auto;">

        {{-- Main Services --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(520px,1fr));gap:1.5rem;margin-bottom:4rem;">
            @foreach([
                [
                    'icon'        => '🌐',
                    'color'       => '#00d4ff',
                    'tag'         => 'Development',
                    'name'        => 'Web Development',
                    'slug'        => 'web-development',
                    'description' => 'Full-stack web applications, SaaS platforms and APIs built with modern technologies and best practices. From MVP to enterprise-scale.',
                    'features'    => ['Full-stack Laravel / Next.js development','SaaS platform architecture & build','REST API design and development','PostgreSQL / MySQL database design','AWS / Railway / Vercel deployment','Performance optimization & scaling'],
                    'delivery'    => '2–12 weeks',
                    'starting'    => '$1,500',
                ],
                [
                    'icon'        => '🔒',
                    'color'       => '#ef4444',
                    'tag'         => 'Security',
                    'name'        => 'Security Audits',
                    'slug'        => 'security-audits',
                    'description' => 'Comprehensive penetration testing and vulnerability assessments to identify and remediate security risks before they become incidents.',
                    'features'    => ['Web application penetration testing','API security assessment','OWASP Top 10 vulnerability scan','Authentication & session security review','Detailed report with remediation steps','Follow-up verification testing'],
                    'delivery'    => '3–10 business days',
                    'starting'    => '$800',
                ],
                [
                    'icon'        => '🐧',
                    'color'       => '#a855f7',
                    'tag'         => 'Infrastructure',
                    'name'        => 'Linux Administration',
                    'slug'        => 'linux-administration',
                    'description' => 'Server setup, hardening, monitoring and ongoing administration for teams that need reliable, secure infrastructure without hiring a full-time sysadmin.',
                    'features'    => ['VPS / dedicated server setup','Security hardening & firewall config','Nginx / Apache / Caddy configuration','SSL certificates & auto-renewal','Automated backups & monitoring','Ongoing monthly retainer available'],
                    'delivery'    => '1–5 business days',
                    'starting'    => '$350',
                ],
                [
                    'icon'        => '🚀',
                    'color'       => '#f59e0b',
                    'tag'         => 'Strategy',
                    'name'        => 'SaaS Consulting',
                    'slug'        => 'saas-consulting',
                    'description' => 'Architecture guidance, tech stack decisions and go-to-market strategy for SaaS founders who want to build right the first time.',
                    'features'    => ['Tech stack selection & architecture','SaaS pricing model strategy','Onboarding flow design','Churn analysis & retention strategy','Investor-ready technical documentation','Fractional CTO engagement available'],
                    'delivery'    => 'Ongoing / project-based',
                    'starting'    => '$500',
                ],
            ] as $service)
            <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:2rem;position:relative;transition:all 0.3s;" onmouseover="this.style.borderColor='{{ $service['color'] }}25'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)'">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:{{ $service['color'] }};opacity:0.4;"></div>

                <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:1.25rem;flex-wrap:wrap;gap:0.75rem;">
                    <div style="display:flex;align-items:center;gap:0.875rem;">
                        <div style="width:44px;height:44px;background:{{ $service['color'] }}12;border:1px solid {{ $service['color'] }}22;display:flex;align-items:center;justify-content:center;font-size:1.25rem;flex-shrink:0;">{{ $service['icon'] }}</div>
                        <div>
                            <span class="font-mono" style="font-size:0.58rem;color:{{ $service['color'] }};letter-spacing:0.15em;text-transform:uppercase;display:block;margin-bottom:0.2rem;">{{ $service['tag'] }}</span>
                            <h3 style="font-size:1.1rem;font-weight:800;color:#fff;">{{ $service['name'] }}</h3>
                        </div>
                    </div>
                    <div style="text-align:right;">
                        <div class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.2);letter-spacing:0.1em;margin-bottom:0.2rem;">STARTING FROM</div>
                        <div style="font-size:1.1rem;font-weight:800;color:{{ $service['color'] }};">{{ $service['starting'] }}</div>
                    </div>
                </div>

                <p style="font-size:0.82rem;color:rgba(255,255,255,0.38);line-height:1.7;margin-bottom:1.5rem;">{{ $service['description'] }}</p>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.5rem;margin-bottom:1.5rem;">
                    @foreach($service['features'] as $f)
                    <div class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.3);display:flex;align-items:flex-start;gap:0.4rem;line-height:1.5;">
                        <span style="color:{{ $service['color'] }};flex-shrink:0;margin-top:0.05rem;">✓</span> {{ $f }}
                    </div>
                    @endforeach
                </div>

                <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.75rem;padding-top:1.25rem;border-top:1px solid rgba(255,255,255,0.04);">
                    <div class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.2);display:flex;align-items:center;gap:0.4rem;">
                        <span style="color:{{ $service['color'] }};">⏱</span> {{ $service['delivery'] }}
                    </div>
                    <div style="display:flex;align-items:center;gap:0.75rem;">
                        <a href="/services/{{ $service['slug'] }}" class="font-mono" style="font-size:0.62rem;color:{{ $service['color'] }};text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:opacity 0.2s;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                            Learn More →
                        </a>
                        <a href="/#contact" class="font-mono" style="font-size:0.65rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:{{ $service['color'] }};padding:0.45rem 1.25rem;text-decoration:none;transition:opacity 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                            Get a Quote →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Process --}}
        <div style="margin-bottom:5rem;">
            <div style="text-align:center;margin-bottom:3rem;">
                <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:0.75rem;">// PROCESS.getSteps()</div>
                <h2 style="font-size:1.75rem;font-weight:800;color:#fff;">How We Work</h2>
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1px;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.04);">
                @foreach([
                    ['01','Discovery','We start with a detailed call to understand your goals, constraints and timeline.','#00ff88'],
                    ['02','Proposal','You receive a clear scope of work, timeline and fixed or milestone-based pricing.','#00d4ff'],
                    ['03','Execution','We build, test and communicate progress at every stage. No surprises.','#a855f7'],
                    ['04','Delivery','You receive full deliverables, documentation and a handoff call.','#f59e0b'],
                ] as $step)
                <div style="background:#0a1520;padding:2rem;text-align:center;">
                    <div class="font-mono" style="font-size:2rem;font-weight:900;color:{{ $step[3] }};opacity:0.25;line-height:1;margin-bottom:1rem;">{{ $step[0] }}</div>
                    <h3 style="font-size:0.9rem;font-weight:700;color:#fff;margin-bottom:0.5rem;">{{ $step[1] }}</h3>
                    <p style="font-size:0.75rem;color:rgba(255,255,255,0.3);line-height:1.6;">{{ $step[2] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- CTA --}}
        <div style="text-align:center;padding:3rem;background:#0a1520;border:1px solid rgba(0,212,255,0.12);position:relative;overflow:hidden;">
            <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,#00d4ff,transparent);"></div>
            <div class="font-mono" style="font-size:0.6rem;color:rgba(0,212,255,0.4);letter-spacing:0.25em;margin-bottom:1rem;">// READY TO BUILD?</div>
            <h2 style="font-size:1.5rem;font-weight:800;color:#fff;margin-bottom:0.75rem;">Let's Work Together</h2>
            <p style="font-size:0.85rem;color:rgba(255,255,255,0.35);margin-bottom:2rem;max-width:400px;margin-left:auto;margin-right:auto;">Tell us about your project and we will get back to you within 24 hours with a plan.</p>
            <a href="/#contact" style="display:inline-flex;align-items:center;font-family:'JetBrains Mono',monospace;font-size:0.75rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#000;background:#00d4ff;padding:0.85rem 2.5rem;text-decoration:none;clip-path:polygon(8px 0,100% 0,calc(100% - 8px) 100%,0 100%);transition:background 0.2s;" onmouseover="this.style.background='#33ddff'" onmouseout="this.style.background='#00d4ff'">
                Start a Conversation →
            </a>
        </div>

    </div>
</section>

@endsection
