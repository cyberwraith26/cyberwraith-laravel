@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    <span>CyberWraith</span>
    <span style="color:rgba(255,255,255,0.1);">/</span>
    <span class="current">Overview</span>
@endsection

@section('content')

{{-- Welcome Header --}}
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2.5rem;">
    <div>
        <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.2em;text-transform:uppercase;margin-bottom:0.4rem;">// DASHBOARD.init()</div>
        <h1 style="font-size:1.5rem;font-weight:800;color:#fff;">Welcome back, {{ explode(' ', auth()->user()->name)[0] }}</h1>
        <p style="font-size:0.82rem;color:rgba(255,255,255,0.3);margin-top:0.25rem;">Here's what's happening with your account today.</p>
    </div>
    <a href="{{ route('tools.index') }}" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#00ff88;padding:0.6rem 1.5rem;text-decoration:none;display:inline-flex;align-items:center;gap:0.5rem;transition:all 0.2s;" onmouseover="this.style.background='#00ffaa'" onmouseout="this.style.background='#00ff88'">
        ⚙ Open Tools
    </a>
</div>

{{-- Stats Row --}}
@php
    $user          = auth()->user();
    $allTools      = collect(config('tools'));
    $allowedCount  = $user->toolLimit();
    $selected      = $user->selected_tools ?? [];
    $selectedCount = count($selected);
    $totalTools    = $allTools->count();

    $dashboardTools = $user->tier === 'agency'
        ? $allTools
        : $allTools->filter(fn($t) => in_array($t['slug'], $selected));
@endphp

<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1.25rem;margin-bottom:2.5rem;">
    @foreach([
        ['Plan', auth()->user()->tier, '#00ff88', '◎'],
        ['Tools Access', $selectedCount . ' / ' . $totalTools, '#00d4ff', '⚙'],
        ['Member Since', auth()->user()->created_at->format('M Y'), '#a855f7', '◈'],
        ['Status', 'Active', '#00ff88', '●'],
    ] as $stat)
    <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.5rem;position:relative;overflow:hidden;">
        <div style="position:absolute;top:0;left:0;right:0;height:1px;background:{{ $stat[2] }};opacity:0.3;"></div>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.75rem;">
            <span class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.25);letter-spacing:0.15em;text-transform:uppercase;">{{ $stat[0] }}</span>
            <span style="color:{{ $stat[2] }};opacity:0.5;font-size:0.9rem;">{{ $stat[3] }}</span>
        </div>
        <div style="font-size:1.25rem;font-weight:700;color:#fff;text-transform:capitalize;">
            @if($stat[0] === 'Plan')
                <span style="color:{{ $stat[2] }};">{{ auth()->user()->tier }}</span>
            @else
                {{ $stat[1] }}
            @endif
        </div>
    </div>
    @endforeach
</div>

{{-- Tools Grid --}}
<div style="margin-bottom:2.5rem;">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
        <h2 style="font-size:0.9rem;font-weight:700;color:#fff;">Your Tools</h2>
        <a href="{{ route('tools.index') }}" class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#00ff88'" onmouseout="this.style.color='rgba(0,255,136,0.5)'">View All →</a>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1rem;">
        @if($dashboardTools->isEmpty())
            <div style="background:#0a1520;border:1px dashed rgba(0,255,136,0.15);padding:3rem 2rem;text-align:center;">
                <p class="font-mono" style="font-size:0.65rem;color:rgba(0,255,136,0.4);letter-spacing:0.2em;margin-bottom:0.5rem;">NO TOOLS SELECTED</p>
                <p style="font-size:0.82rem;color:rgba(255,255,255,0.3);margin-bottom:1.5rem;">You haven't picked your {{ $allowedCount }} tools yet.</p>
                <a href="{{ route('tools.select') }}" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#00ff88;padding:0.6rem 1.5rem;text-decoration:none;">Select My Tools →</a>
            </div>
        @else
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1rem;">
                @foreach($dashboardTools as $tool)
                {{-- existing tool card code stays here --}}
                @endforeach
            </div>
        @endif
    </div>
</div>

{{-- Recent Activity + Upgrade Banner --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">

    {{-- Recent Activity --}}
    <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.5rem;">
        <h3 style="font-size:0.82rem;font-weight:700;color:#fff;margin-bottom:1.25rem;">Recent Activity</h3>
        @if($recentUsages->isEmpty())
            <div style="text-align:center;padding:2rem 0;">
                <div style="font-size:1.5rem;margin-bottom:0.75rem;">📭</div>
                <p class="font-mono" style="font-size:0.65rem;color:rgba(255,255,255,0.2);letter-spacing:0.1em;">NO ACTIVITY YET</p>
                <p style="font-size:0.75rem;color:rgba(255,255,255,0.2);margin-top:0.4rem;">Launch a tool to get started.</p>
            </div>
        @else
            <div style="display:flex;flex-direction:column;gap:0.75rem;">
                @foreach($recentUsages as $usage)
                @php $tool = collect(config('tools'))->firstWhere('slug', $usage->tool_slug); @endphp
                @if($tool)
                <div style="display:flex;align-items:center;gap:0.75rem;padding:0.75rem;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.03);">
                    <span style="font-size:1.1rem;">{{ $tool['icon'] }}</span>
                    <div style="flex:1;">
                        <div style="font-size:0.78rem;font-weight:600;color:rgba(255,255,255,0.6);">{{ $tool['name'] }}</div>
                        <div class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.2);">{{ $usage->created_at->diffForHumans() }}</div>
                    </div>
                    <span class="font-mono" style="font-size:0.55rem;color:{{ $tool['color'] }};letter-spacing:0.1em;text-transform:uppercase;">{{ $usage->action }}</span>
                </div>
                @endif
                @endforeach
            </div>
        @endif
    </div>

    {{-- Upgrade Banner or Current Plan --}}
    @if(auth()->user()->tier === 'agency')
    <div style="background:#0a1520;border:1px solid rgba(0,255,136,0.15);padding:1.5rem;position:relative;overflow:hidden;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#00ff88,#00d4ff);opacity:0.5;"></div>
        <div class="font-mono" style="font-size:0.58rem;color:rgba(0,255,136,0.5);letter-spacing:0.2em;text-transform:uppercase;margin-bottom:0.75rem;">// CURRENT PLAN</div>
        <div style="font-size:1.5rem;font-weight:900;color:#00ff88;margin-bottom:0.4rem;">Agency</div>
        <p style="font-size:0.78rem;color:rgba(255,255,255,0.35);margin-bottom:1.25rem;line-height:1.6;">You have access to all 100 tools and full platform features.</p>
        <div style="display:flex;flex-direction:column;gap:0.4rem;">
            @foreach(['All 100 tools unlocked','Priority support','White-label options','Custom integrations'] as $f)
            <div class="font-mono" style="font-size:0.62rem;color:rgba(255,255,255,0.35);display:flex;align-items:center;gap:0.5rem;">
                <span style="color:#00ff88;">✓</span> {{ $f }}
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div style="background:#0a1520;border:1px solid rgba(0,255,136,0.15);padding:1.5rem;position:relative;overflow:hidden;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#00ff88,#a855f7);opacity:0.4;"></div>
        <div class="font-mono" style="font-size:0.58rem;color:rgba(0,255,136,0.5);letter-spacing:0.2em;text-transform:uppercase;margin-bottom:0.75rem;">// UPGRADE YOUR PLAN</div>
        <div style="font-size:1.1rem;font-weight:800;color:#fff;margin-bottom:0.4rem;">Unlock More Tools</div>
        <p style="font-size:0.78rem;color:rgba(255,255,255,0.35);margin-bottom:1.5rem;line-height:1.6;">
            @if(auth()->user()->tier === 'free')
                Upgrade to Pro and get access to 10 tools including ProposalGen, LeadEnrich and more.
            @else
                Upgrade to Agency and unlock all 100 tools plus team features.
            @endif
        </p>
        <a href="{{ route('billing.index') }}" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#00ff88;padding:0.6rem 1.5rem;text-decoration:none;display:inline-flex;align-items:center;gap:0.5rem;transition:all 0.2s;" onmouseover="this.style.background='#00ffaa'" onmouseout="this.style.background='#00ff88'">
            View Plans →
        </a>
    </div>
    @endif

</div>

@endsection
