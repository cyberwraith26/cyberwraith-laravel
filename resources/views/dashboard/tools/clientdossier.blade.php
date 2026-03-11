<div style="padding:1.5rem;">
<div style="display:grid;grid-template-columns:1fr 1.4fr;gap:2rem;">
  <div>
    <div class="font-mono" style="font-size:0.6rem;color:#00d4ff88;letter-spacing:0.2em;margin-bottom:1.25rem;">// CLIENTDOSSIER.run()</div>
    <div style="display:flex;flex-direction:column;gap:1rem;">
      <div>
        <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:#00d4ff99;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Client name, company, website, and meeting context</label>
        <textarea id="clientdossier-in" rows="9" placeholder="E.g. Meeting with Marcus Chen, Head of Product at Paystack (paystack.com). Pitching a dashboard redesign project. Meeting in 48 hours..." style="width:100%;background:#050a0f;border:1px solid #00d4ff22;color:#00d4ff;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.75rem;outline:none;resize:vertical;line-height:1.6;" onfocus="this.style.borderColor='#00d4ff55'" onblur="this.style.borderColor='#00d4ff22'"></textarea>
      </div>

      <button onclick="run_clientdossier()" id="clientdossier-btn" style="width:100%;background:#00d4ff;color:#000;font-family:'JetBrains Mono',monospace;font-size:0.7rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.85rem;border:none;cursor:pointer;transition:opacity 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
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
      <div class="font-mono" style="font-size:0.6rem;color:#00d4ff88;letter-spacing:0.2em;">// OUTPUT.stream()</div>
      <div style="display:flex;gap:0.5rem;">
        <button onclick="copyOut_clientdossier()" id="clientdossier-copy" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.3);background:transparent;border:1px solid rgba(255,255,255,0.08);padding:0.25rem 0.75rem;cursor:pointer;transition:all 0.2s;">Copy</button>
        <button onclick="clearOut_clientdossier()" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.2);background:transparent;border:1px solid rgba(255,255,255,0.05);padding:0.25rem 0.75rem;cursor:pointer;">Clear</button>
      </div>
    </div>
    <div id="clientdossier-out" style="background:#050a0f;border:1px solid #00d4ff18;padding:1.5rem;min-height:440px;font-size:0.78rem;color:rgba(255,255,255,0.5);line-height:1.9;white-space:pre-wrap;font-family:'JetBrains Mono',monospace;overflow-y:auto;max-height:560px;">
      <span style="color:#00d4ff33;">// Fill in the input and click Generate.
// The AI will produce detailed, actionable output
// tailored exactly to your situation.</span>
    </div>
    <div style="margin-top:0.5rem;display:flex;justify-content:space-between;">
      <div id="clientdossier-status" class="font-mono" style="font-size:0.52rem;color:rgba(255,255,255,0.15);"></div>
      <div id="clientdossier-wc" class="font-mono" style="font-size:0.52rem;color:#00d4ff55;"></div>
    </div>
  </div>
</div>
</div>
<script>
async function run_clientdossier() {
  const input = document.getElementById('clientdossier-in').value.trim();
  const out = document.getElementById('clientdossier-out');
  const btn = document.getElementById('clientdossier-btn');
  const stat = document.getElementById('clientdossier-status');
  const wc = document.getElementById('clientdossier-wc');
  if (!input) { alert('Please fill in the input field.'); return; }
  btn.textContent = '⟳ Generating...'; btn.disabled = true;
  out.innerHTML = '<span style="color:#00d4ff55;">⟳ Connecting to AI...</span>';
  stat.textContent = 'Processing...'; wc.textContent = '';

  const prompt = `Build a complete pre-meeting client intelligence dossier for:

{input}

Structure the dossier as:
1) Company snapshot (industry, size, stage, business model)
2) What they likely care about most right now
3) Recent news or developments to reference in conversation
4) Their probable tech stack and tools
5) Key challenges companies in their position typically face
6) The contact's likely priorities based on their role
7) Potential objections they might raise + your responses
8) 5 smart questions to ask that show deep understanding
9) Conversation icebreakers (relevant and non-generic)
10) Your angle: how to position your service specifically for them
11) Red flags to watch for
12) Follow-up plan after the meeting

Make this feel like insider knowledge, not generic research.`.replace('{input}', input);
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
function copyOut_clientdossier() {
  navigator.clipboard.writeText(document.getElementById('clientdossier-out').textContent).then(() => {
    const b = document.getElementById('clientdossier-copy');
    b.textContent = '✓ Copied!'; b.style.color = '#00ff88';
    setTimeout(() => { b.textContent = 'Copy'; b.style.color = 'rgba(255,255,255,0.3)'; }, 2000);
  });
}
function clearOut_clientdossier() {
  const out = document.getElementById('clientdossier-out');
  out.style.color='rgba(255,255,255,0.5)';
  out.innerHTML = '<span style="color:#00d4ff33;">// Output cleared.</span>';
  document.getElementById('clientdossier-wc').textContent='';
  document.getElementById('clientdossier-status').textContent='';
}
</script>
