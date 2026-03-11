@extends('layouts.app')

@section('title', 'Settings')

@section('breadcrumb')
    <span>CyberWraith</span>
    <span style="color:rgba(255,255,255,0.1);">/</span>
    <span class="current">Settings</span>
@endsection

@section('content')

@php $user = auth()->user(); $isOAuth = !empty($user->provider); @endphp

<div style="margin-bottom:2rem;">
    <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.2em;text-transform:uppercase;margin-bottom:0.4rem;">// SETTINGS.open()</div>
    <h1 style="font-size:1.5rem;font-weight:800;color:#fff;">Account Settings</h1>
    <p style="font-size:0.82rem;color:rgba(255,255,255,0.3);margin-top:0.25rem;">Manage your profile, password and account preferences.</p>
</div>

<div style="max-width:900px;display:flex;flex-direction:column;gap:1.5rem;">

    {{-- Profile Card --}}
    <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.06);position:relative;overflow:hidden;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#00ff88,#00d4ff);"></div>
        <div style="padding:1.5rem 2rem;border-bottom:1px solid rgba(255,255,255,0.04);display:flex;align-items:center;gap:0.6rem;">
            <span style="color:#00ff88;">@</span>
            <span style="font-size:0.88rem;font-weight:700;color:#fff;">Profile Information</span>
        </div>
        <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data" style="padding:2rem;">
            @csrf
            @method('PUT')
            <input type="hidden" name="section" value="profile">
            <div style="display:grid;grid-template-columns:auto 1fr;gap:2rem;align-items:start;">
                <div style="display:flex;flex-direction:column;align-items:center;gap:0.75rem;">
                    <div style="position:relative;width:80px;height:80px;">
                        @if($user->avatar)
                            <img id="avatar-preview" src="{{ Storage::url($user->avatar) }}" alt="Avatar" style="width:80px;height:80px;object-fit:cover;border:2px solid rgba(0,255,136,0.25);display:block;">
                        @else
                            <div id="avatar-initials" style="width:80px;height:80px;background:rgba(0,255,136,0.08);border:2px solid rgba(0,255,136,0.2);display:flex;align-items:center;justify-content:center;font-family:'JetBrains Mono',monospace;font-size:1.75rem;font-weight:700;color:#00ff88;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <img id="avatar-preview" src="" alt="" style="width:80px;height:80px;object-fit:cover;border:2px solid rgba(0,255,136,0.25);display:none;">
                        @endif
                        <label for="avatar-input" style="position:absolute;inset:0;background:rgba(0,0,0,0.65);display:flex;flex-direction:column;align-items:center;justify-content:center;cursor:pointer;opacity:0;transition:opacity 0.2s;gap:0.25rem;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                            <span style="font-size:1.2rem;">&#128247;</span>
                            <span class="font-mono" style="font-size:0.5rem;color:#fff;letter-spacing:0.1em;">CHANGE</span>
                        </label>
                        <input type="file" id="avatar-input" name="avatar" accept="image/png,image/jpeg,image/webp" style="display:none;" onchange="previewAvatar(this)">
                    </div>
                    <span class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.2);letter-spacing:0.08em;text-align:center;">JPG, PNG, WEBP MAX 2MB</span>
                </div>
                <div style="display:flex;flex-direction:column;gap:1.25rem;">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                        <div>
                            <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,255,136,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required style="width:100%;background:#050a0f;border:1px solid rgba(255,255,255,0.08);color:#fff;font-family:'JetBrains Mono',monospace;font-size:0.8rem;padding:0.65rem 0.875rem;outline:none;transition:border-color 0.2s;" onfocus="this.style.borderColor='rgba(0,255,136,0.4)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'">
                            @error('name')<p style="font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:#ef4444;margin-top:0.3rem;">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,255,136,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required {{ $isOAuth ? 'readonly' : '' }} style="width:100%;background:#050a0f;border:1px solid rgba(255,255,255,0.08);color:{{ $isOAuth ? 'rgba(255,255,255,0.25)' : '#fff' }};font-family:'JetBrains Mono',monospace;font-size:0.8rem;padding:0.65rem 0.875rem;outline:none;transition:border-color 0.2s;" onfocus="this.style.borderColor='rgba(0,255,136,0.4)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'">
                            @if($isOAuth)<p style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(0,212,255,0.45);margin-top:0.3rem;">Managed by {{ ucfirst($user->provider) }}</p>@endif
                            @error('email')<p style="font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:#ef4444;margin-top:0.3rem;">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                        <div>
                            <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(255,255,255,0.2);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">Current Plan</label>
                            <div style="background:#050a0f;border:1px solid rgba(255,255,255,0.05);padding:0.65rem 0.875rem;display:flex;align-items:center;justify-content:space-between;">
                                <span style="font-family:'JetBrains Mono',monospace;font-size:0.8rem;color:rgba(255,255,255,0.4);text-transform:capitalize;">{{ $user->tier }}</span>
                                <a href="{{ route('billing.index') }}" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:#00ff88;text-decoration:none;letter-spacing:0.1em;">UPGRADE</a>
                            </div>
                        </div>
                        <div>
                            <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(255,255,255,0.2);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">Member Since</label>
                            <div style="background:#050a0f;border:1px solid rgba(255,255,255,0.05);padding:0.65rem 0.875rem;">
                                <span style="font-family:'JetBrains Mono',monospace;font-size:0.8rem;color:rgba(255,255,255,0.4);">{{ $user->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#00ff88;padding:0.65rem 1.75rem;border:none;cursor:pointer;transition:background 0.2s;" onmouseover="this.style.background='#00ffaa'" onmouseout="this.style.background='#00ff88'">Save Changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Password Card --}}
    <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.06);position:relative;overflow:hidden;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#a855f7,#00d4ff);"></div>
        <div style="padding:1.5rem 2rem;border-bottom:1px solid rgba(255,255,255,0.04);display:flex;align-items:center;gap:0.6rem;">
            <span style="color:#a855f7;">&#9672;</span>
            <span style="font-size:0.88rem;font-weight:700;color:#fff;">Change Password</span>
        </div>
        @if($isOAuth)
            <div style="padding:2rem;display:flex;align-items:center;gap:1.25rem;">
                <div style="width:40px;height:40px;background:rgba(168,85,247,0.08);border:1px solid rgba(168,85,247,0.15);display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0;">&#128274;</div>
                <div>
                    <p style="font-size:0.85rem;font-weight:600;color:rgba(255,255,255,0.5);margin-bottom:0.25rem;">Password managed by {{ ucfirst($user->provider) }}</p>
                    <p style="font-size:0.75rem;color:rgba(255,255,255,0.25);line-height:1.6;">You signed in with {{ ucfirst($user->provider) }}. Manage your password through {{ ucfirst($user->provider) }}.</p>
                </div>
            </div>
        @else
            <form method="POST" action="{{ route('settings.update') }}" style="padding:2rem;">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" value="password">
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:1rem;margin-bottom:1.5rem;">
                    <div>
                        <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,255,136,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">Current Password</label>
                        <div style="position:relative;">
                            <input type="password" name="current_password" id="cp" placeholder="Current" style="width:100%;background:#050a0f;border:1px solid rgba(255,255,255,0.08);color:#fff;font-family:'JetBrains Mono',monospace;font-size:0.8rem;padding:0.65rem 2.5rem 0.65rem 0.875rem;outline:none;transition:border-color 0.2s;" onfocus="this.style.borderColor='rgba(0,255,136,0.4)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'">
                            <button type="button" onclick="tp('cp','ecp')" style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:rgba(255,255,255,0.2);padding:0;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(255,255,255,0.2)'"><svg id="ecp" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button>
                        </div>
                        @error('current_password')<p style="font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:#ef4444;margin-top:0.3rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,255,136,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">New Password</label>
                        <div style="position:relative;">
                            <input type="password" name="password" id="np" placeholder="Min 8 chars" style="width:100%;background:#050a0f;border:1px solid rgba(255,255,255,0.08);color:#fff;font-family:'JetBrains Mono',monospace;font-size:0.8rem;padding:0.65rem 2.5rem 0.65rem 0.875rem;outline:none;transition:border-color 0.2s;" onfocus="this.style.borderColor='rgba(0,255,136,0.4)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'">
                            <button type="button" onclick="tp('np','enp')" style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:rgba(255,255,255,0.2);padding:0;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(255,255,255,0.2)'"><svg id="enp" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button>
                        </div>
                        @error('password')<p style="font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:#ef4444;margin-top:0.3rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,255,136,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.4rem;">Confirm Password</label>
                        <input type="password" name="password_confirmation" placeholder="Repeat" style="width:100%;background:#050a0f;border:1px solid rgba(255,255,255,0.08);color:#fff;font-family:'JetBrains Mono',monospace;font-size:0.8rem;padding:0.65rem 0.875rem;outline:none;transition:border-color 0.2s;" onfocus="this.style.borderColor='rgba(0,255,136,0.4)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'">
                    </div>
                </div>
                <button type="submit" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#fff;background:transparent;border:1px solid rgba(168,85,247,0.4);padding:0.65rem 1.75rem;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.background='rgba(168,85,247,0.1)';this.style.borderColor='rgba(168,85,247,0.7)'" onmouseout="this.style.background='transparent';this.style.borderColor='rgba(168,85,247,0.4)'">Update Password</button>
            </form>
        @endif
    </div>


    {{-- Two-Factor Authentication Card --}}
    <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.06);position:relative;overflow:hidden;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#00d4ff,#a855f7);"></div>
        <div style="padding:1.5rem 2rem;border-bottom:1px solid rgba(255,255,255,0.04);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.75rem;">
            <div style="display:flex;align-items:center;gap:0.6rem;">
                <span style="color:#00d4ff;">&#128274;</span>
                <span style="font-size:0.88rem;font-weight:700;color:#fff;">Two-Factor Authentication</span>
            </div>
            @if($user->hasTwoFactorEnabled())
                <span style="display:flex;align-items:center;gap:0.4rem;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:#00ff88;background:rgba(0,255,136,0.08);border:1px solid rgba(0,255,136,0.2);padding:0.25rem 0.75rem;letter-spacing:0.1em;">
                    <span style="width:5px;height:5px;border-radius:50%;background:#00ff88;"></span> ENABLED
                </span>
            @else
                <span style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(255,255,255,0.2);background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);padding:0.25rem 0.75rem;letter-spacing:0.1em;">DISABLED</span>
            @endif
        </div>

        <div style="padding:2rem;">

            {{-- Flash messages for 2FA --}}
            @if(session('2fa_success'))
                <div style="background:rgba(0,255,136,0.05);border:1px solid rgba(0,255,136,0.2);color:#00ff88;padding:0.75rem 1rem;font-family:'JetBrains Mono',monospace;font-size:0.72rem;margin-bottom:1.5rem;">&#10003; {{ session('2fa_success') }}</div>
            @endif
            @if(session('2fa_error'))
                <div style="background:rgba(239,68,68,0.05);border:1px solid rgba(239,68,68,0.2);color:#ef4444;padding:0.75rem 1rem;font-family:'JetBrains Mono',monospace;font-size:0.72rem;margin-bottom:1.5rem;">&#10005; {{ session('2fa_error') }}</div>
            @endif

            @if($user->hasTwoFactorEnabled())
                {{-- Currently active method --}}
                <div style="display:flex;align-items:center;gap:1rem;padding:1.25rem;background:rgba(0,255,136,0.04);border:1px solid rgba(0,255,136,0.1);margin-bottom:1.5rem;">
                    <div style="width:40px;height:40px;background:rgba(0,255,136,0.08);border:1px solid rgba(0,255,136,0.15);display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0;">
                        @if($user->two_factor_method === 'totp') &#128241;
                        @elseif($user->two_factor_method === 'email') &#128140;
                        @else &#128242;
                        @endif
                    </div>
                    <div>
                        <p style="font-size:0.85rem;font-weight:600;color:#fff;margin-bottom:0.2rem;">
                            @if($user->two_factor_method === 'totp') Authenticator App (TOTP)
                            @elseif($user->two_factor_method === 'email') Email OTP — {{ $user->email }}
                            @else SMS OTP — {{ $user->two_factor_phone }}
                            @endif
                        </p>
                        <p style="font-size:0.72rem;color:rgba(255,255,255,0.3);">Your account is protected with two-factor authentication.</p>
                    </div>
                </div>

                {{-- Disable 2FA --}}
                @if(!$isOAuth)
                <div style="border-top:1px solid rgba(255,255,255,0.04);padding-top:1.25rem;">
                    <p style="font-size:0.78rem;color:rgba(255,255,255,0.25);margin-bottom:0.875rem;">To disable 2FA, confirm your password:</p>
                    <form method="POST" action="{{ route('2fa.disable') }}" style="display:flex;gap:0.75rem;flex-wrap:wrap;align-items:flex-start;">
                        @csrf
                        <div style="flex:1;min-width:200px;">
                            <input type="password" name="password" placeholder="Your password" required
                                style="width:100%;background:#050a0f;border:1px solid rgba(255,255,255,0.08);color:#fff;font-family:'JetBrains Mono',monospace;font-size:0.78rem;padding:0.65rem 0.875rem;outline:none;transition:border-color 0.2s;"
                                onfocus="this.style.borderColor='rgba(239,68,68,0.4)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'">
                        </div>
                        <button type="submit" style="font-family:'JetBrains Mono',monospace;font-size:0.65rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#ef4444;background:transparent;border:1px solid rgba(239,68,68,0.3);padding:0.65rem 1.25rem;cursor:pointer;transition:all 0.2s;white-space:nowrap;" onmouseover="this.style.background='rgba(239,68,68,0.08)';this.style.borderColor='rgba(239,68,68,0.6)'" onmouseout="this.style.background='transparent';this.style.borderColor='rgba(239,68,68,0.3)'">
                            Disable 2FA
                        </button>
                    </form>
                </div>
                @endif

            @else
                {{-- Choose a 2FA method --}}
                <p style="font-size:0.8rem;color:rgba(255,255,255,0.3);margin-bottom:1.5rem;line-height:1.6;">Add an extra layer of security to your account. Choose a method below to get started.</p>

                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:1rem;margin-bottom:1.75rem;">

                    {{-- TOTP Card --}}
                    <div id="method-totp" class="method-card" data-method="totp" style="background:#050a0f;border:1px solid rgba(255,255,255,0.06);padding:1.25rem;cursor:pointer;transition:all 0.2s;" onclick="selectMethod('totp')">
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.75rem;">
                            <span style="font-size:1.5rem;">&#128241;</span>
                            <div id="check-totp" style="width:18px;height:18px;border-radius:50%;border:1px solid rgba(255,255,255,0.1);transition:all 0.2s;"></div>
                        </div>
                        <p style="font-size:0.82rem;font-weight:700;color:#fff;margin-bottom:0.3rem;">Authenticator App</p>
                        <p style="font-size:0.7rem;color:rgba(255,255,255,0.3);">Google Authenticator, Authy, or any TOTP app.</p>
                    </div>

                    {{-- Email OTP Card --}}
                    <div id="method-email" class="method-card" data-method="email" style="background:#050a0f;border:1px solid rgba(255,255,255,0.06);padding:1.25rem;cursor:pointer;transition:all 0.2s;" onclick="selectMethod('email')">
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.75rem;">
                            <span style="font-size:1.5rem;">&#128140;</span>
                            <div id="check-email" style="width:18px;height:18px;border-radius:50%;border:1px solid rgba(255,255,255,0.1);transition:all 0.2s;"></div>
                        </div>
                        <p style="font-size:0.82rem;font-weight:700;color:#fff;margin-bottom:0.3rem;">Email OTP</p>
                        <p style="font-size:0.7rem;color:rgba(255,255,255,0.3);">A code sent to {{ $user->email }}.</p>
                    </div>

                    {{-- SMS Card --}}
                    <div id="method-sms" class="method-card" data-method="sms" style="background:#050a0f;border:1px solid rgba(255,255,255,0.06);padding:1.25rem;cursor:pointer;transition:all 0.2s;" onclick="selectMethod('sms')">
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.75rem;">
                            <span style="font-size:1.5rem;">&#128242;</span>
                            <div id="check-sms" style="width:18px;height:18px;border-radius:50%;border:1px solid rgba(255,255,255,0.1);transition:all 0.2s;"></div>
                        </div>
                        <p style="font-size:0.82rem;font-weight:700;color:#fff;margin-bottom:0.3rem;">SMS OTP</p>
                        <p style="font-size:0.7rem;color:rgba(255,255,255,0.3);">A code sent to your phone number.</p>
                    </div>

                </div>

                {{-- TOTP Setup Panel --}}
                <div id="panel-totp" style="display:none;border:1px solid rgba(0,212,255,0.15);padding:1.5rem;margin-bottom:1rem;background:rgba(0,212,255,0.02);">
                    <p class="font-mono" style="font-size:0.6rem;color:rgba(0,212,255,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:1rem;">STEP 1 — Scan QR Code</p>
                    <div id="qr-container" style="display:flex;gap:1.5rem;align-items:flex-start;flex-wrap:wrap;margin-bottom:1.25rem;">
                        <div id="qr-loading" style="width:140px;height:140px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;">
                            <span class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.2);">Loading...</span>
                        </div>
                        <div id="qr-loaded" style="display:none;">
                            <img id="qr-image" src="" alt="QR Code" style="width:140px;height:140px;border:2px solid rgba(0,212,255,0.2);">
                        </div>
                        <div>
                            <p style="font-size:0.75rem;color:rgba(255,255,255,0.4);line-height:1.7;margin-bottom:0.75rem;">1. Open your authenticator app<br>2. Tap "+" or "Add Account"<br>3. Scan the QR code</p>
                            <p style="font-size:0.65rem;color:rgba(255,255,255,0.2);margin-bottom:0.4rem;">Or enter this key manually:</p>
                            <code id="totp-secret" style="font-family:'JetBrains Mono',monospace;font-size:0.7rem;color:#00d4ff;background:rgba(0,212,255,0.06);padding:0.3rem 0.6rem;letter-spacing:0.1em;border:1px solid rgba(0,212,255,0.15);">Loading...</code>
                        </div>
                    </div>
                    <p class="font-mono" style="font-size:0.6rem;color:rgba(0,212,255,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.75rem;">STEP 2 — Confirm with code</p>
                    <form method="POST" action="{{ route('2fa.totp.confirm') }}" style="display:flex;gap:0.75rem;flex-wrap:wrap;align-items:flex-start;">
                        @csrf
                        <input type="text" name="code" maxlength="6" inputmode="numeric" placeholder="6-digit code" required
                            style="width:160px;background:#050a0f;border:1px solid rgba(255,255,255,0.08);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:1.1rem;font-weight:700;padding:0.65rem 0.875rem;outline:none;text-align:center;letter-spacing:0.3em;transition:border-color 0.2s;"
                            onfocus="this.style.borderColor='rgba(0,212,255,0.4)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'">
                        <button type="submit" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#00d4ff;padding:0.7rem 1.5rem;border:none;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">Activate</button>
                    </form>
                </div>

                {{-- Email OTP Setup Panel --}}
                <div id="panel-email" style="display:none;border:1px solid rgba(0,212,255,0.15);padding:1.5rem;margin-bottom:1rem;background:rgba(0,212,255,0.02);">
                    @if(session('2fa_success') && str_contains(session('2fa_success',''), 'sent to'))
                        {{-- Confirm step --}}
                        <p class="font-mono" style="font-size:0.6rem;color:rgba(0,212,255,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.75rem;">ENTER CONFIRMATION CODE</p>
                        <form method="POST" action="{{ route('2fa.email.confirm') }}" style="display:flex;gap:0.75rem;flex-wrap:wrap;align-items:flex-start;">
                            @csrf
                            <input type="text" name="code" maxlength="6" inputmode="numeric" placeholder="6-digit code" autofocus required
                                style="width:160px;background:#050a0f;border:1px solid rgba(255,255,255,0.08);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:1.1rem;font-weight:700;padding:0.65rem 0.875rem;outline:none;text-align:center;letter-spacing:0.3em;"
                                onfocus="this.style.borderColor='rgba(0,212,255,0.4)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'">
                            <button type="submit" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#00d4ff;padding:0.7rem 1.5rem;border:none;cursor:pointer;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">Confirm</button>
                        </form>
                    @else
                        <p style="font-size:0.78rem;color:rgba(255,255,255,0.4);margin-bottom:1rem;">We'll send a 6-digit code to <span style="color:#00d4ff;">{{ $user->email }}</span> to verify.</p>
                        <form method="POST" action="{{ route('2fa.email.setup') }}">
                            @csrf
                            <button type="submit" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#00d4ff;padding:0.7rem 1.5rem;border:none;cursor:pointer;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">Send Code</button>
                        </form>
                    @endif
                </div>

                {{-- SMS OTP Setup Panel --}}
                <div id="panel-sms" style="display:none;border:1px solid rgba(0,212,255,0.15);padding:1.5rem;margin-bottom:1rem;background:rgba(0,212,255,0.02);">
                    @if(session('2fa_success') && str_contains(session('2fa_success',''), 'sent to') && $user->two_factor_method === 'sms')
                        <p class="font-mono" style="font-size:0.6rem;color:rgba(0,212,255,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.75rem;">ENTER CONFIRMATION CODE</p>
                        <form method="POST" action="{{ route('2fa.sms.confirm') }}" style="display:flex;gap:0.75rem;flex-wrap:wrap;align-items:flex-start;">
                            @csrf
                            <input type="text" name="code" maxlength="6" inputmode="numeric" placeholder="6-digit code" autofocus required
                                style="width:160px;background:#050a0f;border:1px solid rgba(255,255,255,0.08);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:1.1rem;font-weight:700;padding:0.65rem 0.875rem;outline:none;text-align:center;letter-spacing:0.3em;"
                                onfocus="this.style.borderColor='rgba(0,212,255,0.4)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'">
                            <button type="submit" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#00d4ff;padding:0.7rem 1.5rem;border:none;cursor:pointer;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">Confirm</button>
                        </form>
                    @else
                        <p style="font-size:0.78rem;color:rgba(255,255,255,0.4);margin-bottom:1rem;">Enter your phone number to receive a verification code via SMS.</p>
                        <form method="POST" action="{{ route('2fa.sms.setup') }}" style="display:flex;gap:0.75rem;flex-wrap:wrap;align-items:flex-start;">
                            @csrf
                            <input type="tel" name="phone" placeholder="+1234567890" required
                                style="width:200px;background:#050a0f;border:1px solid rgba(255,255,255,0.08);color:#fff;font-family:'JetBrains Mono',monospace;font-size:0.8rem;padding:0.65rem 0.875rem;outline:none;transition:border-color 0.2s;"
                                onfocus="this.style.borderColor='rgba(0,212,255,0.4)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'">
                            <button type="submit" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#00d4ff;padding:0.7rem 1.5rem;border:none;cursor:pointer;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">Send Code</button>
                        </form>
                    @endif
                </div>

            @endif
        </div>
    </div>

    {{-- Danger Zone --}}
    <div style="background:#0a1520;border:1px solid rgba(239,68,68,0.12);position:relative;overflow:hidden;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#ef4444;opacity:0.4;"></div>
        <div style="padding:1.5rem 2rem;border-bottom:1px solid rgba(239,68,68,0.06);display:flex;align-items:center;gap:0.6rem;">
            <span style="color:#ef4444;">&#9888;</span>
            <span style="font-size:0.88rem;font-weight:700;color:#ef4444;">Danger Zone</span>
        </div>
        <div style="padding:2rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
            <div>
                <p style="font-size:0.85rem;font-weight:600;color:rgba(255,255,255,0.5);margin-bottom:0.25rem;">Delete Account</p>
                <p style="font-size:0.75rem;color:rgba(255,255,255,0.25);line-height:1.6;max-width:480px;">Permanently delete your account and all associated data. This action cannot be undone and your subscription will be cancelled immediately.</p>
            </div>
            <button onclick="openDeleteModal()" style="font-family:'JetBrains Mono',monospace;font-size:0.65rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#ef4444;background:transparent;border:1px solid rgba(239,68,68,0.3);padding:0.65rem 1.5rem;cursor:pointer;transition:all 0.2s;white-space:nowrap;" onmouseover="this.style.background='rgba(239,68,68,0.08)';this.style.borderColor='rgba(239,68,68,0.6)'" onmouseout="this.style.background='transparent';this.style.borderColor='rgba(239,68,68,0.3)'">Delete My Account</button>
            <form id="delete-form" method="POST" action="{{ route('settings.destroy') }}" style="display:none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

</div>

{{-- Delete Modal --}}
<div id="delete-modal" style="display:none;position:fixed;inset:0;z-index:999;align-items:center;justify-content:center;padding:1.5rem;">
    <div onclick="closeDeleteModal()" style="position:absolute;inset:0;background:rgba(0,0,0,0.88);backdrop-filter:blur(8px);"></div>
    <div style="position:relative;z-index:1;background:#0a1520;border:1px solid rgba(239,68,68,0.35);width:100%;max-width:460px;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#ef4444;"></div>

        <div style="padding:1.75rem 2rem;border-bottom:1px solid rgba(239,68,68,0.08);display:flex;align-items:center;justify-content:space-between;">
            <div style="display:flex;align-items:center;gap:0.875rem;">
                <div style="width:38px;height:38px;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);display:flex;align-items:center;justify-content:center;font-size:1.1rem;">&#9888;</div>
                <div>
                    <h3 style="font-size:1rem;font-weight:800;color:#fff;margin-bottom:0.15rem;">Delete Account</h3>
                    <p class="font-mono" style="font-size:0.55rem;color:rgba(239,68,68,0.5);letter-spacing:0.15em;text-transform:uppercase;">IRREVERSIBLE ACTION</p>
                </div>
            </div>
            <button onclick="closeDeleteModal()" style="background:none;border:none;color:rgba(255,255,255,0.3);cursor:pointer;font-size:1.1rem;padding:0.25rem;line-height:1;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.3)'">&#10005;</button>
        </div>

        <div style="padding:1.75rem 2rem;">
            <p style="font-size:0.85rem;color:rgba(255,255,255,0.45);line-height:1.7;margin-bottom:1.25rem;">
                You are about to permanently delete <strong style="color:#fff;">{{ $user->name }}</strong>'s account. The following will happen immediately:
            </p>
            <div style="display:flex;flex-direction:column;gap:0.5rem;margin-bottom:1.75rem;padding:1rem;background:rgba(239,68,68,0.04);border:1px solid rgba(239,68,68,0.08);">
                @foreach(['Your account and profile will be permanently deleted','Your active subscription will be cancelled','All tool access will be revoked immediately','Saved data and history will be erased'] as $item)
                <div style="display:flex;align-items:center;gap:0.6rem;font-family:'JetBrains Mono',monospace;font-size:0.62rem;color:rgba(255,255,255,0.3);">
                    <span style="color:#ef4444;flex-shrink:0;">&#10005;</span> {{ $item }}
                </div>
                @endforeach
            </div>

            <div style="margin-bottom:1.5rem;">
                <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(239,68,68,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.5rem;">Type <strong style="color:#ef4444;">DELETE</strong> to confirm</label>
                <input type="text" id="delete-confirm-input" placeholder="Type DELETE here" autocomplete="off" oninput="checkDeleteInput(this)"
                    style="width:100%;background:#050a0f;border:1px solid rgba(239,68,68,0.2);color:#ef4444;font-family:'JetBrains Mono',monospace;font-size:0.85rem;padding:0.7rem 0.875rem;outline:none;letter-spacing:0.15em;transition:border-color 0.2s;"
                    onfocus="this.style.borderColor='rgba(239,68,68,0.5)'" onblur="this.style.borderColor='rgba(239,68,68,0.2)'">
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;">
                <button onclick="closeDeleteModal()" type="button" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.5);background:transparent;border:1px solid rgba(255,255,255,0.1);padding:0.8rem;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(255,255,255,0.3)';this.style.color='#fff'" onmouseout="this.style.borderColor='rgba(255,255,255,0.1)';this.style.color='rgba(255,255,255,0.5)'">Cancel</button>
                <button id="delete-confirm-btn" onclick="submitDelete()" type="button" disabled style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:rgba(239,68,68,0.25);background:rgba(239,68,68,0.04);border:1px solid rgba(239,68,68,0.1);padding:0.8rem;cursor:not-allowed;transition:all 0.3s;">Delete My Account</button>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fadeIn { from { opacity:0; transform:translateY(-12px); } to { opacity:1; transform:translateY(0); } }
</style>

<script>
// ── Delete modal ──────────────────────────────────────────────
function openDeleteModal() {
    const modal = document.getElementById('delete-modal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    document.getElementById('delete-confirm-input').value = '';
    resetDeleteBtn();
}
function closeDeleteModal() {
    document.getElementById('delete-modal').style.display = 'none';
    document.body.style.overflow = '';
}
function resetDeleteBtn() {
    const btn = document.getElementById('delete-confirm-btn');
    btn.disabled = true;
    btn.style.cssText = 'font-family:JetBrains Mono,monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:rgba(239,68,68,0.25);background:rgba(239,68,68,0.04);border:1px solid rgba(239,68,68,0.1);padding:0.8rem;cursor:not-allowed;transition:all 0.3s;';
}
function checkDeleteInput(input) {
    const btn = document.getElementById('delete-confirm-btn');
    if (input.value.trim().toUpperCase() === 'DELETE') {
        btn.disabled = false;
        btn.style.cssText = 'font-family:JetBrains Mono,monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#ef4444;background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.4);padding:0.8rem;cursor:pointer;transition:all 0.3s;';
    } else {
        resetDeleteBtn();
    }
}
function submitDelete() {
    if (document.getElementById('delete-confirm-input').value.trim().toUpperCase() === 'DELETE') {
        document.getElementById('delete-form').submit();
    }
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeDeleteModal(); });

// ── Password toggle ───────────────────────────────────────────
function tp(fieldId, iconId) {
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

// ── Avatar preview ────────────────────────────────────────────
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('avatar-preview');
            const initials = document.getElementById('avatar-initials');
            preview.src = e.target.result;
            preview.style.display = 'block';
            if (initials) initials.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// ── 2FA method selection ──────────────────────────────────────
let activeMethod = null;

function selectMethod(method) {
    activeMethod = method;
    ['totp', 'email', 'sms'].forEach(m => {
        const card  = document.getElementById('method-' + m);
        const check = document.getElementById('check-' + m);
        const panel = document.getElementById('panel-' + m);
        if (card) {
            card.style.borderColor = m === method ? 'rgba(0,212,255,0.5)' : 'rgba(255,255,255,0.06)';
            card.style.background  = m === method ? 'rgba(0,212,255,0.04)' : '#050a0f';
        }
        if (check) {
            check.style.background   = m === method ? '#00d4ff' : 'transparent';
            check.style.borderColor  = m === method ? '#00d4ff' : 'rgba(255,255,255,0.1)';
        }
        if (panel) panel.style.display = m === method ? 'block' : 'none';
    });
    if (method === 'totp') loadTotpQr();
}

function loadTotpQr() {
    fetch('{{ route("2fa.totp.setup") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        }
    })
    .then(r => r.json())
    .then(data => {
        document.getElementById('totp-secret').textContent = data.secret;
        const qrUrl = 'https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=' + encodeURIComponent(data.qr_url);
        const img   = document.getElementById('qr-image');
        img.src     = qrUrl;
        img.onload  = () => {
            document.getElementById('qr-loading').style.display = 'none';
            document.getElementById('qr-loaded').style.display  = 'block';
        };
    })
    .catch(() => {
        document.getElementById('qr-loading').innerHTML = '<span style="font-size:0.6rem;color:#ef4444;font-family:monospace;">Failed to load. Try again.</span>';
    });
}

// Fix onmouseover on cards — use data attribute instead of JS var
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.method-card').forEach(card => {
        card.addEventListener('mouseenter', () => {
            if (activeMethod !== card.dataset.method) card.style.borderColor = 'rgba(0,212,255,0.3)';
        });
        card.addEventListener('mouseleave', () => {
            if (activeMethod !== card.dataset.method) card.style.borderColor = 'rgba(255,255,255,0.06)';
        });
    });

    @if(session('2fa_success') && str_contains(session('2fa_success', ''), 'sent to'))
        @if(isset($user->two_factor_method) && $user->two_factor_method === 'email')
            selectMethod('email');
        @elseif(isset($user->two_factor_method) && $user->two_factor_method === 'sms')
            selectMethod('sms');
        @endif
    @endif
});
</script>

@endsection
