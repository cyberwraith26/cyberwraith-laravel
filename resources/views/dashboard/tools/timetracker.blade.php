<div style="padding:1.5rem;">
<div style="display:grid;grid-template-columns:1fr 1.5fr;gap:2rem;">
<div>
<div class="font-mono" style="font-size:0.6rem;color:rgba(245,158,11,0.5);letter-spacing:0.2em;margin-bottom:1.25rem;">// TIME.track()</div>
<div style="background:#050a0f;border:1px solid rgba(245,158,11,0.15);padding:1.5rem;text-align:center;margin-bottom:1.25rem;">
<div class="font-mono" style="font-size:0.58rem;color:rgba(245,158,11,0.4);letter-spacing:0.15em;margin-bottom:0.75rem;">ACTIVE TIMER</div>
<div id="tt-display" style="font-size:3.5rem;font-weight:900;color:#f59e0b;font-family:'JetBrains Mono',monospace;letter-spacing:0.05em;margin-bottom:1rem;">00:00:00</div>
<div style="margin-bottom:1rem;">
<input type="text" id="tt-project" placeholder="Project / Task name" style="width:100%;background:#0a1520;border:1px solid rgba(245,158,11,0.15);color:#f59e0b;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.55rem 0.75rem;outline:none;text-align:center;margin-bottom:0.5rem;">
<select id="tt-client" style="width:100%;background:#0a1520;border:1px solid rgba(245,158,11,0.15);color:rgba(245,158,11,0.7);font-family:'JetBrains Mono',monospace;font-size:0.72rem;padding:0.55rem 0.75rem;outline:none;cursor:pointer;">
<option>Acme Corp</option><option>Notion Labs</option><option>Personal</option><option>+ New Client</option>
</select>
</div>
<div style="display:flex;gap:0.75rem;justify-content:center;">
<button id="tt-btn" onclick="toggleTimer()" style="flex:2;background:#f59e0b;color:#000;font-family:'JetBrains Mono',monospace;font-size:0.7rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.75rem;border:none;cursor:pointer;">▶ START</button>
<button onclick="resetTimer()" style="flex:1;background:transparent;color:rgba(255,255,255,0.25);font-family:'JetBrains Mono',monospace;font-size:0.65rem;letter-spacing:0.1em;text-transform:uppercase;padding:0.75rem;border:1px solid rgba(255,255,255,0.08);cursor:pointer;">Reset</button>
</div>
</div>
<div style="background:#050a0f;border:1px solid rgba(255,255,255,0.05);padding:1.25rem;">
<div class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.2);letter-spacing:0.12em;margin-bottom:0.75rem;">TODAY'S SUMMARY</div>
<div style="display:flex;justify-content:space-between;margin-bottom:0.5rem;">
<span class="font-mono" style="font-size:0.65rem;color:rgba(255,255,255,0.3);">Billable Hours</span>
<span id="tt-bill" class="font-mono" style="font-size:0.65rem;color:#00ff88;">4h 30m</span>
</div>
<div style="display:flex;justify-content:space-between;margin-bottom:0.5rem;">
<span class="font-mono" style="font-size:0.65rem;color:rgba(255,255,255,0.3);">Non-Billable</span>
<span class="font-mono" style="font-size:0.65rem;color:rgba(255,255,255,0.4);">1h 15m</span>
</div>
<div style="display:flex;justify-content:space-between;">
<span class="font-mono" style="font-size:0.65rem;color:rgba(255,255,255,0.3);">Earnings Today</span>
<span id="tt-earn" class="font-mono" style="font-size:0.65rem;color:#f59e0b;">$360</span>
</div>
<div style="margin-top:0.75rem;height:4px;background:rgba(255,255,255,0.05);">
<div style="height:100%;width:75%;background:linear-gradient(90deg,#f59e0b,#00ff88);"></div>
</div>
<div class="font-mono" style="font-size:0.52rem;color:rgba(255,255,255,0.15);margin-top:0.3rem;">75% billable today</div>
</div>
</div>
<div>
<div class="font-mono" style="font-size:0.6rem;color:rgba(245,158,11,0.5);letter-spacing:0.2em;margin-bottom:1.25rem;">// TIME.entries()</div>
<div style="background:#050a0f;border:1px solid rgba(255,255,255,0.05);">
<div style="padding:0.75rem 1rem;border-bottom:1px solid rgba(255,255,255,0.05);display:flex;justify-content:space-between;align-items:center;">
<div class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.25);">TODAY'S ENTRIES</div>
<button style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(245,158,11,0.5);background:transparent;border:none;cursor:pointer;">Export Timesheet</button>
</div>
<div id="tt-entries">
@foreach([['Acme Corp','Homepage redesign','2h 15m','$180','billable'],['Notion Labs','API integration','1h 45m','$157','billable'],['Personal','Admin / email','1h 00m','—','non-billable'],['Acme Corp','Client call','0h 30m','$40','billable']] as $e)
<div style="display:grid;grid-template-columns:1fr 1.5fr 0.8fr 0.7fr 0.7fr;gap:0;padding:0.75rem 1rem;border-bottom:1px solid rgba(255,255,255,0.03);align-items:center;">
<div style="font-size:0.68rem;color:rgba(255,255,255,0.5);">{{$e[0]}}</div>
<div class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.3);">{{$e[1]}}</div>
<div class="font-mono" style="font-size:0.62rem;color:#f59e0b;">{{$e[2]}}</div>
<div class="font-mono" style="font-size:0.62rem;color:#00ff88;">{{$e[3]}}</div>
<div class="font-mono" style="font-size:0.55rem;padding:0.1rem 0.4rem;border:1px solid rgba({{ $e[4]==='billable' ? '0,255,136' : '255,255,255' }},0.15);color:{{ $e[4]==='billable' ? '#00ff88' : 'rgba(255,255,255,0.3)' }};">{{$e[4]}}</div>
</div>
@endforeach
<div id="tt-new-entries"></div>
</div>
</div>
</div>
</div>
</div>
<script>
let ttRunning=false,ttSeconds=0,ttInterval=null,ttStart=null;
function toggleTimer(){
    if(!ttRunning){
        ttRunning=true;
        ttStart=Date.now()-ttSeconds*1000;
        ttInterval=setInterval(()=>{ttSeconds=Math.floor((Date.now()-ttStart)/1000);updateDisplay();},1000);
        document.getElementById('tt-btn').textContent='⏸ PAUSE';
        document.getElementById('tt-btn').style.background='#ef4444';
    } else {
        clearInterval(ttInterval);ttRunning=false;
        const proj=document.getElementById('tt-project').value||'Untitled Task';
        const client=document.getElementById('tt-client').value;
        const h=Math.floor(ttSeconds/3600),m=Math.floor(ttSeconds%3600/60);
        const earning='$'+Math.round((ttSeconds/3600)*80);
        const row=document.createElement('div');
        row.style.cssText='display:grid;grid-template-columns:1fr 1.5fr 0.8fr 0.7fr 0.7fr;gap:0;padding:0.75rem 1rem;border-bottom:1px solid rgba(255,255,255,0.03);align-items:center;background:rgba(245,158,11,0.02);animation:fadeIn 0.3s ease;';
        row.innerHTML=`<div style="font-size:0.68rem;color:rgba(255,255,255,0.5);">${client}</div><div style="font-family:monospace;font-size:0.6rem;color:rgba(255,255,255,0.3);">${proj}</div><div style="font-family:monospace;font-size:0.62rem;color:#f59e0b;">${h}h ${m}m</div><div style="font-family:monospace;font-size:0.62rem;color:#00ff88;">${earning}</div><div style="font-family:monospace;font-size:0.55rem;padding:0.1rem 0.4rem;border:1px solid rgba(0,255,136,0.15);color:#00ff88;">billable</div>`;
        document.getElementById('tt-new-entries').prepend(row);
        document.getElementById('tt-btn').textContent='▶ START';
        document.getElementById('tt-btn').style.background='#f59e0b';
        resetTimer();
    }
}
function resetTimer(){if(ttRunning)return;ttSeconds=0;updateDisplay();}
function updateDisplay(){
    const h=String(Math.floor(ttSeconds/3600)).padStart(2,'0');
    const m=String(Math.floor(ttSeconds%3600/60)).padStart(2,'0');
    const s=String(ttSeconds%60).padStart(2,'0');
    document.getElementById('tt-display').textContent=`${h}:${m}:${s}`;
}
</script>
<style>@keyframes fadeIn{from{opacity:0;transform:translateY(4px)}to{opacity:1;transform:translateY(0)}}</style>
