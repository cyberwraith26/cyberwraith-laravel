@extends('layouts.app')

@section('title', 'Select Your Tools')

@section('breadcrumb')
    <span>CyberWraith</span>
    <span style="color:rgba(255,255,255,0.1);">/</span>
    <a href="{{ route('tools.index') }}" style="color:rgba(255,255,255,0.4);text-decoration:none;">Tools</a>
    <span style="color:rgba(255,255,255,0.1);">/</span>
    <span class="current">Select</span>
@endsection

@section('content')

@php
    $selectedCount = count($selected);
    $remaining     = $allowedCount - $selectedCount;
    $isFull        = $selectedCount >= $allowedCount;
@endphp

{{-- Header --}}
<div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2rem;">
    <div>
        <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.2em;text-transform:uppercase;margin-bottom:0.4rem;">// TOOLS.select()</div>
        <h1 style="font-size:1.5rem;font-weight:800;color:#fff;">Select Your Tools</h1>
        <p style="font-size:0.82rem;color:rgba(255,255,255,0.3);margin-top:0.25rem;">
            Choose the <span style="color:#00ff88;font-weight:700;">{{ $allowedCount }} tools</span> you want access to on your <span style="color:#00ff88;text-transform:capitalize;">{{ ucfirst($user->tier) }}</span> plan.
        </p>
    </div>

    {{-- Slot counter --}}
    <div style="background:#0a1520;border:1px solid rgba(0,255,136,0.2);padding:1rem 1.5rem;min-width:180px;position:relative;overflow:hidden;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#00ff88,#00d4ff);opacity:0.5;"></div>
        <div class="font-mono" style="font-size:0.55rem;color:rgba(0,255,136,0.5);letter-spacing:0.2em;text-transform:uppercase;margin-bottom:0.4rem;">SLOTS USED</div>
        <div style="font-size:2rem;font-weight:900;color:#fff;line-height:1;">
            <span id="slot-count" style="color:#00ff88;">{{ $selectedCount }}</span>
            <span style="color:rgba(255,255,255,0.2);font-size:1.2rem;"> / {{ $allowedCount }}</span>
        </div>
        <div class="font-mono" id="slot-label" style="font-size:0.6rem;margin-top:0.35rem;color:{{ $isFull ? '#f59e0b' : 'rgba(255,255,255,0.3)' }};">
            {{ $isFull ? 'All slots filled' : $remaining . ' slot' . ($remaining > 1 ? 's' : '') . ' remaining' }}
        </div>
        {{-- Progress bar --}}
        <div style="margin-top:0.75rem;height:3px;background:rgba(255,255,255,0.06);border-radius:2px;overflow:hidden;">
            <div id="slot-bar" style="height:100%;width:{{ ($selectedCount / $allowedCount) * 100 }}%;background:linear-gradient(90deg,#00ff88,#00d4ff);transition:width 0.3s ease;"></div>
        </div>
    </div>
</div>


{{-- Locked banner --}}
@if($isLocked)
    <div style="background:rgba(245,158,11,0.06);border:1px solid rgba(245,158,11,0.25);padding:1rem 1.5rem;margin-bottom:1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
        <div style="display:flex;align-items:center;gap:0.75rem;">
            <span style="color:#f59e0b;font-size:1rem;">&#128274;</span>
            <div>
                <p class="font-mono" style="font-size:0.65rem;color:#f59e0b;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:0.2rem;">SELECTION LOCKED</p>
                <p style="font-size:0.75rem;color:rgba(255,255,255,0.35);">All {{ $allowedCount }} slots are filled. Your tools are locked in permanently on this plan.</p>
            </div>
        </div>
        <a href="{{ route('billing.index') }}" style="font-family:'JetBrains Mono',monospace;font-size:0.62rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#000;background:#f59e0b;padding:0.5rem 1.25rem;text-decoration:none;white-space:nowrap;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
            Upgrade to Change &#8594;
        </a>
    </div>
@endif

{{-- Flash info message --}}
@if(session('info'))
    <div style="background:rgba(0,212,255,0.05);border:1px solid rgba(0,212,255,0.2);color:#00d4ff;padding:0.875rem 1.25rem;margin-bottom:1.5rem;font-family:'JetBrains Mono',monospace;font-size:0.72rem;display:flex;align-items:center;gap:0.75rem;">
        <span>&#9432;</span> {{ session('info') }}
    </div>
@endif

{{-- Filter bar --}}
<div style="display:flex;align-items:center;gap:0.75rem;flex-wrap:wrap;margin-bottom:1.5rem;">
    <button onclick="filterTag('all')" id="tag-all" class="tag-btn active-tag font-mono" style="font-size:0.6rem;letter-spacing:0.1em;text-transform:uppercase;padding:0.4rem 0.9rem;border:1px solid rgba(0,255,136,0.4);color:#00ff88;background:rgba(0,255,136,0.08);cursor:pointer;transition:all 0.2s;">ALL</button>
    <button onclick="filterTag('selected')" id="tag-selected" class="tag-btn font-mono" style="font-size:0.6rem;letter-spacing:0.1em;text-transform:uppercase;padding:0.4rem 0.9rem;border:1px solid rgba(255,255,255,0.08);color:rgba(255,255,255,0.3);background:transparent;cursor:pointer;transition:all 0.2s;">SELECTED</button>
    @foreach($tags as $tag)
    <button onclick="filterTag('{{ $tag }}')" id="tag-{{ Str::slug($tag) }}" class="tag-btn font-mono" style="font-size:0.6rem;letter-spacing:0.1em;text-transform:uppercase;padding:0.4rem 0.9rem;border:1px solid rgba(255,255,255,0.08);color:rgba(255,255,255,0.3);background:transparent;cursor:pointer;transition:all 0.2s;">{{ $tag }}</button>
    @endforeach
</div>

{{-- Search --}}
<div style="position:relative;margin-bottom:1.5rem;max-width:400px;">
    <span style="position:absolute;left:0.875rem;top:50%;transform:translateY(-50%);color:rgba(255,255,255,0.2);font-size:0.8rem;">&#128269;</span>
    <input type="text" id="tool-search" placeholder="Search tools..." oninput="searchTools(this.value)"
        style="width:100%;background:#0a1520;border:1px solid rgba(255,255,255,0.08);color:#fff;padding:0.65rem 0.875rem 0.65rem 2.25rem;font-family:'JetBrains Mono',monospace;font-size:0.72rem;outline:none;transition:border-color 0.2s;box-sizing:border-box;"
        onfocus="this.style.borderColor='rgba(0,255,136,0.3)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'">
</div>

{{-- Save button (top) --}}
<form method="POST" action="{{ route('tools.saveSelection') }}" id="selection-form">
    @csrf

    {{-- Hidden inputs populated by JS --}}
    <div id="hidden-inputs"></div>

    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;flex-wrap:wrap;gap:0.75rem;">
        <p class="font-mono" style="font-size:0.62rem;color:rgba(255,255,255,0.2);">@if($isLocked)Selection locked. Upgrade your plan to change tools.@else Click a tool to select or deselect it. Changes are saved when you click Save.@endif</p>
        @if(!$isLocked)
        <button type="submit" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#00ff88;border:none;padding:0.65rem 1.75rem;cursor:pointer;transition:background 0.2s;" onmouseover="this.style.background='#00ffaa'" onmouseout="this.style.background='#00ff88'">
            Save Selection &#10003;
        </button>
        @else
        <a href="{{ route('billing.index') }}" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#f59e0b;padding:0.65rem 1.75rem;text-decoration:none;display:inline-block;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">Upgrade to Change &#8594;</a>
        @endif
    </div>

    {{-- Tools Grid --}}
    <div id="tools-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1rem;margin-bottom:2rem;">
        @foreach($allTools as $tool)
        @php $isSelected = in_array($tool['slug'], $selected); @endphp
        <div
            class="tool-card"
            data-slug="{{ $tool['slug'] }}"
            data-tag="{{ $tool['tag'] }}"
            data-name="{{ strtolower($tool['name']) }} {{ strtolower($tool['description']) }}"
            data-selected="{{ $isSelected ? 'true' : 'false' }}"
            onclick="toggleTool(this)"
            style="background:#0a1520;border:1px solid {{ $isSelected ? 'rgba(0,255,136,0.35)' : 'rgba(255,255,255,0.05)' }};padding:1.5rem;position:relative;overflow:hidden;cursor:{{ $isLocked ? 'default' : 'pointer' }};transition:all 0.2s;user-select:none;opacity:{{ $isLocked && !$isSelected ? '0.4' : '1' }};">

            {{-- Top accent bar --}}
            <div class="tool-accent" style="position:absolute;top:0;left:0;right:0;height:2px;background:{{ $tool['color'] }};opacity:{{ $isSelected ? '0.6' : '0.15' }};transition:opacity 0.2s;"></div>

            {{-- Selected checkmark --}}
            <div class="tool-check" style="position:absolute;top:0.75rem;right:0.75rem;width:20px;height:20px;border-radius:50%;background:{{ $isSelected ? '#00ff88' : 'rgba(255,255,255,0.06)' }};border:1px solid {{ $isSelected ? '#00ff88' : 'rgba(255,255,255,0.1)' }};display:flex;align-items:center;justify-content:center;transition:all 0.2s;">
                <span style="color:#000;font-size:0.6rem;font-weight:900;opacity:{{ $isSelected ? '1' : '0' }};transition:opacity 0.2s;">&#10003;</span>
            </div>

            <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:0.75rem;padding-right:2rem;">
                <span style="font-size:1.5rem;">{{ $tool['icon'] }}</span>
                <div>
                    <div style="font-size:0.88rem;font-weight:700;color:#fff;">{{ $tool['name'] }}</div>
                    <span class="font-mono" style="font-size:0.55rem;color:{{ $tool['color'] }};letter-spacing:0.1em;text-transform:uppercase;opacity:0.7;">{{ $tool['tag'] }}</span>
                </div>
            </div>

            <p style="font-size:0.72rem;color:rgba(255,255,255,0.3);line-height:1.5;margin-bottom:0.75rem;">{{ $tool['description'] }}</p>

            @if($tool['status'] === 'coming_soon')
                <span class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.2);border:1px solid rgba(255,255,255,0.06);padding:0.15rem 0.5rem;letter-spacing:0.1em;">COMING SOON</span>
            @else
                <span class="font-mono" style="font-size:0.55rem;color:#00ff88;border:1px solid rgba(0,255,136,0.2);padding:0.15rem 0.5rem;letter-spacing:0.1em;">LIVE</span>
            @endif
        </div>
        @endforeach
    </div>

    {{-- Save button (bottom) --}}
    <div style="display:flex;justify-content:flex-end;padding-top:1rem;border-top:1px solid rgba(255,255,255,0.05);">
        @if(!$isLocked)
        <button type="submit" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#00ff88;border:none;padding:0.65rem 1.75rem;cursor:pointer;transition:background 0.2s;" onmouseover="this.style.background='#00ffaa'" onmouseout="this.style.background='#00ff88'">
            Save Selection &#10003;
        </button>
        @else
        <a href="{{ route('billing.index') }}" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#f59e0b;padding:0.65rem 1.75rem;text-decoration:none;display:inline-block;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">Upgrade to Change &#8594;</a>
        @endif
    </div>

</form>

<script>
    const ALLOWED   = {{ $allowedCount }};
    const IS_LOCKED = {{ $isLocked ? 'true' : 'false' }};
    let selected    = new Set(@json($selected));

    function toggleTool(card) {
        if (IS_LOCKED) return;
        const slug = card.dataset.slug;

        if (selected.has(slug)) {
            // Deselect
            selected.delete(slug);
            card.style.borderColor = 'rgba(255,255,255,0.05)';
            card.querySelector('.tool-accent').style.opacity = '0.15';
            card.querySelector('.tool-check').style.background = 'rgba(255,255,255,0.06)';
            card.querySelector('.tool-check').style.borderColor = 'rgba(255,255,255,0.1)';
            card.querySelector('.tool-check span').style.opacity = '0';
            card.dataset.selected = 'false';
        } else {
            if (selected.size >= ALLOWED) {
                // Flash the counter to warn user
                const counter = document.getElementById('slot-count');
                counter.style.color = '#ef4444';
                setTimeout(() => counter.style.color = '#00ff88', 600);
                return;
            }
            // Select
            selected.add(slug);
            card.style.borderColor = 'rgba(0,255,136,0.35)';
            card.querySelector('.tool-accent').style.opacity = '0.6';
            card.querySelector('.tool-check').style.background = '#00ff88';
            card.querySelector('.tool-check').style.borderColor = '#00ff88';
            card.querySelector('.tool-check span').style.opacity = '1';
            card.dataset.selected = 'true';
        }

        updateCounter();
        updateHiddenInputs();
    }

    function updateCounter() {
        const count     = selected.size;
        const remaining = ALLOWED - count;
        const pct       = (count / ALLOWED) * 100;

        document.getElementById('slot-count').textContent = count;
        document.getElementById('slot-bar').style.width   = pct + '%';

        const label = document.getElementById('slot-label');
        if (count >= ALLOWED) {
            label.textContent = 'All slots filled';
            label.style.color = '#f59e0b';
        } else {
            label.textContent = remaining + ' slot' + (remaining > 1 ? 's' : '') + ' remaining';
            label.style.color = 'rgba(255,255,255,0.3)';
        }
    }

    function updateHiddenInputs() {
        const container = document.getElementById('hidden-inputs');
        container.innerHTML = '';
        selected.forEach(slug => {
            const input = document.createElement('input');
            input.type  = 'hidden';
            input.name  = 'tools[]';
            input.value = slug;
            container.appendChild(input);
        });
    }

    function filterTag(tag) {
        // Update button styles
        document.querySelectorAll('.tag-btn').forEach(btn => {
            btn.style.borderColor  = 'rgba(255,255,255,0.08)';
            btn.style.color        = 'rgba(255,255,255,0.3)';
            btn.style.background   = 'transparent';
        });
        const activeBtn = document.getElementById('tag-' + (tag === 'all' ? 'all' : tag === 'selected' ? 'selected' : '{{ Str::slug("") }}'));

        // Find and highlight the clicked button
        document.querySelectorAll('.tag-btn').forEach(btn => {
            if (btn.textContent.trim().toUpperCase() === tag.toUpperCase() ||
                (tag === 'all' && btn.textContent.trim() === 'ALL') ||
                (tag === 'selected' && btn.textContent.trim() === 'SELECTED')) {
                btn.style.borderColor = 'rgba(0,255,136,0.4)';
                btn.style.color       = '#00ff88';
                btn.style.background  = 'rgba(0,255,136,0.08)';
            }
        });

        // Show/hide cards
        document.querySelectorAll('.tool-card').forEach(card => {
            if (tag === 'all') {
                card.style.display = '';
            } else if (tag === 'selected') {
                card.style.display = card.dataset.selected === 'true' ? '' : 'none';
            } else {
                card.style.display = card.dataset.tag === tag ? '' : 'none';
            }
        });
    }

    function searchTools(query) {
        const q = query.toLowerCase().trim();
        document.querySelectorAll('.tool-card').forEach(card => {
            card.style.display = card.dataset.name.includes(q) ? '' : 'none';
        });
    }

    // Init hidden inputs on load
    updateHiddenInputs();
</script>

@endsection
