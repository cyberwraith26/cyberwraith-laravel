@if ($paginator->hasPages())
    <nav style="display:flex;align-items:center;justify-content:center;gap:0.4rem;margin-top:3rem;flex-wrap:wrap;">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="font-mono" style="font-size:0.65rem;padding:0.45rem 0.85rem;border:1px solid rgba(255,255,255,0.06);color:rgba(255,255,255,0.15);letter-spacing:0.08em;cursor:not-allowed;user-select:none;">← PREV</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="font-mono" style="font-size:0.65rem;padding:0.45rem 0.85rem;border:1px solid rgba(168,85,247,0.25);color:rgba(168,85,247,0.7);letter-spacing:0.08em;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(168,85,247,0.6)';this.style.color='#a855f7'" onmouseout="this.style.borderColor='rgba(168,85,247,0.25)';this.style.color='rgba(168,85,247,0.7)'">← PREV</a>
        @endif

        {{-- Page numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="font-mono" style="font-size:0.65rem;padding:0.45rem 0.6rem;color:rgba(255,255,255,0.2);">...</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="font-mono" style="font-size:0.65rem;padding:0.45rem 0.75rem;border:1px solid #a855f7;background:rgba(168,85,247,0.15);color:#a855f7;letter-spacing:0.08em;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="font-mono" style="font-size:0.65rem;padding:0.45rem 0.75rem;border:1px solid rgba(255,255,255,0.08);color:rgba(255,255,255,0.35);letter-spacing:0.08em;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(168,85,247,0.35)';this.style.color='#a855f7'" onmouseout="this.style.borderColor='rgba(255,255,255,0.08)';this.style.color='rgba(255,255,255,0.35)'">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="font-mono" style="font-size:0.65rem;padding:0.45rem 0.85rem;border:1px solid rgba(168,85,247,0.25);color:rgba(168,85,247,0.7);letter-spacing:0.08em;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.borderColor='rgba(168,85,247,0.6)';this.style.color='#a855f7'" onmouseout="this.style.borderColor='rgba(168,85,247,0.25)';this.style.color='rgba(168,85,247,0.7)'">NEXT →</a>
        @else
            <span class="font-mono" style="font-size:0.65rem;padding:0.45rem 0.85rem;border:1px solid rgba(255,255,255,0.06);color:rgba(255,255,255,0.15);letter-spacing:0.08em;cursor:not-allowed;user-select:none;">NEXT →</span>
        @endif

    </nav>

    {{-- Page info --}}
    <p class="font-mono" style="text-align:center;font-size:0.58rem;color:rgba(255,255,255,0.18);letter-spacing:0.08em;margin-top:1rem;text-transform:uppercase;">
        Showing {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} of {{ $paginator->total() }} articles
    </p>
@endif
