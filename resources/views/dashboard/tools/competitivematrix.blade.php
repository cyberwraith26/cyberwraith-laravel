<div style="padding:1.5rem;">
<div style="display:grid;grid-template-columns:1fr 1.4fr;gap:2rem;">
  <div>
    <div class="font-mono" style="font-size:0.6rem;color:#f59e0b88;letter-spacing:0.2em;margin-bottom:1.25rem;">// COMPETITIVEMATRIX.run()</div>
    <div style="display:flex;flex-direction:column;gap:1rem;">
      <div>
        <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:#f59e0b99;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Your service and your top 3-5 competitors</label>
        <textarea id="competitivematrix-in" rows="9" placeholder="E.g. I'm a freelance UX designer. Competitors: other freelancers on Upwork/Toptal, local agencies, offshore teams, in-house designers. My edges: fast turnaround, startup experience, Figma expert..." style="width:100%;background:#050a0f;border:1px solid #f59e0b22;color:#f59e0b;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.75rem;outline:none;resize:vertical;line-height:1.6;" onfocus="this.style.borderColor='#f59e0b55'" onblur="this.style.borderColor='#f59e0b22'"></textarea>
      </div>

      <button onclick="run_competitivematrix()" id="competitivematrix-btn" style="width:100%;background:#f59e0b;color:#000;font-family:'JetBrains Mono',monospace;font-size:0.7rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.85rem;border:none;cursor:pointer;transition:opacity 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
        ✨ Generate →
      </button>
      <div style="background:#050a0f;border:1px solid rgba(255,255,255,0.04);padding:0.875rem;">
        <div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.2);letter-spacing:0.12em;margin-bottom:0.4rem;">POWERED BY</div>
        <div style="display:flex;align-items:center;gap:0.5rem;">
          <span style="font-size:0.8rem;">✦</span>
          <span class="font-mono" style="font-size:0.62rem;color:rgba(255,255,255,0.35);">Claude AI (claude-sonnet-4)</span>
        </div>
      </div>
    </div>
  </div>
  <div>
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
      <div class="font-mono" style="font-size:0.6rem;color:#f59e0b88;letter-spacing:0.2em;">// OUTPUT.stream()</div>
      <div style="display:flex;gap:0.5rem;">
        <button onclick="copyOut_competitivematrix()" id="competitivematrix-copy" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.3);background:transparent;border:1px solid rgba(255,255,255,0.08);padding:0.25rem 0.75rem;cursor:pointer;transition:all 0.2s;">Copy</button>
        <button onclick="clearOut_competitivematrix()" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.2);background:transparent;border:1px solid rgba(255,255,255,0.05);padding:0.25rem 0.75rem;cursor:pointer;">Clear</button>
      </div>
    </div>
    <div id="competitivematrix-out" style="background:#050a0f;border:1px solid #f59e0b18;padding:1.5rem;min-height:440px;font-size:0.78rem;color:rgba(255,255,255,0.5);line-height:1.9;white-space:pre-wrap;font-family:'JetBrains Mono',monospace;overflow-y:auto;max-height:560px;">
      <span style="color:#f59e0b33;">// Fill in the input and click Generate.
// The AI will produce detailed, actionable output
// tailored exactly to your situation.</span>
    </div>
    <div style="margin-top:0.5rem;display:flex;justify-content:space-between;">
      <div id="competitivematrix-status" class="font-mono" style="font-size:0.52rem;color:rgba(255,255,255,0.15);"></div>
      <div id="competitivematrix-wc" class="font-mono" style="font-size:0.52rem;color:#f59e0b55;"></div>
    </div>
  </div>
</div>
</div>
<script>
async function run_competitivematrix() {
  const input = document.getElementById('competitivematrix-in').value.trim();
  const out = document.getElementById('competitivematrix-out');
  const btn = document.getElementById('competitivematrix-btn');
  const stat = document.getElementById('competitivematrix-status');
  const wc = document.getElementById('competitivematrix-wc');
  if (!input) { alert('Please fill in the input field.'); return; }
  btn.textContent = '⟳ Generating...'; btn.disabled = true;
  out.innerHTML = '<span style="color:#f59e0b55;">⟳ Connecting to AI...</span>';
  stat.textContent = 'Processing...'; wc.textContent = '';

  const prompt = `Build a comprehensive competitive analysis and matrix for:

{input}

Deliver:
1) Competitive landscape overview (how the market is structured)
2) Competitor profiles (for each competitor listed):
   - Their core offer and positioning
   - Who they target
   - Price range
   - Strengths and weaknesses
3) Comparison matrix (you vs competitors on key dimensions)
4) Dimensions to compare: price, speed, quality, specialization, communication, results, trust signals
5) Your clear advantages (where you win)
6) Your honest weaknesses (where you need to improve or avoid competing)
7) Market gaps — underserved segments you could own
8) Positioning recommendation: which gap to occupy and how
9) How to communicate your competitive advantage without being defensive
10) What to say when clients compare you to cheaper alternatives
11) The moat: what would make your position unassailable over 12 months?

Be honest and strategic — this is for internal use.`.replace('{input}', input);
  try {
    const res = await fetch('https://api.anthropic.com/v1/messages', {
      method: 'POST', headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ model: 'claude-sonnet-4-20250514', max_tokens: 1000,
        messages: [{ role: 'user', content: prompt }] })
    });
    const data = await res.json();
    const text = data.content?.[0]?.text || 'Error: No response from AI.';
    out.style.color = 'rgba(255,255,255,0.75)'; out.textContent = text;
    wc.textContent = text.split(' ').length + ' words';
    stat.textContent = 'Done · ' + new Date().toLocaleTimeString();
  } catch(e) {
    out.style.color = '#ef4444';
    out.textContent = 'Connection error. Please try again.';
    stat.textContent = 'Error';
  }
  btn.textContent = '✨ Generate →'; btn.disabled = false;
}
function copyOut_competitivematrix() {
  navigator.clipboard.writeText(document.getElementById('competitivematrix-out').textContent).then(() => {
    const b = document.getElementById('competitivematrix-copy');
    b.textContent = '✓ Copied!'; b.style.color = '#00ff88';
    setTimeout(() => { b.textContent = 'Copy'; b.style.color = 'rgba(255,255,255,0.3)'; }, 2000);
  });
}
function clearOut_competitivematrix() {
  const out = document.getElementById('competitivematrix-out');
  out.style.color='rgba(255,255,255,0.5)';
  out.innerHTML = '<span style="color:#f59e0b33;">// Output cleared.</span>';
  document.getElementById('competitivematrix-wc').textContent='';
  document.getElementById('competitivematrix-status').textContent='';
}
</script>
