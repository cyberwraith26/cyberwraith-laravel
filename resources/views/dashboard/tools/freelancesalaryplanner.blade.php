<div style="padding:1.5rem;">
<div style="display:grid;grid-template-columns:1fr 1.4fr;gap:2rem;">
  <div>
    <div class="font-mono" style="font-size:0.6rem;color:#00ff8888;letter-spacing:0.2em;margin-bottom:1.25rem;">// FREELANCESALARYPLANNER.run()</div>
    <div style="display:flex;flex-direction:column;gap:1rem;">
      <div>
        <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:#00ff8899;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Your income goal, current clients, and financial situation</label>
        <textarea id="freelancesalaryplanner-in" rows="9" placeholder="E.g. Want to take home $6,000/month after tax. Currently have 2 retainer clients at $1,500/month each. Single, no dependents, UK-based..." style="width:100%;background:#050a0f;border:1px solid #00ff8822;color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.75rem;outline:none;resize:vertical;line-height:1.6;" onfocus="this.style.borderColor='#00ff8855'" onblur="this.style.borderColor='#00ff8822'"></textarea>
      </div>

      <button onclick="run_freelancesalaryplanner()" id="freelancesalaryplanner-btn" style="width:100%;background:#00ff88;color:#000;font-family:'JetBrains Mono',monospace;font-size:0.7rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.85rem;border:none;cursor:pointer;transition:opacity 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
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
      <div class="font-mono" style="font-size:0.6rem;color:#00ff8888;letter-spacing:0.2em;">// OUTPUT.stream()</div>
      <div style="display:flex;gap:0.5rem;">
        <button onclick="copyOut_freelancesalaryplanner()" id="freelancesalaryplanner-copy" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.3);background:transparent;border:1px solid rgba(255,255,255,0.08);padding:0.25rem 0.75rem;cursor:pointer;transition:all 0.2s;">Copy</button>
        <button onclick="clearOut_freelancesalaryplanner()" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.2);background:transparent;border:1px solid rgba(255,255,255,0.05);padding:0.25rem 0.75rem;cursor:pointer;">Clear</button>
      </div>
    </div>
    <div id="freelancesalaryplanner-out" style="background:#050a0f;border:1px solid #00ff8818;padding:1.5rem;min-height:440px;font-size:0.78rem;color:rgba(255,255,255,0.5);line-height:1.9;white-space:pre-wrap;font-family:'JetBrains Mono',monospace;overflow-y:auto;max-height:560px;">
      <span style="color:#00ff8833;">// Fill in the input and click Generate.
// The AI will produce detailed, actionable output
// tailored exactly to your situation.</span>
    </div>
    <div style="margin-top:0.5rem;display:flex;justify-content:space-between;">
      <div id="freelancesalaryplanner-status" class="font-mono" style="font-size:0.52rem;color:rgba(255,255,255,0.15);"></div>
      <div id="freelancesalaryplanner-wc" class="font-mono" style="font-size:0.52rem;color:#00ff8855;"></div>
    </div>
  </div>
</div>
</div>
<script>
async function run_freelancesalaryplanner() {
  const input = document.getElementById('freelancesalaryplanner-in').value.trim();
  const out = document.getElementById('freelancesalaryplanner-out');
  const btn = document.getElementById('freelancesalaryplanner-btn');
  const stat = document.getElementById('freelancesalaryplanner-status');
  const wc = document.getElementById('freelancesalaryplanner-wc');
  if (!input) { alert('Please fill in the input field.'); return; }
  btn.textContent = '⟳ Generating...'; btn.disabled = true;
  out.innerHTML = '<span style="color:#00ff8855;">⟳ Connecting to AI...</span>';
  stat.textContent = 'Processing...'; wc.textContent = '';

  const prompt = `Build a complete freelance salary plan for:

{input}

Deliver:
1) Current income gap analysis (how far from target and why)
2) Monthly income target breakdown (gross needed to hit net goal after tax)
3) Client mix strategy (how many clients at what rates to hit the target)
4) Slow month contingency plan (how to handle months with 30-50% less income)
5) Emergency fund recommendation (how much and how to build it)
6) Quarterly financial milestones to hit
7) Rate increase roadmap (when and by how much to raise rates)
8) Passive income ideas relevant to this freelancer's skills
9) The 'feast or famine' cycle — how to break it with specific tactics
10) A simple monthly financial review checklist

Be specific with numbers. Include formulas where useful.`.replace('{input}', input);
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
function copyOut_freelancesalaryplanner() {
  navigator.clipboard.writeText(document.getElementById('freelancesalaryplanner-out').textContent).then(() => {
    const b = document.getElementById('freelancesalaryplanner-copy');
    b.textContent = '✓ Copied!'; b.style.color = '#00ff88';
    setTimeout(() => { b.textContent = 'Copy'; b.style.color = 'rgba(255,255,255,0.3)'; }, 2000);
  });
}
function clearOut_freelancesalaryplanner() {
  const out = document.getElementById('freelancesalaryplanner-out');
  out.style.color='rgba(255,255,255,0.5)';
  out.innerHTML = '<span style="color:#00ff8833;">// Output cleared.</span>';
  document.getElementById('freelancesalaryplanner-wc').textContent='';
  document.getElementById('freelancesalaryplanner-status').textContent='';
}
</script>
