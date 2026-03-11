@extends('layouts.landing')

@section('title', 'Blog — CyberWraith')
@section('description', 'Insights, guides and strategies for freelancers, agencies and SaaS founders from the CyberWraith team.')

@section('content')

{{-- Hero --}}
<section style="padding:5rem 2.5rem 3rem;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 60% 50% at 50% 0%,rgba(168,85,247,0.06) 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:relative;z-index:1;max-width:640px;margin:0 auto;">
        <div class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.6);letter-spacing:0.3em;text-transform:uppercase;margin-bottom:1rem;">// BLOG.getPosts()</div>
        <h1 style="font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#fff;line-height:1.1;margin-bottom:1rem;">Insights for<br><span style="color:#a855f7;">Modern Freelancers</span></h1>
        <p style="font-size:0.9rem;color:rgba(255,255,255,0.4);line-height:1.7;">Guides, strategies and deep dives on freelancing, SaaS, productivity and the tools that help you scale.</p>
    </div>
</section>

<section style="padding:2rem 2.5rem 6rem;">
    <div style="max-width:1100px;margin:0 auto;">

        {{-- Category Filter --}}
        <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:3rem;flex-wrap:wrap;">
            @php
                $categories = ['All', 'Freelancing', 'SaaS', 'Productivity', 'Security', 'Business'];
            @endphp
            @foreach($categories as $i => $cat)
            <button onclick="filterPosts('{{ strtolower($cat) }}')" id="cat-{{ strtolower($cat) }}" class="font-mono" style="font-size:0.63rem;letter-spacing:0.12em;text-transform:uppercase;padding:0.35rem 1rem;border:1px solid {{ $i === 0 ? 'rgba(168,85,247,0.4)' : 'rgba(255,255,255,0.08)' }};background:{{ $i === 0 ? 'rgba(168,85,247,0.08)' : 'transparent' }};color:{{ $i === 0 ? '#a855f7' : 'rgba(255,255,255,0.3)' }};cursor:pointer;transition:all 0.2s;">
                {{ $cat }}
            </button>
            @endforeach
        </div>

        @if(isset($posts) && $posts->count() > 0)

            {{-- Featured Post --}}
            @php $featured = $posts->first(); @endphp
            <div class="post-card" data-category="{{ strtolower($featured->category ?? 'general') }}" style="background:#0a1520;border:1px solid rgba(168,85,247,0.15);padding:2.5rem;position:relative;margin-bottom:2rem;display:grid;grid-template-columns:1fr 1fr;gap:2.5rem;align-items:center;" onmouseover="this.style.borderColor='rgba(168,85,247,0.3)'" onmouseout="this.style.borderColor='rgba(168,85,247,0.15)'">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#a855f7,#00d4ff);opacity:0.5;"></div>
                <div>
                    <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1.25rem;">
                        <span class="font-mono" style="font-size:0.58rem;padding:0.2rem 0.6rem;border:1px solid rgba(168,85,247,0.3);color:#a855f7;letter-spacing:0.1em;text-transform:uppercase;">{{ $featured->category ?? 'General' }}</span>
                        <span class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.2);letter-spacing:0.05em;">FEATURED</span>
                    </div>
                    <h2 style="font-size:1.5rem;font-weight:800;color:#fff;line-height:1.25;margin-bottom:1rem;">{{ $featured->title }}</h2>
                    <p style="font-size:0.85rem;color:rgba(255,255,255,0.38);line-height:1.7;margin-bottom:1.5rem;">{{ $featured->excerpt }}</p>
                    <div style="display:flex;align-items:center;gap:1.5rem;">
                        <a href="/blog/{{ $featured->slug }}" class="font-mono" style="font-size:0.65rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#a855f7;text-decoration:none;display:inline-flex;align-items:center;gap:0.4rem;transition:gap 0.2s;" onmouseover="this.style.gap='0.8rem'" onmouseout="this.style.gap='0.4rem'">
                            Read Article →
                        </a>
                        <span class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.2);">{{ $featured->read_time ?? '5' }} min read · {{ $featured->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
                <div style="background:rgba(168,85,247,0.04);border:1px solid rgba(168,85,247,0.1);height:200px;display:flex;align-items:center;justify-content:center;">
                    <span style="font-size:4rem;opacity:0.4;">{{ $featured->emoji ?? '📝' }}</span>
                </div>
            </div>

            {{-- Post Grid --}}
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.25rem;">
                @foreach($posts->skip(1) as $post)
                <div class="post-card" data-category="{{ strtolower($post->category ?? 'general') }}" style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.75rem;position:relative;transition:all 0.3s;" onmouseover="this.style.borderColor='rgba(168,85,247,0.2)';this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)';this.style.transform='translateY(0)'">
                    <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#a855f7;opacity:0.25;"></div>
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
                        <span class="font-mono" style="font-size:0.58rem;padding:0.18rem 0.5rem;border:1px solid rgba(168,85,247,0.2);color:#a855f7;letter-spacing:0.1em;text-transform:uppercase;">{{ $post->category ?? 'General' }}</span>
                        <span class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.18);">{{ $post->read_time ?? '5' }} min</span>
                    </div>
                    <h3 style="font-size:0.95rem;font-weight:700;color:#fff;line-height:1.4;margin-bottom:0.6rem;">{{ $post->title }}</h3>
                    <p style="font-size:0.78rem;color:rgba(255,255,255,0.3);line-height:1.6;margin-bottom:1.25rem;">{{ $post->excerpt }}</p>
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <a href="/blog/{{ $post->slug }}" class="font-mono" style="font-size:0.6rem;color:#a855f7;text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;display:inline-flex;align-items:center;gap:0.3rem;transition:gap 0.2s;" onmouseover="this.style.gap='0.6rem'" onmouseout="this.style.gap='0.3rem'">
                            Read →
                        </a>
                        <span class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.18);">{{ $post->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($posts->hasPages())
            <div style="margin-top:3rem;display:flex;justify-content:center;">
                {{ $posts->links() }}
            </div>
            @endif

        @else

            {{-- Empty state — no posts yet --}}
            <div style="text-align:center;padding:5rem 2rem;background:#0a1520;border:1px solid rgba(255,255,255,0.05);">
                <div style="font-size:3rem;margin-bottom:1.5rem;opacity:0.3;">📝</div>
                <div class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.5);letter-spacing:0.25em;margin-bottom:1rem;">// POSTS.length === 0</div>
                <h2 style="font-size:1.25rem;font-weight:800;color:#fff;margin-bottom:0.75rem;">Articles Coming Soon</h2>
                <p style="font-size:0.85rem;color:rgba(255,255,255,0.3);max-width:400px;margin:0 auto 2rem;line-height:1.7;">
                    We are working on in-depth guides for freelancers, SaaS founders and agency owners. Check back soon.
                </p>
                <div style="display:flex;flex-direction:column;gap:0.75rem;max-width:320px;margin:0 auto;">
                    @foreach(['How to Price Your Freelance Services in 2025','The Complete Guide to Cold Email Outreach','Building a SaaS on a Freelance Budget','Linux Server Security: The Essential Checklist','How to Write Proposals That Actually Win'] as $upcoming)
                    <div style="background:rgba(168,85,247,0.04);border:1px solid rgba(168,85,247,0.08);padding:0.75rem 1rem;text-align:left;display:flex;align-items:center;gap:0.75rem;">
                        <span style="color:rgba(168,85,247,0.4);font-size:0.7rem;">◈</span>
                        <span class="font-mono" style="font-size:0.63rem;color:rgba(255,255,255,0.25);">{{ $upcoming }}</span>
                    </div>
                    @endforeach
                </div>
                <p class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.15);letter-spacing:0.15em;margin-top:1.5rem;">COMING SOON</p>
            </div>

        @endif

        {{-- Newsletter CTA --}}
        <div style="margin-top:4rem;padding:2.5rem;background:#0a1520;border:1px solid rgba(168,85,247,0.12);position:relative;overflow:hidden;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:2rem;">
            <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,#a855f7,transparent);"></div>
            <div>
                <div class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.5);letter-spacing:0.25em;margin-bottom:0.5rem;">// NEWSLETTER.subscribe()</div>
                <h3 style="font-size:1.1rem;font-weight:800;color:#fff;margin-bottom:0.4rem;">Get New Articles in Your Inbox</h3>
                <p style="font-size:0.8rem;color:rgba(255,255,255,0.3);">No spam. Unsubscribe anytime.</p>
            </div>
            <form method="POST" action="{{ route('newsletter.subscribe') }}" style="display:flex;gap:0.75rem;flex-wrap:wrap;">
                @csrf
                <input type="email" name="email" placeholder="your@email.com" required style="background:#050a0f;border:1px solid rgba(168,85,247,0.2);color:#a855f7;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.6rem 1rem;outline:none;min-width:240px;transition:border-color 0.2s;" onfocus="this.style.borderColor='rgba(168,85,247,0.5)'" onblur="this.style.borderColor='rgba(168,85,247,0.2)'">
                <button type="submit" style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#a855f7;padding:0.6rem 1.5rem;border:none;cursor:pointer;transition:opacity 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                    Subscribe →
                </button>
            </form>
        </div>

    </div>
</section>

<script>
function filterPosts(cat) {
    const cards = document.querySelectorAll('.post-card');
    const cats  = ['all','freelancing','saas','productivity','security','business'];
    cats.forEach(c => {
        const btn = document.getElementById('cat-' + c);
        if (!btn) return;
        btn.style.borderColor = 'rgba(255,255,255,0.08)';
        btn.style.background  = 'transparent';
        btn.style.color       = 'rgba(255,255,255,0.3)';
    });
    const active = document.getElementById('cat-' + cat);
    if (active) {
        active.style.borderColor = 'rgba(168,85,247,0.4)';
        active.style.background  = 'rgba(168,85,247,0.08)';
        active.style.color       = '#a855f7';
    }
    cards.forEach(card => {
        if (cat === 'all' || card.dataset.category === cat) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

@endsection
