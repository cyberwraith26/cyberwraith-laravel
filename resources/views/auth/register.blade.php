@extends('layouts.guest')

@section('title', 'Create Account')

@slot('nav-action')
    <a href="{{ route('login') }}" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.4);border:1px solid rgba(255,255,255,0.1);padding:0.4rem 1rem;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.color='#00ff88';this.style.borderColor='rgba(0,255,136,0.3)'" onmouseout="this.style.color='rgba(255,255,255,0.4)';this.style.borderColor='rgba(255,255,255,0.1)'">
        Login
    </a>
@endslot

@section('content')
<div style="width:100%;max-width:440px;">

    <div style="text-align:center;margin-bottom:2.5rem;">
        <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:0.75rem;">// AUTH.register()</div>
        <h1 style="font-size:2rem;font-weight:800;color:#fff;margin-bottom:0.5rem;">Create Your Account</h1>
        <p style="font-size:0.82rem;color:rgba(255,255,255,0.35);">Free plan. No credit card required.</p>
    </div>

    <div style="background:#0a1520;border:1px solid rgba(0,255,136,0.15);padding:2.5rem;position:relative;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#00ff88,#00d4ff);opacity:0.5;"></div>

        {{-- Social Buttons --}}
        <div style="display:flex;flex-direction:column;gap:0.75rem;margin-bottom:1.75rem;">
            <a href="{{ route('auth.social.redirect', 'google') }}" style="display:flex;align-items:center;justify-content:center;gap:0.75rem;padding:0.75rem;background:#050a0f;border:1px solid rgba(255,255,255,0.08);text-decoration:none;transition:all 0.2s;font-family:'JetBrains Mono',monospace;font-size:0.68rem;letter-spacing:0.1em;text-transform:uppercase;color:rgba(255,255,255,0.5);" onmouseover="this.style.borderColor='rgba(255,255,255,0.2)';this.style.color='#fff'" onmouseout="this.style.borderColor='rgba(255,255,255,0.08)';this.style.color='rgba(255,255,255,0.5)'">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Continue with Google
            </a>

            <a href="{{ route('auth.social.redirect', 'github') }}" style="display:flex;align-items:center;justify-content:center;gap:0.75rem;padding:0.75rem;background:#050a0f;border:1px solid rgba(255,255,255,0.08);text-decoration:none;transition:all 0.2s;font-family:'JetBrains Mono',monospace;font-size:0.68rem;letter-spacing:0.1em;text-transform:uppercase;color:rgba(255,255,255,0.5);" onmouseover="this.style.borderColor='rgba(255,255,255,0.2)';this.style.color='#fff'" onmouseout="this.style.borderColor='rgba(255,255,255,0.08)';this.style.color='rgba(255,255,255,0.5)'">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                </svg>
                Continue with GitHub
            </a>
        </div>

        {{-- Divider --}}
        <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.75rem;">
            <div style="flex:1;height:1px;background:rgba(255,255,255,0.06);"></div>
            <span class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.2);letter-spacing:0.15em;">OR CONTINUE WITH EMAIL</span>
            <div style="flex:1;height:1px;background:rgba(255,255,255,0.06);"></div>
        </div>

        <form method="POST" action="{{ route('register') }}" style="display:flex;flex-direction:column;gap:1.25rem;">
            @csrf

            <div>
                <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(0,255,136,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" required autofocus
                    style="width:100%;background:#050a0f;border:1px solid rgba(0,255,136,0.2);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.82rem;padding:0.7rem 0.875rem;outline:none;transition:border-color 0.2s;"
                    onfocus="this.style.borderColor='rgba(0,255,136,0.5)'" onblur="this.style.borderColor='rgba(0,255,136,0.2)'">
                @error('name')
                    <p style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:#ef4444;margin-top:0.3rem;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(0,255,136,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="user@domain.com" required
                    style="width:100%;background:#050a0f;border:1px solid rgba(0,255,136,0.2);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.82rem;padding:0.7rem 0.875rem;outline:none;transition:border-color 0.2s;"
                    onfocus="this.style.borderColor='rgba(0,255,136,0.5)'" onblur="this.style.borderColor='rgba(0,255,136,0.2)'">
                @error('email')
                    <p style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:#ef4444;margin-top:0.3rem;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(0,255,136,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">Password</label>
                <div style="position:relative;">
                    <input type="password" name="password" id="password" placeholder="Min 8 chars, upper + number" required
                        style="width:100%;background:#050a0f;border:1px solid rgba(0,255,136,0.2);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.82rem;padding:0.7rem 2.75rem 0.7rem 0.875rem;outline:none;transition:border-color 0.2s;"
                        onfocus="this.style.borderColor='rgba(0,255,136,0.5)'" onblur="this.style.borderColor='rgba(0,255,136,0.2)'">
                    <button type="button" onclick="togglePassword('password','eye-pw')" style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:rgba(0,255,136,0.4);padding:0;display:flex;align-items:center;transition:color 0.2s;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(0,255,136,0.4)'">
                        <svg id="eye-pw" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:#ef4444;margin-top:0.3rem;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(0,255,136,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">Confirm Password</label>
                <div style="position:relative;">
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" required
                        style="width:100%;background:#050a0f;border:1px solid rgba(0,255,136,0.2);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.82rem;padding:0.7rem 2.75rem 0.7rem 0.875rem;outline:none;transition:border-color 0.2s;"
                        onfocus="this.style.borderColor='rgba(0,255,136,0.5)'" onblur="this.style.borderColor='rgba(0,255,136,0.2)'">
                    <button type="button" onclick="togglePassword('password_confirmation','eye-pc')" style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:rgba(0,255,136,0.4);padding:0;display:flex;align-items:center;transition:color 0.2s;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(0,255,136,0.4)'">
                        <svg id="eye-pc" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" style="width:100%;background:#00ff88;color:#000;font-family:'JetBrains Mono',monospace;font-size:0.75rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.875rem;border:none;cursor:pointer;transition:all 0.2s;margin-top:0.25rem;" onmouseover="this.style.background='#00ffaa'" onmouseout="this.style.background='#00ff88'">
                Create Account →
            </button>

            <p style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(255,255,255,0.2);text-align:center;line-height:1.6;">
                By creating an account you agree to our
                <a href="/terms" style="color:rgba(0,255,136,0.5);text-decoration:none;">Terms</a> and
                <a href="/privacy" style="color:rgba(0,255,136,0.5);text-decoration:none;">Privacy Policy</a>.
            </p>
        </form>
    </div>

    <p style="text-align:center;margin-top:1.5rem;font-family:'JetBrains Mono',monospace;font-size:0.65rem;color:rgba(255,255,255,0.2);">
        Already have an account?
        <a href="{{ route('login') }}" style="color:rgba(0,255,136,0.6);text-decoration:none;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(0,255,136,0.6)'">Login →</a>
    </p>
</div>

<script>
function togglePassword(fieldId, iconId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(iconId);
    if (field.type === 'password') {
        field.type = 'text';
        icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23" stroke="currentColor" stroke-width="2"/>';
    } else {
        field.type = 'password';
        icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
    }
}
</script>
@endsection
