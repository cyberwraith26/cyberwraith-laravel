<div style="padding:1.5rem;">
<div style="display:grid;grid-template-columns:1fr 1.4fr;gap:2rem;">
  <div>
    <div class="font-mono" style="font-size:0.6rem;color:#ef444488;letter-spacing:0.2em;margin-bottom:1.25rem;">// BUSINESSPLANWRITER.run()</div>
    <div style="display:flex;flex-direction:column;gap:1rem;">
      <div>
        <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:#ef444499;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Your business, current state, goals, and timeframe</label>
        <textarea id="businessplanwriter-in" rows="9" placeholder="E.g. Solo freelance dev agency, currently $6K/month revenue, 3 regular clients. Want to grow to $25K/month in 18 months by hiring 2 contractors and productizing services..." style="width:100%;background:#050a0f;border:1px solid #ef444422;color:#ef4444;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.75rem;outline:none;resize:vertical;line-height:1.6;" onfocus="this.style.borderColor='#ef444455'" onblur="this.style.borderColor='#ef444422'"></textarea>
      </div>

      <button onclick="run_businessplanwriter()" id="businessplanwriter-btn" style="width:100%;background:#ef4444;color:#000;font-family:'JetBrains Mono',monospace;font-size:0.7rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.85rem;border:none;cursor:pointer;transition:opacity 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
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
      <div class="font-mono" style="font-size:0.6rem;color:#ef444488;letter-spacing:0.2em;">// OUTPUT.stream()</div>
      <div style="display:flex;gap:0.5rem;">
        <button onclick="copyOut_businessplanwriter()" id="businessplanwriter-copy" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.3);background:transparent;border:1px solid rgba(255,255,255,0.08);padding:0.25rem 0.75rem;cursor:pointer;transition:all 0.2s;">Copy</button>
        <button onclick="clearOut_businessplanwriter()" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.2);background:transparent;border:1px solid rgba(255,255,255,0.05);padding:0.25rem 0.75rem;cursor:pointer;">Clear</button>
      </div>
    </div>
    <div id="businessplanwriter-out" style="background:#050a0f;border:1px solid #ef444418;padding:1.5rem;min-height:440px;font-size:0.78rem;color:rgba(255,255,255,0.5);line-height:1.9;white-space:pre-wrap;font-family:'JetBrains Mono',monospace;overflow-y:auto;max-height:560px;">
      <span style="color:#ef444433;">// Fill in the input and click Generate.
// The AI will produce detailed, actionable output
// tailored exactly to your situation.</span>
    </div>
    <div style="margin-top:0.5rem;display:flex;justify-content:space-between;">
      <div id="businessplanwriter-status" class="font-mono" style="font-size:0.52rem;color:rgba(255,255,255,0.15);"></div>
      <div id="businessplanwriter-wc" class="font-mono" style="font-size:0.52rem;color:#ef444455;"></div>
    </div>
  </div>
</div>
</div>
<script>
async function run_businessplanwriter() {
  const input = document.getElementById('businessplanwriter-in').value.trim();
  const out = document.getElementById('businessplanwriter-out');
  const btn = document.getElementById('businessplanwriter-btn');
  const stat = document.getElementById('businessplanwriter-status');
  const wc = document.getElementById('businessplanwriter-wc');
  if (!input) { alert('Please fill in the input field.'); return; }
  btn.textContent = '⟳ Generating...'; btn.disabled = true;
  out.innerHTML = '<span style="color:#ef444455;">⟳ Connecting to AI...</span>';
  stat.textContent = 'Processing...'; wc.textContent = '';

  const prompt = `Write a focused, realistic business plan for:

{input}

Structure as:
1) Executive Summary (half page — vision, current state, goal, strategy)
2) Business Description (what you do, for whom, how you deliver)
3) Market Analysis (your niche, size, key trends, why now)
4) Competitive Analysis (your positioning and moat)
5) Service Offering (what you sell, at what price, the value delivered)
6) Go-To-Market Strategy (how you'll acquire clients at scale)
7) Operations Plan (team, tools, processes, capacity)
8) Financial Projections:
   - Revenue model with assumptions
   - Monthly targets for 18 months
   - Key expenses
   - Break-even analysis
9) Milestones and KPIs (what success looks like at 3, 6, 12, 18 months)
10) Risks and Mitigation
11) What You Need to Execute (skills, hires, capital, tools)

Make it concise, actionable, and honest — not corporate fluff.`.replace('{input}', input);
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
function copyOut_businessplanwriter() {
  navigator.clipboard.writeText(document.getElementById('businessplanwriter-out').textContent).then(() => {
    const b = document.getElementById('businessplanwriter-copy');
    b.textContent = '✓ Copied!'; b.style.color = '#00ff88';
    setTimeout(() => { b.textContent = 'Copy'; b.style.color = 'rgba(255,255,255,0.3)'; }, 2000);
  });
}
function clearOut_businessplanwriter() {
  const out = document.getElementById('businessplanwriter-out');
  out.style.color='rgba(255,255,255,0.5)';
  out.innerHTML = '<span style="color:#ef444433;">// Output cleared.</span>';
  document.getElementById('businessplanwriter-wc').textContent='';
  document.getElementById('businessplanwriter-status').textContent='';
}
</script>
