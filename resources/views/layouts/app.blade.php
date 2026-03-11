<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — CyberWraith</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800;900&display=swap');
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
        body { background: var(--dark); color: rgba(255,255,255,0.8); font-family: 'Inter', sans-serif; display: flex; min-height: 100vh; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }

        /* Sidebar */
        .sidebar {
            width: 220px;
            min-height: 100vh;
            background: var(--dark-100);
            border-right: 1px solid rgba(255,255,255,0.05);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 40;
        }
        .sidebar-logo {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }
        .sidebar-nav { padding: 1.5rem 0; flex: 1; }
        .sidebar-section {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.6rem;
            color: rgba(255,255,255,0.2);
            letter-spacing: 0.2em;
            text-transform: uppercase;
            padding: 0 1.25rem;
            margin-bottom: 0.5rem;
            margin-top: 1.5rem;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.6rem 1.25rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
            text-decoration: none;
            transition: all 0.2s;
            border-left: 2px solid transparent;
        }
        .sidebar-link:hover, .sidebar-link.active {
            color: #00ff88;
            background: rgba(0,255,136,0.05);
            border-left-color: #00ff88;
        }
        .sidebar-footer {
            padding: 1.25rem;
            border-top: 1px solid rgba(255,255,255,0.05);
        }
        .user-badge {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }
        .user-avatar {
            width: 32px;
            height: 32px;
            background: rgba(0,255,136,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            color: #00ff88;
            flex-shrink: 0;
        }

        /* Main content */
        .main-content {
            margin-left: 220px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Topbar */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 30;
            background: rgba(10,21,32,0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.2);
        }
        .breadcrumb .current { color: #00ff88; }

        /* Cards */
        .card {
            background: var(--dark-100);
            border: 1px solid rgba(255,255,255,0.05);
            transition: border-color 0.2s;
        }
        .card:hover { border-color: rgba(255,255,255,0.1); }

        /* Buttons */
        .btn-primary {
            background: #00ff88;
            color: #000;
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.5rem 1.25rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        .btn-primary:hover { background: #00ffaa; }
        .btn-ghost {
            background: transparent;
            color: rgba(255,255,255,0.4);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.4rem 0.875rem;
            border: 1px solid rgba(255,255,255,0.1);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        .btn-ghost:hover { color: #00ff88; border-color: rgba(0,255,136,0.3); }
        .btn-danger {
            background: transparent;
            color: #ef4444;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.4rem 0.875rem;
            border: 1px solid rgba(239,68,68,0.3);
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-danger:hover { background: rgba(239,68,68,0.1); }

        /* Alerts */
        .alert-success {
            background: rgba(0,255,136,0.05);
            border: 1px solid rgba(0,255,136,0.2);
            color: #00ff88;
            padding: 0.75rem 1rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            margin-bottom: 1.5rem;
        }
        .alert-error {
            background: rgba(239,68,68,0.05);
            border: 1px solid rgba(239,68,68,0.2);
            color: #ef4444;
            padding: 0.75rem 1rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    <aside class="sidebar">
        <a href="{{ route('home') }}" class="sidebar-logo">
            <div style="width:28px;height:28px;background:linear-gradient(135deg,#00ff88,#00d4ff);clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);flex-shrink:0;"></div>
            <span class="font-mono" style="font-size:0.8rem;letter-spacing:0.2em;color:#fff;">CYBER<span style="color:#00ff88;">WRAITH</span></span>
        </a>

        <nav class="sidebar-nav">
            <div class="sidebar-section">Navigation</div>
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span>⬡</span> Overview
            </a>
            <a href="{{ route('tools.index') }}" class="sidebar-link {{ request()->routeIs('tools.*') ? 'active' : '' }}">
                <span>⚙</span> My Tools
            </a>
            <a href="{{ route('settings.index') }}" class="sidebar-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <span>◈</span> Settings
            </a>
            <a href="{{ route('billing.index') }}" class="sidebar-link {{ request()->routeIs('billing.*') ? 'active' : '' }}">
                <span>◎</span> Billing
            </a>

            <div class="sidebar-section">My Tools</div>
            @php
                $sidebarSelected = auth()->user()->selected_tools ?? [];
                $sidebarTools    = auth()->user()->tier === 'agency'
                    ? collect(config('tools'))
                    : collect(config('tools'))->filter(fn($t) => in_array($t['slug'], $sidebarSelected));
            @endphp

            @if($sidebarTools->isEmpty())
                <div style="padding:0.5rem 1.25rem;">
                    <a href="{{ route('tools.select') }}" class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.35);text-decoration:none;letter-spacing:0.1em;line-height:1.6;">
                        + SELECT YOUR TOOLS
                    </a>
                </div>
            @else
                @foreach($sidebarTools as $tool)
                    <a href="{{ route('tools.show', $tool['slug']) }}" class="sidebar-link {{ request()->is('tools/'.$tool['slug']) ? 'active' : '' }}" style="{{ request()->is('tools/'.$tool['slug']) ? 'color:'.$tool['color'].';border-left-color:'.$tool['color'] : '' }}">
                        <span>{{ $tool['icon'] }}</span>
                        {{ $tool['name'] }}
                    </a>
                @endforeach
                <div style="padding:0.5rem 1.25rem;margin-top:0.25rem;">
                    <a href="{{ route('tools.index') }}" class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.35);text-decoration:none;letter-spacing:0.1em;">&#8594; VIEW ALL TOOLS</a>
                </div>
            @endif
        </nav>

        <div class="sidebar-footer">
            <div class="user-badge">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <div style="font-size:0.75rem;color:rgba(255,255,255,0.7);font-weight:500;">{{ auth()->user()->name }}</div>
                    <div class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.2);text-transform:uppercase;letter-spacing:0.1em;">{{ auth()->user()->tier }}</div>
                </div>
            </div>

            {{-- Admin Panel Button (admins only) --}}
            @if(auth()->user()->role === 'admin')
            <a href="/admin" target="_blank" class="font-mono" style="display:flex;align-items:center;justify-content:space-between;width:100%;font-size:0.62rem;letter-spacing:0.1em;text-transform:uppercase;color:rgba(0,255,136,0.6);text-decoration:none;margin-bottom:0.75rem;padding:0.5rem 0.625rem;border:1px solid rgba(0,255,136,0.2);background:rgba(0,255,136,0.03);transition:all 0.2s;" onmouseover="this.style.color='#00ff88';this.style.borderColor='rgba(0,255,136,0.5)';this.style.background='rgba(0,255,136,0.08)'" onmouseout="this.style.color='rgba(0,255,136,0.6)';this.style.borderColor='rgba(0,255,136,0.2)';this.style.background='rgba(0,255,136,0.03)'">
                <span style="display:flex;align-items:center;gap:0.5rem;">
                    <span style="font-size:0.7rem;">⬡</span> Admin Panel
                </span>
                <span style="font-size:0.6rem;opacity:0.5;">↗</span>
            </a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="font-mono" style="background:none;border:none;color:rgba(255,255,255,0.2);font-size:0.65rem;letter-spacing:0.1em;text-transform:uppercase;cursor:pointer;transition:color 0.2s;padding:0;" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='rgba(255,255,255,0.2)'">
                    Logout →
                </button>
            </form>
        </div>
    </aside>

    {{-- Main --}}
    <div class="main-content">
        {{-- Topbar --}}
        <header class="topbar">
            <div class="breadcrumb">
                @yield('breadcrumb')
            </div>
            <div style="display:flex;align-items:center;gap:1rem;">
                <div style="display:flex;align-items:center;gap:0.5rem;">
                    <div style="width:6px;height:6px;border-radius:50%;background:#00ff88;box-shadow:0 0 8px #00ff88;"></div>
                    <span class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.4);letter-spacing:0.15em;">ONLINE</span>
                </div>
                <div class="user-avatar" style="width:28px;height:28px;font-size:0.65rem;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </header>

        {{-- Page content --}}
        <main style="flex:1;padding:2rem;">
            @if(session('success'))
                <div class="alert-success">✓ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error">✕ {{ session('error') }}</div>
            @endif
            @yield('content')
        </main>
    </div>

</body>
</html>
