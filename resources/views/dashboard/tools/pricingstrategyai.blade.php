<div style="padding:1.5rem;">
<div style="display:grid;grid-template-columns:1fr 1.4fr;gap:2rem;">
  <div>
    <div class="font-mono" style="font-size:0.6rem;color:#a855f788;letter-spacing:0.2em;margin-bottom:1.25rem;">// PRICINGSTRATEGYAI.run()</div>
    <div style="display:flex;flex-direction:column;gap:1rem;">
      <div>
        <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:#a855f799;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Your service, current pricing approach, and business goals</label>
        <textarea id="pricingstrategyai-in" rows="9" placeholder="E.g. Freelance copywriter currently charging $80/hr. Want to move to project-based pricing or retainers. Struggling to justify rates vs cheaper competitors. Want to earn $120K this year..." style="width:100%;background:#050a0f;border:1px solid #a855f722;color:#a855f7;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.75rem;outline:none;resize:vertical;line-height:1.6;" onfocus="this.style.borderColor='#a855f755'" onblur="this.style.borderColor='#a855f722'"></textarea>
      </div>

      <button onclick="run_pricingstrategyai()" id="pricingstrategyai-btn" style="width:100%;background:#a855f7;color:#000;font-family:'JetBrains Mono',monospace;font-size:0.7rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.85rem;border:none;cursor:pointer;transition:opacity 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
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
      <div class="font-mono" style="font-size:0.6rem;color:#a855f788;letter-spacing:0.2em;">// OUTPUT.stream()</div>
      <div style="display:flex;gap:0.5rem;">
        <button onclick="copyOut_pricingstrategyai()" id="pricingstrategyai-copy" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.3);background:transparent;border:1px solid rgba(255,255,255,0.08);padding:0.25rem 0.75rem;cursor:pointer;transition:all 0.2s;">Copy</button>
        <button onclick="clearOut_pricingstrategyai()" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.2);background:transparent;border:1px solid rgba(255,255,255,0.05);padding:0.25rem 0.75rem;cursor:pointer;">Clear</button>
      </div>
    </div>
    <div id="pricingstrategyai-out" style="background:#050a0f;border:1px solid #a855f718;padding:1.5rem;min-height:440px;font-size:0.78rem;color:rgba(255,255,255,0.5);line-height:1.9;white-space:pre-wrap;font-family:'JetBrains Mono',monospace;overflow-y:auto;max-height:560px;">
      <span style="color:#a855f733;">// Fill in the input and click Generate.
// The AI will produce detailed, actionable output
// tailored exactly to your situation.</span>
    </div>
    <div style="margin-top:0.5rem;display:flex;justify-content:space-between;">
      <div id="pricingstrategyai-status" class="font-mono" style="font-size:0.52rem;color:rgba(255,255,255,0.15);"></div>
      <div id="pricingstrategyai-wc" class="font-mono" style="font-size:0.52rem;color:#a855f755;"></div>
    </div>
  </div>
</div>
</div>
<script>
async function run_pricingstrategyai() {
  const input = document.getElementById('pricingstrategyai-in').value.trim();
  const out = document.getElementById('pricingstrategyai-out');
  const btn = document.getElementById('pricingstrategyai-btn');
  const stat = document.getElementById('pricingstrategyai-status');
  const wc = document.getElementById('pricingstrategyai-wc');
  if (!input) { alert('Please fill in the input field.'); return; }
  btn.textContent = '⟳ Generating...'; btn.disabled = true;
  out.innerHTML = '<span style="color:#a855f755;">⟳ Connecting to AI...</span>';
  stat.textContent = 'Processing...'; wc.textContent = '';

  const prompt = `Design a complete pricing strategy for:

{input}

Deliver:
1) Pricing model recommendation (hourly/project/retainer/value-based) with pros/cons
2) The case for moving away from hourly billing (if applicable)
3) Package design (3-tier structure with names, features, and pricing)
4) Anchoring strategy (how to present prices to make the middle option obvious)
5) Value-based pricing calculation (how to price on outcomes, not time)
6) Price presentation techniques (how to reveal prices without losing the sale)
7) How to raise rates on existing clients (step-by-step with scripts)
8) How to justify premium rates to price-sensitive prospects
9) Discount policy (when to offer, how much, how to frame)
10) Rush fee policy
11) How your pricing page should be structured
12) Psychological pricing principles applied to your specific service

Be specific and opinionated — give real price recommendations.`.replace('{input}', input);
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
function copyOut_pricingstrategyai() {
  navigator.clipboard.writeText(document.getElementById('pricingstrategyai-out').textContent).then(() => {
    const b = document.getElementById('pricingstrategyai-copy');
    b.textContent = '✓ Copied!'; b.style.color = '#00ff88';
    setTimeout(() => { b.textContent = 'Copy'; b.style.color = 'rgba(255,255,255,0.3)'; }, 2000);
  });
}
function clearOut_pricingstrategyai() {
  const out = document.getElementById('pricingstrategyai-out');
  out.style.color='rgba(255,255,255,0.5)';
  out.innerHTML = '<span style="color:#a855f733;">// Output cleared.</span>';
  document.getElementById('pricingstrategyai-wc').textContent='';
  document.getElementById('pricingstrategyai-status').textContent='';
}
</script>
