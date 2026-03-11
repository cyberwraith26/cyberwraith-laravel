@extends('layouts.landing')

@section('title', $study->title . ' — CyberWraith Portfolio')
@section('description', $study->tagline)

@section('content')

@php $accent = $study->accent_color; @endphp

{{-- Hero --}}
<section style="padding:5rem 2.5rem 3.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 60% 50% at 50% 0%,{{ $accent }}0d 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:absolute;inset:0;background-image:linear-gradient({{ $accent }}08 1px,transparent 1px),linear-gradient(90deg,{{ $accent }}08 1px,transparent 1px);background-size:48px 48px;pointer-events:none;"></div>

    <div style="max-width:860px;margin:0 auto;position:relative;z-index:1;">

        {{-- Back --}}
        <a href="/portfolio" class="font-mono" style="font-size:0.6rem;color:{{ $accent }}99;letter-spacing:0.15em;text-transform:uppercase;text-decoration:none;display:inline-flex;align-items:center;gap:0.4rem;margin-bottom:2.5rem;transition:color 0.2s;" onmouseover="this.style.color='{{ $accent }}'" onmouseout="this.style.color='{{ $accent }}99'">
            ← Portfolio
        </a>

        {{-- Meta row --}}
        <div style="display:flex;align-items:center;gap:0.75rem;flex-wrap:wrap;margin-bottom:1.5rem;">
            <span class="font-mono" style="font-size:0.55rem;padding:0.2rem 0.65rem;border:1px solid {{ $accent }}4d;color:{{ $accent }};letter-spacing:0.1em;text-transform:uppercase;">{{ $study->category }}</span>
            @if($study->duration_weeks)
            <span class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.2);">{{ $study->duration_weeks }} weeks</span>
            @endif
            <span class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.2);">{{ $study->client_name }}</span>
        </div>

        <div style="font-size:3.5rem;margin-bottom:1rem;line-height:1;">{{ $study->emoji }}</div>
        <h1 style="font-size:clamp(1.8rem,4vw,2.8rem);font-weight:900;color:#fff;line-height:1.1;margin-bottom:1rem;">{{ $study->title }}</h1>
        <p style="font-size:1rem;color:rgba(255,255,255,0.45);line-height:1.7;max-width:640px;border-left:2px solid {{ $accent }}66;padding-left:1rem;">{{ $study->tagline }}</p>

    </div>
</section>

{{-- Results bar --}}
<div style="background:#0a1520;border-top:1px solid rgba(255,255,255,0.04);border-bottom:1px solid rgba(255,255,255,0.04);">
    <div style="max-width:860px;margin:0 auto;padding:1.75rem 2.5rem;display:grid;grid-template-columns:repeat(auto-fit,minmax(130px,1fr));gap:1.5rem;">
        @foreach($study->results as $result)
        <div style="text-align:center;">
            <div class="font-mono" style="font-size:1.5rem;font-weight:900;color:{{ $accent }};line-height:1;">{{ $result['metric'] }}</div>
            <div class="font-mono" style="font-size:0.52rem;color:rgba(255,255,255,0.25);letter-spacing:0.1em;text-transform:uppercase;margin-top:0.35rem;">{{ $result['label'] }}</div>
        </div>
        @endforeach
    </div>
</div>

{{-- Body content --}}
<section style="padding:4rem 2.5rem 6rem;">
    <div style="max-width:860px;margin:0 auto;display:grid;grid-template-columns:1fr 260px;gap:3.5rem;align-items:start;">

        {{-- Main content --}}
        <div>

            {{-- Overview --}}
            <div style="margin-bottom:3rem;">
                <div class="font-mono" style="font-size:0.58rem;color:{{ $accent }}99;letter-spacing:0.2em;text-transform:uppercase;margin-bottom:0.75rem;">// 01 — Overview</div>
                <div style="height:1px;background:linear-gradient(90deg,{{ $accent }}33,transparent);margin-bottom:1.5rem;"></div>
                <div style="font-size:0.88rem;color:rgba(255,255,255,0.55);line-height:1.9;">
                    @foreach(explode("\n\n", $study->overview) as $para)
                        <p style="margin-bottom:1rem;">{{ $para }}</p>
                    @endforeach
                </div>
            </div>

            {{-- Challenge --}}
            <div style="margin-bottom:3rem;">
                <div class="font-mono" style="font-size:0.58rem;color:{{ $accent }}99;letter-spacing:0.2em;text-transform:uppercase;margin-bottom:0.75rem;">// 02 — The Challenge</div>
                <div style="height:1px;background:linear-gradient(90deg,{{ $accent }}33,transparent);margin-bottom:1.5rem;"></div>
                <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);border-left:3px solid {{ $accent }}66;padding:1.5rem 1.75rem;">
                    <div style="font-size:0.88rem;color:rgba(255,255,255,0.55);line-height:1.9;">
                        @foreach(explode("\n\n", $study->challenge) as $para)
                            <p style="margin-bottom:1rem;">{{ $para }}</p>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Solution --}}
            <div style="margin-bottom:3rem;">
                <div class="font-mono" style="font-size:0.58rem;color:{{ $accent }}99;letter-spacing:0.2em;text-transform:uppercase;margin-bottom:0.75rem;">// 03 — The Solution</div>
                <div style="height:1px;background:linear-gradient(90deg,{{ $accent }}33,transparent);margin-bottom:1.5rem;"></div>
                <div style="font-size:0.88rem;color:rgba(255,255,255,0.55);line-height:1.9;">
                    @foreach(explode("\n\n", $study->solution) as $para)
                        <p style="margin-bottom:1rem;">{{ $para }}</p>
                    @endforeach
                </div>
            </div>

            {{-- Results detail --}}
            <div style="margin-bottom:3rem;">
                <div class="font-mono" style="font-size:0.58rem;color:{{ $accent }}99;letter-spacing:0.2em;text-transform:uppercase;margin-bottom:0.75rem;">// 04 — Results</div>
                <div style="height:1px;background:linear-gradient(90deg,{{ $accent }}33,transparent);margin-bottom:1.5rem;"></div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                    @foreach($study->results as $result)
                    <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.25rem 1.5rem;position:relative;overflow:hidden;">
                        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:{{ $accent }};opacity:0.3;"></div>
                        <div class="font-mono" style="font-size:1.6rem;font-weight:900;color:{{ $accent }};line-height:1;margin-bottom:0.35rem;">{{ $result['metric'] }}</div>
                        <div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.3);letter-spacing:0.08em;text-transform:uppercase;">{{ $result['label'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- Sidebar --}}
        <div style="position:sticky;top:2rem;">

            {{-- Tech stack --}}
            <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.5rem;margin-bottom:1.25rem;position:relative;">
                <div style="position:absolute;top:0;left:0;right:0;height:2px;background:{{ $accent }};opacity:0.3;"></div>
                <div class="font-mono" style="font-size:0.58rem;color:{{ $accent }}99;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:1rem;">Tech Stack</div>
                <div style="display:flex;flex-wrap:wrap;gap:0.4rem;">
                    @foreach($study->tech_stack as $tech)
                    <span class="font-mono" style="font-size:0.58rem;padding:0.2rem 0.6rem;border:1px solid rgba(255,255,255,0.07);color:rgba(255,255,255,0.35);">{{ $tech }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Project info --}}
            <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.5rem;margin-bottom:1.25rem;">
                <div class="font-mono" style="font-size:0.58rem;color:{{ $accent }}99;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:1rem;">Project Info</div>
                <div style="display:flex;flex-direction:column;gap:0.75rem;">
                    <div>
                        <div class="font-mono" style="font-size:0.52rem;color:rgba(255,255,255,0.2);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.2rem;">Client</div>
                        <div class="font-mono" style="font-size:0.7rem;color:rgba(255,255,255,0.5);">{{ $study->client_name }}</div>
                    </div>
                    <div>
                        <div class="font-mono" style="font-size:0.52rem;color:rgba(255,255,255,0.2);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.2rem;">Category</div>
                        <div class="font-mono" style="font-size:0.7rem;color:rgba(255,255,255,0.5);">{{ $study->category }}</div>
                    </div>
                    @if($study->duration_weeks)
                    <div>
                        <div class="font-mono" style="font-size:0.52rem;color:rgba(255,255,255,0.2);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.2rem;">Duration</div>
                        <div class="font-mono" style="font-size:0.7rem;color:rgba(255,255,255,0.5);">{{ $study->duration_weeks }} weeks</div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- CTA --}}
            <div style="background:{{ $accent }}0d;border:1px solid {{ $accent }}33;padding:1.5rem;text-align:center;">
                <div class="font-mono" style="font-size:0.55rem;color:{{ $accent }}99;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.6rem;">Want results like this?</div>
                <a href="{{ route('register') }}" class="font-mono" style="display:block;font-size:0.63rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:{{ $accent }};padding:0.6rem 1rem;text-decoration:none;transition:opacity 0.2s;margin-bottom:0.75rem;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                    Try CyberWraith Free →
                </a>
                <a href="/portfolio" class="font-mono" style="font-size:0.58rem;color:{{ $accent }}66;text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='{{ $accent }}'" onmouseout="this.style.color='{{ $accent }}66'">← All Case Studies</a>
            </div>

        </div>
    </div>
</section>

@endsection
