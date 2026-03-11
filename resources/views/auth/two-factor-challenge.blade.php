<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication — CyberWraith</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800&display=swap');
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #050a0f; font-family: 'Inter', sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 1.5rem; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body>

@php
    $userId = session('2fa_user_id');
    $user   = $userId ? \App\Models\User::find($userId) : null;
    $method = $user?->two_factor_method ?? 'totp';
@endphp

<div style="width:100%;max-width:420px;">

    {{-- Logo --}}
    <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:0.75rem;text-decoration:none;margin-bottom:2.5rem;justify-content:center;">
        <div style="width:28px;height:28px;background:linear-gradient(135deg,#00ff88,#00d4ff);clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);"></div>
        <span class="font-mono" style="font-size:0.9rem;letter-spacing:0.2em;color:#fff;">CYBER<span style="color:#00ff88;">WRAITH</span></span>
    </a>

    <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.06);position:relative;overflow:hidden;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#00ff88,#00d4ff);"></div>

        <div style="padding:2rem 2rem 1.5rem;">
            <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.2em;text-transform:uppercase;margin-bottom:0.5rem;">// 2FA.verify()</div>
            <h1 style="font-size:1.35rem;font-weight:800;color:#fff;margin-bottom:0.4rem;">Two-Factor Authentication</h1>
            <p style="font-size:0.8rem;color:rgba(255,255,255,0.3);line-height:1.6;">
                @if($method === 'totp')
                    Open your authenticator app and enter the 6-digit code.
                @elseif($method === 'email')
                    A 6-digit code was sent to <span style="color:#00ff88;">{{ $user?->email }}</span>.
                @elseif($method === 'sms')
                    A 6-digit code was sent to <span style="color:#00ff88;">{{ $user?->two_factor_phone }}</span>.
                @endif
            </p>
        </div>

        <div style="padding:0 2rem 2rem;">

            @if(session('resent'))
                <div style="background:rgba(0,255,136,0.05);border:1px solid rgba(0,255,136,0.2);color:#00ff88;padding:0.75rem 1rem;font-family:'JetBrains Mono',monospace;font-size:0.72rem;margin-bottom:1.25rem;">
                    ✓ {{ session('resent') }}
                </div>
            @endif

            @if($errors->any())
                <div style="background:rgba(239,68,68,0.05);border:1px solid rgba(239,68,68,0.2);color:#ef4444;padding:0.75rem 1rem;font-family:'JetBrains Mono',monospace;font-size:0.72rem;margin-bottom:1.25rem;">
                    ✕ {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('2fa.verify') }}">
                @csrf

                <div style="margin-bottom:1.5rem;">
                    <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,255,136,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.5rem;">Verification Code</label>
                    <input
                        type="text"
                        name="code"
                        maxlength="6"
                        autofocus
                        autocomplete="one-time-code"
                        inputmode="numeric"
                        placeholder="000000"
                        style="width:100%;background:#050a0f;border:1px solid rgba(255,255,255,0.08);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:1.75rem;font-weight:700;padding:1rem;outline:none;text-align:center;letter-spacing:0.4em;transition:border-color 0.2s;"
                        onfocus="this.style.borderColor='rgba(0,255,136,0.4)'"
                        onblur="this.style.borderColor='rgba(255,255,255,0.08)'"
                        oninput="this.value=this.value.replace(/\D/g,'').slice(0,6);if(this.value.length===6)this.closest('form').querySelector('[type=submit]').click();"
                    >
                </div>

                <button type="submit" style="width:100%;font-family:'JetBrains Mono',monospace;font-size:0.75rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#00ff88;padding:0.875rem;border:none;cursor:pointer;transition:background 0.2s;margin-bottom:1rem;" onmouseover="this.style.background='#00ffaa'" onmouseout="this.style.background='#00ff88'">
                    Verify &amp; Sign In
                </button>
            </form>

            {{-- Resend for email/sms --}}
            @if(in_array($method, ['email', 'sms']))
                <form method="POST" action="{{ route('2fa.resend') }}" style="text-align:center;">
                    @csrf
                    <button type="submit" class="font-mono" style="background:none;border:none;cursor:pointer;font-size:0.65rem;color:rgba(0,255,136,0.4);letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(0,255,136,0.4)'">
                        Resend Code ↺
                    </button>
                </form>
            @endif

        </div>
    </div>

    <div style="text-align:center;margin-top:1.5rem;">
        <a href="{{ route('login') }}" class="font-mono" style="font-size:0.62rem;color:rgba(255,255,255,0.2);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='rgba(255,255,255,0.5)'" onmouseout="this.style.color='rgba(255,255,255,0.2)'">
            ← Back to Login
        </a>
    </div>

</div>

</body>
</html>
