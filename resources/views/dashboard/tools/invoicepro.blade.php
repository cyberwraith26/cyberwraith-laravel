<div style="padding:1.5rem;">
<div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem;">

    {{-- Left: Invoice Builder --}}
    <div>
        <div class="font-mono" style="font-size:0.6rem;color:rgba(0,212,255,0.5);letter-spacing:0.2em;margin-bottom:1.25rem;">// INVOICE.build()</div>

        {{-- Invoice Header --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
            <div>
                <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,212,255,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Invoice #</label>
                <input type="text" id="inv-num" value="INV-001" style="width:100%;background:#050a0f;border:1px solid rgba(0,212,255,0.15);color:#00d4ff;font-family:'JetBrains Mono',monospace;font-size:0.78rem;padding:0.6rem 0.75rem;outline:none;" oninput="updatePreview()">
            </div>
            <div>
                <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,212,255,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Due Date</label>
                <input type="date" id="inv-due" style="width:100%;background:#050a0f;border:1px solid rgba(0,212,255,0.15);color:#00d4ff;font-family:'JetBrains Mono',monospace;font-size:0.78rem;padding:0.6rem 0.75rem;outline:none;" oninput="updatePreview()">
            </div>
        </div>

        <div style="margin-bottom:1rem;">
            <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,212,255,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Bill To</label>
            <input type="text" id="inv-client" placeholder="Client Name / Company" style="width:100%;background:#050a0f;border:1px solid rgba(0,212,255,0.15);color:#00d4ff;font-family:'JetBrains Mono',monospace;font-size:0.78rem;padding:0.6rem 0.75rem;outline:none;margin-bottom:0.5rem;" oninput="updatePreview()">
            <input type="email" id="inv-cemail" placeholder="client@company.com" style="width:100%;background:#050a0f;border:1px solid rgba(0,212,255,0.15);color:#00d4ff;font-family:'JetBrains Mono',monospace;font-size:0.78rem;padding:0.6rem 0.75rem;outline:none;" oninput="updatePreview()">
        </div>

        {{-- Line Items --}}
        <div style="margin-bottom:1rem;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.5rem;">
                <label style="font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,212,255,0.5);letter-spacing:0.15em;text-transform:uppercase;">Line Items</label>
                <button onclick="addLineItem()" style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:#00d4ff;background:transparent;border:1px solid rgba(0,212,255,0.2);padding:0.2rem 0.6rem;cursor:pointer;">+ Add Row</button>
            </div>
            <div style="background:#050a0f;border:1px solid rgba(0,212,255,0.1);">
                <div style="display:grid;grid-template-columns:3fr 1fr 1fr;gap:0;border-bottom:1px solid rgba(255,255,255,0.05);">
                    @foreach(['Description','Qty','Rate'] as $h)
                    <div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.2);padding:0.5rem 0.75rem;letter-spacing:0.1em;{{ !$loop->last ? 'border-right:1px solid rgba(255,255,255,0.05);' : '' }}">{{$h}}</div>
                    @endforeach
                </div>
                <div id="line-items">
                    <div class="line-row" style="display:grid;grid-template-columns:3fr 1fr 1fr;">
                        <input type="text" placeholder="Web Development" class="li-desc" style="background:transparent;border:none;border-right:1px solid rgba(255,255,255,0.05);color:#00d4ff;font-family:'JetBrains Mono',monospace;font-size:0.72rem;padding:0.6rem 0.75rem;outline:none;width:100%;" oninput="calcTotal()">
                        <input type="number" placeholder="1" class="li-qty" style="background:transparent;border:none;border-right:1px solid rgba(255,255,255,0.05);color:#00d4ff;font-family:'JetBrains Mono',monospace;font-size:0.72rem;padding:0.6rem 0.75rem;outline:none;width:100%;" oninput="calcTotal()">
                        <input type="number" placeholder="500" class="li-rate" style="background:transparent;border:none;color:#00d4ff;font-family:'JetBrains Mono',monospace;font-size:0.72rem;padding:0.6rem 0.75rem;outline:none;width:100%;" oninput="calcTotal()">
                    </div>
                </div>
            </div>
        </div>

        {{-- Tax --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
            <div>
                <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,212,255,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Tax %</label>
                <input type="number" id="inv-tax" value="0" min="0" max="100" style="width:100%;background:#050a0f;border:1px solid rgba(0,212,255,0.15);color:#00d4ff;font-family:'JetBrains Mono',monospace;font-size:0.78rem;padding:0.6rem 0.75rem;outline:none;" oninput="calcTotal()">
            </div>
            <div>
                <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,212,255,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Currency</label>
                <select id="inv-currency" style="width:100%;background:#050a0f;border:1px solid rgba(0,212,255,0.15);color:rgba(0,212,255,0.7);font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.6rem 0.75rem;outline:none;" onchange="calcTotal()">
                    <option value="$">USD ($)</option>
                    <option value="€">EUR (€)</option>
                    <option value="£">GBP (£)</option>
                    <option value="₵">GHS (₵)</option>
                </select>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;">
            <button onclick="generateInvoice()" style="width:100%;background:#00d4ff;color:#000;font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.75rem;border:none;cursor:pointer;transition:opacity 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">Generate PDF →</button>
            <button onclick="sendInvoice()" style="width:100%;background:transparent;color:#00d4ff;font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.75rem;border:1px solid rgba(0,212,255,0.3);cursor:pointer;">Send via Email</button>
        </div>
    </div>

    {{-- Right: Live Preview --}}
    <div>
        <div class="font-mono" style="font-size:0.6rem;color:rgba(0,212,255,0.5);letter-spacing:0.2em;margin-bottom:1.25rem;">// INVOICE.preview()</div>
        <div id="inv-preview" style="background:#fff;color:#000;padding:2rem;min-height:400px;font-family:'Inter',sans-serif;font-size:0.8rem;position:relative;">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:2rem;">
                <div>
                    <div style="font-size:1.2rem;font-weight:900;color:#000;letter-spacing:-0.02em;">INVOICE</div>
                    <div id="prev-num" style="font-size:0.7rem;color:#666;margin-top:0.2rem;">INV-001</div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:0.7rem;font-weight:700;color:#000;">CyberWraith</div>
                    <div style="font-size:0.65rem;color:#666;">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.5rem;">
                <div>
                    <div style="font-size:0.6rem;font-weight:700;color:#999;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:0.3rem;">BILL TO</div>
                    <div id="prev-client" style="font-weight:600;color:#000;">Client Name</div>
                    <div id="prev-cemail" style="font-size:0.65rem;color:#666;"></div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:0.6rem;font-weight:700;color:#999;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:0.3rem;">DUE DATE</div>
                    <div id="prev-due" style="font-weight:600;color:#000;">—</div>
                </div>
            </div>
            <table style="width:100%;border-collapse:collapse;margin-bottom:1.5rem;">
                <thead>
                    <tr style="border-bottom:2px solid #000;">
                        <th style="text-align:left;font-size:0.6rem;letter-spacing:0.1em;color:#666;padding:0.4rem 0;text-transform:uppercase;">Description</th>
                        <th style="text-align:right;font-size:0.6rem;letter-spacing:0.1em;color:#666;padding:0.4rem 0;text-transform:uppercase;">Qty</th>
                        <th style="text-align:right;font-size:0.6rem;letter-spacing:0.1em;color:#666;padding:0.4rem 0;text-transform:uppercase;">Rate</th>
                        <th style="text-align:right;font-size:0.6rem;letter-spacing:0.1em;color:#666;padding:0.4rem 0;text-transform:uppercase;">Amount</th>
                    </tr>
                </thead>
                <tbody id="prev-items"></tbody>
            </table>
            <div style="text-align:right;">
                <div style="font-size:0.7rem;color:#666;margin-bottom:0.3rem;">Subtotal: <span id="prev-sub">$0.00</span></div>
                <div style="font-size:0.7rem;color:#666;margin-bottom:0.5rem;">Tax: <span id="prev-tax-amt">$0.00</span></div>
                <div style="font-size:1.2rem;font-weight:900;color:#000;">TOTAL: <span id="prev-total">$0.00</span></div>
            </div>
            <div style="margin-top:2rem;padding-top:1rem;border-top:1px solid #eee;font-size:0.65rem;color:#999;">Thank you for your business. Payment due within the specified date.</div>
        </div>

        {{-- Invoice History --}}
        <div style="margin-top:1rem;background:#050a0f;border:1px solid rgba(255,255,255,0.06);padding:1rem;">
            <div class="font-mono" style="font-size:0.58rem;color:rgba(255,255,255,0.2);letter-spacing:0.15em;margin-bottom:0.75rem;">RECENT INVOICES</div>
            @foreach([['INV-003','Acme Corp','$2,400','paid'],['INV-002','StartupXYZ','$850','overdue'],['INV-001','FreelanceHub','$1,200','sent']] as $inv)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:0.5rem 0;border-bottom:1px solid rgba(255,255,255,0.03);">
                <div>
                    <div class="font-mono" style="font-size:0.65rem;color:rgba(255,255,255,0.6);">{{$inv[0]}} · {{$inv[1]}}</div>
                </div>
                <div style="display:flex;align-items:center;gap:0.75rem;">
                    <span style="font-family:'JetBrains Mono',monospace;font-size:0.65rem;color:#00d4ff;">{{$inv[2]}}</span>
                    <span style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;padding:0.1rem 0.4rem;border:1px solid {{ $inv[3]==='paid' ? 'rgba(0,255,136,0.3)' : ($inv[3]==='overdue' ? 'rgba(239,68,68,0.3)' : 'rgba(245,158,11,0.3)') }};color:{{ $inv[3]==='paid' ? '#00ff88' : ($inv[3]==='overdue' ? '#ef4444' : '#f59e0b') }};">{{strtoupper($inv[3])}}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>

<script>
function calcTotal() {
    const rows = document.querySelectorAll('.line-row');
    const currency = document.getElementById('inv-currency').value;
    let sub = 0;
    const tbody = document.getElementById('prev-items');
    tbody.innerHTML = '';
    rows.forEach(r => {
        const desc = r.querySelector('.li-desc').value;
        const qty = parseFloat(r.querySelector('.li-qty').value) || 0;
        const rate = parseFloat(r.querySelector('.li-rate').value) || 0;
        const amt = qty * rate;
        sub += amt;
        if (desc || qty || rate) {
            const tr = document.createElement('tr');
            tr.innerHTML = `<td style="padding:0.4rem 0;font-size:0.72rem;border-bottom:1px solid #f0f0f0;">${desc}</td><td style="text-align:right;padding:0.4rem 0;font-size:0.72rem;border-bottom:1px solid #f0f0f0;">${qty}</td><td style="text-align:right;padding:0.4rem 0;font-size:0.72rem;border-bottom:1px solid #f0f0f0;">${currency}${rate.toFixed(2)}</td><td style="text-align:right;padding:0.4rem 0;font-size:0.72rem;border-bottom:1px solid #f0f0f0;">${currency}${amt.toFixed(2)}</td>`;
            tbody.appendChild(tr);
        }
    });
    const taxPct = parseFloat(document.getElementById('inv-tax').value) || 0;
    const taxAmt = sub * taxPct / 100;
    const total = sub + taxAmt;
    document.getElementById('prev-sub').textContent = currency + sub.toFixed(2);
    document.getElementById('prev-tax-amt').textContent = currency + taxAmt.toFixed(2);
    document.getElementById('prev-total').textContent = currency + total.toFixed(2);
    updatePreview();
}

function updatePreview() {
    document.getElementById('prev-num').textContent = document.getElementById('inv-num').value || 'INV-001';
    document.getElementById('prev-client').textContent = document.getElementById('inv-client').value || 'Client Name';
    document.getElementById('prev-cemail').textContent = document.getElementById('inv-cemail').value || '';
    const due = document.getElementById('inv-due').value;
    document.getElementById('prev-due').textContent = due ? new Date(due).toLocaleDateString('en-US', {month:'short',day:'numeric',year:'numeric'}) : '—';
}

function addLineItem() {
    const div = document.createElement('div');
    div.className = 'line-row';
    div.style.cssText = 'display:grid;grid-template-columns:3fr 1fr 1fr;border-top:1px solid rgba(255,255,255,0.04);';
    div.innerHTML = `<input type="text" placeholder="Service description" class="li-desc" style="background:transparent;border:none;border-right:1px solid rgba(255,255,255,0.05);color:#00d4ff;font-family:'JetBrains Mono',monospace;font-size:0.72rem;padding:0.6rem 0.75rem;outline:none;width:100%;" oninput="calcTotal()"><input type="number" placeholder="1" class="li-qty" style="background:transparent;border:none;border-right:1px solid rgba(255,255,255,0.05);color:#00d4ff;font-family:'JetBrains Mono',monospace;font-size:0.72rem;padding:0.6rem 0.75rem;outline:none;width:100%;" oninput="calcTotal()"><input type="number" placeholder="0" class="li-rate" style="background:transparent;border:none;color:#00d4ff;font-family:'JetBrains Mono',monospace;font-size:0.72rem;padding:0.6rem 0.75rem;outline:none;width:100%;" oninput="calcTotal()">`;
    document.getElementById('line-items').appendChild(div);
}

function generateInvoice() {
    const preview = document.getElementById('inv-preview');
    const w = window.open('', '_blank');
    w.document.write('<html><head><title>Invoice</title><style>body{font-family:Inter,sans-serif;padding:40px;}</style></head><body>');
    w.document.write(preview.innerHTML);
    w.document.write('</body></html>');
    w.document.close();
    w.print();
}

function sendInvoice() {
    alert('Invoice send feature connects to your email. Configure SMTP in Settings to enable.');
}

// Init date
document.getElementById('inv-due').value = new Date(Date.now() + 14*864e5).toISOString().split('T')[0];
updatePreview();
</script>
