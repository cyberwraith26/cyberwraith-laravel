@extends('layouts.guest')

@section('title', 'Forgot Password')

@section('content')
<div style="width:100%;max-width:420px;">

    <div style="text-align:center;margin-bottom:2.5rem;">
        <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:0.75rem;">// AUTH.resetPassword()</div>
        <h1 style="font-size:1.5rem;font-weight:800;color:#fff;margin-bottom:0.5rem;">Reset Password</h1>
        <p style="font-size:0.82rem;color:rgba(255,255,255,0.35);max-width:320px;margin:0 auto;line-height:1.6;">Enter your email and we will send you a reset link if an account exists.</p>
    </div>

    <div style="background:#0a1520;border:1px solid rgba(0,255,136,0.15);padding:2.5rem;position:relative;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#00ff88,#00d4ff);opacity:0.5;"></div>

        @if(session('status'))
            <div style="background:rgba(0,255,136,0.05);border:1px solid rgba(0,255,136,0.2);color:#00ff88;padding:0.875rem 1rem;font-family:'JetBrains Mono',monospace;font-size:0.7rem;margin-bottom:1.5rem;line-height:1.5;">
                ✓ {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" style="display:flex;flex-direction:column;gap:1.25rem;">
            @csrf
            <div>
                <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(0,255,136,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="user@domain.com" required autofocus
                    style="width:100%;background:#050a0f;border:1px solid rgba(0,255,136,0.2);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.82rem;padding:0.7rem 0.875rem;outline:none;transition:border-color 0.2s;"
                    onfocus="this.style.borderColor='rgba(0,255,136,0.5)'" onblur="this.style.borderColor='rgba(0,255,136,0.2)'">
                @error('email')
                    <p style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:#ef4444;margin-top:0.3rem;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" style="width:100%;background:#00ff88;color:#000;font-family:'JetBrains Mono',monospace;font-size:0.75rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.875rem;border:none;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.background='#00ffaa'" onmouseout="this.style.background='#00ff88'">
                Send Reset Link →
            </button>
        </form>
    </div>

    <p style="text-align:center;margin-top:1.5rem;font-family:'JetBrains Mono',monospace;font-size:0.65rem;color:rgba(255,255,255,0.2);">
        Remembered it?
        <a href="{{ route('login') }}" style="color:rgba(0,255,136,0.6);text-decoration:none;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(0,255,136,0.6)'">Back to login →</a>
    </p>
</div>
@endsection
