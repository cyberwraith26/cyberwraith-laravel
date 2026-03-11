@if(isset($showOnboarding) && $showOnboarding)
<div id="onboarding-checklist" style="background:#0a1520;border:1px solid rgba(168,85,247,0.2);padding:1.5rem;margin-bottom:2rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#a855f7,#00d4ff);"></div>

    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;margin-bottom:1.25rem;">
        <div>
            <div class="font-mono" style="font-size:0.58rem;color:rgba(168,85,247,0.6);letter-spacing:0.2em;text-transform:uppercase;margin-bottom:0.3rem;">// ONBOARDING.checklist()</div>
            <h3 style="font-size:1rem;font-weight:800;color:#fff;margin:0;">Get started with CyberWraith</h3>
        </div>
        <button onclick="dismissOnboarding()" style="background:none;border:none;color:rgba(255,255,255,0.2);cursor:pointer;font-size:1rem;transition:color 0.2s;flex-shrink:0;" onmouseover="this.style.color='rgba(255,255,255,0.4)'" onmouseout="this.style.color='rgba(255,255,255,0.2)'">✕</button>
    </div>

    {{-- Progress bar --}}
    <div style="background:rgba(255,255,255,0.05);height:4px;margin-bottom:1.5rem;position:relative;">
        <div id="onboarding-progress" style="height:100%;background:linear-gradient(90deg,#a855f7,#00d4ff);transition:width 0.4s ease;width:0%;"></div>
    </div>

    {{-- Steps --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:0.75rem;" id="onboarding-steps">
        @php
        $steps = [
            ['id'=>'step-profile',  'icon'=>'👤', 'label'=>'Complete your profile',      'href'=>'/settings/profile'],
            ['id'=>'step-tool',     'icon'=>'🛠️', 'label'=>'Use your first tool',         'href'=>'/tools'],
            ['id'=>'step-save',     'icon'=>'💾', 'label'=>'Save a tool output',          'href'=>'/tools'],
            ['id'=>'step-explore',  'icon'=>'🗂️', 'label'=>'Explore all categories',      'href'=>'/tools'],
            ['id'=>'step-upgrade',  'icon'=>'⚡', 'label'=>'Upgrade for full access',     'href'=>'/pricing'],
        ];
        @endphp

        @foreach($steps as $step)
        <div id="{{ $step['id'] }}" class="onboarding-step" data-step="{{ $step['id'] }}" style="background:#050a0f;border:1px solid rgba(255,255,255,0.05);padding:0.75rem 1rem;display:flex;align-items:center;gap:0.75rem;cursor:pointer;transition:all 0.2s;" onclick="completeStep('{{ $step['id'] }}', '{{ $step['href'] }}')" onmouseover="this.style.borderColor='rgba(168,85,247,0.25)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)'">
            <div class="step-check" style="width:18px;height:18px;border:1px solid rgba(168,85,247,0.3);border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;transition:all 0.2s;">
                <span class="check-icon" style="color:#a855f7;font-size:0.6rem;display:none;">✓</span>
            </div>
            <span style="font-size:0.9rem;">{{ $step['icon'] }}</span>
            <span class="font-mono" style="font-size:0.62rem;color:rgba(255,255,255,0.5);">{{ $step['label'] }}</span>
        </div>
        @endforeach
    </div>

    <div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.15);margin-top:1rem;letter-spacing:0.08em;">
        <span id="steps-done">0</span>/{{ count($steps) }} steps complete
    </div>
</div>
@endif

<script>
(function() {
    const completed = JSON.parse(localStorage.getItem('cw_onboarding') || '[]');
    let count = 0;
    const total = document.querySelectorAll('.onboarding-step').length;

    completed.forEach(id => {
        markStep(id);
        count++;
    });

    updateProgress(count, total);
})();

function completeStep(id, href) {
    markStep(id);
    const completed = JSON.parse(localStorage.getItem('cw_onboarding') || '[]');
    if (!completed.includes(id)) {
        completed.push(id);
        localStorage.setItem('cw_onboarding', JSON.stringify(completed));
    }
    const total = document.querySelectorAll('.onboarding-step').length;
    updateProgress(completed.length, total);

    setTimeout(() => { window.location.href = href; }, 300);
}

function markStep(id) {
    const el = document.getElementById(id);
    if (!el) return;
    const check = el.querySelector('.step-check');
    const icon  = el.querySelector('.check-icon');
    check.style.background      = 'rgba(168,85,247,0.2)';
    check.style.borderColor     = '#a855f7';
    icon.style.display          = 'block';
    el.style.opacity            = '0.5';
    document.getElementById('steps-done').textContent =
        document.querySelectorAll('.onboarding-step').length -
        document.querySelectorAll('.onboarding-step[style*="opacity: 1"]').length;
}

function updateProgress(done, total) {
    const pct = Math.round((done / total) * 100);
    const bar = document.getElementById('onboarding-progress');
    if (bar) bar.style.width = pct + '%';
    const el = document.getElementById('steps-done');
    if (el) el.textContent = done;
}

function dismissOnboarding() {
    const el = document.getElementById('onboarding-checklist');
    if (el) { el.style.opacity = '0'; el.style.maxHeight = '0'; el.style.marginBottom = '0'; el.style.padding = '0'; el.style.border = 'none'; }
    localStorage.setItem('cw_onboarding_dismissed', '1');
}
</script>

@extends('layouts.app')

@section('title', 'Tools')

@section('breadcrumb')
    <span>CyberWraith</span>
    <span style="color:rgba(255,255,255,0.1);">/</span>
    <span class="current">Tools</span>
@endsection

@section('content')

@php
    $selected     = $user->selected_tools ?? [];
    $selectedCount = count($selected);
    $isLocked     = $selectedCount >= $allowedCount && $user->tier !== 'agency';

    // Sort: selected tools first, then unselected
    $selectedTools   = $tools->filter(fn($t) => in_array($t['slug'], $selected));
    $unselectedTools = $tools->filter(fn($t) => !in_array($t['slug'], $selected));
    $sortedTools     = $selectedTools->merge($unselectedTools);
@endphp

<div style="margin-bottom:2rem;">
    <div style="position:relative;max-width:560px;">
        <div style="position:absolute;left:1rem;top:50%;transform:translateY(-50%);color:rgba(168,85,247,0.5);font-size:0.85rem;pointer-events:none;">⌕</div>
        <input
            type="text"
            id="tool-search"
            placeholder="Search 200+ tools... (e.g. 'cold email', 'invoice', 'SEO')"
            oninput="searchTools(this.value)"
            style="width:100%;background:#0a1520;border:1px solid rgba(168,85,247,0.2);color:#fff;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.75rem 1rem 0.75rem 2.25rem;outline:none;transition:border-color 0.2s;box-sizing:border-box;"
            onfocus="this.style.borderColor='rgba(168,85,247,0.5)'"
            onblur="this.style.borderColor='rgba(168,85,247,0.2)'"
        >
        <div id="search-clear" onclick="clearSearch()" style="position:absolute;right:1rem;top:50%;transform:translateY(-50%);color:rgba(255,255,255,0.2);cursor:pointer;font-size:0.9rem;display:none;transition:color 0.2s;" onmouseover="this.style.color='rgba(255,255,255,0.5)'" onmouseout="this.style.color='rgba(255,255,255,0.2)'">✕</div>
    </div>
    <div id="search-count" class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.2);margin-top:0.5rem;letter-spacing:0.08em;display:none;"></div>
</div>

<script>
function searchTools(query) {
    const q = query.toLowerCase().trim();
    const cards = document.querySelectorAll('.tool-card');
    const clearBtn = document.getElementById('search-clear');
    const countEl  = document.getElementById('search-count');
    let visible = 0;

    clearBtn.style.display = q ? 'block' : 'none';

    cards.forEach(card => {
        const name = (card.dataset.name || '').toLowerCase();
        const desc = (card.dataset.desc || '').toLowerCase();
        const cat  = (card.dataset.category || '').toLowerCase();
        const match = !q || name.includes(q) || desc.includes(q) || cat.includes(q);
        card.style.display = match ? '' : 'none';
        if (match) visible++;
    });

    if (q) {
        countEl.style.display = 'block';
        countEl.textContent = visible + ' tool' + (visible !== 1 ? 's' : '') + ' found';
    } else {
        countEl.style.display = 'none';
    }
}

function clearSearch() {
    const input = document.getElementById('tool-search');
    input.value = '';
    searchTools('');
    input.focus();
}
</script>

<div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2rem;">
    <div>
        <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.2em;text-transform:uppercase;margin-bottom:0.4rem;">// TOOLS.getAll()</div>
        <h1 style="font-size:1.5rem;font-weight:800;color:#fff;">My Tools</h1>
        <p style="font-size:0.82rem;color:rgba(255,255,255,0.3);margin-top:0.25rem;">
            @if($user->tier === 'agency')
                You have access to all tools.
            @elseif($isLocked)
                Your <span style="color:#00ff88;">{{ $selectedCount }}</span> tools are selected and locked.
                <a href="{{ route('billing.index') }}" style="color:#f59e0b;text-decoration:none;">Upgrade to change &#8594;</a>
            @else
                You have selected <span style="color:#00ff88;">{{ $selectedCount }}</span> of <span style="color:#00ff88;">{{ $allowedCount }}</span> tools.
                <a href="{{ route('tools.select') }}" style="color:#00ff88;text-decoration:none;">Manage selection &#8594;</a>
            @endif
        </p>
    </div>
    @if(!$isLocked && $user->tier !== 'agency')
        <a href="{{ route('tools.select') }}" style="font-family:'JetBrains Mono',monospace;font-size:0.65rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#000;background:#00ff88;padding:0.55rem 1.25rem;text-decoration:none;display:inline-flex;align-items:center;gap:0.5rem;" onmouseover="this.style.background='#00ffaa'" onmouseout="this.style.background='#00ff88'">
            &#9881; Select Tools
        </a>
    @endif
</div>

{{-- Selected tools section header --}}
@if($selectedTools->isNotEmpty() && $user->tier !== 'agency')
<div style="margin-bottom:0.75rem;">
    <h2 style="font-size:0.7rem;font-weight:700;color:rgba(0,255,136,0.5);font-family:'JetBrains Mono',monospace;letter-spacing:0.2em;text-transform:uppercase;display:flex;align-items:center;gap:0.5rem;">
        <span style="width:6px;height:6px;border-radius:50%;background:#00ff88;display:inline-block;"></span>
        YOUR SELECTED TOOLS ({{ $selectedCount }})
    </h2>
</div>
@endif

<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.25rem;">
    @foreach($sortedTools as $tool)
    @php
        $hasAccess = $user->hasToolAccess($tool['slug']);
        $isFirst   = $loop->first && !$hasAccess && $user->tier !== 'agency';
    @endphp

    {{-- Divider between selected and unselected --}}
    @if(!$hasAccess && $loop->index === $selectedTools->count() && $unselectedTools->isNotEmpty() && $user->tier !== 'agency')
    <div style="grid-column:1/-1;padding-top:0.5rem;margin-top:0.25rem;border-top:1px solid rgba(255,255,255,0.05);">
        <h2 style="font-size:0.7rem;font-weight:700;color:rgba(255,255,255,0.15);font-family:'JetBrains Mono',monospace;letter-spacing:0.2em;text-transform:uppercase;">
            OTHER TOOLS &#8212; {{ $unselectedTools->count() }} available
        </h2>
    </div>
    @endif

    <div style="background:#0a1520;border:1px solid {{ $hasAccess ? 'rgba(0,255,136,0.12)' : 'rgba(255,255,255,0.04)' }};padding:1.75rem;position:relative;overflow:hidden;transition:all 0.3s;opacity:{{ $hasAccess ? '1' : '0.45' }};" onmouseover="this.style.borderColor='{{ $tool['color'] }}{{ $hasAccess ? '30' : '10' }}'" onmouseout="this.style.borderColor='{{ $hasAccess ? 'rgba(0,255,136,0.12)' : 'rgba(255,255,255,0.04)' }}'">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:{{ $tool['color'] }};opacity:{{ $hasAccess ? '0.4' : '0.08' }};"></div>

        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:1.1rem;">
            <span style="font-size:1.75rem;">{{ $tool['icon'] }}</span>
            <div style="display:flex;flex-direction:column;align-items:flex-end;gap:0.35rem;">
                <span class="font-mono" style="font-size:0.58rem;padding:0.18rem 0.5rem;border:1px solid {{ $tool['color'] }}30;color:{{ $tool['color'] }};letter-spacing:0.1em;text-transform:uppercase;opacity:{{ $hasAccess ? '1' : '0.4' }};">{{ $tool['tag'] }}</span>
                @if($hasAccess)
                    @if($tool['status'] === 'live')
                        <span style="display:flex;align-items:center;gap:0.3rem;font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(0,255,136,0.5);letter-spacing:0.1em;">
                            <span style="width:5px;height:5px;border-radius:50%;background:#00ff88;"></span> LIVE
                        </span>
                    @else
                        <span class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.2);border:1px solid rgba(255,255,255,0.06);padding:0.1rem 0.4rem;letter-spacing:0.08em;">SOON</span>
                    @endif
                @else
                    <span class="font-mono" style="font-size:0.55rem;padding:0.15rem 0.4rem;border:1px solid rgba(255,255,255,0.06);color:rgba(255,255,255,0.15);letter-spacing:0.1em;text-transform:uppercase;">NOT SELECTED</span>
                @endif
            </div>
        </div>

        <h3 style="font-size:1rem;font-weight:700;color:{{ $hasAccess ? '#fff' : 'rgba(255,255,255,0.3)' }};margin-bottom:0.4rem;">{{ $tool['name'] }}</h3>
        <p style="font-size:0.78rem;color:rgba(255,255,255,0.25);line-height:1.6;margin-bottom:1.25rem;">{{ $tool['description'] }}</p>

        <ul style="list-style:none;display:flex;flex-direction:column;gap:0.35rem;margin-bottom:1.5rem;">
            @foreach($tool['features'] as $feature)
                <li class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.18);display:flex;align-items:center;gap:0.5rem;">
                    <span style="color:{{ $tool['color'] }};flex-shrink:0;opacity:{{ $hasAccess ? '0.8' : '0.25' }};">&#10003;</span> {{ $feature }}
                </li>
            @endforeach
        </ul>

        @if($hasAccess)
            <a href="{{ route('tools.show', $tool['slug']) }}" style="display:inline-flex;align-items:center;gap:0.5rem;font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:{{ $tool['color'] }};padding:0.55rem 1.25rem;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                Launch Tool &#8594;
            </a>
        @elseif(!$isLocked)
            <a href="{{ route('tools.select') }}" style="display:inline-flex;align-items:center;gap:0.5rem;font-family:'JetBrains Mono',monospace;font-size:0.68rem;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.2);border:1px solid rgba(255,255,255,0.06);padding:0.55rem 1.25rem;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.color='#00ff88';this.style.borderColor='rgba(0,255,136,0.3)'" onmouseout="this.style.color='rgba(255,255,255,0.2)';this.style.borderColor='rgba(255,255,255,0.06)'">
                + Add to My Tools
            </a>
        @else
            <span class="font-mono" style="font-size:0.62rem;color:rgba(255,255,255,0.1);letter-spacing:0.1em;text-transform:uppercase;">&#128274; Locked</span>
        @endif
    </div>
    @endforeach
</div>

@endsection
