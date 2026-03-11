@extends('layouts.landing')

@section('title', $service['name'] . ' — CyberWraith')
@section('description', $service['description'])

@section('content')

{{-- Hero --}}
<section style="padding:5rem 2.5rem 3.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 60% 50% at 50% 0%,{{ $service['color'] }}08 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,{{ $service['color'] }},transparent);opacity:0.4;"></div>

    <div style="max-width:860px;margin:0 auto;position:relative;z-index:1;">

        {{-- Breadcrumb --}}
        <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:2.5rem;">
            <a href="/services" class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.25);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='{{ $service['color'] }}'" onmouseout="this.style.color='rgba(255,255,255,0.25)'">Services</a>
            <span class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.12);">/</span>
            <span class="font-mono" style="font-size:0.6rem;color:{{ $service['color'] }};letter-spacing:0.1em;text-transform:uppercase;">{{ $service['name'] }}</span>
        </div>

        <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1.5rem;flex-wrap:wrap;">
            <span class="font-mono" style="font-size:0.58rem;padding:0.2rem 0.75rem;border:1px solid {{ $service['color'] }}30;color:{{ $service['color'] }};letter-spacing:0.12em;text-transform:uppercase;">{{ $service['tag'] }}</span>
            <span class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.18);letter-spacing:0.1em;">⏱ {{ $service['delivery'] }}</span>
        </div>

        <div style="display:flex;align-items:flex-start;gap:1.5rem;margin-bottom:1.5rem;flex-wrap:wrap;">
            <div style="width:60px;height:60px;background:{{ $service['color'] }}12;border:1px solid {{ $service['color'] }}25;display:flex;align-items:center;justify-content:center;font-size:1.75rem;flex-shrink:0;">{{ $service['icon'] }}</div>
            <div>
                <h1 style="font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#fff;line-height:1.05;margin-bottom:0.5rem;">{{ $service['name'] }}</h1>
                <p style="font-size:0.95rem;color:rgba(255,255,255,0.4);line-height:1.6;max-width:540px;">{{ $service['tagline'] }}</p>
            </div>
        </div>

        <div style="display:flex;align-items:center;gap:1.25rem;flex-wrap:wrap;margin-top:2rem;">
            <a href="/#contact" style="font-family:'JetBrains Mono',monospace;font-size:0.72rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#000;background:{{ $service['color'] }};padding:0.8rem 2rem;text-decoration:none;clip-path:polygon(8px 0,100% 0,calc(100% - 8px) 100%,0 100%);transition:opacity 0.2s;display:inline-flex;align-items:center;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                Get a Quote →
            </a>
            <div class="font-mono" style="font-size:0.65rem;color:rgba(255,255,255,0.2);">Starting from <span style="color:{{ $service['color'] }};font-weight:700;">{{ $service['starting'] }}</span></div>
        </div>

    </div>
</section>

{{-- Main Content --}}
<section style="padding:1rem 2.5rem 6rem;">
    <div style="max-width:1100px;margin:0 auto;display:grid;grid-template-columns:1fr 340px;gap:3rem;align-items:start;">

        {{-- Left column --}}
        <div>

            {{-- Overview --}}
            <div style="margin-bottom:3rem;">
                <div class="font-mono" style="font-size:0.58rem;color:{{ $service['color'] }};letter-spacing:0.25em;text-transform:uppercase;margin-bottom:0.875rem;">// OVERVIEW</div>
                <p style="font-size:0.9rem;color:rgba(255,255,255,0.5);line-height:1.85;">{{ $service['overview'] }}</p>
            </div>

            {{-- The Problem --}}
            <div style="margin-bottom:3rem;padding:1.75rem;background:#0a1520;border:1px solid rgba(255,255,255,0.05);position:relative;overflow:hidden;">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:{{ $service['color'] }};opacity:0.25;"></div>
                <div class="font-mono" style="font-size:0.58rem;color:{{ $service['color'] }};letter-spacing:0.25em;text-transform:uppercase;margin-bottom:0.875rem;">// THE PROBLEM</div>
                <p style="font-size:0.85rem;color:rgba(255,255,255,0.4);line-height:1.8;margin:0;">{{ $service['problem'] }}</p>
            </div>

            {{-- Our Approach --}}
            <div style="margin-bottom:3rem;">
                <div class="font-mono" style="font-size:0.58rem;color:{{ $service['color'] }};letter-spacing:0.25em;text-transform:uppercase;margin-bottom:0.875rem;">// OUR APPROACH</div>
                <p style="font-size:0.9rem;color:rgba(255,255,255,0.5);line-height:1.85;">{{ $service['approach'] }}</p>
            </div>

            {{-- Process Steps --}}
            <div style="margin-bottom:3rem;">
                <div class="font-mono" style="font-size:0.58rem;color:{{ $service['color'] }};letter-spacing:0.25em;text-transform:uppercase;margin-bottom:1.5rem;">// PROCESS</div>
                <div style="display:flex;flex-direction:column;gap:0px;">
                    @foreach($service['process'] as $i => $step)
                    <div style="display:flex;gap:1.25rem;padding:1.25rem 0;{{ !$loop->last ? 'border-bottom:1px solid rgba(255,255,255,0.04);' : '' }}">
                        <div class="font-mono" style="font-size:0.65rem;font-weight:900;color:{{ $service['color'] }};opacity:0.4;flex-shrink:0;width:24px;padding-top:0.1rem;">0{{ $loop->iteration }}</div>
                        <div>
                            <div class="font-mono" style="font-size:0.72rem;font-weight:700;color:rgba(255,255,255,0.7);margin-bottom:0.3rem;">{{ $step[0] }}</div>
                            <div style="font-size:0.8rem;color:rgba(255,255,255,0.32);line-height:1.6;">{{ $step[1] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- FAQs --}}
            <div style="margin-bottom:3rem;">
                <div class="font-mono" style="font-size:0.58rem;color:{{ $service['color'] }};letter-spacing:0.25em;text-transform:uppercase;margin-bottom:1.5rem;">// FAQ</div>
                <div style="display:flex;flex-direction:column;gap:0.75rem;">
                    @foreach($service['faqs'] as $i => $faq)
                    <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);overflow:hidden;">
                        <button onclick="toggleFaq({{ $i }})" style="width:100%;background:none;border:none;padding:1.1rem 1.25rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;cursor:pointer;text-align:left;">
                            <span class="font-mono" style="font-size:0.75rem;font-weight:700;color:rgba(255,255,255,0.65);">{{ $faq[0] }}</span>
                            <span id="sfaq-icon-{{ $i }}" style="color:{{ $service['color'] }};font-size:1rem;flex-shrink:0;transition:transform 0.3s;font-family:monospace;">+</span>
                        </button>
                        <div id="sfaq-body-{{ $i }}" style="max-height:0;overflow:hidden;transition:max-height 0.35s ease;">
                            <div style="padding:0 1.25rem 1.1rem;">
                                <div style="height:1px;background:{{ $service['color'] }}18;margin-bottom:0.875rem;"></div>
                                <p style="font-size:0.78rem;color:rgba(255,255,255,0.35);line-height:1.75;margin:0;">{{ $faq[1] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Testimonial --}}
            <div style="padding:1.75rem;background:#0a1520;border:1px solid {{ $service['color'] }}18;position:relative;overflow:hidden;">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:{{ $service['color'] }};opacity:0.3;"></div>
                <div style="font-size:2rem;color:{{ $service['color'] }};opacity:0.2;margin-bottom:0.75rem;font-family:Georgia,serif;line-height:1;">"</div>
                <p style="font-size:0.85rem;color:rgba(255,255,255,0.48);line-height:1.8;font-style:italic;margin-bottom:1rem;">"{{ $service['testimonial'][0] }}"</p>
                <div class="font-mono" style="font-size:0.62rem;color:{{ $service['color'] }};font-weight:700;">— {{ $service['testimonial'][1] }}</div>
            </div>

        </div>

        {{-- Right sidebar --}}
        <div style="position:sticky;top:5rem;display:flex;flex-direction:column;gap:1.25rem;">

            {{-- Pricing card --}}
            <div style="background:#0a1520;border:1px solid {{ $service['color'] }}25;padding:1.75rem;position:relative;overflow:hidden;">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:{{ $service['color'] }};opacity:0.5;"></div>
                <div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.2);letter-spacing:0.2em;text-transform:uppercase;margin-bottom:0.5rem;">Starting From</div>
                <div style="font-size:2.5rem;font-weight:900;color:{{ $service['color'] }};line-height:1;margin-bottom:0.25rem;">{{ $service['starting'] }}</div>
                <div class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.2);margin-bottom:1.5rem;">{{ $service['delivery'] }}</div>
                <a href="/#contact" style="display:block;text-align:center;font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:{{ $service['color'] }};padding:0.75rem;text-decoration:none;transition:opacity 0.2s;margin-bottom:1rem;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                    Get a Quote →
                </a>
                <div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.15);text-align:center;letter-spacing:0.08em;">We respond within 24 hours</div>
            </div>

            {{-- What's included --}}
            <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.75rem;">
                <div class="font-mono" style="font-size:0.58rem;color:{{ $service['color'] }};letter-spacing:0.2em;text-transform:uppercase;margin-bottom:1.25rem;">What's Included</div>
                <ul style="list-style:none;display:flex;flex-direction:column;gap:0.6rem;">
                    @foreach($service['features'] as $f)
                    <li class="font-mono" style="font-size:0.63rem;color:rgba(255,255,255,0.35);display:flex;align-items:flex-start;gap:0.5rem;line-height:1.5;">
                        <span style="color:{{ $service['color'] }};flex-shrink:0;">✓</span> {{ $f }}
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Deliverables --}}
            <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.75rem;">
                <div class="font-mono" style="font-size:0.58rem;color:{{ $service['color'] }};letter-spacing:0.2em;text-transform:uppercase;margin-bottom:1.25rem;">Deliverables</div>
                <ul style="list-style:none;display:flex;flex-direction:column;gap:0.6rem;">
                    @foreach($service['deliverables'] as $d)
                    <li class="font-mono" style="font-size:0.63rem;color:rgba(255,255,255,0.35);display:flex;align-items:flex-start;gap:0.5rem;line-height:1.5;">
                        <span style="color:{{ $service['color'] }};flex-shrink:0;">→</span> {{ $d }}
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</section>

{{-- More Services --}}
<section style="padding:3rem 2.5rem 6rem;border-top:1px solid rgba(255,255,255,0.04);">
    <div style="max-width:1100px;margin:0 auto;">
        <div class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.2);letter-spacing:0.25em;text-transform:uppercase;margin-bottom:2rem;">// OTHER SERVICES</div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.25rem;">
            @foreach($others as $other)
            <a href="/services/{{ $other['slug'] }}" style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.5rem;text-decoration:none;display:block;position:relative;overflow:hidden;transition:all 0.3s;" onmouseover="this.style.borderColor='{{ $other['color'] }}25';this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)';this.style.transform='translateY(0)'">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:{{ $other['color'] }};opacity:0.3;"></div>
                <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:0.75rem;">
                    <span style="font-size:1.25rem;">{{ $other['icon'] }}</span>
                    <div>
                        <div class="font-mono" style="font-size:0.55rem;color:{{ $other['color'] }};letter-spacing:0.12em;text-transform:uppercase;margin-bottom:0.15rem;">{{ $other['tag'] }}</div>
                        <div style="font-size:0.9rem;font-weight:700;color:#fff;">{{ $other['name'] }}</div>
                    </div>
                </div>
                <p style="font-size:0.75rem;color:rgba(255,255,255,0.3);line-height:1.6;margin-bottom:1rem;">{{ $other['description'] }}</p>
                <span class="font-mono" style="font-size:0.6rem;color:{{ $other['color'] }};letter-spacing:0.1em;text-transform:uppercase;">Learn More →</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

<script>
function toggleFaq(i) {
    const body = document.getElementById('sfaq-body-' + i);
    const icon = document.getElementById('sfaq-icon-' + i);
    const isOpen = body.style.maxHeight !== '0px' && body.style.maxHeight !== '';
    document.querySelectorAll('[id^="sfaq-body-"]').forEach(el => el.style.maxHeight = '0px');
    document.querySelectorAll('[id^="sfaq-icon-"]').forEach(el => { el.textContent = '+'; el.style.transform = 'rotate(0deg)'; });
    if (!isOpen) {
        body.style.maxHeight = body.scrollHeight + 'px';
        icon.textContent = '−';
    }
}
</script>

@endsection
