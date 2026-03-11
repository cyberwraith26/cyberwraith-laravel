<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CyberWraith — SaaS & Tech Solutions Platform')</title>
    <meta name="description" content="@yield('description', 'CyberWraith powers productivity tools and advanced technical solutions to help freelancers and businesses scale globally.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-green: #00ff88;
            --brand-cyan: #00d4ff;
            --brand-purple: #a855f7;
            --brand-amber: #f59e0b;
            --brand-red: #ef4444;
            --dark: #050a0f;
            --dark-100: #0a1520;
            --dark-200: #0f1e2d;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            background: var(--dark);
            color: rgba(255,255,255,0.8);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background-image:
                linear-gradient(rgba(0,255,136,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,255,136,0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }
        .font-mono { font-family: 'JetBrains Mono', monospace; }

        /* Header */
        .site-header {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 50;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2.5rem;
            transition: all 0.3s;
        }
        .site-header.scrolled {
            background: rgba(5,10,15,0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0,255,136,0.1);
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }
        .logo-hex {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, #00ff88, #00d4ff);
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
            transition: box-shadow 0.3s;
            flex-shrink: 0;
        }
        .logo:hover .logo-hex { box-shadow: 0 0 20px rgba(0,255,136,0.4); }
        .logo-text {
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.1rem;
            letter-spacing: 0.2em;
            color: #fff;
        }
        .logo-text span { color: var(--brand-green); }
        .desktop-nav {
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        .desktop-nav a {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.4);
            text-decoration: none;
            transition: color 0.2s;
        }
        .desktop-nav a:hover { color: var(--brand-green); }
        .header-actions { display: flex; align-items: center; gap: 0.75rem; }
        .btn-ghost-sm {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
            background: transparent;
            border: 1px solid rgba(255,255,255,0.1);
            padding: 0.4rem 1rem;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
        }
        .btn-ghost-sm:hover { color: var(--brand-green); border-color: rgba(0,255,136,0.3); }
        .btn-primary-sm {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #000;
            background: var(--brand-green);
            border: none;
            padding: 0.45rem 1.25rem;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            clip-path: polygon(6px 0, 100% 0, calc(100% - 6px) 100%, 0 100%);
        }
        .btn-primary-sm:hover { background: #00ffaa; }

        /* Mobile Nav Toggle */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            color: rgba(255,255,255,0.6);
            font-size: 1.25rem;
            cursor: pointer;
        }

        /* Mobile Drawer */
        .mobile-backdrop {
            display: none;
            position: fixed; inset: 0;
            z-index: 40;
            background: rgba(0,0,0,0.8);
            backdrop-filter: blur(4px);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
        }
        .mobile-drawer {
            position: fixed;
            top: 0; right: 0; bottom: 0;
            z-index: 50;
            width: 280px;
            background: var(--dark-100);
            border-left: 1px solid rgba(0,255,136,0.2);
            display: flex;
            flex-direction: column;
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }
        .mobile-drawer.open { transform: translateX(0); }
        .mobile-backdrop.open { opacity: 1; pointer-events: auto; }

        /* Main */
        main { padding-top: 60px; }

        /* Footer */
        .site-footer {
            border-top: 1px solid rgba(0,255,136,0.1);
            background: var(--dark);
            margin-top: 4rem;
        }
        .footer-main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2.5rem;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
        }
        .footer-brand p {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.35);
            line-height: 1.7;
            max-width: 280px;
            margin: 1.25rem 0;
        }
        .footer-social { display: flex; gap: 0.75rem; }
        .footer-social a {
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            border: 1px solid rgba(255,255,255,0.1);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            color: rgba(255,255,255,0.4);
            text-decoration: none;
            transition: all 0.2s;
        }
        .footer-social a:hover { color: var(--brand-green); border-color: rgba(0,255,136,0.4); }
        .footer-col-title {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(0,255,136,0.5);
            margin-bottom: 1.25rem;
        }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 0.6rem; }
        .footer-col ul a {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.4);
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-col ul a:hover { color: var(--brand-green); }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.05);
            padding: 1.25rem 2.5rem;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .footer-bottom span, .footer-bottom a {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.1em;
            color: rgba(255,255,255,0.2);
            text-decoration: none;
        }
        .footer-bottom a:hover { color: rgba(0,255,136,0.6); }
        .status-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--brand-green);
            box-shadow: 0 0 8px var(--brand-green);
            animation: pulse-glow 2s infinite;
            display: inline-block;
            margin-right: 0.4rem;
        }

        @keyframes pulse-glow {
            0%, 100% { opacity: 1; box-shadow: 0 0 8px var(--brand-green); }
            50% { opacity: 0.5; box-shadow: 0 0 4px var(--brand-green); }
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        @media (max-width: 768px) {
            .desktop-nav { display: none; }
            .header-actions { display: none; }
            .mobile-toggle { display: block; }
            .mobile-backdrop { display: block; }
            .footer-main { grid-template-columns: 1fr; gap: 2rem; }
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <header class="site-header" id="site-header">
        <a href="{{ route('home') }}" class="logo">
            <div class="logo-hex"></div>
            <span class="logo-text">CYBER<span>WRAITH</span></span>
        </a>

        <nav class="desktop-nav">
            <a href="/#tools">Tools</a>
            <a href="/pricing">Pricing</a>
            <a href="/blog">Blog</a>
            <a href="/services">Services</a>
            <a href="{{ route('changelog') }}">Changelog</a>
            <a href="/portfolio">Portfolio</a>
            <a href="/#contact">Contact</a>
        </nav>

        <div class="header-actions">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-ghost-sm">Dashboard</a>
                @if(auth()->user()->isAdmin())
                    <a href="/admin" class="btn-ghost-sm">Admin</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-ghost-sm">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-ghost-sm">Login</a>
                <a href="{{ route('register') }}" class="btn-primary-sm">Start Free</a>
            @endauth
        </div>

        <button class="mobile-toggle" onclick="toggleMobileNav()">☰</button>
    </header>

    {{-- Mobile Backdrop --}}
    <div class="mobile-backdrop" id="mobile-backdrop" onclick="toggleMobileNav()"></div>

    {{-- Mobile Drawer --}}
    <div class="mobile-drawer" id="mobile-drawer">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:1.5rem;border-bottom:1px solid rgba(255,255,255,0.05);">
            <span class="font-mono" style="font-size:0.7rem;letter-spacing:0.2em;color:var(--brand-green);">// MENU</span>
            <button onclick="toggleMobileNav()" style="background:none;border:none;color:rgba(255,255,255,0.4);cursor:pointer;font-size:1rem;">✕</button>
        </div>
        <nav style="flex:1;padding:1.5rem;display:flex;flex-direction:column;gap:0.25rem;">
            @foreach([['Tools','/#tools'],['Pricing','/pricing'],['Services','/services'],['Blog','/blog'],['Contact','/#contact']] as $i => $item)
                <a href="{{ $item[1] }}" onclick="toggleMobileNav()" class="font-mono" style="font-size:0.7rem;letter-spacing:0.15em;text-transform:uppercase;color:rgba(255,255,255,0.4);text-decoration:none;padding:0.75rem 1rem;border-left:2px solid transparent;transition:all 0.2s;" onmouseover="this.style.color='#00ff88';this.style.borderLeftColor='#00ff88'" onmouseout="this.style.color='rgba(255,255,255,0.4)';this.style.borderLeftColor='transparent'">
                    0{{ $i+1 }}. {{ $item[0] }}
                </a>
            @endforeach
        </nav>
        <div style="padding:1.5rem;border-top:1px solid rgba(255,255,255,0.05);display:flex;flex-direction:column;gap:0.75rem;">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-ghost-sm" style="justify-content:center;">Dashboard</a>
            @else
                <a href="{{ route('register') }}" class="btn-primary-sm" style="justify-content:center;clip-path:none;">Start Free Trial</a>
                <a href="{{ route('login') }}" class="btn-ghost-sm" style="justify-content:center;">Login</a>
            @endauth
        </div>
        <div style="padding:1rem 1.5rem;">
            <span class="status-dot"></span>
            <span class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.4);letter-spacing:0.15em;">SYSTEM OPERATIONAL</span>
        </div>
    </div>

    {{-- Main --}}
    <main>
        @if(session('success'))
            <div style="background:rgba(0,255,136,0.05);border-bottom:1px solid rgba(0,255,136,0.15);color:#00ff88;padding:0.75rem 2.5rem;font-family:'JetBrains Mono',monospace;font-size:0.75rem;letter-spacing:0.1em;">
                ✓ {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="site-footer">
        <div class="footer-main">
            {{-- Brand --}}
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="logo">
                    <div class="logo-hex" style="width:28px;height:28px;"></div>
                    <span class="logo-text" style="font-size:0.9rem;">CYBER<span>WRAITH</span></span>
                </a>
                <p>The all-in-one productivity and technical solutions platform for modern freelancers and businesses worldwide.</p>
                <div class="footer-social">
                    <a href="https://github.com/cyberwraith25" target="_blank">GH</a>
                    <a href="https://twitter.com/TheCyberWraithMentor" target="_blank">TW</a>
                    <a href="https://linkedin.com" target="_blank">LI</a>
                </div>
            </div>

            {{-- Platform --}}
            <div class="footer-col">
                <div class="footer-col-title">Platform</div>
                <ul>
                    <li><a href="/#tools">Tools</a></li>
                    <li><a href="/pricing">Pricing</a></li>
                    <li><a href="{{ route('register') }}">Start Free</a></li>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div class="footer-col">
                <div class="footer-col-title">Services</div>
                <ul>
                    <li><a href="/services">All Services</a></li>
                    <li><a href="/services/web-development">Web Development</a></li>
                    <li><a href="/services/security-audits">Security Audits</a></li>
                    <li><a href="/services/linux-administration">Linux Administration</a></li>
                    <li><a href="/services/saas-consulting">SaaS Consulting</a></li>
                </ul>
            </div>

            {{-- Company --}}
            <div class="footer-col">
                <div class="footer-col-title">Company</div>
                <ul>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="/#contact">Contact</a></li>
                    <li><a href="/privacy">Privacy Policy</a></li>
                    <li><a href="/terms">Terms of Service</a></li>
                    <li><a href="/cookies">Cookie Policy</a></li>
                </ul>
            </div>
        </div>

        <div style="border-top:1px solid rgba(255,255,255,0.05);">
            <div class="footer-bottom">
                <span>© {{ date('Y') }} CYBERWRAITH // ALL RIGHTS RESERVED</span>
                <div style="display:flex;gap:1.5rem;">
                    <a href="/privacy">PRIVACY</a>
                    <a href="/terms">TERMS</a>
                    <a href="/cookies">COOKIES</a>
                </div>
                <div style="display:flex;align-items:center;">
                    <span class="status-dot"></span>
                    <span class="font-mono" style="font-size:0.65rem;color:rgba(0,255,136,0.4);letter-spacing:0.1em;">STATUS: OPERATIONAL</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', () => {
            const header = document.getElementById('site-header');
            if (window.scrollY > 20) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        function toggleMobileNav() {
            const drawer = document.getElementById('mobile-drawer');
            const backdrop = document.getElementById('mobile-backdrop');
            drawer.classList.toggle('open');
            backdrop.classList.toggle('open');
        }
    </script>

    {{-- ── FLOATING CTA BAR ──────────────────────────────────────── --}}
    <div id="floating-cta" style="position:fixed;bottom:0;left:0;right:0;z-index:9000;transform:translateY(100%);transition:transform 0.4s cubic-bezier(0.16,1,0.3,1);will-change:transform;">
        <div style="background:#0a1520;border-top:1px solid rgba(168,85,247,0.25);padding:0.85rem 2rem;display:flex;align-items:center;justify-content:space-between;gap:1.5rem;flex-wrap:wrap;box-shadow:0 -8px 32px rgba(0,0,0,0.5);">
            <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#a855f7,#00d4ff,#00ff88);opacity:0.7;"></div>
            <div style="display:flex;align-items:center;gap:1rem;flex-wrap:wrap;">
                <div style="display:flex;align-items:center;gap:0.5rem;">
                    <div style="width:6px;height:6px;background:#00ff88;border-radius:50%;animation:pulse-green 2s infinite;"></div>
                    <span class="font-mono" style="font-size:0.58rem;color:#00ff88;letter-spacing:0.15em;text-transform:uppercase;">200+ Tools Live</span>
                </div>
                <span class="font-mono" style="font-size:0.78rem;font-weight:700;color:#fff;">Start free — no credit card required.</span>
            </div>
            <div style="display:flex;align-items:center;gap:0.75rem;flex-shrink:0;">
                <a href="{{ route('register') }}" class="font-mono" style="font-size:0.65rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#a855f7;padding:0.5rem 1.5rem;text-decoration:none;transition:opacity 0.2s;white-space:nowrap;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">Get Started Free →</a>
                <button onclick="dismissFloatingCta()" style="background:none;border:none;color:rgba(255,255,255,0.2);cursor:pointer;font-size:1rem;padding:0.25rem;transition:color 0.2s;line-height:1;" onmouseover="this.style.color='rgba(255,255,255,0.5)'" onmouseout="this.style.color='rgba(255,255,255,0.2)'">✕</button>
            </div>
        </div>
    </div>

    {{-- ── EXIT INTENT POPUP ─────────────────────────────────────── --}}
    <div id="exit-overlay" style="position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.75);backdrop-filter:blur(4px);display:none;align-items:center;justify-content:center;padding:2rem;">
        <div id="exit-modal" style="background:#0a1520;border:1px solid rgba(168,85,247,0.25);max-width:480px;width:100%;position:relative;transform:scale(0.9);opacity:0;transition:all 0.3s cubic-bezier(0.16,1,0.3,1);">
            <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#a855f7,#00d4ff);"></div>

            {{-- Close --}}
            <button onclick="closeExitPopup()" style="position:absolute;top:1rem;right:1rem;background:none;border:none;color:rgba(255,255,255,0.2);cursor:pointer;font-size:1.1rem;transition:color 0.2s;line-height:1;z-index:1;" onmouseover="this.style.color='rgba(255,255,255,0.5)'" onmouseout="this.style.color='rgba(255,255,255,0.2)'">✕</button>

            <div style="padding:2.5rem;">
                <div class="font-mono" style="font-size:0.58rem;color:rgba(168,85,247,0.6);letter-spacing:0.25em;text-transform:uppercase;margin-bottom:0.75rem;">// WAIT.before_you_go()</div>
                <div style="font-size:2.5rem;margin-bottom:1rem;">🚀</div>
                <h2 style="font-size:1.4rem;font-weight:900;color:#fff;line-height:1.2;margin-bottom:0.75rem;">Don't leave empty-handed.</h2>
                <p style="font-size:0.82rem;color:rgba(255,255,255,0.38);line-height:1.7;margin-bottom:1.75rem;">Get instant access to <strong style="color:#a855f7;">5 free AI tools</strong> — no credit card, no commitment. Write better pitches, emails and proposals starting today.</p>

                {{-- Offer bullets --}}
                <div style="display:flex;flex-direction:column;gap:0.5rem;margin-bottom:1.75rem;">
                    @foreach(['✓  Pitch Script Writer','✓  Cold Email Generator','✓  Proposal Builder','✓  Freelance Salary Planner','✓  Client Dossier Builder'] as $perk)
                    <div class="font-mono" style="font-size:0.65rem;color:rgba(0,255,136,0.7);">{{ $perk }}</div>
                    @endforeach
                </div>

                <a href="{{ route('register') }}" class="font-mono" style="display:block;text-align:center;font-size:0.7rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#a855f7;padding:0.75rem 1.5rem;text-decoration:none;transition:opacity 0.2s;margin-bottom:0.75rem;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                    Claim My Free Tools →
                </a>
                <button onclick="closeExitPopup()" class="font-mono" style="display:block;width:100%;text-align:center;background:none;border:none;font-size:0.6rem;color:rgba(255,255,255,0.2);cursor:pointer;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='rgba(255,255,255,0.4)'" onmouseout="this.style.color='rgba(255,255,255,0.2)'">
                    No thanks, I'll figure it out myself
                </button>
            </div>
        </div>
    </div>

    <script>
    // ── Floating CTA bar ──────────────────────────────────────────────
    (function() {
        let dismissed = sessionStorage.getItem('cta_dismissed');
        const bar = document.getElementById('floating-cta');

        if (!dismissed) {
            setTimeout(() => {
                bar.style.transform = 'translateY(0)';
            }, 4000);
        }

        window.dismissFloatingCta = function() {
            bar.style.transform = 'translateY(100%)';
            sessionStorage.setItem('cta_dismissed', '1');
        };
    })();

    // ── Exit intent popup ─────────────────────────────────────────────
    (function() {
        let shown = sessionStorage.getItem('exit_shown');
        if (shown) return;

        const overlay = document.getElementById('exit-overlay');
        const modal   = document.getElementById('exit-modal');

        function showPopup() {
            if (sessionStorage.getItem('exit_shown')) return;
            sessionStorage.setItem('exit_shown', '1');
            overlay.style.display = 'flex';
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    modal.style.transform = 'scale(1)';
                    modal.style.opacity   = '1';
                });
            });
        }

        // Desktop: mouse leaves viewport towards top
        document.addEventListener('mouseleave', function(e) {
            if (e.clientY <= 0) showPopup();
        });

        // Mobile: back button / page visibility change
        document.addEventListener('visibilitychange', function() {
            if (document.visibilityState === 'hidden') showPopup();
        });

        window.closeExitPopup = function() {
            modal.style.transform = 'scale(0.9)';
            modal.style.opacity   = '0';
            setTimeout(() => { overlay.style.display = 'none'; }, 300);
        };

        // Close on overlay click
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) closeExitPopup();
        });

        // Close on Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeExitPopup();
        });
    })();
    </script>

</body>
</html>
