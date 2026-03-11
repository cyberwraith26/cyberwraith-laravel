<div style="padding:1.5rem;">
<div style="display:grid;grid-template-columns:1fr 1.4fr;gap:2rem;">
<div>
<div class="font-mono" style="font-size:0.6rem;color:rgba(0,212,255,0.5);letter-spacing:0.2em;margin-bottom:1.25rem;">// COLDMAIL.generate()</div>
<div style="display:flex;flex-direction:column;gap:1rem;">
<div><label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,212,255,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Prospect Name</label><input type="text" id="cm-name" placeholder="Sarah Johnson" style="width:100%;background:#050a0f;border:1px solid rgba(0,212,255,0.15);color:#00d4ff;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.6rem 0.75rem;outline:none;"></div>
<div><label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,212,255,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Their Company & Role</label><input type="text" id="cm-company" placeholder="CEO at Acme Corp" style="width:100%;background:#050a0f;border:1px solid rgba(0,212,255,0.15);color:#00d4ff;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.6rem 0.75rem;outline:none;"></div>
<div><label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,212,255,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Your Service / Offer</label><input type="text" id="cm-service" placeholder="Laravel development, SEO, Copywriting..." style="width:100%;background:#050a0f;border:1px solid rgba(0,212,255,0.15);color:#00d4ff;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.6rem 0.75rem;outline:none;"></div>
<div><label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,212,255,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Pain Point / Problem You Solve</label><textarea id="cm-pain" rows="3" placeholder="They are struggling with slow website load times and losing customers..." style="width:100%;background:#050a0f;border:1px solid rgba(0,212,255,0.15);color:#00d4ff;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.6rem 0.75rem;outline:none;resize:vertical;"></textarea></div>
<div><label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,212,255,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Email Style</label>
<select id="cm-style" style="width:100%;background:#050a0f;border:1px solid rgba(0,212,255,0.15);color:rgba(0,212,255,0.7);font-family:'JetBrains Mono',monospace;font-size:0.72rem;padding:0.6rem 0.75rem;outline:none;cursor:pointer;">
<option>Short & punchy (3-4 sentences)</option><option>Value-led (lead with results)</option><option>Question opener (start with curiosity)</option><option>Case study led (social proof first)</option>
</select></div>
<div style="display:flex;gap:0.75rem;">
<button onclick="genEmail('main')" style="flex:2;background:#00d4ff;color:#000;font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.75rem;border:none;cursor:pointer;">Generate Email →</button>
<button onclick="genEmail('subject')" style="flex:1;background:transparent;color:#00d4ff;font-family:'JetBrains Mono',monospace;font-size:0.65rem;letter-spacing:0.1em;text-transform:uppercase;padding:0.75rem;border:1px solid rgba(0,212,255,0.3);cursor:pointer;">+ Subject Lines</button>
</div>
</div>
</div>
<div>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.25rem;">
<div class="font-mono" style="font-size:0.6rem;color:rgba(0,212,255,0.5);letter-spacing:0.2em;">// OUTPUT.email()</div>
<button onclick="copyText('cm-out')" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.3);background:transparent;border:1px solid rgba(255,255,255,0.08);padding:0.25rem 0.75rem;cursor:pointer;">Copy</button>
</div>
<div id="cm-subjects" style="margin-bottom:1rem;display:none;"></div>
<div id="cm-out" style="background:#050a0f;border:1px solid rgba(0,212,255,0.1);padding:1.5rem;min-height:400px;font-size:0.78rem;color:rgba(255,255,255,0.5);line-height:1.9;white-space:pre-wrap;font-family:'JetBrains Mono',monospace;overflow-y:auto;max-height:500px;"><span style="color:rgba(0,212,255,0.3);">// Your cold email will appear here.
// It will be short, personalized and
// designed to get a reply — not a sale.</span></div>
<div style="margin-top:0.75rem;display:flex;gap:0.5rem;flex-wrap:wrap;">
@foreach(['Shorter','More Direct','Friendlier','Add Social Proof','Different Hook'] as $v)
<button onclick="refineEmail('{{$v}}')" class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.25);background:transparent;border:1px solid rgba(255,255,255,0.06);padding:0.25rem 0.6rem;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.color='#00d4ff';this.style.borderColor='rgba(0,212,255,0.3)'" onmouseout="this.style.color='rgba(255,255,255,0.25)';this.style.borderColor='rgba(255,255,255,0.06)'">{{$v}}</button>
@endforeach
</div>
</div>
</div>
</div>
<script>
let lastPrompt = '';
async function genEmail(mode) {
    const name=document.getElementById('cm-name').value||'the prospect';
    const company=document.getElementById('cm-company').value||'their company';
    const service=document.getElementById('cm-service').value||'my service';
    const pain=document.getElementById('cm-pain').value||'their challenges';
    const style=document.getElementById('cm-style').value;
    const out=document.getElementById('cm-out');
    out.style.color='rgba(255,255,255,0.5)';
    out.textContent='⟳ Generating...';
    if(mode==='subject'){
        const res=await fetch('https://api.anthropic.com/v1/messages',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({model:'claude-sonnet-4-20250514',max_tokens:1000,messages:[{role:'user',content:`Generate 5 high-converting cold email subject lines for: Service: ${service}, Prospect: ${name} at ${company}, Pain point: ${pain}. Make them short, curiosity-driven and avoid spam words. Format as numbered list.`}]})});
        const data=await res.json();
        const subDiv=document.getElementById('cm-subjects');
        subDiv.style.display='block';
        subDiv.innerHTML='<div class="font-mono" style="font-size:0.58rem;color:rgba(0,212,255,0.4);letter-spacing:0.15em;margin-bottom:0.5rem;">SUBJECT LINE OPTIONS</div><div style="background:#050a0f;border:1px solid rgba(0,212,255,0.1);padding:1rem;font-family:\'JetBrains Mono\',monospace;font-size:0.7rem;color:rgba(0,212,255,0.7);white-space:pre-wrap;">'+(data.content?.[0]?.text||'Error')+'</div>';
        out.textContent='';return;
    }
    lastPrompt=`Write a ${style} cold email from a freelancer to ${name} (${company}). Service offered: ${service}. Problem I solve: ${pain}. Rules: personalized, NO generic intros like "I hope this finds you well", short CTA asking for a 15-min call or reply, do NOT pitch immediately, show you understand their world first. Write only the email body and a suggested subject line at the top.`;
    const res=await fetch('https://api.anthropic.com/v1/messages',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({model:'claude-sonnet-4-20250514',max_tokens:1000,messages:[{role:'user',content:lastPrompt}]})});
    const data=await res.json();
    out.textContent=data.content?.[0]?.text||'Error generating email.';
    out.style.color='rgba(255,255,255,0.7)';
}
async function refineEmail(instruction){
    const out=document.getElementById('cm-out');
    const current=out.textContent;
    if(!current||current.startsWith('//')){return;}
    out.textContent='⟳ Refining...';
    const res=await fetch('https://api.anthropic.com/v1/messages',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({model:'claude-sonnet-4-20250514',max_tokens:1000,messages:[{role:'user',content:`Rewrite this cold email to be "${instruction}". Keep same intent and prospect info.\n\n${current}`}]})});
    const data=await res.json();
    out.textContent=data.content?.[0]?.text||current;
    out.style.color='rgba(255,255,255,0.7)';
}
function copyText(id){navigator.clipboard.writeText(document.getElementById(id).textContent).then(()=>{const b=event.target;b.textContent='Copied!';setTimeout(()=>b.textContent='Copy',2000);});}
</script>
