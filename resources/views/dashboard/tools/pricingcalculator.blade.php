<div style="padding:1.5rem;">
<div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem;">
<div>
<div class="font-mono" style="font-size:0.6rem;color:rgba(245,158,11,0.5);letter-spacing:0.2em;margin-bottom:1.25rem;">// PRICING.calculate()</div>
<div style="display:flex;flex-direction:column;gap:1rem;">
<div><label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(245,158,11,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Monthly Expenses ($)</label><input type="number" id="pc-expenses" value="2000" style="width:100%;background:#050a0f;border:1px solid rgba(245,158,11,0.15);color:#f59e0b;font-family:'JetBrains Mono',monospace;font-size:0.78rem;padding:0.6rem 0.75rem;outline:none;" oninput="calcPrice()"></div>
<div><label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(245,158,11,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Desired Monthly Profit ($)</label><input type="number" id="pc-profit" value="3000" style="width:100%;background:#050a0f;border:1px solid rgba(245,158,11,0.15);color:#f59e0b;font-family:'JetBrains Mono',monospace;font-size:0.78rem;padding:0.6rem 0.75rem;outline:none;" oninput="calcPrice()"></div>
<div><label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(245,158,11,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Billable Hours Per Week</label><input type="number" id="pc-hours" value="30" min="1" max="80" style="width:100%;background:#050a0f;border:1px solid rgba(245,158,11,0.15);color:#f59e0b;font-family:'JetBrains Mono',monospace;font-size:0.78rem;padding:0.6rem 0.75rem;outline:none;" oninput="calcPrice()"></div>
<div><label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(245,158,11,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Tax Rate (%)</label><input type="number" id="pc-tax" value="25" min="0" max="60" style="width:100%;background:#050a0f;border:1px solid rgba(245,158,11,0.15);color:#f59e0b;font-family:'JetBrains Mono',monospace;font-size:0.78rem;padding:0.6rem 0.75rem;outline:none;" oninput="calcPrice()"></div>
<div><label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(245,158,11,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Experience Level</label>
<select id="pc-level" style="width:100%;background:#050a0f;border:1px solid rgba(245,158,11,0.15);color:rgba(245,158,11,0.7);font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.6rem 0.75rem;outline:none;cursor:pointer;" onchange="calcPrice()">
<option value="1">Entry (0-2 years)</option><option value="1.3" selected>Mid (2-5 years)</option><option value="1.7">Senior (5-10 years)</option><option value="2.2">Expert (10+ years)</option>
</select></div>
<div><label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(245,158,11,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Pricing Model</label>
<div style="display:flex;gap:0.5rem;">
@foreach(['Hourly','Project','Retainer'] as $m)
<label style="flex:1;cursor:pointer;"><input type="radio" name="pc-model" value="{{$m}}" {{ $loop->first ? 'checked' : '' }} style="display:none;" onchange="calcPrice()"><span class="font-mono" style="display:block;text-align:center;font-size:0.62rem;padding:0.4rem;border:1px solid rgba(245,158,11,{{ $loop->first ? '0.4' : '0.12' }});color:{{ $loop->first ? '#f59e0b' : 'rgba(255,255,255,0.25)' }};cursor:pointer;transition:all 0.2s;" onclick="this.parentNode.querySelector('input').checked=true;calcPrice();document.querySelectorAll('[name=pc-model]+span').forEach(s=>{s.style.borderColor='rgba(245,158,11,0.12)';s.style.color='rgba(255,255,255,0.25)';});this.style.borderColor='rgba(245,158,11,0.4)';this.style.color='#f59e0b';">{{$m}}</span></label>
@endforeach
</div></div>
</div>
</div>
<div>
<div class="font-mono" style="font-size:0.6rem;color:rgba(245,158,11,0.5);letter-spacing:0.2em;margin-bottom:1.25rem;">// PRICING.results()</div>
<div style="display:flex;flex-direction:column;gap:1rem;">
<div style="background:#050a0f;border:1px solid rgba(245,158,11,0.2);padding:1.5rem;text-align:center;">
<div class="font-mono" style="font-size:0.58rem;color:rgba(245,158,11,0.5);letter-spacing:0.2em;margin-bottom:0.5rem;">MINIMUM HOURLY RATE</div>
<div id="pc-min" style="font-size:3rem;font-weight:900;color:#f59e0b;line-height:1;">$0</div>
<div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.2);margin-top:0.3rem;">to break even</div>
</div>
<div style="background:#050a0f;border:1px solid rgba(0,255,136,0.2);padding:1.5rem;text-align:center;">
<div class="font-mono" style="font-size:0.58rem;color:rgba(0,255,136,0.5);letter-spacing:0.2em;margin-bottom:0.5rem;">RECOMMENDED RATE</div>
<div id="pc-rec" style="font-size:3rem;font-weight:900;color:#00ff88;line-height:1;">$0</div>
<div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.2);margin-top:0.3rem;">for target profit</div>
</div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;">
<div style="background:#050a0f;border:1px solid rgba(255,255,255,0.05);padding:1rem;text-align:center;">
<div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.2);letter-spacing:0.12em;margin-bottom:0.4rem;">ANNUAL TARGET</div>
<div id="pc-annual" style="font-size:1.2rem;font-weight:700;color:#fff;">$0</div>
</div>
<div style="background:#050a0f;border:1px solid rgba(255,255,255,0.05);padding:1rem;text-align:center;">
<div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.2);letter-spacing:0.12em;margin-bottom:0.4rem;">PROJECT RATE</div>
<div id="pc-project" style="font-size:1.2rem;font-weight:700;color:#fff;">$0</div>
</div>
</div>
<div style="background:#050a0f;border:1px solid rgba(255,255,255,0.05);padding:1.25rem;">
<div class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.2);letter-spacing:0.12em;margin-bottom:0.75rem;">MARKET COMPARISON</div>
<div id="pc-market" style="display:flex;flex-direction:column;gap:0.5rem;"></div>
</div>
<div id="pc-advice" style="background:rgba(245,158,11,0.04);border:1px solid rgba(245,158,11,0.1);padding:1rem;font-family:'JetBrains Mono',monospace;font-size:0.65rem;color:rgba(245,158,11,0.6);line-height:1.6;"></div>
</div>
</div>
</div>
</div>
<script>
function calcPrice(){
    const exp=parseFloat(document.getElementById('pc-expenses').value)||0;
    const profit=parseFloat(document.getElementById('pc-profit').value)||0;
    const hrs=parseFloat(document.getElementById('pc-hours').value)||1;
    const tax=parseFloat(document.getElementById('pc-tax').value)||0;
    const lvl=parseFloat(document.getElementById('pc-level').value)||1;
    const monthHrs=hrs*4.33;
    const taxMult=1+(tax/100);
    const needed=(exp+profit)*taxMult;
    const minRate=Math.ceil(exp*taxMult/monthHrs);
    const recRate=Math.ceil((needed/monthHrs)*lvl);
    document.getElementById('pc-min').textContent='$'+minRate;
    document.getElementById('pc-rec').textContent='$'+recRate;
    document.getElementById('pc-annual').textContent='$'+Math.round(profit*12).toLocaleString();
    document.getElementById('pc-project').textContent='$'+Math.round(recRate*20).toLocaleString();
    const mkt=[['Upwork Global Avg','$45-85/hr'],['Toptal Developers','$80-200/hr'],['Fiverr Pro','$35-120/hr'],['Direct Clients','$60-250/hr']];
    document.getElementById('pc-market').innerHTML=mkt.map(m=>`<div style="display:flex;justify-content:space-between;"><span style="font-family:monospace;font-size:0.6rem;color:rgba(255,255,255,0.3);">${m[0]}</span><span style="font-family:monospace;font-size:0.6rem;color:rgba(245,158,11,0.6);">${m[1]}</span></div>`).join('');
    const advice=recRate<50?'⚠ Your rate is below market. Consider raising prices or reducing expenses.':recRate<100?'✓ Your rate is competitive for mid-level freelancers.':'✓ Premium rate — position yourself accordingly with a strong portfolio.';
    document.getElementById('pc-advice').textContent=advice;
}
calcPrice();
</script>
