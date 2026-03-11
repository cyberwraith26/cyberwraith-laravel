<div style="padding:1.5rem;">
<div style="display:grid;grid-template-columns:1fr 1.4fr;gap:2rem;">
  <div>
    <div class="font-mono" style="font-size:0.6rem;color:#00ff8888;letter-spacing:0.2em;margin-bottom:1.25rem;">// PITCHSCRIPTWRITER.run()</div>
    <div style="display:flex;flex-direction:column;gap:1rem;">
      <div>
        <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:#00ff8899;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Your service + target client + channel (call/DM/meeting)</label>
        <textarea id="pitchscriptwriter-in" rows="9" placeholder="E.g. I offer Laravel development to SaaS startups. I'm pitching a Series A startup on a cold LinkedIn DM..." style="width:100%;background:#050a0f;border:1px solid #00ff8822;color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.75rem;outline:none;resize:vertical;line-height:1.6;" onfocus="this.style.borderColor='#00ff8855'" onblur="this.style.borderColor='#00ff8822'"></textarea>
      </div>

      <button onclick="run_pitchscriptwriter()" id="pitchscriptwriter-btn" style="width:100%;background:#00ff88;color:#000;font-family:'JetBrains Mono',monospace;font-size:0.7rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.85rem;border:none;cursor:pointer;transition:opacity 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
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
        <button onclick="copyOut_pitchscriptwriter()" id="pitchscriptwriter-copy" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.3);background:transparent;border:1px solid rgba(255,255,255,0.08);padding:0.25rem 0.75rem;cursor:pointer;transition:all 0.2s;">Copy</button>
        <button onclick="clearOut_pitchscriptwriter()" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.2);background:transparent;border:1px solid rgba(255,255,255,0.05);padding:0.25rem 0.75rem;cursor:pointer;">Clear</button>
      </div>
    </div>
    <div id="pitchscriptwriter-out" style="background:#050a0f;border:1px solid #00ff8818;padding:1.5rem;min-height:440px;font-size:0.78rem;color:rgba(255,255,255,0.5);line-height:1.9;white-space:pre-wrap;font-family:'JetBrains Mono',monospace;overflow-y:auto;max-height:560px;">
      <span style="color:#00ff8833;">// Fill in the input and click Generate.
// The AI will produce detailed, actionable output
// tailored exactly to your situation.</span>
    </div>
    <div style="margin-top:0.5rem;display:flex;justify-content:space-between;">
      <div id="pitchscriptwriter-status" class="font-mono" style="font-size:0.52rem;color:rgba(255,255,255,0.15);"></div>
      <div id="pitchscriptwriter-wc" class="font-mono" style="font-size:0.52rem;color:#00ff8855;"></div>
    </div>
  </div>
</div>
</div>
<script>
async function run_pitchscriptwriter() {
  const input = document.getElementById('pitchscriptwriter-in').value.trim();
  const out = document.getElementById('pitchscriptwriter-out');
  const btn = document.getElementById('pitchscriptwriter-btn');
  const stat = document.getElementById('pitchscriptwriter-status');
  const wc = document.getElementById('pitchscriptwriter-wc');
  if (!input) { alert('Please fill in the input field.'); return; }
  btn.textContent = '⟳ Generating...'; btn.disabled = true;
  out.innerHTML = '<span style="color:#00ff8855;">⟳ Connecting to AI...</span>';
  stat.textContent = 'Processing...'; wc.textContent = '';

  const prompt = `Write 3 complete pitch scripts for a freelancer pitching their services:

{input}

For each script provide:
1) Channel-appropriate opener (cold call / DM / in-person)
2) The hook (what gets their attention in 10 seconds)
3) The problem statement (show you understand their world)
4) The pivot to your solution (brief, specific)
5) Social proof (1 result or client example placeholder)
6) Soft CTA (low friction next step)
7) Objection response (most likely pushback + your answer)

Make each script sound natural and human — not robotic. Include timing cues (e.g. [pause 2s]). Rate each script 1-10 for conversion potential.`.replace('{input}', input);
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
function copyOut_pitchscriptwriter() {
  navigator.clipboard.writeText(document.getElementById('pitchscriptwriter-out').textContent).then(() => {
    const b = document.getElementById('pitchscriptwriter-copy');
    b.textContent = '✓ Copied!'; b.style.color = '#00ff88';
    setTimeout(() => { b.textContent = 'Copy'; b.style.color = 'rgba(255,255,255,0.3)'; }, 2000);
  });
}
function clearOut_pitchscriptwriter() {
  const out = document.getElementById('pitchscriptwriter-out');
  out.style.color='rgba(255,255,255,0.5)';
  out.innerHTML = '<span style="color:#00ff8833;">// Output cleared.</span>';
  document.getElementById('pitchscriptwriter-wc').textContent='';
  document.getElementById('pitchscriptwriter-status').textContent='';
}
</script>
