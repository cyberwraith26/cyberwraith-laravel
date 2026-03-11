<div style="padding:1.5rem;">
<div style="display:grid;grid-template-columns:1fr 1.4fr;gap:2rem;">

    {{-- Left: Inputs --}}
    <div>
        <div class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.5);letter-spacing:0.2em;margin-bottom:1.25rem;">// PROPOSAL.generate()</div>

        <div style="display:flex;flex-direction:column;gap:1rem;">
            <div>
                <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(168,85,247,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Client Name</label>
                <input type="text" id="pg-client" placeholder="Acme Corporation" style="width:100%;background:#050a0f;border:1px solid rgba(168,85,247,0.2);color:#a855f7;font-family:'JetBrains Mono',monospace;font-size:0.78rem;padding:0.6rem 0.75rem;outline:none;" onfocus="this.style.borderColor='rgba(168,85,247,0.5)'" onblur="this.style.borderColor='rgba(168,85,247,0.2)'">
            </div>
            <div>
                <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(168,85,247,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Project Type</label>
                <select id="pg-type" style="width:100%;background:#050a0f;border:1px solid rgba(168,85,247,0.2);color:rgba(168,85,247,0.7);font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.6rem 0.75rem;outline:none;cursor:pointer;">
                    <option>Web Development</option>
                    <option>Mobile App</option>
                    <option>UI/UX Design</option>
                    <option>SEO & Marketing</option>
                    <option>Brand Identity</option>
                    <option>SaaS Development</option>
                    <option>Security Audit</option>
                    <option>Content Strategy</option>
                </select>
            </div>
            <div>
                <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(168,85,247,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Project Brief</label>
                <textarea id="pg-brief" rows="4" placeholder="Describe what the client needs. E.g. 'E-commerce site for a fashion brand, needs payment integration, 50 products, mobile-first design...'" style="width:100%;background:#050a0f;border:1px solid rgba(168,85,247,0.2);color:#a855f7;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.6rem 0.75rem;outline:none;resize:vertical;" onfocus="this.style.borderColor='rgba(168,85,247,0.5)'" onblur="this.style.borderColor='rgba(168,85,247,0.2)'"></textarea>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div>
                    <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(168,85,247,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Budget Range</label>
                    <select id="pg-budget" style="width:100%;background:#050a0f;border:1px solid rgba(168,85,247,0.2);color:rgba(168,85,247,0.7);font-family:'JetBrains Mono',monospace;font-size:0.72rem;padding:0.6rem 0.75rem;outline:none;cursor:pointer;">
                        <option>$500 - $1,000</option>
                        <option>$1,000 - $3,000</option>
                        <option>$3,000 - $8,000</option>
                        <option>$8,000 - $20,000</option>
                        <option>$20,000+</option>
                    </select>
                </div>
                <div>
                    <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(168,85,247,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Timeline</label>
                    <select id="pg-timeline" style="width:100%;background:#050a0f;border:1px solid rgba(168,85,247,0.2);color:rgba(168,85,247,0.7);font-family:'JetBrains Mono',monospace;font-size:0.72rem;padding:0.6rem 0.75rem;outline:none;cursor:pointer;">
                        <option>1 - 2 weeks</option>
                        <option>2 - 4 weeks</option>
                        <option>1 - 2 months</option>
                        <option>2 - 4 months</option>
                        <option>4+ months</option>
                    </select>
                </div>
            </div>
            <div>
                <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(168,85,247,0.6);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Tone</label>
                <div style="display:flex;gap:0.5rem;flex-wrap:wrap;">
                    @foreach(['Professional','Friendly','Bold','Technical','Consultative'] as $tone)
                    <label style="cursor:pointer;">
                        <input type="radio" name="pg-tone" value="{{$tone}}" {{ $loop->first ? 'checked' : '' }} style="display:none;">
                        <span class="tone-btn font-mono" style="display:inline-block;font-size:0.6rem;padding:0.3rem 0.75rem;border:1px solid rgba(168,85,247,{{ $loop->first ? '0.5' : '0.15' }});color:{{ $loop->first ? '#a855f7' : 'rgba(255,255,255,0.25)' }};cursor:pointer;transition:all 0.2s;background:{{ $loop->first ? 'rgba(168,85,247,0.08)' : 'transparent' }};">{{$tone}}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            <button onclick="generateProposal()" id="pg-btn" style="width:100%;background:#a855f7;color:#fff;font-family:'JetBrains Mono',monospace;font-size:0.72rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.8rem;border:none;cursor:pointer;transition:opacity 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                ✨ Generate Proposal →
            </button>
        </div>
    </div>

    {{-- Right: Output --}}
    <div>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
            <div class="font-mono" style="font-size:0.6rem;color:rgba(168,85,247,0.5);letter-spacing:0.2em;">// PROPOSAL.output()</div>
            <div style="display:flex;gap:0.5rem;">
                <button onclick="copyProposal()" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.3);background:transparent;border:1px solid rgba(255,255,255,0.08);padding:0.25rem 0.75rem;cursor:pointer;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.3)'">Copy</button>
                <button onclick="window.print()" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(168,85,247,0.5);background:transparent;border:1px solid rgba(168,85,247,0.15);padding:0.25rem 0.75rem;cursor:pointer;">Export</button>
            </div>
        </div>

        <div id="pg-output" style="background:#050a0f;border:1px solid rgba(168,85,247,0.1);padding:1.5rem;min-height:480px;font-size:0.8rem;color:rgba(255,255,255,0.5);line-height:1.8;white-space:pre-wrap;font-family:'JetBrains Mono',monospace;overflow-y:auto;max-height:600px;">
<span style="color:rgba(168,85,247,0.3);">// Fill in the form and click Generate to create your proposal.
// The AI will write a complete, client-ready proposal based on your inputs.

// Features:
// ✓ Professional formatting
// ✓ Scope of work
// ✓ Deliverables & timeline
// ✓ Investment breakdown
// ✓ Next steps CTA</span>
        </div>

        {{-- Token counter --}}
        <div style="margin-top:0.5rem;display:flex;justify-content:space-between;align-items:center;">
            <div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.15);">Powered by Claude AI</div>
            <div id="pg-status" class="font-mono" style="font-size:0.55rem;color:rgba(168,85,247,0.4);"></div>
        </div>
    </div>
</div>
</div>

<script>
// Tone button toggle
document.querySelectorAll('input[name="pg-tone"]').forEach(radio => {
    radio.addEventListener('change', () => {
        document.querySelectorAll('.tone-btn').forEach(btn => {
            btn.style.borderColor = 'rgba(168,85,247,0.15)';
            btn.style.color = 'rgba(255,255,255,0.25)';
            btn.style.background = 'transparent';
        });
        const span = radio.nextElementSibling;
        span.style.borderColor = 'rgba(168,85,247,0.5)';
        span.style.color = '#a855f7';
        span.style.background = 'rgba(168,85,247,0.08)';
    });
});

async function generateProposal() {
    const client = document.getElementById('pg-client').value.trim() || 'the client';
    const type = document.getElementById('pg-type').value;
    const brief = document.getElementById('pg-brief').value.trim();
    const budget = document.getElementById('pg-budget').value;
    const timeline = document.getElementById('pg-timeline').value;
    const tone = document.querySelector('input[name="pg-tone"]:checked').value;
    const output = document.getElementById('pg-output');
    const btn = document.getElementById('pg-btn');
    const status = document.getElementById('pg-status');

    if (!brief) { alert('Please describe the project brief.'); return; }

    btn.textContent = '⟳ Generating...';
    btn.disabled = true;
    output.textContent = '';
    status.textContent = 'Connecting to AI...';

    const prompt = `Write a professional ${tone.toLowerCase()} freelance proposal for a ${type} project.

Client: ${client}
Project Brief: ${brief}
Budget Range: ${budget}
Timeline: ${timeline}
Tone: ${tone}

Write a complete, client-ready proposal with these sections:
1. Executive Summary (2-3 sentences that show you understand their need)
2. Understanding Your Project (what you understand about their goals)
3. Proposed Approach (how you will solve their problem, step by step)
4. Deliverables (specific list of what they receive)
5. Timeline & Milestones (broken into phases)
6. Investment (budget breakdown by phase/deliverable)
7. Why Choose Me (3 specific reasons, not generic)
8. Next Steps (clear CTA)

Make it compelling, specific, and ${tone.toLowerCase()}. Use professional formatting. Address the client by name. Do not use placeholder text.`;

    try {
        const res = await fetch('https://api.anthropic.com/v1/messages', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                model: 'claude-sonnet-4-20250514',
                max_tokens: 1000,
                messages: [{ role: 'user', content: prompt }]
            })
        });
        const data = await res.json();
        const text = data.content?.[0]?.text || 'Error generating proposal. Please try again.';
        output.style.color = 'rgba(255,255,255,0.7)';
        output.textContent = text;
        status.textContent = `Generated · ${text.split(' ').length} words`;
    } catch(e) {
        output.style.color = '#ef4444';
        output.textContent = 'Failed to connect to AI. Please check your connection.';
    }
    btn.textContent = '✨ Generate Proposal →';
    btn.disabled = false;
}

function copyProposal() {
    const text = document.getElementById('pg-output').textContent;
    navigator.clipboard.writeText(text).then(() => {
        const btn = event.target;
        btn.textContent = 'Copied!';
        setTimeout(() => btn.textContent = 'Copy', 2000);
    });
}
</script>
