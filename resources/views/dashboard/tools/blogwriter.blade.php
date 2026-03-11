<div style="padding:1.5rem;">
<div style="display:grid;grid-template-columns:1fr 1.4fr;gap:2rem;">

  {-- Left: Input Panel --}
  <div>
    <div class="font-mono" style="font-size:0.6rem;color:#a855f788;letter-spacing:0.2em;margin-bottom:1.25rem;">// BLOGPOSTWRITER.run()</div>
    <div style="display:flex;flex-direction:column;gap:1rem;">
      <div>
        <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:#a855f799;letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Blog topic, target audience, and main keyword</label>
        <textarea id="blogpostwriter-in" rows="9" placeholder="Enter your details here..." style="width:100%;background:#050a0f;border:1px solid #a855f722;color:#a855f7;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.75rem;outline:none;resize:vertical;line-height:1.6;" onfocus="this.style.borderColor='#a855f755'" onblur="this.style.borderColor='#a855f722'"></textarea>
      </div>
      <button onclick="run_blogpostwriter()" id="blogpostwriter-btn" style="width:100%;background:#a855f7;color:#000;font-family:'JetBrains Mono',monospace;font-size:0.7rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.85rem;border:none;cursor:pointer;transition:opacity 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
        ✨ Generate →
      </button>
      <div style="background:#050a0f;border:1px solid rgba(255,255,255,0.04);padding:0.875rem;">
        <div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.2);letter-spacing:0.12em;margin-bottom:0.5rem;">POWERED BY</div>
        <div style="display:flex;align-items:center;gap:0.5rem;">
          <span style="font-size:0.8rem;">✦</span>
          <span class="font-mono" style="font-size:0.62rem;color:rgba(255,255,255,0.35);">Claude AI (claude-sonnet-4)</span>
        </div>
      </div>
    </div>
  </div>

  {-- Right: Output Panel --}
  <div>
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
      <div class="font-mono" style="font-size:0.6rem;color:#a855f788;letter-spacing:0.2em;">// OUTPUT.stream()</div>
      <div style="display:flex;gap:0.5rem;">
        <button onclick="copyOutput_blogpostwriter()" id="blogpostwriter-copy" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.3);background:transparent;border:1px solid rgba(255,255,255,0.08);padding:0.25rem 0.75rem;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.3)'">Copy</button>
        <button onclick="clearOutput_blogpostwriter()" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.2);background:transparent;border:1px solid rgba(255,255,255,0.05);padding:0.25rem 0.75rem;cursor:pointer;">Clear</button>
      </div>
    </div>
    <div id="blogpostwriter-out" style="background:#050a0f;border:1px solid #a855f718;padding:1.5rem;min-height:440px;font-size:0.78rem;color:rgba(255,255,255,0.5);line-height:1.9;white-space:pre-wrap;font-family:'JetBrains Mono',monospace;overflow-y:auto;max-height:560px;">
      <span style="color:#a855f733;">// Fill in the input and click Generate.
// The AI will produce detailed, actionable output
// tailored exactly to your situation.</span>
    </div>
    <div style="margin-top:0.5rem;display:flex;justify-content:space-between;align-items:center;">
      <div id="blogpostwriter-status" class="font-mono" style="font-size:0.52rem;color:rgba(255,255,255,0.15);"></div>
      <div id="blogpostwriter-wc" class="font-mono" style="font-size:0.52rem;color:#a855f755;"></div>
    </div>
  </div>

</div>
</div>

<script>
async function run_blogpostwriter() {
  const input = document.getElementById('blogpostwriter-in').value.trim();
  const out   = document.getElementById('blogpostwriter-out');
  const btn   = document.getElementById('blogpostwriter-btn');
  const stat  = document.getElementById('blogpostwriter-status');
  const wc    = document.getElementById('blogpostwriter-wc');

  if (!input) { alert('Please fill in the input field.'); return; }

  btn.textContent = '⟳ Generating...';
  btn.disabled = true;
  out.innerHTML = '<span style="color:#a855f755;">⟳ Connecting to AI...</span>';
  stat.textContent = 'Processing...';
  wc.textContent = '';

  const prompt = `Write a complete, SEO-optimized long-form blog post for:

{input}

Include: Attention-grabbing title (with keyword), Meta description (155 chars), Intro with strong hook and promise, 6 H2 sections with rich content (each 150-200 words), relevant examples and data, Conclusion with CTA, 8 LSI keywords to naturally include. Make it genuinely useful and original — not generic AI filler.`.replace('{input}', input);

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
    const text = data.content?.[0]?.text || 'Error: No response from AI.';
    out.style.color = 'rgba(255,255,255,0.75)';
    out.textContent = text;
    const words = text.split(' ').length;
    wc.textContent = words + ' words generated';
    stat.textContent = 'Done · ' + new Date().toLocaleTimeString();
  } catch (e) {
    out.style.color = '#ef4444';
    out.textContent = 'Connection error. Please check your network and try again.';
    stat.textContent = 'Error';
  }

  btn.textContent = '✨ Generate →';
  btn.disabled = false;
}

function copyOutput_blogpostwriter() {
  const text = document.getElementById('blogpostwriter-out').textContent;
  navigator.clipboard.writeText(text).then(() => {
    const btn = document.getElementById('blogpostwriter-copy');
    btn.textContent = '✓ Copied!';
    btn.style.color = '#00ff88';
    setTimeout(() => { btn.textContent = 'Copy'; btn.style.color = 'rgba(255,255,255,0.3)'; }, 2000);
  });
}

function clearOutput_blogpostwriter() {
  const out = document.getElementById('blogpostwriter-out');
  out.style.color = 'rgba(255,255,255,0.5)';
  out.innerHTML = '<span style="color:#a855f733;">// Output cleared. Generate a new result above.</span>';
  document.getElementById('blogpostwriter-wc').textContent = '';
  document.getElementById('blogpostwriter-status').textContent = '';
}
</script>
