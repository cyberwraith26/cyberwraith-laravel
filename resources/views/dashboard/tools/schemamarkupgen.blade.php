<div style="padding:1.5rem;">
<div style="display:grid;grid-template-columns:1fr 1.4fr;gap:2rem;">
  <div>
    <div class="font-mono" style="font-size:0.6rem;color:#00ff8888;letter-spacing:0.2em;margin-bottom:1.25rem;">// SCHEMAMARKUPGEN.run()</div>
    <div style="display:flex;flex-direction:column;gap:1rem;">
      <div>
        <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:#00ff8899;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Page type, business info, and page content</label>
        <textarea id="schemamarkupgen-in" rows="9" placeholder="E.g. Local freelance web design agency in Accra. Service page for 'Web Design for Small Businesses'. Business name: PixelForge, phone: +233-XX-XXX, serves Accra area..." style="width:100%;background:#050a0f;border:1px solid #00ff8822;color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.75rem;outline:none;resize:vertical;line-height:1.6;" onfocus="this.style.borderColor='#00ff8855'" onblur="this.style.borderColor='#00ff8822'"></textarea>
      </div>

      <button onclick="run_schemamarkupgen()" id="schemamarkupgen-btn" style="width:100%;background:#00ff88;color:#000;font-family:'JetBrains Mono',monospace;font-size:0.7rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.85rem;border:none;cursor:pointer;transition:opacity 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
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
        <button onclick="copyOut_schemamarkupgen()" id="schemamarkupgen-copy" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.3);background:transparent;border:1px solid rgba(255,255,255,0.08);padding:0.25rem 0.75rem;cursor:pointer;transition:all 0.2s;">Copy</button>
        <button onclick="clearOut_schemamarkupgen()" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.2);background:transparent;border:1px solid rgba(255,255,255,0.05);padding:0.25rem 0.75rem;cursor:pointer;">Clear</button>
      </div>
    </div>
    <div id="schemamarkupgen-out" style="background:#050a0f;border:1px solid #00ff8818;padding:1.5rem;min-height:440px;font-size:0.78rem;color:rgba(255,255,255,0.5);line-height:1.9;white-space:pre-wrap;font-family:'JetBrains Mono',monospace;overflow-y:auto;max-height:560px;">
      <span style="color:#00ff8833;">// Fill in the input and click Generate.
// The AI will produce detailed, actionable output
// tailored exactly to your situation.</span>
    </div>
    <div style="margin-top:0.5rem;display:flex;justify-content:space-between;">
      <div id="schemamarkupgen-status" class="font-mono" style="font-size:0.52rem;color:rgba(255,255,255,0.15);"></div>
      <div id="schemamarkupgen-wc" class="font-mono" style="font-size:0.52rem;color:#00ff8855;"></div>
    </div>
  </div>
</div>
</div>
<script>
async function run_schemamarkupgen() {
  const input = document.getElementById('schemamarkupgen-in').value.trim();
  const out = document.getElementById('schemamarkupgen-out');
  const btn = document.getElementById('schemamarkupgen-btn');
  const stat = document.getElementById('schemamarkupgen-status');
  const wc = document.getElementById('schemamarkupgen-wc');
  if (!input) { alert('Please fill in the input field.'); return; }
  btn.textContent = '⟳ Generating...'; btn.disabled = true;
  out.innerHTML = '<span style="color:#00ff8855;">⟳ Connecting to AI...</span>';
  stat.textContent = 'Processing...'; wc.textContent = '';

  const prompt = `Generate complete schema markup for:

{input}

Provide:
1) Primary schema type recommendation (and why)
2) Complete JSON-LD code (valid and ready to paste)
3) Secondary schema types to add (if applicable)
4) Breadcrumb schema (if relevant)
5) FAQ schema (generate 5 relevant FAQs + answers + schema code)
6) How to implement: exact placement in HTML
7) How to test: Google Rich Results Test instructions
8) What rich snippet appearance to expect in search results
9) Common schema mistakes for this page type
10) Additional schema opportunities for the broader website

All code must be valid JSON-LD following schema.org standards.`.replace('{input}', input);
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
function copyOut_schemamarkupgen() {
  navigator.clipboard.writeText(document.getElementById('schemamarkupgen-out').textContent).then(() => {
    const b = document.getElementById('schemamarkupgen-copy');
    b.textContent = '✓ Copied!'; b.style.color = '#00ff88';
    setTimeout(() => { b.textContent = 'Copy'; b.style.color = 'rgba(255,255,255,0.3)'; }, 2000);
  });
}
function clearOut_schemamarkupgen() {
  const out = document.getElementById('schemamarkupgen-out');
  out.style.color='rgba(255,255,255,0.5)';
  out.innerHTML = '<span style="color:#00ff8833;">// Output cleared.</span>';
  document.getElementById('schemamarkupgen-wc').textContent='';
  document.getElementById('schemamarkupgen-status').textContent='';
}
</script>
