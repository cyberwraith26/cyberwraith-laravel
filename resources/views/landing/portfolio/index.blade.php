@extends('layouts.landing')

@section('title', 'Portfolio — CyberWraith')
@section('description', 'Real projects. Real results. Browse case studies, client work, SaaS builds and AI tool demos from the CyberWraith team.')

@section('content')

{{-- Hero --}}
<section style="padding:5rem 2.5rem 3rem;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 60% 50% at 50% 0%,rgba(168,85,247,0.07) 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(168,85,247,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(168,85,247,0.03) 1px,transparent 1px);background-size:48px 48px;pointer-events:none;"></div>
    <div style="position:relative;z-index:1;max-width:640px;margin:0 auto;">
        <div class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.6);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:1rem;">// PORTFOLIO.getAll()</div>
        <h1 style="font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#fff;line-height:1.1;margin-bottom:1rem;">Built to <span style="color:#a855f7;">Perform.</span><br>Proven in the Wild.</h1>
        <p style="font-size:0.9rem;color:rgba(255,255,255,0.4);line-height:1.7;">Case studies, client work, SaaS products and live AI tool demos — everything shipped with intention and measured by results.</p>
    </div>
</section>

<section style="padding:2rem 2.5rem 6rem;">
    <div style="max-width:1100px;margin:0 auto;">

        {{-- Filter tabs --}}
        <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:3rem;flex-wrap:wrap;">
            @php $filters = ['All','Client Web Apps','SaaS Products','Freelance Case Studies','Tool Demos']; @endphp
            @foreach($filters as $i => $f)
            <button onclick="filterWork('{{ Str::slug($f) }}')" id="filter-{{ Str::slug($f) }}" class="font-mono" style="font-size:0.63rem;letter-spacing:0.12em;text-transform:uppercase;padding:0.35rem 1rem;border:1px solid {{ $i===0 ? 'rgba(168,85,247,0.4)' : 'rgba(255,255,255,0.08)' }};background:{{ $i===0 ? 'rgba(168,85,247,0.08)' : 'transparent' }};color:{{ $i===0 ? '#a855f7' : 'rgba(255,255,255,0.3)' }};cursor:pointer;transition:all 0.2s;">
                {{ $f }}
            </button>
            @endforeach
        </div>

        {{-- ── FEATURED ─────────────────────────────────── --}}
        <div class="work-card" data-type="saas-products" style="background:#0a1520;border:1px solid rgba(168,85,247,0.15);position:relative;margin-bottom:1.25rem;display:grid;grid-template-columns:1fr 1.1fr;overflow:hidden;transition:border-color 0.3s;" onmouseover="this.style.borderColor='rgba(168,85,247,0.35)'" onmouseout="this.style.borderColor='rgba(168,85,247,0.15)'">
            <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#a855f7,#00d4ff);"></div>
            <div style="padding:2.5rem;">
                <div style="display:flex;align-items:center;gap:0.6rem;margin-bottom:1.5rem;flex-wrap:wrap;">
                    <span class="font-mono" style="font-size:0.55rem;padding:0.18rem 0.6rem;background:rgba(168,85,247,0.12);border:1px solid rgba(168,85,247,0.3);color:#a855f7;letter-spacing:0.1em;text-transform:uppercase;">SaaS Product</span>
                    <span class="font-mono" style="font-size:0.55rem;padding:0.18rem 0.6rem;background:rgba(0,212,255,0.06);border:1px solid rgba(0,212,255,0.2);color:#00d4ff;letter-spacing:0.1em;text-transform:uppercase;">Featured</span>
                </div>
                <h2 style="font-size:1.5rem;font-weight:900;color:#fff;line-height:1.2;margin-bottom:0.75rem;">CyberWraith Platform</h2>
                <p style="font-size:0.85rem;color:rgba(255,255,255,0.38);line-height:1.7;margin-bottom:1rem;">200+ AI-powered tools built for freelancers and agencies. Architected from scratch on Laravel + PostgreSQL with a real-time Claude AI backend. Handles cold email generation, salary planning, SEO audits, client intelligence and more — all in one dark, fast workspace.</p>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.6rem;margin-bottom:1.5rem;">
                    @foreach([['200+','AI Tools'],['Laravel','Backend'],['Claude Sonnet','AI Engine'],['PostgreSQL','Database']] as $d)
                    <div style="background:rgba(168,85,247,0.04);border:1px solid rgba(168,85,247,0.08);padding:0.5rem 0.75rem;">
                        <div class="font-mono" style="font-size:0.75rem;font-weight:700;color:#a855f7;">{{ $d[0] }}</div>
                        <div class="font-mono" style="font-size:0.52rem;color:rgba(255,255,255,0.25);text-transform:uppercase;letter-spacing:0.08em;">{{ $d[1] }}</div>
                    </div>
                    @endforeach
                </div>
                <div style="display:flex;align-items:center;gap:1.5rem;">
                    <a href="{{ route('register') }}" class="font-mono" style="font-size:0.63rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#a855f7;padding:0.5rem 1.25rem;text-decoration:none;transition:opacity 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">Try It Free →</a>
                    <a href="/portfolio/cyberwraith-platform" class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.6);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#a855f7'" onmouseout="this.style.color='rgba(168,85,247,0.6)'">Full Case Study</a>
                </div>
            </div>
            <div style="background:rgba(168,85,247,0.04);border-left:1px solid rgba(168,85,247,0.1);padding:2rem;display:flex;flex-direction:column;gap:0.6rem;justify-content:center;">
                <div class="font-mono" style="font-size:0.58rem;color:rgba(168,85,247,0.4);margin-bottom:0.25rem;">// live.tools.sample</div>
                @foreach([['🎯','Pitch Script Writer','Sales & Outreach','live'],['📊','Client Dossier Builder','CRM & Intelligence','live'],['💰','Freelance Salary Planner','Finance','live'],['🔐','Linux Security Checklist','Security','live'],['📋','Proposal Generator','Freelancing','live']] as $row)
                <div style="background:#050a0f;border:1px solid rgba(255,255,255,0.04);padding:0.55rem 0.8rem;display:flex;align-items:center;gap:0.65rem;">
                    <span style="font-size:0.9rem;">{{ $row[0] }}</span>
                    <div style="flex:1;min-width:0;">
                        <div class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.5);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $row[1] }}</div>
                        <div class="font-mono" style="font-size:0.5rem;color:rgba(255,255,255,0.18);">{{ $row[2] }}</div>
                    </div>
                    <span class="font-mono" style="font-size:0.48rem;padding:0.1rem 0.4rem;background:rgba(0,255,136,0.08);border:1px solid rgba(0,255,136,0.2);color:#00ff88;">{{ $row[3] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ── GRID ──────────────────────────────────────── --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.25rem;margin-bottom:1.25rem;">

            {{-- Client Web App 1 --}}
            <div class="work-card" data-type="client-web-apps" style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.75rem;position:relative;transition:all 0.3s;" onmouseover="this.style.borderColor='rgba(0,212,255,0.25)';this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)';this.style.transform='translateY(0)'">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#00d4ff;opacity:0.4;"></div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
                    <span class="font-mono" style="font-size:0.55rem;padding:0.18rem 0.55rem;border:1px solid rgba(0,212,255,0.25);color:#00d4ff;letter-spacing:0.1em;text-transform:uppercase;">Client Web App</span>
                    <span style="font-size:1.3rem;">🌐</span>
                </div>
                <h3 style="font-size:1rem;font-weight:800;color:#fff;margin-bottom:0.5rem;line-height:1.3;">Agency Booking Portal</h3>
                <p style="font-size:0.78rem;color:rgba(255,255,255,0.3);line-height:1.6;margin-bottom:1rem;">Custom client intake, scheduling and proposal management system for a 12-person marketing agency. Replaced 4 separate tools with one unified platform.</p>
                <div style="display:flex;gap:0.75rem;margin-bottom:1rem;flex-wrap:wrap;">
                    <div><div class="font-mono" style="font-size:0.8rem;font-weight:700;color:#00d4ff;">60%</div><div class="font-mono" style="font-size:0.5rem;color:rgba(255,255,255,0.2);text-transform:uppercase;">Less Admin Time</div></div>
                    <div><div class="font-mono" style="font-size:0.8rem;font-weight:700;color:#00d4ff;">4→1</div><div class="font-mono" style="font-size:0.5rem;color:rgba(255,255,255,0.2);text-transform:uppercase;">Tools Consolidated</div></div>
                </div>
                <div style="display:flex;flex-wrap:wrap;gap:0.35rem;margin-bottom:1.25rem;">
                    @foreach(['Vue.js','Node.js','MySQL','AWS'] as $t)
                    <span class="font-mono" style="font-size:0.52rem;padding:0.12rem 0.45rem;border:1px solid rgba(255,255,255,0.06);color:rgba(255,255,255,0.25);">{{ $t }}</span>
                    @endforeach
                </div>
                <a href="/portfolio/agency-booking-portal" class="font-mono" style="font-size:0.6rem;color:rgba(0,212,255,0.6);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#00d4ff'" onmouseout="this.style.color='rgba(0,212,255,0.6)'">View Case Study →</a>
            </div>

            {{-- Freelance Case Study 1 --}}
            <div class="work-card" data-type="freelance-case-studies" style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.75rem;position:relative;transition:all 0.3s;" onmouseover="this.style.borderColor='rgba(168,85,247,0.25)';this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)';this.style.transform='translateY(0)'">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#a855f7;opacity:0.4;"></div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
                    <span class="font-mono" style="font-size:0.55rem;padding:0.18rem 0.55rem;border:1px solid rgba(168,85,247,0.25);color:#a855f7;letter-spacing:0.1em;text-transform:uppercase;">Case Study</span>
                    <span style="font-size:1.3rem;">📈</span>
                </div>
                <h3 style="font-size:1rem;font-weight:800;color:#fff;margin-bottom:0.5rem;line-height:1.3;">E-Commerce Overhaul</h3>
                <p style="font-size:0.78rem;color:rgba(255,255,255,0.3);line-height:1.6;margin-bottom:1rem;">End-to-end rebuild of a Shopify store for a DTC skincare brand. New UX, speed optimisation and checkout flow redesign delivered measurable revenue lift in 90 days.</p>
                <div style="display:flex;gap:0.75rem;margin-bottom:1rem;flex-wrap:wrap;">
                    <div><div class="font-mono" style="font-size:0.8rem;font-weight:700;color:#a855f7;">3.8%</div><div class="font-mono" style="font-size:0.5rem;color:rgba(255,255,255,0.2);text-transform:uppercase;">Conversion Rate</div></div>
                    <div><div class="font-mono" style="font-size:0.8rem;font-weight:700;color:#a855f7;">↑217%</div><div class="font-mono" style="font-size:0.5rem;color:rgba(255,255,255,0.2);text-transform:uppercase;">vs 1.2% Before</div></div>
                </div>
                <div style="display:flex;flex-wrap:wrap;gap:0.35rem;margin-bottom:1.25rem;">
                    @foreach(['Shopify','Liquid','GA4','CRO'] as $t)
                    <span class="font-mono" style="font-size:0.52rem;padding:0.12rem 0.45rem;border:1px solid rgba(255,255,255,0.06);color:rgba(255,255,255,0.25);">{{ $t }}</span>
                    @endforeach
                </div>
                <a href="/portfolio/ecommerce-overhaul" class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.6);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#a855f7'" onmouseout="this.style.color='rgba(168,85,247,0.6)'">View Case Study →</a>
            </div>

            {{-- Tool Demo 1 --}}
            <div class="work-card" data-type="tool-demos" style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.75rem;position:relative;transition:all 0.3s;" onmouseover="this.style.borderColor='rgba(0,255,136,0.2)';this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)';this.style.transform='translateY(0)'">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#00ff88;opacity:0.35;"></div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
                    <span class="font-mono" style="font-size:0.55rem;padding:0.18rem 0.55rem;border:1px solid rgba(0,255,136,0.2);color:#00ff88;letter-spacing:0.1em;text-transform:uppercase;">Tool Demo</span>
                    <span style="font-size:1.3rem;">🎯</span>
                </div>
                <h3 style="font-size:1rem;font-weight:800;color:#fff;margin-bottom:0.5rem;line-height:1.3;">AI Pitch Script Writer</h3>
                <p style="font-size:0.78rem;color:rgba(255,255,255,0.3);line-height:1.6;margin-bottom:1rem;">Generates a personalised cold outreach sequence — niche, pain point, offer. One of the most-used tools on the platform.</p>
                <div style="background:#050a0f;border:1px solid rgba(0,255,136,0.08);padding:0.65rem 0.85rem;margin-bottom:1.25rem;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(0,255,136,0.5);">
                    <span style="color:rgba(255,255,255,0.2);">→</span> Generating pitch for <span style="color:#00ff88;">SaaS founders</span>...<br>
                    <span style="color:rgba(255,255,255,0.2);">→</span> Subject line: <span style="color:rgba(255,255,255,0.4);">"You're leaving $X on the table"</span>
                </div>
                <a href="/tools/pitchscriptwriter" class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.6);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(0,255,136,0.6)'">Try Live →</a>
            </div>

            {{-- Client Web App 2 --}}
            <div class="work-card" data-type="client-web-apps" style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.75rem;position:relative;transition:all 0.3s;" onmouseover="this.style.borderColor='rgba(0,212,255,0.25)';this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)';this.style.transform='translateY(0)'">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#00d4ff;opacity:0.4;"></div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
                    <span class="font-mono" style="font-size:0.55rem;padding:0.18rem 0.55rem;border:1px solid rgba(0,212,255,0.25);color:#00d4ff;letter-spacing:0.1em;text-transform:uppercase;">Client Web App</span>
                    <span style="font-size:1.3rem;">🏥</span>
                </div>
                <h3 style="font-size:1rem;font-weight:800;color:#fff;margin-bottom:0.5rem;line-height:1.3;">MedSpa Client Portal</h3>
                <p style="font-size:0.78rem;color:rgba(255,255,255,0.3);line-height:1.6;margin-bottom:1rem;">Patient intake, appointment management and automated aftercare follow-up system for a boutique aesthetics clinic. HIPAA-aware data handling throughout.</p>
                <div style="display:flex;gap:0.75rem;margin-bottom:1rem;flex-wrap:wrap;">
                    <div><div class="font-mono" style="font-size:0.8rem;font-weight:700;color:#00d4ff;">40%</div><div class="font-mono" style="font-size:0.5rem;color:rgba(255,255,255,0.2);text-transform:uppercase;">No-Show Reduction</div></div>
                    <div><div class="font-mono" style="font-size:0.8rem;font-weight:700;color:#00d4ff;">4.9★</div><div class="font-mono" style="font-size:0.5rem;color:rgba(255,255,255,0.2);text-transform:uppercase;">Client Rating</div></div>
                </div>
                <div style="display:flex;flex-wrap:wrap;gap:0.35rem;margin-bottom:1.25rem;">
                    @foreach(['Laravel','Alpine.js','Twilio','Stripe'] as $t)
                    <span class="font-mono" style="font-size:0.52rem;padding:0.12rem 0.45rem;border:1px solid rgba(255,255,255,0.06);color:rgba(255,255,255,0.25);">{{ $t }}</span>
                    @endforeach
                </div>
                <a href="/portfolio/medspa-client-portal" class="font-mono" style="font-size:0.6rem;color:rgba(0,212,255,0.6);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#00d4ff'" onmouseout="this.style.color='rgba(0,212,255,0.6)'">View Case Study →</a>
            </div>

            {{-- Freelance Case Study 2 --}}
            <div class="work-card" data-type="freelance-case-studies" style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.75rem;position:relative;transition:all 0.3s;" onmouseover="this.style.borderColor='rgba(168,85,247,0.25)';this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)';this.style.transform='translateY(0)'">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#a855f7;opacity:0.4;"></div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
                    <span class="font-mono" style="font-size:0.55rem;padding:0.18rem 0.55rem;border:1px solid rgba(168,85,247,0.25);color:#a855f7;letter-spacing:0.1em;text-transform:uppercase;">Case Study</span>
                    <span style="font-size:1.3rem;">⚡</span>
                </div>
                <h3 style="font-size:1rem;font-weight:800;color:#fff;margin-bottom:0.5rem;line-height:1.3;">SaaS Onboarding Redesign</h3>
                <p style="font-size:0.78rem;color:rgba(255,255,255,0.3);line-height:1.6;margin-bottom:1rem;">Audited and rebuilt the onboarding flow for a B2B SaaS tool. Identified 3 critical drop-off points and redesigned the first-run experience from scratch.</p>
                <div style="display:flex;gap:0.75rem;margin-bottom:1rem;flex-wrap:wrap;">
                    <div><div class="font-mono" style="font-size:0.8rem;font-weight:700;color:#a855f7;">+34%</div><div class="font-mono" style="font-size:0.5rem;color:rgba(255,255,255,0.2);text-transform:uppercase;">Activation Rate</div></div>
                    <div><div class="font-mono" style="font-size:0.8rem;font-weight:700;color:#a855f7;">-48%</div><div class="font-mono" style="font-size:0.5rem;color:rgba(255,255,255,0.2);text-transform:uppercase;">Churn (90-day)</div></div>
                </div>
                <div style="display:flex;flex-wrap:wrap;gap:0.35rem;margin-bottom:1.25rem;">
                    @foreach(['React','Figma','Mixpanel','Intercom'] as $t)
                    <span class="font-mono" style="font-size:0.52rem;padding:0.12rem 0.45rem;border:1px solid rgba(255,255,255,0.06);color:rgba(255,255,255,0.25);">{{ $t }}</span>
                    @endforeach
                </div>
                <a href="/portfolio/saas-onboarding-redesign" class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.6);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#a855f7'" onmouseout="this.style.color='rgba(168,85,247,0.6)'">View Case Study →</a>
            </div>

            {{-- Tool Demo 2 --}}
            <div class="work-card" data-type="tool-demos" style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.75rem;position:relative;transition:all 0.3s;" onmouseover="this.style.borderColor='rgba(0,255,136,0.2)';this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)';this.style.transform='translateY(0)'">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#00ff88;opacity:0.35;"></div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
                    <span class="font-mono" style="font-size:0.55rem;padding:0.18rem 0.55rem;border:1px solid rgba(0,255,136,0.2);color:#00ff88;letter-spacing:0.1em;text-transform:uppercase;">Tool Demo</span>
                    <span style="font-size:1.3rem;">🔐</span>
                </div>
                <h3 style="font-size:1rem;font-weight:800;color:#fff;margin-bottom:0.5rem;line-height:1.3;">Linux Security Audit Kit</h3>
                <p style="font-size:0.78rem;color:rgba(255,255,255,0.3);line-height:1.6;margin-bottom:1rem;">Input your server setup and get a tailored hardening checklist — firewall rules, SSH config, fail2ban setup and more.</p>
                <div style="background:#050a0f;border:1px solid rgba(0,255,136,0.08);padding:0.65rem 0.85rem;margin-bottom:1.25rem;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(0,255,136,0.5);">
                    <span style="color:rgba(255,255,255,0.2);">→</span> Scanning: <span style="color:#00ff88;">Ubuntu 24.04 LTS</span><br>
                    <span style="color:rgba(255,255,255,0.2);">→</span> <span style="color:rgba(255,100,100,0.7);">⚠ SSH root login: enabled</span>
                </div>
                <a href="/tools/linuxsecurityaudit" class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.6);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(0,255,136,0.6)'">Try Live →</a>
            </div>

        </div>

        {{-- Stats bar --}}
        <div style="padding:1.75rem 2rem;background:#0a1520;border:1px solid rgba(255,255,255,0.05);display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:1.5rem;margin-bottom:3rem;">
            @foreach([['47+','Projects Delivered'],['$2.4M','Client Revenue Generated'],['98%','Client Retention Rate'],['200+','AI Tools Built']] as $stat)
            <div style="text-align:center;">
                <div class="font-mono" style="font-size:1.5rem;font-weight:900;color:#a855f7;line-height:1;">{{ $stat[0] }}</div>
                <div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.25);letter-spacing:0.1em;text-transform:uppercase;margin-top:0.35rem;">{{ $stat[1] }}</div>
            </div>
            @endforeach
        </div>

        {{-- CTA --}}
        <div style="text-align:center;padding:3rem 2rem;background:#0a1520;border:1px solid rgba(168,85,247,0.12);position:relative;overflow:hidden;">
            <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,#a855f7,transparent);"></div>
            <div class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.5);letter-spacing:0.25em;margin-bottom:0.75rem;">// NEXT_PROJECT.init()</div>
            <h3 style="font-size:1.5rem;font-weight:900;color:#fff;margin-bottom:0.75rem;">Want Results Like These?</h3>
            <p style="font-size:0.85rem;color:rgba(255,255,255,0.35);max-width:480px;margin:0 auto 2rem;line-height:1.7;">Start with CyberWraith free. 200+ AI tools to help you pitch better, deliver faster and grow your freelance business on your terms.</p>
            <a href="/register" class="font-mono" style="font-size:0.7rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#000;background:#a855f7;padding:0.75rem 2rem;text-decoration:none;display:inline-block;transition:opacity 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">Start Free Today →</a>
        </div>

    </div>
</section>

<script>
function filterWork(type) {
    const cards   = document.querySelectorAll('.work-card');
    const filters = ['all','client-web-apps','saas-products','freelance-case-studies','tool-demos'];
    filters.forEach(f => {
        const btn = document.getElementById('filter-' + f);
        if (!btn) return;
        btn.style.borderColor = 'rgba(255,255,255,0.08)';
        btn.style.background  = 'transparent';
        btn.style.color       = 'rgba(255,255,255,0.3)';
    });
    const active = document.getElementById('filter-' + type);
    if (active) {
        active.style.borderColor = 'rgba(168,85,247,0.4)';
        active.style.background  = 'rgba(168,85,247,0.08)';
        active.style.color       = '#a855f7';
    }
    cards.forEach(card => {
        if (type === 'all' || card.dataset.type === type) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

@endsection
