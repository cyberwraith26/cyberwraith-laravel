@extends('layouts.landing')

@section('title', $post->title . ' — CyberWraith Blog')
@section('description', $post->excerpt)

@section('content')

<section style="padding:5rem 2.5rem 6rem;">
    <div style="max-width:720px;margin:0 auto;">

        {{-- Back link --}}
        <a href="/blog" class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.6);letter-spacing:0.15em;text-transform:uppercase;text-decoration:none;display:inline-flex;align-items:center;gap:0.4rem;margin-bottom:2.5rem;transition:color 0.2s;" onmouseover="this.style.color='#a855f7'" onmouseout="this.style.color='rgba(168,85,247,0.6)'">
            ← Back to Blog
        </a>

        {{-- Header --}}
        <div style="margin-bottom:2.5rem;">
            <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1.25rem;">
                <span class="font-mono" style="font-size:0.58rem;padding:0.2rem 0.6rem;border:1px solid rgba(168,85,247,0.3);color:#a855f7;letter-spacing:0.1em;text-transform:uppercase;">{{ $post->category }}</span>
                <span class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.2);">{{ $post->read_time }} min read · {{ $post->created_at->format('M d, Y') }}</span>
            </div>
            <div style="font-size:3rem;margin-bottom:1rem;">{{ $post->emoji }}</div>
            <h1 style="font-size:clamp(1.6rem,3vw,2.4rem);font-weight:900;color:#fff;line-height:1.2;margin-bottom:1rem;">{{ $post->title }}</h1>
            <p style="font-size:0.95rem;color:rgba(255,255,255,0.4);line-height:1.7;border-left:2px solid rgba(168,85,247,0.4);padding-left:1rem;">{{ $post->excerpt }}</p>
        </div>

        {{-- Divider --}}
        <div style="height:1px;background:linear-gradient(90deg,rgba(168,85,247,0.3),transparent);margin-bottom:2.5rem;"></div>

        {{-- Content --}}
        <div style="font-size:0.9rem;color:rgba(255,255,255,0.65);line-height:1.9;">
            @if($post->content && strlen($post->content) > 100)
                {!! nl2br(e($post->content)) !!}
            @else
                <p style="color:rgba(255,255,255,0.3);font-style:italic;">Full article content coming soon. Stay tuned!</p>
            @endif
        </div>

        {{-- Bottom nav --}}
        <div style="margin-top:4rem;padding-top:2rem;border-top:1px solid rgba(255,255,255,0.06);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;">
            <a href="/blog" class="font-mono" style="font-size:0.63rem;color:rgba(168,85,247,0.6);text-decoration:none;letter-spacing:0.12em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#a855f7'" onmouseout="this.style.color='rgba(168,85,247,0.6)'">
                ← All Articles
            </a>
            <a href="/register" class="font-mono" style="font-size:0.63rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#a855f7;padding:0.5rem 1.25rem;text-decoration:none;transition:opacity 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                Try CyberWraith Free →
            </a>
        </div>

    </div>
</section>

@endsection
