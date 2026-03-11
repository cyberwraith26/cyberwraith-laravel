<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CyberWraith')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        :root { --brand-green: #00ff88; --dark: #050a0f; --dark-100: #0a1520; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: var(--dark); color: rgba(255,255,255,0.8); font-family: 'Inter', sans-serif; min-height: 100vh; display: flex; flex-direction: column;
            background-image: linear-gradient(rgba(0,255,136,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(0,255,136,0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .text-brand-green { color: var(--brand-green); }
        input {
            width: 100%;
            background: var(--dark-100);
            border: 1px solid rgba(0,255,136,0.2);
            color: #00ff88;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            padding: 0.75rem 1rem;
            outline: none;
            transition: border-color 0.2s;
        }
        input:focus { border-color: rgba(0,255,136,0.5); }
        input::placeholder { color: rgba(0,255,136,0.25); }
        label {
            display: block;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            color: rgba(0,255,136,0.6);
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }
        .btn-primary {
            width: 100%;
            background: #00ff88;
            color: #000;
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            font-size: 0.8rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            padding: 0.875rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-primary:hover { background: #00ffaa; }
        .error { font-family: 'JetBrains Mono', monospace; font-size: 0.7rem; color: #ef4444; margin-top: 0.25rem; }
    </style>
</head>
<body>
    {{-- Nav --}}
    <nav style="height:60px;display:flex;align-items:center;justify-content:space-between;padding:0 2.5rem;border-bottom:1px solid rgba(255,255,255,0.05);">
        <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:0.75rem;text-decoration:none;">
            <div style="width:28px;height:28px;background:linear-gradient(135deg,#00ff88,#00d4ff);clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);"></div>
            <span class="font-mono" style="font-size:0.9rem;letter-spacing:0.2em;color:#fff;">CYBER<span class="text-brand-green">WRAITH</span></span>
        </a>
        <div style="display:flex;align-items:center;gap:1.5rem;">
            @foreach([['Tools','/#tools'],['Pricing','/pricing'],['Blog','/blog'],['Contact','/#contact']] as $item)
                <a href="{{ $item[1] }}" class="font-mono" style="font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:rgba(255,255,255,0.3);text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(255,255,255,0.3)'">{{ $item[0] }}</a>
            @endforeach
        </div>
        <div>@yield('nav-action')</div>
    </nav>

    {{-- Content --}}
    <div style="flex:1;display:flex;align-items:center;justify-content:center;padding:3rem 1.5rem;">
        @yield('content')
    </div>
</body>
</html>
