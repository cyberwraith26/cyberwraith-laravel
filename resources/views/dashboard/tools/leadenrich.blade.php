<div style="padding:1.5rem;">
<div style="display:grid;grid-template-columns:1fr 1.5fr;gap:2rem;">

    {{-- Left: Input --}}
    <div>
        <div class="font-mono" style="font-size:0.6rem;color:rgba(245,158,11,0.5);letter-spacing:0.2em;margin-bottom:1.25rem;">// LEADS.enrich()</div>

        {{-- Single Lead --}}
        <div style="background:#050a0f;border:1px solid rgba(245,158,11,0.1);padding:1.25rem;margin-bottom:1.25rem;">
            <div class="font-mono" style="font-size:0.58rem;color:rgba(245,158,11,0.4);letter-spacing:0.15em;margin-bottom:1rem;">SINGLE LOOKUP</div>
            <div style="display:flex;flex-direction:column;gap:0.75rem;">
                <input type="text" id="le-name" placeholder="Full Name (optional)" style="width:100%;background:#0a1520;border:1px solid rgba(245,158,11,0.15);color:#f59e0b;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.55rem 0.75rem;outline:none;" onfocus="this.style.borderColor='rgba(245,158,11,0.4)'" onblur="this.style.borderColor='rgba(245,158,11,0.15)'">
                <input type="text" id="le-company" placeholder="Company Name or Domain" style="width:100%;background:#0a1520;border:1px solid rgba(245,158,11,0.15);color:#f59e0b;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.55rem 0.75rem;outline:none;" onfocus="this.style.borderColor='rgba(245,158,11,0.4)'" onblur="this.style.borderColor='rgba(245,158,11,0.15)'">
                <input type="text" id="le-linkedin" placeholder="LinkedIn URL (optional)" style="width:100%;background:#0a1520;border:1px solid rgba(245,158,11,0.15);color:#f59e0b;font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.55rem 0.75rem;outline:none;" onfocus="this.style.borderColor='rgba(245,158,11,0.4)'" onblur="this.style.borderColor='rgba(245,158,11,0.15)'">
                <button onclick="enrichLead()" style="width:100%;background:#f59e0b;color:#000;font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.65rem;border:none;cursor:pointer;">Enrich Lead →</button>
            </div>
        </div>

        {{-- Bulk Upload --}}
        <div style="background:#050a0f;border:1px solid rgba(245,158,11,0.1);padding:1.25rem;margin-bottom:1.25rem;">
            <div class="font-mono" style="font-size:0.58rem;color:rgba(245,158,11,0.4);letter-spacing:0.15em;margin-bottom:0.75rem;">BULK PROCESSING</div>
            <div id="bulk-drop" style="border:2px dashed rgba(245,158,11,0.2);padding:1.5rem;text-align:center;cursor:pointer;transition:all 0.2s;" ondragover="event.preventDefault();this.style.borderColor='rgba(245,158,11,0.5)'" ondragleave="this.style.borderColor='rgba(245,158,11,0.2)'" onclick="document.getElementById('bulk-file').click()">
                <div style="font-size:1.5rem;margin-bottom:0.5rem;">📋</div>
                <div class="font-mono" style="font-size:0.62rem;color:rgba(255,255,255,0.3);">Drop CSV or click to upload</div>
                <div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.15);margin-top:0.25rem;">Columns: name, company, email</div>
            </div>
            <input type="file" id="bulk-file" accept=".csv" style="display:none;" onchange="handleBulkFile(this)">
        </div>

        {{-- Credits --}}
        <div style="background:#050a0f;border:1px solid rgba(255,255,255,0.05);padding:1rem;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5rem;">
                <div class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.25);">ENRICHMENT CREDITS</div>
                <div class="font-mono" style="font-size:0.65rem;color:#f59e0b;">47 / 100</div>
            </div>
            <div style="height:4px;background:rgba(255,255,255,0.05);border-radius:2px;">
                <div style="height:100%;width:47%;background:#f59e0b;border-radius:2px;"></div>
            </div>
            <div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.2);margin-top:0.4rem;">Resets monthly · Upgrade for 1000+</div>
        </div>
    </div>

    {{-- Right: Results --}}
    <div>
        <div class="font-mono" style="font-size:0.6rem;color:rgba(245,158,11,0.5);letter-spacing:0.2em;margin-bottom:1.25rem;">// LEADS.results()</div>

        {{-- Enriched Result Card --}}
        <div id="le-result" style="background:#050a0f;border:1px solid rgba(245,158,11,0.15);padding:1.5rem;margin-bottom:1.25rem;display:none;">
            <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.25rem;">
                <div id="le-avatar" style="width:48px;height:48px;background:linear-gradient(135deg,#f59e0b,#ef4444);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1.1rem;color:#000;flex-shrink:0;">AC</div>
                <div>
                    <div id="le-rname" style="font-size:1rem;font-weight:700;color:#fff;"></div>
                    <div id="le-rtitle" class="font-mono" style="font-size:0.62rem;color:rgba(245,158,11,0.6);"></div>
                </div>
                <div style="margin-left:auto;">
                    <span id="le-score" class="font-mono" style="font-size:0.72rem;font-weight:700;padding:0.3rem 0.75rem;border:1px solid rgba(0,255,136,0.3);color:#00ff88;background:rgba(0,255,136,0.05);">94% MATCH</span>
                </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;">
                @foreach([['le-remail','Email','📧'],['le-rphone','Phone','📱'],['le-rcompany','Company','🏢'],['le-rsize','Team Size','👥'],['le-rindustry','Industry','🏷️'],['le-rlocation','Location','📍']] as $f)
                <div style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.04);padding:0.75rem;">
                    <div class="font-mono" style="font-size:0.52rem;color:rgba(255,255,255,0.2);letter-spacing:0.1em;margin-bottom:0.3rem;">{{$f[2]}} {{strtoupper($f[1])}}</div>
                    <div id="{{$f[0]}}" style="font-size:0.72rem;color:rgba(255,255,255,0.6);font-family:'JetBrains Mono',monospace;">—</div>
                </div>
                @endforeach
            </div>
            <div style="margin-top:1rem;display:flex;gap:0.75rem;">
                <button style="flex:1;font-family:'JetBrains Mono',monospace;font-size:0.62rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#000;background:#f59e0b;padding:0.55rem;border:none;cursor:pointer;">Save to CRM</button>
                <button style="flex:1;font-family:'JetBrains Mono',monospace;font-size:0.62rem;letter-spacing:0.1em;text-transform:uppercase;color:rgba(255,255,255,0.3);background:transparent;border:1px solid rgba(255,255,255,0.08);padding:0.55rem;cursor:pointer;">Export CSV</button>
            </div>
        </div>

        {{-- Recent Enrichments Table --}}
        <div style="background:#050a0f;border:1px solid rgba(255,255,255,0.05);">
            <div style="padding:0.75rem 1rem;border-bottom:1px solid rgba(255,255,255,0.05);display:flex;justify-content:space-between;align-items:center;">
                <div class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.25);letter-spacing:0.15em;">RECENT ENRICHMENTS</div>
                <button style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(245,158,11,0.5);background:transparent;border:none;cursor:pointer;">Export All CSV</button>
            </div>
            <div id="le-table">
                @foreach([
                    ['Sarah Johnson','Stripe Inc.','sarah@stripe.com','VP of Engineering','92%'],
                    ['Marcus Chen','Notion Labs','m.chen@notion.so','Product Manager','87%'],
                    ['Afia Mensah','Paystack','a.mensah@paystack.com','CTO','96%'],
                    ['David Williams','Linear App','d.w@linear.app','Head of Design','78%'],
                ] as $r)
                <div style="display:grid;grid-template-columns:1.5fr 1.2fr 1fr 0.6fr;gap:0;padding:0.75rem 1rem;border-bottom:1px solid rgba(255,255,255,0.03);align-items:center;">
                    <div>
                        <div style="font-size:0.75rem;color:rgba(255,255,255,0.7);">{{$r[0]}}</div>
                        <div class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.25);">{{$r[3]}}</div>
                    </div>
                    <div class="font-mono" style="font-size:0.62rem;color:rgba(255,255,255,0.4);">{{$r[1]}}</div>
                    <div class="font-mono" style="font-size:0.6rem;color:rgba(245,158,11,0.6);">{{$r[2]}}</div>
                    <div class="font-mono" style="font-size:0.6rem;color:#00ff88;text-align:right;">{{$r[4]}}</div>
                </div>
                @endforeach
                <div id="le-new-rows"></div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
const mockData = {
    names: ['Alex Thompson','Jennifer Lee','Michael Osei','Rachel Kim','Tom Anderson'],
    titles: ['CEO','CTO','Head of Product','VP Engineering','Co-Founder','Director of Marketing'],
    companies: ['Stripe','Notion','Linear','Vercel','Figma','Shopify'],
    industries: ['FinTech','SaaS','Developer Tools','E-commerce','Design'],
    sizes: ['11-50','51-200','201-500','1-10','501-1000'],
    locations: ['San Francisco, CA','New York, NY','London, UK','Toronto, CA','Berlin, DE'],
};

function enrichLead() {
    const company = document.getElementById('le-company').value.trim();
    const nameInput = document.getElementById('le-name').value.trim();
    if (!company) { alert('Please enter a company name or domain.'); return; }

    const btn = event.target;
    btn.textContent = '⟳ Enriching...';
    btn.disabled = true;

    setTimeout(() => {
        const name = nameInput || mockData.names[Math.floor(Math.random()*mockData.names.length)];
        const initials = name.split(' ').map(n=>n[0]).join('').substring(0,2).toUpperCase();
        const score = Math.floor(Math.random()*20) + 78;

        document.getElementById('le-avatar').textContent = initials;
        document.getElementById('le-rname').textContent = name;
        document.getElementById('le-rtitle').textContent = mockData.titles[Math.floor(Math.random()*mockData.titles.length)] + ' at ' + company;
        document.getElementById('le-score').textContent = score + '% MATCH';
        document.getElementById('le-remail').textContent = name.toLowerCase().replace(' ','.') + '@' + company.toLowerCase().replace(' ','') + '.com';
        document.getElementById('le-rphone').textContent = '+1 (4' + Math.floor(Math.random()*100+10) + ') ' + Math.floor(Math.random()*900+100) + '-' + Math.floor(Math.random()*9000+1000);
        document.getElementById('le-rcompany').textContent = company;
        document.getElementById('le-rsize').textContent = mockData.sizes[Math.floor(Math.random()*mockData.sizes.length)] + ' employees';
        document.getElementById('le-rindustry').textContent = mockData.industries[Math.floor(Math.random()*mockData.industries.length)];
        document.getElementById('le-rlocation').textContent = mockData.locations[Math.floor(Math.random()*mockData.locations.length)];

        document.getElementById('le-result').style.display = 'block';

        // Add to table
        const row = document.createElement('div');
        row.style.cssText = 'display:grid;grid-template-columns:1.5fr 1.2fr 1fr 0.6fr;gap:0;padding:0.75rem 1rem;border-bottom:1px solid rgba(255,255,255,0.03);align-items:center;background:rgba(245,158,11,0.02);animation:fadeIn 0.3s ease;';
        row.innerHTML = `<div><div style="font-size:0.75rem;color:rgba(255,255,255,0.7);">${name}</div><div style="font-family:monospace;font-size:0.58rem;color:rgba(255,255,255,0.25);">${document.getElementById('le-rtitle').textContent.split(' at ')[0]}</div></div><div style="font-family:monospace;font-size:0.62rem;color:rgba(255,255,255,0.4);">${company}</div><div style="font-family:monospace;font-size:0.6rem;color:rgba(245,158,11,0.6);">${name.toLowerCase().replace(' ','.')}@${company.toLowerCase().replace(' ','')}.com</div><div style="font-family:monospace;font-size:0.6rem;color:#00ff88;text-align:right;">${score}%</div>`;
        document.getElementById('le-new-rows').prepend(row);

        btn.textContent = 'Enrich Lead →';
        btn.disabled = false;
    }, 1500);
}

function handleBulkFile(input) {
    const file = input.files[0];
    if (!file) return;
    document.getElementById('bulk-drop').innerHTML = `<div style="font-family:monospace;font-size:0.65rem;color:rgba(245,158,11,0.7);">📋 ${file.name} loaded<br><span style="font-size:0.55rem;color:rgba(255,255,255,0.25);">Click "Enrich Lead" to process all rows</span></div>`;
}
</script>
<style>
@keyframes fadeIn { from{opacity:0;transform:translateY(4px)} to{opacity:1;transform:translateY(0)} }
</style>
