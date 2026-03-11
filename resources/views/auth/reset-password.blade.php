@extends('layouts.guest')

@section('title', 'Reset Password')

@section('content')
<div style="width:100%;max-width:420px;">

    <div style="text-align:center;margin-bottom:2.5rem;">
        <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:0.75rem;">// AUTH.setNewPassword()</div>
        <h1 style="font-size:1.5rem;font-weight:800;color:#fff;margin-bottom:0.5rem;">Set New Password</h1>
        <p style="font-size:0.82rem;color:rgba(255,255,255,0.35);max-width:320px;margin:0 auto;line-height:1.6;">Choose a strong password for your account.</p>
    </div>

    <div style="background:#0a1520;border:1px solid rgba(0,255,136,0.15);padding:2.5rem;position:relative;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#00ff88,#00d4ff);opacity:0.5;"></div>

        @if($errors->any())
            <div style="background:rgba(239,68,68,0.05);border:1px solid rgba(239,68,68,0.2);color:#ef4444;padding:0.875rem 1rem;font-family:'JetBrains Mono',monospace;font-size:0.7rem;margin-bottom:1.5rem;">
                ✕ {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" style="display:flex;flex-direction:column;gap:1.25rem;">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(0,255,136,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">Email Address</label>
                <input type="email" name="email" value="{{ old('email', $email ?? '') }}" required
                    style="width:100%;background:#050a0f;border:1px solid rgba(0,255,136,0.2);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.82rem;padding:0.7rem 0.875rem;outline:none;transition:border-color 0.2s;"
                    onfocus="this.style.borderColor='rgba(0,255,136,0.5)'" onblur="this.style.borderColor='rgba(0,255,136,0.2)'">
                @error('email')
                    <p style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:#ef4444;margin-top:0.3rem;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(0,255,136,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">New Password</label>
                <div style="position:relative;">
                    <input type="password" name="password" id="rp-pw" placeholder="Min 8 characters" required
                        style="width:100%;background:#050a0f;border:1px solid rgba(0,255,136,0.2);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.82rem;padding:0.7rem 2.5rem 0.7rem 0.875rem;outline:none;transition:border-color 0.2s;"
                        onfocus="this.style.borderColor='rgba(0,255,136,0.5)'" onblur="this.style.borderColor='rgba(0,255,136,0.2)'">
                    <button type="button" onclick="togglePw('rp-pw','rp-eye')" style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:rgba(255,255,255,0.2);padding:0;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(255,255,255,0.2)'">
                        <svg id="rp-eye" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
                @error('password')
                    <p style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:#ef4444;margin-top:0.3rem;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(0,255,136,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">Confirm Password</label>
                <div style="position:relative;">
                    <input type="password" name="password_confirmation" id="rp-pw2" placeholder="Repeat password" required
                        style="width:100%;background:#050a0f;border:1px solid rgba(0,255,136,0.2);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.82rem;padding:0.7rem 2.5rem 0.7rem 0.875rem;outline:none;transition:border-color 0.2s;"
                        onfocus="this.style.borderColor='rgba(0,255,136,0.5)'" onblur="this.style.borderColor='rgba(0,255,136,0.2)'">
                    <button type="button" onclick="togglePw('rp-pw2','rp-eye2')" style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:rgba(255,255,255,0.2);padding:0;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(255,255,255,0.2)'">
                        <svg id="rp-eye2" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
            </div>

            <button type="submit" style="width:100%;background:#00ff88;color:#000;font-family:'JetBrains Mono',monospace;font-size:0.75rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.875rem;border:none;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.background='#00ffaa'" onmouseout="this.style.background='#00ff88'">
                Reset Password &rarr;
            </button>
        </form>
    </div>

    <p style="text-align:center;margin-top:1.5rem;font-family:'JetBrains Mono',monospace;font-size:0.65rem;color:rgba(255,255,255,0.2);">
        Remembered it?
        <a href="{{ route('login') }}" style="color:rgba(0,255,136,0.6);text-decoration:none;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(0,255,136,0.6)'">Back to login &rarr;</a>
    </p>
</div>

<script>
function togglePw(fieldId, iconId) {
    const f = document.getElementById(fieldId);
    const i = document.getElementById(iconId);
    if (f.type === 'password') {
        f.type = 'text';
        i.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23" stroke="currentColor" stroke-width="2"/>';
    } else {
        f.type = 'password';
        i.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
    }
}
</script>
@endsection
