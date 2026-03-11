@extends('layouts.app')

@section('title', $tool['name'])

@section('breadcrumb')
    <span>CyberWraith</span>
    <span style="color:rgba(255,255,255,0.1);">/</span>
    <a href="{{ route('tools.index') }}" style="color:rgba(255,255,255,0.3);text-decoration:none;">Tools</a>
    <span style="color:rgba(255,255,255,0.1);">/</span>
    <span class="current">{{ $tool['name'] }}</span>
@endsection

@section('content')

{{-- Header --}}
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2rem;">
    <div style="display:flex;align-items:center;gap:1rem;">
        <span style="font-size:2rem;">{{ $tool['icon'] }}</span>
        <div>
            <div class="font-mono" style="font-size:0.6rem;color:{{ $tool['color'] }};letter-spacing:0.2em;text-transform:uppercase;margin-bottom:0.25rem;">// {{ strtoupper($tool['slug']) }}.init()</div>
            <h1 style="font-size:1.5rem;font-weight:800;color:#fff;">{{ $tool['name'] }}</h1>
            <p style="font-size:0.78rem;color:rgba(255,255,255,0.3);margin-top:0.2rem;">{{ $tool['description'] }}</p>
        </div>
    </div>
    <div style="display:flex;align-items:center;gap:0.75rem;">
        @if(($tool['status'] ?? 'coming_soon') === 'live')
            <span style="display:flex;align-items:center;gap:0.4rem;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(0,255,136,0.6);letter-spacing:0.15em;border:1px solid rgba(0,255,136,0.2);padding:0.3rem 0.75rem;background:rgba(0,255,136,0.05);">
                <span style="width:5px;height:5px;border-radius:50%;background:#00ff88;box-shadow:0 0 6px #00ff88;animation:blink 2s infinite;"></span>
                LIVE
            </span>
        @else
            <span style="display:flex;align-items:center;gap:0.4rem;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(245,158,11,0.6);letter-spacing:0.15em;border:1px solid rgba(245,158,11,0.2);padding:0.3rem 0.75rem;background:rgba(245,158,11,0.05);">
                <span style="width:5px;height:5px;border-radius:50%;background:#f59e0b;"></span>
                COMING SOON
            </span>
        @endif
        <span class="font-mono" style="font-size:0.58rem;padding:0.2rem 0.6rem;border:1px solid {{ $tool['color'] }}30;color:{{ $tool['color'] }};letter-spacing:0.1em;text-transform:uppercase;">{{ $tool['tag'] }}</span>
    </div>
</div>

{{-- Tool Workspace --}}
<div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);position:relative;overflow:hidden;">
    <div style="position:absolute;top:0;left:0;right:0;height:2px;background:{{ $tool['color'] }};opacity:0.5;z-index:1;"></div>

    @if(($tool['status'] ?? 'coming_soon') === 'live')
        @if(view()->exists('dashboard.tools.' . $tool['slug']))
            @include('dashboard.tools.' . $tool['slug'], ['tool' => $tool, 'user' => $user])
        @else
            {{-- Generic live placeholder --}}
            <div style="text-align:center;padding:4rem 2rem;">
                <span style="font-size:3.5rem;display:block;margin-bottom:1.5rem;">{{ $tool['icon'] }}</span>
                <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.4);letter-spacing:0.2em;margin-bottom:1rem;">// WORKSPACE LOADING</div>
                <h2 style="font-size:1.25rem;font-weight:800;color:#fff;margin-bottom:0.75rem;">{{ $tool['name'] }} Workspace</h2>
                <p style="font-size:0.85rem;color:rgba(255,255,255,0.35);max-width:480px;margin:0 auto 2rem;line-height:1.7;">
                    The {{ $tool['name'] }} interface is being finalized. Check back soon.
                </p>
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:0.75rem;max-width:600px;margin:0 auto 2rem;">
                    @foreach($tool['features'] as $feature)
                    <div style="background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.05);padding:0.75rem 1rem;text-align:left;">
                        <div class="font-mono" style="font-size:0.62rem;color:rgba(255,255,255,0.3);display:flex;align-items:center;gap:0.5rem;">
                            <span style="color:{{ $tool['color'] }};">✓</span> {{ $feature }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif
    @else
        {{-- Coming soon --}}
        <div style="text-align:center;padding:4rem 2rem;">
            <div style="width:80px;height:80px;margin:0 auto 1.5rem;border:2px solid {{ $tool['color'] }}30;display:flex;align-items:center;justify-content:center;font-size:2.5rem;">{{ $tool['icon'] }}</div>
            <div class="font-mono" style="font-size:0.6rem;color:rgba(245,158,11,0.5);letter-spacing:0.25em;margin-bottom:1rem;">// IN DEVELOPMENT</div>
            <h2 style="font-size:1.25rem;font-weight:800;color:#fff;margin-bottom:0.75rem;">{{ $tool['name'] }} is Coming Soon</h2>
            <p style="font-size:0.85rem;color:rgba(255,255,255,0.35);max-width:460px;margin:0 auto 2.5rem;line-height:1.7;">This tool is currently in development. Here's what it will do:</p>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:0.75rem;max-width:600px;margin:0 auto 2.5rem;">
                @foreach($tool['features'] as $feature)
                <div style="background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.04);padding:0.875rem 1rem;text-align:left;">
                    <div class="font-mono" style="font-size:0.62rem;color:rgba(255,255,255,0.25);display:flex;align-items:center;gap:0.5rem;">
                        <span style="color:{{ $tool['color'] }};opacity:0.6;">◈</span> {{ $feature }}
                    </div>
                </div>
                @endforeach
            </div>
            <div style="display:inline-flex;align-items:center;gap:1rem;flex-wrap:wrap;justify-content:center;">
                <a href="{{ route('tools.index') }}" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.3);border:1px solid rgba(255,255,255,0.08);padding:0.6rem 1.25rem;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.color='#fff';this.style.borderColor='rgba(255,255,255,0.2)'" onmouseout="this.style.color='rgba(255,255,255,0.3)';this.style.borderColor='rgba(255,255,255,0.08)'">← Back to Tools</a>
                <a href="{{ route('dashboard') }}" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:{{ $tool['color'] }};padding:0.6rem 1.25rem;text-decoration:none;transition:opacity 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">Back to Dashboard</a>
            </div>
        </div>
    @endif
</div>

<style>
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }
</style>

@endsection
