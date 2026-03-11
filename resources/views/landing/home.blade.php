@extends('layouts.landing')

@section('title', 'CyberWraith — The All-in-One SaaS & Tech Solutions Platform')
@section('description', 'CyberWraith powers productivity tools and advanced technical solutions to help freelancers and businesses scale globally.')

@section('content')

{{-- Hero --}}
<section style="min-height:calc(100vh - 60px);display:flex;align-items:center;justify-content:center;padding:4rem 2.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 80% 60% at 50% 40%,rgba(0,30,20,0.9) 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 50% 40% at 50% 35%,rgba(0,255,136,0.05) 0%,transparent 70%);pointer-events:none;"></div>

    <div style="max-width:860px;margin:0 auto;text-align:center;position:relative;z-index:1;">

        <div style="display:flex;align-items:center;justify-content:center;gap:1rem;margin-bottom:2.5rem;">
            <div style="width:48px;height:48px;background:linear-gradient(135deg,#00ff88,#00d4ff);clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);box-shadow:0 0 40px rgba(0,255,136,0.25);flex-shrink:0;"></div>
            <span class="font-mono" style="font-size:1.6rem;font-weight:700;letter-spacing:0.25em;color:#fff;">CYBER<span style="color:#00ff88;">WRAITH</span></span>
        </div>

        <div style="display:inline-flex;align-items:center;gap:0.6rem;border:1px solid rgba(0,255,136,0.25);background:rgba(0,255,136,0.04);padding:0.35rem 1.25rem;margin-bottom:2.5rem;">
            <div style="width:6px;height:6px;border-radius:50%;background:#00ff88;box-shadow:0 0 8px #00ff88;animation:pulse 2s infinite;flex-shrink:0;"></div>
            <span class="font-mono" style="font-size:0.6rem;letter-spacing:0.25em;color:rgba(0,255,136,0.7);text-transform:uppercase;">SYSTEM ONLINE // v2.5.1</span>
        </div>

        <h1 style="font-size:clamp(2rem,5vw,4rem);font-weight:900;line-height:1.05;letter-spacing:-0.02em;color:#fff;margin-bottom:1.5rem;">
            The All-in-One<br>
            <span style="color:#00ff88;">SaaS &amp; Tech</span> Solutions Platform
        </h1>

        <p style="font-size:0.95rem;color:rgba(255,255,255,0.45);max-width:480px;margin:0 auto 2.5rem;line-height:1.7;">
            Productivity tools and advanced technical solutions for freelancers and businesses worldwide.
        </p>

        <div style="display:flex;align-items:center;justify-content:center;gap:1rem;flex-wrap:wrap;margin-bottom:4rem;">
            <a href="{{ route('register') }}" style="font-family:'JetBrains Mono',monospace;font-size:0.75rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#000;background:#00ff88;padding:0.85rem 2.25rem;text-decoration:none;transition:all 0.2s;clip-path:polygon(8px 0,100% 0,calc(100% - 8px) 100%,0 100%);display:inline-flex;align-items:center;" onmouseover="this.style.background='#00ffaa'" onmouseout="this.style.background='#00ff88'">
                Start Free Trial →
            </a>
            <a href="#tools" style="font-family:'JetBrains Mono',monospace;font-size:0.72rem;letter-spacing:0.15em;text-transform:uppercase;color:rgba(255,255,255,0.45);background:transparent;border:1px solid rgba(255,255,255,0.12);padding:0.85rem 1.75rem;text-decoration:none;transition:all 0.2s;display:inline-flex;align-items:center;" onmouseover="this.style.color='#00ff88';this.style.borderColor='rgba(0,255,136,0.3)'" onmouseout="this.style.color='rgba(255,255,255,0.45)';this.style.borderColor='rgba(255,255,255,0.12)'">
                Explore Tools
            </a>
        </div>

        @php
            $allToolsConfig = collect(config('tools'));
            $heroLiveCount  = $allToolsConfig->where('status','live')->count();
            $heroTotal      = $allToolsConfig->count();
        @endphp
        <div style="display:grid;grid-template-columns:repeat(4,1fr);border:1px solid rgba(255,255,255,0.06);background:rgba(0,0,0,0.2);">
            @foreach([[$heroLiveCount.'+','LIVE TOOLS'],[$heroTotal.'+','TOTAL TOOLS'],['14','DAY FREE TRIAL'],['100%','REMOTE READY']] as $stat)
                <div style="padding:1.25rem 1rem;text-align:center;{{ !$loop->last ? 'border-right:1px solid rgba(255,255,255,0.06);' : '' }}">
                    <div class="font-mono" style="font-size:1.5rem;font-weight:700;color:#00ff88;margin-bottom:0.3rem;">{{ $stat[0] }}</div>
                    <div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.22);letter-spacing:0.2em;">{{ $stat[1] }}</div>
                </div>
            @endforeach
        </div>
    </div>

</section>

{{-- Tools Preview --}}
<section id="tools" style="padding:6rem 2.5rem;background:rgba(0,5,10,0.85);">
    @php
        $allTools     = collect(config('tools'));
        $liveTools    = $allTools->where('status','live');
        $soonTools    = $allTools->where('status','coming_soon');
        $previewTools = $liveTools->take(5)->merge($soonTools->take(5));
        $totalCount   = $allTools->count();
    @endphp

    <div style="max-width:1200px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:3rem;">
            <div class="font-mono" style="font-size:0.62rem;color:rgba(0,255,136,0.5);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:0.875rem;">// TOOLS.getAll()</div>
            <h2 style="font-size:clamp(1.5rem,2.5vw,2.25rem);font-weight:800;color:#fff;margin-bottom:0.875rem;">Everything You Need to Scale</h2>
            <p style="color:rgba(255,255,255,0.35);max-width:480px;margin:0 auto;font-size:0.875rem;line-height:1.7;">
                {{ $totalCount }}+ tools built for freelancers, individuals and agencies. Showing a preview of 10.
            </p>
        </div>

        {{-- Filter Tabs with live counts --}}
        <div style="display:flex;align-items:center;justify-content:center;gap:0.5rem;margin-bottom:2.5rem;flex-wrap:wrap;">
            <button onclick="filterTools('all')" id="tab-all" class="font-mono" style="font-size:0.63rem;letter-spacing:0.12em;text-transform:uppercase;padding:0.4rem 1.1rem;border:1px solid rgba(0,255,136,0.4);background:rgba(0,255,136,0.08);color:#00ff88;cursor:pointer;transition:all 0.2s;">
                All <span style="opacity:0.55;">(10)</span>
            </button>
            <button onclick="filterTools('live')" id="tab-live" class="font-mono" style="font-size:0.63rem;letter-spacing:0.12em;text-transform:uppercase;padding:0.4rem 1.1rem;border:1px solid rgba(255,255,255,0.08);background:transparent;color:rgba(255,255,255,0.3);cursor:pointer;transition:all 0.2s;">
                Live <span style="opacity:0.55;">(5)</span>
            </button>
            <button onclick="filterTools('coming-soon')" id="tab-coming-soon" class="font-mono" style="font-size:0.63rem;letter-spacing:0.12em;text-transform:uppercase;padding:0.4rem 1.1rem;border:1px solid rgba(255,255,255,0.08);background:transparent;color:rgba(255,255,255,0.3);cursor:pointer;transition:all 0.2s;">
                Coming Soon <span style="opacity:0.55;">(5)</span>
            </button>
        </div>

        {{-- Tool of the Day — rotates daily --}}
        @php
            $liveToolsList = collect(config('tools'))->where('status', 'live')->values();
            $dayIndex      = (int) date('z') % $liveToolsList->count(); // day of year mod total live tools
            $toolOfTheDay  = $liveToolsList[$dayIndex];
        @endphp

        <div style="background:#0a1520;border:1px solid rgba(0,255,136,0.2);padding:1rem 1.5rem;display:flex;align-items:center;gap:1.25rem;flex-wrap:wrap;position:relative;overflow:hidden;margin-bottom:1.5rem;">
            <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#00ff88,transparent);opacity:0.6;"></div>
            <div style="display:flex;align-items:center;gap:0.5rem;flex-shrink:0;">
                <div style="width:6px;height:6px;background:#00ff88;border-radius:50%;animation:pulse-green 2s infinite;"></div>
                <span class="font-mono" style="font-size:0.55rem;color:#00ff88;letter-spacing:0.2em;text-transform:uppercase;">Tool of the Day</span>
            </div>
            <div style="flex:1;display:flex;align-items:center;gap:0.75rem;flex-wrap:wrap;">
                <span style="font-size:1.1rem;">{{ $toolOfTheDay['icon'] }}</span>
                <div>
                    <span class="font-mono" style="font-size:0.72rem;font-weight:700;color:#fff;">{{ $toolOfTheDay['name'] }}</span>
                    <span class="font-mono" style="font-size:0.65rem;color:rgba(255,255,255,0.3);margin-left:0.75rem;">{{ $toolOfTheDay['description'] }}</span>
                </div>
            </div>
            <a href="/tools/{{ $toolOfTheDay['slug'] }}" class="font-mono" style="font-size:0.6rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#000;background:#00ff88;padding:0.4rem 1rem;text-decoration:none;white-space:nowrap;transition:opacity 0.2s;flex-shrink:0;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">Try Now →</a>
        </div>

        {{-- 10 Tool Cards --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.25rem;" id="tools-grid">
            @foreach($previewTools as $tool)
            <div class="tool-card" data-status="{{ $tool['status'] }}" style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.75rem;position:relative;overflow:hidden;transition:all 0.3s;" onmouseover="this.style.borderColor='{{ $tool['color'] }}30';this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)';this.style.transform='translateY(0)'">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:{{ $tool['color'] }};opacity:0.35;"></div>

                <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:1rem;">
                    <span style="font-size:1.75rem;">{{ $tool['icon'] }}</span>
                    <div style="display:flex;flex-direction:column;align-items:flex-end;gap:0.35rem;">
                        <span class="font-mono" style="font-size:0.58rem;padding:0.18rem 0.5rem;border:1px solid {{ $tool['color'] }}30;color:{{ $tool['color'] }};letter-spacing:0.1em;text-transform:uppercase;">{{ $tool['tag'] }}</span>
                        @if($tool['status'] === 'coming_soon')
                            <span class="font-mono" style="font-size:0.55rem;padding:0.15rem 0.5rem;border:1px solid rgba(245,158,11,0.2);color:rgba(245,158,11,0.6);background:rgba(245,158,11,0.04);letter-spacing:0.1em;text-transform:uppercase;">SOON</span>
                        @else
                            <span style="display:flex;align-items:center;gap:0.3rem;font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(0,255,136,0.5);letter-spacing:0.1em;">
                                <span style="width:4px;height:4px;border-radius:50%;background:#00ff88;box-shadow:0 0 4px #00ff88;"></span> LIVE
                            </span>
                        @endif
                    </div>
                </div>

                <h3 style="font-size:1rem;font-weight:700;color:#fff;margin-bottom:0.4rem;">{{ $tool['name'] }}</h3>
                <p style="font-size:0.8rem;color:rgba(255,255,255,0.35);line-height:1.6;margin-bottom:1.25rem;">{{ $tool['description'] }}</p>

                <ul style="list-style:none;display:flex;flex-direction:column;gap:0.35rem;margin-bottom:1.25rem;">
                    @foreach($tool['features'] as $feature)
                        <li class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.25);display:flex;align-items:center;gap:0.5rem;">
                            <span style="color:{{ $tool['color'] }};flex-shrink:0;">✓</span> {{ $feature }}
                        </li>
                    @endforeach
                </ul>

                @if($tool['status'] === 'coming_soon')
                    <span class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.18);letter-spacing:0.1em;text-transform:uppercase;">In Development</span>
                @else
                    <a href="{{ route('register') }}" class="font-mono" style="font-size:0.62rem;color:{{ $tool['color'] }};text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;display:inline-flex;align-items:center;gap:0.4rem;transition:gap 0.2s;" onmouseover="this.style.gap='0.8rem'" onmouseout="this.style.gap='0.4rem'">
                        Get Access →
                    </a>
                @endif
            </div>
            @endforeach
        </div>

        {{-- View All CTA --}}
        <div style="margin-top:3rem;padding-top:2.5rem;border-top:1px solid rgba(255,255,255,0.05);text-align:center;">
            <p class="font-mono" style="font-size:0.62rem;color:rgba(255,255,255,0.2);letter-spacing:0.15em;margin-bottom:1.5rem;">
                SHOWING 10 OF {{ $totalCount }} TOOLS &nbsp;·&nbsp; {{ $soonTools->count() }} MORE IN DEVELOPMENT
            </p>
            <div style="display:flex;align-items:center;justify-content:center;gap:1rem;flex-wrap:wrap;">
                <a href="{{ route('register') }}" style="font-family:'JetBrains Mono',monospace;font-size:0.72rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#000;background:#00ff88;padding:0.75rem 2rem;text-decoration:none;transition:all 0.2s;display:inline-flex;align-items:center;gap:0.5rem;" onmouseover="this.style.background='#00ffaa'" onmouseout="this.style.background='#00ff88'">
                    ⚙ Sign Up to Access All Tools
                </a>
                <a href="{{ route('pricing') }}" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;letter-spacing:0.15em;text-transform:uppercase;color:rgba(255,255,255,0.3);border:1px solid rgba(255,255,255,0.08);padding:0.75rem 1.5rem;text-decoration:none;transition:all 0.2s;display:inline-flex;align-items:center;" onmouseover="this.style.color='#00ff88';this.style.borderColor='rgba(0,255,136,0.3)'" onmouseout="this.style.color='rgba(255,255,255,0.3)';this.style.borderColor='rgba(255,255,255,0.08)'">
                    View Pricing →
                </a>
            </div>
        </div>
    </div>
</section>

<section style="padding:0 2.5rem;position:relative;">
    <div style="max-width:1100px;margin:0 auto;">
        <div id="stats-bar" style="background:#0a1520;border:1px solid rgba(168,85,247,0.12);padding:2rem;display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:1.5rem;position:relative;overflow:hidden;">
            <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,#a855f7,#00d4ff,transparent);"></div>
            @foreach([
                ['data-target'=>'200',  'suffix'=>'+', 'label'=>'AI Tools Available',      'color'=>'#a855f7'],
                ['data-target'=>'132',  'suffix'=>'',  'label'=>'Tools Live Right Now',     'color'=>'#00d4ff'],
                ['data-target'=>'47',   'suffix'=>'+', 'label'=>'Projects Delivered',        'color'=>'#00ff88'],
                ['data-target'=>'98',   'suffix'=>'%', 'label'=>'Client Retention Rate',    'color'=>'#a855f7'],
                ['data-target'=>'2400', 'suffix'=>'K', 'label'=>'Revenue Generated ($)',    'color'=>'#00d4ff'],
            ] as $stat)
            <div style="text-align:center;">
                <div class="font-mono stat-counter" data-target="{{ $stat['data-target'] }}" style="font-size:2rem;font-weight:900;color:{{ $stat['color'] }};line-height:1;transition:all 0.3s;">0</div>
                <div style="font-size:0.85rem;font-weight:700;color:{{ $stat['color'] }};display:inline;" class="font-mono stat-suffix">{{ $stat['suffix'] }}</div>
                <div class="font-mono" style="font-size:0.52rem;color:rgba(255,255,255,0.22);letter-spacing:0.12em;text-transform:uppercase;margin-top:0.4rem;">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
(function() {
    const counters = document.querySelectorAll('.stat-counter');
    const speed = 2000;
    let animated = false;

    function animateCounters() {
        if (animated) return;
        animated = true;
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const increment = Math.ceil(target / (speed / 16));
            let current = 0;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                counter.textContent = current.toLocaleString();
            }, 16);
        });
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => { if (entry.isIntersecting) animateCounters(); });
    }, { threshold: 0.3 });

    const bar = document.getElementById('stats-bar');
    if (bar) observer.observe(bar);
})();
</script>

{{-- ============================================================
     PORTFOLIO SECTION — paste into home.blade.php
     Recommended placement: after Tools section, before Pricing
     ============================================================ --}}

<section id="portfolio" style="padding:5rem 2.5rem 6rem;position:relative;overflow:hidden;">

    {{-- Background grid --}}
    <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(168,85,247,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(168,85,247,0.03) 1px,transparent 1px);background-size:48px 48px;pointer-events:none;"></div>
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 70% 50% at 50% 100%,rgba(168,85,247,0.05) 0%,transparent 70%);pointer-events:none;"></div>

    <div style="max-width:1100px;margin:0 auto;position:relative;z-index:1;">

        {{-- Section header --}}
        <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:1.5rem;margin-bottom:3.5rem;">
            <div>
                <div class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.6);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:0.75rem;">// PORTFOLIO.render()</div>
                <h2 style="font-size:clamp(1.75rem,3vw,2.5rem);font-weight:900;color:#fff;line-height:1.1;margin:0;">Work That <span style="color:#a855f7;">Speaks for Itself</span></h2>
            </div>
            <a href="/portfolio" class="font-mono" style="font-size:0.63rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#a855f7;text-decoration:none;border:1px solid rgba(168,85,247,0.3);padding:0.5rem 1.25rem;transition:all 0.2s;white-space:nowrap;" onmouseover="this.style.background='rgba(168,85,247,0.08)';this.style.borderColor='rgba(168,85,247,0.6)'" onmouseout="this.style.background='transparent';this.style.borderColor='rgba(168,85,247,0.3)'">View All Work →</a>
        </div>

        {{-- Featured project (large) --}}
        <div style="background:#0a1520;border:1px solid rgba(168,85,247,0.15);position:relative;margin-bottom:1.25rem;display:grid;grid-template-columns:1fr 1.1fr;overflow:hidden;transition:border-color 0.3s;" onmouseover="this.style.borderColor='rgba(168,85,247,0.35)'" onmouseout="this.style.borderColor='rgba(168,85,247,0.15)'">
            <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#a855f7,#00d4ff);"></div>

            {{-- Info --}}
            <div style="padding:2.5rem;">
                <div style="display:flex;align-items:center;gap:0.6rem;margin-bottom:1.5rem;flex-wrap:wrap;">
                    <span class="font-mono" style="font-size:0.55rem;padding:0.18rem 0.6rem;background:rgba(168,85,247,0.12);border:1px solid rgba(168,85,247,0.3);color:#a855f7;letter-spacing:0.1em;text-transform:uppercase;">SaaS Product</span>
                    <span class="font-mono" style="font-size:0.55rem;padding:0.18rem 0.6rem;background:rgba(0,212,255,0.06);border:1px solid rgba(0,212,255,0.2);color:#00d4ff;letter-spacing:0.1em;text-transform:uppercase;">Featured</span>
                </div>
                <h3 style="font-size:1.4rem;font-weight:900;color:#fff;line-height:1.2;margin-bottom:0.75rem;">CyberWraith Platform</h3>
                <p style="font-size:0.82rem;color:rgba(255,255,255,0.38);line-height:1.7;margin-bottom:1.75rem;">200+ AI-powered tools built for freelancers and agencies. From cold email generation to invoice calculators — all in one dark, fast, no-fluff workspace.</p>
                <div style="display:flex;flex-wrap:wrap;gap:0.4rem;margin-bottom:1.75rem;">
                    @foreach(['Laravel', 'PostgreSQL', 'Tailwind', 'REST API'] as $tech)
                    <span class="font-mono" style="font-size:0.55rem;padding:0.15rem 0.55rem;border:1px solid rgba(255,255,255,0.08);color:rgba(255,255,255,0.3);letter-spacing:0.08em;">{{ $tech }}</span>
                    @endforeach
                </div>
                <div style="display:flex;align-items:center;gap:1.5rem;">
                    <a href="/register" class="font-mono" style="font-size:0.63rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#a855f7;padding:0.5rem 1.25rem;text-decoration:none;transition:opacity 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">Try It Free →</a>
                    <a href="/portfolio/cyberwraith-platform" class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.6);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#a855f7'" onmouseout="this.style.color='rgba(168,85,247,0.6)'">Case Study</a>
                </div>
            </div>

            {{-- Visual preview --}}
            <div style="background:rgba(168,85,247,0.04);border-left:1px solid rgba(168,85,247,0.1);padding:2rem;display:flex;flex-direction:column;gap:0.75rem;justify-content:center;min-height:280px;">
                <div class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.4);letter-spacing:0.1em;margin-bottom:0.5rem;">// dashboard.tools</div>
                @foreach([['🎯','Pitch Script Writer','Closes more deals'],['📧','Cold Email Outreach','Books 3–5 calls/wk'],['💰','Freelance Salary Planner','Know your worth'],['🔐','Security Audit Kit','Lock it down']] as $tool)
                <div style="background:#050a0f;border:1px solid rgba(255,255,255,0.04);padding:0.6rem 0.85rem;display:flex;align-items:center;gap:0.75rem;">
                    <span style="font-size:1rem;">{{ $tool[0] }}</span>
                    <div style="flex:1;">
                        <div class="font-mono" style="font-size:0.63rem;color:rgba(255,255,255,0.55);">{{ $tool[1] }}</div>
                        <div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.18);">{{ $tool[2] }}</div>
                    </div>
                    <div style="width:6px;height:6px;background:#a855f7;border-radius:50%;opacity:0.6;"></div>
                </div>
                @endforeach
                <div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.12);text-align:right;margin-top:0.25rem;">+196 more tools</div>
            </div>
        </div>

        {{-- 3-column grid --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.25rem;">

            {{-- Card: Client Web App --}}
            <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.75rem;position:relative;transition:all 0.3s;cursor:default;" onmouseover="this.style.borderColor='rgba(168,85,247,0.25)';this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)';this.style.transform='translateY(0)'">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#00d4ff;opacity:0.4;"></div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
                    <span class="font-mono" style="font-size:0.55rem;padding:0.18rem 0.55rem;border:1px solid rgba(0,212,255,0.25);color:#00d4ff;letter-spacing:0.1em;text-transform:uppercase;">Client Web App</span>
                    <span style="font-size:1.4rem;">🌐</span>
                </div>
                <h3 style="font-size:1rem;font-weight:800;color:#fff;margin-bottom:0.6rem;line-height:1.3;">Agency Booking Portal</h3>
                <p style="font-size:0.78rem;color:rgba(255,255,255,0.3);line-height:1.6;margin-bottom:1.25rem;">Custom client intake, scheduling and proposal system for a 12-person marketing agency. Reduced admin time by 60%.</p>
                <div style="display:flex;flex-wrap:wrap;gap:0.35rem;margin-bottom:1.25rem;">
                    @foreach(['Vue.js','Node.js','MySQL'] as $t)
                    <span class="font-mono" style="font-size:0.52rem;padding:0.12rem 0.45rem;border:1px solid rgba(255,255,255,0.06);color:rgba(255,255,255,0.25);">{{ $t }}</span>
                    @endforeach
                </div>
                <a href="/portfolio/agency-booking-portal" class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.6);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#a855f7'" onmouseout="this.style.color='rgba(168,85,247,0.6)'">View Case Study →</a>
            </div>

            {{-- Card: Freelance Case Study --}}
            <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.75rem;position:relative;transition:all 0.3s;cursor:default;" onmouseover="this.style.borderColor='rgba(168,85,247,0.25)';this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)';this.style.transform='translateY(0)'">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#a855f7;opacity:0.4;"></div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
                    <span class="font-mono" style="font-size:0.55rem;padding:0.18rem 0.55rem;border:1px solid rgba(168,85,247,0.25);color:#a855f7;letter-spacing:0.1em;text-transform:uppercase;">Freelance Case Study</span>
                    <span style="font-size:1.4rem;">💼</span>
                </div>
                <h3 style="font-size:1rem;font-weight:800;color:#fff;margin-bottom:0.6rem;line-height:1.3;">E-Commerce Overhaul</h3>
                <p style="font-size:0.78rem;color:rgba(255,255,255,0.3);line-height:1.6;margin-bottom:1.25rem;">End-to-end rebuild of a Shopify store for a DTC brand. Conversion rate went from 1.2% to 3.8% in 90 days post-launch.</p>
                <div style="display:flex;flex-wrap:wrap;gap:0.35rem;margin-bottom:1.25rem;">
                    @foreach(['Shopify','Liquid','Analytics'] as $t)
                    <span class="font-mono" style="font-size:0.52rem;padding:0.12rem 0.45rem;border:1px solid rgba(255,255,255,0.06);color:rgba(255,255,255,0.25);">{{ $t }}</span>
                    @endforeach
                </div>
                <a href="/portfolio/ecommerce-overhaul" class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.6);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#a855f7'" onmouseout="this.style.color='rgba(168,85,247,0.6)'">View Case Study →</a>
            </div>

            {{-- Card: CyberWraith Tool Demo --}}
            <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.75rem;position:relative;transition:all 0.3s;cursor:default;" onmouseover="this.style.borderColor='rgba(168,85,247,0.25)';this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)';this.style.transform='translateY(0)'">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#00ff88;opacity:0.35;"></div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
                    <span class="font-mono" style="font-size:0.55rem;padding:0.18rem 0.55rem;border:1px solid rgba(0,255,136,0.2);color:#00ff88;letter-spacing:0.1em;text-transform:uppercase;">Tool Demo</span>
                    <span style="font-size:1.4rem;">🤖</span>
                </div>
                <h3 style="font-size:1rem;font-weight:800;color:#fff;margin-bottom:0.6rem;line-height:1.3;">AI Pitch Script Writer</h3>
                <p style="font-size:0.78rem;color:rgba(255,255,255,0.3);line-height:1.6;margin-bottom:1.25rem;">Watch the Pitch Script Writer generate a cold outreach sequence live — from niche input to a 5-step email chain in under 10 seconds.</p>
                <div style="display:flex;flex-wrap:wrap;gap:0.35rem;margin-bottom:1.25rem;">
                    @foreach(['Claude AI','Laravel','Streaming'] as $t)
                    <span class="font-mono" style="font-size:0.52rem;padding:0.12rem 0.45rem;border:1px solid rgba(255,255,255,0.06);color:rgba(255,255,255,0.25);">{{ $t }}</span>
                    @endforeach
                </div>
                <a href="/tools/pitchscriptwriter" class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.6);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(0,255,136,0.6)'">Try the Tool →</a>
            </div>

        </div>

        {{-- Stats bar --}}
        <div style="margin-top:2rem;padding:1.5rem 2rem;background:#0a1520;border:1px solid rgba(255,255,255,0.05);display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:1.5rem;">
            @foreach([['47+','Projects Delivered'],['$2.4M','Client Revenue Generated'],['98%','Client Retention Rate'],['200+','AI Tools Built']] as $stat)
            <div style="text-align:center;">
                <div class="font-mono" style="font-size:1.4rem;font-weight:900;color:#a855f7;line-height:1;">{{ $stat[0] }}</div>
                <div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.25);letter-spacing:0.1em;text-transform:uppercase;margin-top:0.35rem;">{{ $stat[1] }}</div>
            </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ============================================================
     TESTIMONIALS SECTION — paste into home.blade.php
     Recommended placement: after Portfolio section, before Pricing
     ============================================================ --}}
<section style="padding:5rem 2.5rem 6rem;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 80% 40% at 50% 50%,rgba(168,85,247,0.04) 0%,transparent 70%);pointer-events:none;"></div>

    <div style="max-width:1100px;margin:0 auto;position:relative;z-index:1;">
        <div style="text-align:center;margin-bottom:3.5rem;">
            <div class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.6);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:0.75rem;">// USERS.speak()</div>
            <h2 style="font-size:clamp(1.75rem,3vw,2.5rem);font-weight:900;color:#fff;line-height:1.1;">What Freelancers <span style="color:#a855f7;">Actually Say</span></h2>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.25rem;">
            @foreach([
                [
                    'quote'  => 'I closed a $4,800 project using the Pitch Script Writer. Generated the email in 8 seconds, sent it, got a reply the same day. This thing is unreal.',
                    'name'   => 'Marcus D.',
                    'role'   => 'Freelance Copywriter',
                    'stars'  => 5,
                    'accent' => '#a855f7',
                ],
                [
                    'quote'  => 'Finally a tool suite that doesn\'t feel like it was designed for a Fortune 500. Dark mode, fast, no fluff. The Cold Email tool alone is worth the subscription.',
                    'name'   => 'Priya S.',
                    'role'   => 'UX Designer & Consultant',
                    'stars'  => 5,
                    'accent' => '#00d4ff',
                ],
                [
                    'quote'  => 'The Freelance Salary Planner told me I was undercharging by 40%. Raised my rate, kept all my clients. I don\'t know how I was operating without this.',
                    'name'   => 'Tom R.',
                    'role'   => 'Full-Stack Developer',
                    'stars'  => 5,
                    'accent' => '#00ff88',
                ],
                [
                    'quote'  => 'We run a 6-person agency and use CyberWraith for proposals, content briefs and client onboarding docs. It\'s saved us probably 8 hours a week across the team.',
                    'name'   => 'Leila M.',
                    'role'   => 'Agency Owner',
                    'stars'  => 5,
                    'accent' => '#a855f7',
                ],
                [
                    'quote'  => 'The Schema Markup Generator and Core Web Vitals Advisor helped me rank a client\'s site on page one in 6 weeks. My clients think I\'m a wizard.',
                    'name'   => 'Carlos F.',
                    'role'   => 'SEO Consultant',
                    'stars'  => 5,
                    'accent' => '#00d4ff',
                ],
                [
                    'quote'  => 'Incredibly polished for an early-stage product. The AI outputs actually sound like a human wrote them — not like every other AI tool that spits out garbage.',
                    'name'   => 'Sophie W.',
                    'role'   => 'Content Strategist',
                    'stars'  => 5,
                    'accent' => '#00ff88',
                ],
            ] as $t)
            <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.75rem;position:relative;transition:all 0.3s;" onmouseover="this.style.borderColor='rgba(168,85,247,0.2)';this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)';this.style.transform='translateY(0)'">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:{{ $t['accent'] }};opacity:0.3;"></div>
                {{-- Stars --}}
                <div style="display:flex;gap:0.2rem;margin-bottom:1rem;">
                    @for($i = 0; $i < $t['stars']; $i++)
                    <span style="color:{{ $t['accent'] }};font-size:0.75rem;">★</span>
                    @endfor
                </div>
                <p style="font-size:0.82rem;color:rgba(255,255,255,0.5);line-height:1.75;margin-bottom:1.25rem;font-style:italic;">"{{ $t['quote'] }}"</p>
                <div style="display:flex;align-items:center;gap:0.75rem;">
                    <div style="width:32px;height:32px;background:rgba(168,85,247,0.12);border:1px solid {{ $t['accent'] }};border-radius:50%;display:flex;align-items:center;justify-content:center;">
                        <span class="font-mono" style="font-size:0.65rem;font-weight:700;color:{{ $t['accent'] }};">{{ substr($t['name'], 0, 1) }}</span>
                    </div>
                    <div>
                        <div class="font-mono" style="font-size:0.65rem;font-weight:700;color:rgba(255,255,255,0.7);">{{ $t['name'] }}</div>
                        <div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.25);">{{ $t['role'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Services Preview --}}
<section id="services" style="padding:6rem 2.5rem;">
    <div style="max-width:1200px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:3rem;">
            <div class="font-mono" style="font-size:0.62rem;color:rgba(0,212,255,0.5);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:0.875rem;">// SERVICES.getAll()</div>
            <h2 style="font-size:clamp(1.5rem,2.5vw,2.25rem);font-weight:800;color:#fff;margin-bottom:0.875rem;">Technical Services</h2>
            <p style="color:rgba(255,255,255,0.35);max-width:440px;margin:0 auto;font-size:0.875rem;line-height:1.7;">Expert technical solutions for businesses that need more than just tools.</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:1.25rem;">
            @foreach([
                ['🌐','Web Development','Full-stack web applications and SaaS platforms built to scale.','#00d4ff'],
                ['🔒','Security Audits','Penetration testing and vulnerability assessments for your systems.','#ef4444'],
                ['🐧','Linux Administration','Server setup, hardening, and ongoing system administration.','#a855f7'],
                ['🚀','SaaS Consulting','Strategy and architecture consulting for SaaS founders.','#f59e0b'],
            ] as $service)
            <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.75rem;transition:all 0.3s;" onmouseover="this.style.borderColor='{{ $service[3] }}25';this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)';this.style.transform='translateY(0)'">
                <div style="width:40px;height:40px;background:{{ $service[3] }}12;border:1px solid {{ $service[3] }}22;display:flex;align-items:center;justify-content:center;font-size:1.1rem;margin-bottom:1.1rem;">{{ $service[0] }}</div>
                <h3 style="font-size:0.95rem;font-weight:700;color:#fff;margin-bottom:0.4rem;">{{ $service[1] }}</h3>
                <p style="font-size:0.78rem;color:rgba(255,255,255,0.32);line-height:1.6;margin-bottom:1.1rem;">{{ $service[2] }}</p>
                <a href="/services" class="font-mono" style="font-size:0.6rem;color:{{ $service[3] }};text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;display:inline-flex;align-items:center;gap:0.4rem;transition:gap 0.2s;" onmouseover="this.style.gap='0.8rem'" onmouseout="this.style.gap='0.4rem'">
                    Learn More →
                </a>
            </div>
            @endforeach
        </div>
        <div style="text-align:center;margin-top:2.5rem;">
            <a href="/services" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;letter-spacing:0.15em;text-transform:uppercase;color:rgba(255,255,255,0.35);border:1px solid rgba(255,255,255,0.08);padding:0.7rem 2rem;text-decoration:none;display:inline-flex;align-items:center;gap:0.5rem;transition:all 0.2s;" onmouseover="this.style.color='#00d4ff';this.style.borderColor='rgba(0,212,255,0.3)'" onmouseout="this.style.color='rgba(255,255,255,0.35)';this.style.borderColor='rgba(255,255,255,0.08)'">
                View All Services →
            </a>
        </div>
    </div>
</section>

<div style="padding:0 2.5rem 3rem;">
    <div style="max-width:1100px;margin:0 auto;">

        {{-- Money-back banner --}}
        <div style="background:rgba(0,255,136,0.04);border:1px solid rgba(0,255,136,0.15);padding:1.25rem 2rem;display:flex;align-items:center;gap:1.5rem;flex-wrap:wrap;margin-bottom:1.5rem;position:relative;overflow:hidden;">
            <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#00ff88,transparent);opacity:0.5;"></div>
            <span style="font-size:1.75rem;flex-shrink:0;">🛡️</span>
            <div>
                <div class="font-mono" style="font-size:0.75rem;font-weight:700;color:#00ff88;margin-bottom:0.2rem;">14-Day Money-Back Guarantee</div>
                <div class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.3);">Not happy in the first 14 days? We'll refund you — no questions asked, no forms, no chasing.</div>
            </div>
        </div>

        {{-- Trust badges --}}
        <div style="display:flex;flex-wrap:wrap;gap:1rem;align-items:center;justify-content:center;">
            @foreach([
                ['🔒', 'SSL Secured',          'All data encrypted in transit'],
                ['🚫', 'No Spam. Ever.',        'We will never sell your data'],
                ['⚡', 'Cancel Anytime',        'No lock-in, no hidden fees'],
                ['🤖', 'Powered by Claude AI',  'Anthropic\'s frontier model'],
                ['🇬🇧', 'GDPR Compliant',       'Your data, your rights'],
            ] as $badge)
            <div style="display:flex;align-items:center;gap:0.6rem;padding:0.55rem 1rem;background:#0a1520;border:1px solid rgba(255,255,255,0.06);">
                <span style="font-size:0.9rem;">{{ $badge[0] }}</span>
                <div>
                    <div class="font-mono" style="font-size:0.6rem;font-weight:700;color:rgba(255,255,255,0.55);">{{ $badge[1] }}</div>
                    <div class="font-mono" style="font-size:0.5rem;color:rgba(255,255,255,0.2);">{{ $badge[2] }}</div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>

{{-- Pricing --}}
<section id="pricing" style="padding:6rem 2.5rem;">
    <div style="max-width:1100px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:3rem;">
            <div class="font-mono" style="font-size:0.62rem;color:rgba(0,255,136,0.5);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:0.875rem;">// PRICING.getPlans()</div>
            <h2 style="font-size:clamp(1.5rem,2.5vw,2.25rem);font-weight:800;color:#fff;margin-bottom:0.875rem;">Simple, Transparent Pricing</h2>
            <p style="color:rgba(255,255,255,0.35);font-size:0.875rem;">Start free. Upgrade when you are ready.</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem;align-items:center;">
            @foreach($plans as $key => $plan)
            @php $isPopular = $key === 'pro'; @endphp
            <div style="background:#0a1520;border:1px solid {{ $isPopular ? 'rgba(0,255,136,0.3)' : 'rgba(255,255,255,0.05)' }};padding:2.25rem;position:relative;{{ $isPopular ? 'box-shadow:0 0 40px rgba(0,255,136,0.07);transform:scale(1.02);' : '' }}">
                @if($isPopular)
                    <div class="font-mono" style="position:absolute;top:0;left:50%;transform:translate(-50%,-50%);background:#00ff88;color:#000;font-size:0.55rem;font-weight:700;padding:0.2rem 1.25rem;letter-spacing:0.2em;white-space:nowrap;">MOST POPULAR</div>
                @endif
                <div class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.22);letter-spacing:0.25em;text-transform:uppercase;margin-bottom:0.875rem;">{{ $plan['name'] }}</div>
                <div style="margin-bottom:0.5rem;display:flex;align-items:baseline;gap:0.3rem;">
                    <span style="font-size:3rem;font-weight:900;color:#fff;line-height:1;">${{ $plan['price'] }}</span>
                    <span style="color:rgba(255,255,255,0.22);font-size:0.78rem;">/month</span>
                </div>
                <p style="font-size:0.78rem;color:rgba(255,255,255,0.25);margin-bottom:1.25rem;padding-bottom:1.25rem;border-bottom:1px solid rgba(255,255,255,0.05);">{{ $plan['description'] }}</p>
                <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:1.25rem;padding:0.55rem 0.875rem;background:rgba(0,255,136,0.04);border:1px solid rgba(0,255,136,0.1);">
                    <span style="font-size:0.875rem;">⚙</span>
                    <span class="font-mono" style="font-size:0.63rem;color:rgba(0,255,136,0.65);letter-spacing:0.05em;">Access to <strong style="color:#00ff88;">{{ $plan['tools'] }}</strong> tool{{ $plan['tools'] > 1 ? 's' : '' }}</span>
                </div>
                <ul style="list-style:none;display:flex;flex-direction:column;gap:0.6rem;margin-bottom:1.75rem;">
                    @foreach($plan['features'] as $feature)
                        <li class="font-mono" style="font-size:0.63rem;color:rgba(255,255,255,0.38);display:flex;align-items:flex-start;gap:0.5rem;line-height:1.4;">
                            <span style="color:#00ff88;flex-shrink:0;">✓</span> {{ $feature }}
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('register') }}" style="display:block;text-align:center;padding:0.75rem;text-decoration:none;font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;transition:all 0.2s;{{ $isPopular ? 'background:#00ff88;color:#000;' : 'border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.4);' }}" onmouseover="{{ $isPopular ? "this.style.background='#00ffaa'" : "this.style.borderColor='rgba(0,255,136,0.3)';this.style.color='#00ff88'" }}" onmouseout="{{ $isPopular ? "this.style.background='#00ff88'" : "this.style.borderColor='rgba(255,255,255,0.1)';this.style.color='rgba(255,255,255,0.4)'" }}">
                    {{ $plan['price'] == 0 ? 'Start Free →' : 'Get Started →' }}
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section style="padding:5rem 2.5rem 6rem;position:relative;">
    <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(168,85,247,0.02) 1px,transparent 1px),linear-gradient(90deg,rgba(168,85,247,0.02) 1px,transparent 1px);background-size:48px 48px;pointer-events:none;"></div>

    <div style="max-width:720px;margin:0 auto;position:relative;z-index:1;">
        <div style="text-align:center;margin-bottom:3.5rem;">
            <div class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.6);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:0.75rem;">// FAQ.getAnswers()</div>
            <h2 style="font-size:clamp(1.75rem,3vw,2.5rem);font-weight:900;color:#fff;line-height:1.1;">Questions <span style="color:#a855f7;">Answered.</span></h2>
        </div>

        <div style="display:flex;flex-direction:column;gap:0.75rem;" id="faq-list">
            @foreach([
                [
                    'q' => 'What exactly is CyberWraith?',
                    'a' => 'CyberWraith is a SaaS platform with 200+ AI-powered tools built specifically for freelancers and agencies. Think of it as your AI co-worker — it handles cold emails, proposals, invoicing, SEO audits, content creation, client research and much more, all powered by Anthropic\'s Claude AI.',
                ],
                [
                    'q' => 'Do I need any technical skills to use it?',
                    'a' => 'None. Every tool has a simple input form — you fill in the details, hit generate, and get professional output in seconds. No prompting experience required.',
                ],
                [
                    'q' => 'Which AI model powers the tools?',
                    'a' => 'All tools run on Anthropic\'s Claude Sonnet — one of the most capable and safety-focused frontier models available. We fine-tune each tool\'s prompt so outputs are specific and actionable, not generic.',
                ],
                [
                    'q' => 'Is there a free trial?',
                    'a' => 'Yes. You can sign up and access a selection of tools for free with no credit card required. When you\'re ready to unlock all 200+ tools, you can upgrade to a paid plan.',
                ],
                [
                    'q' => 'What\'s your refund policy?',
                    'a' => 'We offer a 14-day money-back guarantee on all paid plans. If you\'re not satisfied for any reason in the first 14 days, contact us and we\'ll refund you in full — no questions asked.',
                ],
                [
                    'q' => 'Can I use it for my whole agency, not just myself?',
                    'a' => 'Absolutely. Many of our users are agency owners who use CyberWraith across their whole team. Agency plan details are available on our pricing page.',
                ],
                [
                    'q' => 'How is my data handled?',
                    'a' => 'We take privacy seriously. Your inputs are sent to the Claude API for processing and are not stored or used for model training. All data in transit is SSL encrypted. We are GDPR compliant and will never sell your data.',
                ],
                [
                    'q' => 'How often are new tools added?',
                    'a' => 'We ship new tools regularly. You can follow along on our Changelog page, or subscribe to the newsletter to get notified when new tools drop.',
                ],
            ] as $i => $faq)
            <div class="faq-item" style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);overflow:hidden;transition:border-color 0.2s;">
                <button onclick="toggleFaq({{ $i }})" style="width:100%;background:none;border:none;padding:1.25rem 1.5rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;cursor:pointer;text-align:left;">
                    <span class="font-mono" style="font-size:0.78rem;font-weight:700;color:rgba(255,255,255,0.75);">{{ $faq['q'] }}</span>
                    <span id="faq-icon-{{ $i }}" style="color:#a855f7;font-size:1.1rem;flex-shrink:0;transition:transform 0.3s;font-family:monospace;">+</span>
                </button>
                <div id="faq-body-{{ $i }}" style="max-height:0;overflow:hidden;transition:max-height 0.35s ease;">
                    <div style="padding:0 1.5rem 1.25rem;">
                        <div style="height:1px;background:rgba(168,85,247,0.1);margin-bottom:1rem;"></div>
                        <p style="font-size:0.8rem;color:rgba(255,255,255,0.38);line-height:1.8;margin:0;">{{ $faq['a'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
function toggleFaq(i) {
    const body = document.getElementById('faq-body-' + i);
    const icon = document.getElementById('faq-icon-' + i);
    const isOpen = body.style.maxHeight !== '0px' && body.style.maxHeight !== '';
    // Close all
    document.querySelectorAll('[id^="faq-body-"]').forEach(el => el.style.maxHeight = '0px');
    document.querySelectorAll('[id^="faq-icon-"]').forEach(el => { el.textContent = '+'; el.style.transform = 'rotate(0deg)'; });
    // Open clicked if it was closed
    if (!isOpen) {
        body.style.maxHeight = body.scrollHeight + 'px';
        icon.textContent = '−';
    }
}
</script>

{{-- Contact --}}
<section id="contact" style="padding:6rem 2.5rem;background:rgba(0,5,10,0.85);">
    <div style="max-width:660px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:3rem;">
            <div class="font-mono" style="font-size:0.62rem;color:rgba(239,68,68,0.6);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:0.875rem;">// CONTACT.open()</div>
            <h2 style="font-size:clamp(1.5rem,2.5vw,2.25rem);font-weight:800;color:#fff;margin-bottom:0.875rem;">Get In Touch</h2>
            <p style="color:rgba(255,255,255,0.35);font-size:0.875rem;line-height:1.7;">Questions about the platform or need a consultation? We respond within 24 hours.</p>
        </div>
        @if(session('contact_success'))
            <div style="background:rgba(0,255,136,0.05);border:1px solid rgba(0,255,136,0.2);color:#00ff88;padding:2rem;text-align:center;font-family:'JetBrains Mono',monospace;font-size:0.78rem;">
                ✓ Message sent. We will get back to you within 24 hours.
            </div>
        @else
            <form method="POST" action="{{ route('contact.store') }}" style="display:flex;flex-direction:column;gap:1.25rem;">
                @csrf
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
                    <div>
                        <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(0,255,136,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="John_Doe" required style="width:100%;background:#0a1520;border:1px solid rgba(0,255,136,0.2);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.8rem;padding:0.65rem 0.875rem;outline:none;transition:border-color 0.2s;" onfocus="this.style.borderColor='rgba(0,255,136,0.5)'" onblur="this.style.borderColor='rgba(0,255,136,0.2)'">
                        @error('name')<p style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:#ef4444;margin-top:0.3rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(0,255,136,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="user@domain.com" required style="width:100%;background:#0a1520;border:1px solid rgba(0,255,136,0.2);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.8rem;padding:0.65rem 0.875rem;outline:none;transition:border-color 0.2s;" onfocus="this.style.borderColor='rgba(0,255,136,0.5)'" onblur="this.style.borderColor='rgba(0,255,136,0.2)'">
                        @error('email')<p style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:#ef4444;margin-top:0.3rem;">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(0,255,136,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">Inquiry Type</label>
                    <select name="type" style="width:100%;background:#0a1520;border:1px solid rgba(0,255,136,0.2);color:rgba(0,255,136,0.7);font-family:'JetBrains Mono',monospace;font-size:0.78rem;padding:0.65rem 2.25rem 0.65rem 0.875rem;outline:none;appearance:none;-webkit-appearance:none;cursor:pointer;background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%2300ff88' stroke-width='1.5' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:calc(100% - 0.875rem) center;">
                        <option value="saas">SaaS Tool Support</option>
                        <option value="consult">Service Consultation</option>
                        <option value="security">Security Audit Request</option>
                        <option value="dev">Web Development Project</option>
                    </select>
                </div>
                <div>
                    <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(0,255,136,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">Message</label>
                    <textarea name="message" rows="5" placeholder="Describe your project or question..." required style="width:100%;background:#0a1520;border:1px solid rgba(0,255,136,0.2);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.78rem;padding:0.65rem 0.875rem;outline:none;resize:vertical;transition:border-color 0.2s;" onfocus="this.style.borderColor='rgba(0,255,136,0.5)'" onblur="this.style.borderColor='rgba(0,255,136,0.2)'">{{ old('message') }}</textarea>
                    @error('message')<p style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:#ef4444;margin-top:0.3rem;">{{ $message }}</p>@enderror
                </div>
                <div style="display:flex;align-items:center;gap:2rem;">
                    <button type="submit" style="font-family:'JetBrains Mono',monospace;font-size:0.72rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#000;background:#00ff88;padding:0.8rem 2.25rem;border:none;cursor:pointer;transition:all 0.2s;clip-path:polygon(8px 0,100% 0,calc(100% - 8px) 100%,0 100%);" onmouseover="this.style.background='#00ffaa'" onmouseout="this.style.background='#00ff88'">
                        Send Message →
                    </button>
                    <span class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.18);letter-spacing:0.15em;">// RESPONSE WITHIN 24H</span>
                </div>
            </form>
        @endif
    </div>
</section>

<style>
@keyframes pulse { 0%,100%{opacity:1}50%{opacity:0.3} }
@keyframes pulse-green {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.4; transform: scale(1.4); }
}
</style>

<script>
function filterTools(filter) {
    const cards = document.querySelectorAll('.tool-card');
    ['all','live','coming-soon'].forEach(t => {
        const tab = document.getElementById('tab-' + t);
        if (!tab) return;
        tab.style.borderColor = 'rgba(255,255,255,0.08)';
        tab.style.background  = 'transparent';
        tab.style.color       = 'rgba(255,255,255,0.3)';
    });
    const activeTab = document.getElementById('tab-' + filter);
    if (activeTab) {
        activeTab.style.borderColor = 'rgba(0,255,136,0.4)';
        activeTab.style.background  = 'rgba(0,255,136,0.08)';
        activeTab.style.color       = '#00ff88';
    }
    cards.forEach(card => {
        const status = card.dataset.status;
        if (filter === 'all') {
            card.style.display = '';
        } else if (filter === 'live') {
            card.style.display = (status === 'live' || status === 'beta') ? '' : 'none';
        } else if (filter === 'coming-soon') {
            card.style.display = status === 'coming_soon' ? '' : 'none';
        }
    });
}
</script>

@endsection
