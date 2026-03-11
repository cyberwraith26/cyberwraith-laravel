<div x-data="followstack()" style="padding:1.5rem;">

    {{-- Stats Bar --}}
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:2rem;">
        @foreach([['Active Sequences','3','#00ff88'],['Emails Queued','14','#00d4ff'],['Reply Rate','28%','#a855f7'],['Deals Won','2','#f59e0b']] as $s)
        <div style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.05);padding:1rem;text-align:center;">
            <div class="font-mono" style="font-size:1.4rem;font-weight:700;color:{{$s[2]}};">{{$s[1]}}</div>
            <div class="font-mono" style="font-size:0.55rem;color:rgba(255,255,255,0.25);letter-spacing:0.15em;margin-top:0.2rem;">{{$s[0]}}</div>
        </div>
        @endforeach
    </div>

    <div style="display:grid;grid-template-columns:1fr 1.5fr;gap:1.5rem;">

        {{-- New Sequence Form --}}
        <div>
            <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.2em;margin-bottom:1rem;">// NEW_SEQUENCE.create()</div>
            <div style="display:flex;flex-direction:column;gap:1rem;">
                <div>
                    <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,255,136,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Prospect Name</label>
                    <input type="text" id="fs-name" placeholder="e.g. Acme Corp" style="width:100%;background:#050a0f;border:1px solid rgba(0,255,136,0.15);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.78rem;padding:0.6rem 0.75rem;outline:none;" onfocus="this.style.borderColor='rgba(0,255,136,0.4)'" onblur="this.style.borderColor='rgba(0,255,136,0.15)'">
                </div>
                <div>
                    <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,255,136,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Prospect Email</label>
                    <input type="email" id="fs-email" placeholder="contact@prospect.com" style="width:100%;background:#050a0f;border:1px solid rgba(0,255,136,0.15);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.78rem;padding:0.6rem 0.75rem;outline:none;" onfocus="this.style.borderColor='rgba(0,255,136,0.4)'" onblur="this.style.borderColor='rgba(0,255,136,0.15)'">
                </div>
                <div>
                    <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,255,136,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Sequence Template</label>
                    <select id="fs-template" style="width:100%;background:#050a0f;border:1px solid rgba(0,255,136,0.15);color:rgba(0,255,136,0.7);font-family:'JetBrains Mono',monospace;font-size:0.75rem;padding:0.6rem 0.75rem;outline:none;cursor:pointer;">
                        <option value="proposal">Post-Proposal (3 emails, 7 days)</option>
                        <option value="cold">Cold Outreach (5 emails, 14 days)</option>
                        <option value="quote">Post-Quote (2 emails, 4 days)</option>
                        <option value="ghosted">Re-engagement (4 emails, 21 days)</option>
                    </select>
                </div>
                <div>
                    <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,255,136,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">First Contact Date</label>
                    <input type="date" id="fs-date" style="width:100%;background:#050a0f;border:1px solid rgba(0,255,136,0.15);color:#00ff88;font-family:'JetBrains Mono',monospace;font-size:0.78rem;padding:0.6rem 0.75rem;outline:none;cursor:pointer;" onfocus="this.style.borderColor='rgba(0,255,136,0.4)'" onblur="this.style.borderColor='rgba(0,255,136,0.15)'">
                </div>
                <div>
                    <label style="display:block;font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(0,255,136,0.5);letter-spacing:0.15em;text-transform:uppercase;margin-bottom:0.35rem;">Stop on Reply?</label>
                    <div style="display:flex;gap:1rem;">
                        <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;font-family:'JetBrains Mono',monospace;font-size:0.7rem;color:rgba(255,255,255,0.5);">
                            <input type="radio" name="fs-reply" value="yes" checked style="accent-color:#00ff88;"> Yes (recommended)
                        </label>
                        <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;font-family:'JetBrains Mono',monospace;font-size:0.7rem;color:rgba(255,255,255,0.5);">
                            <input type="radio" name="fs-reply" value="no" style="accent-color:#00ff88;"> No
                        </label>
                    </div>
                </div>
                <button onclick="addSequence()" style="width:100%;background:#00ff88;color:#000;font-family:'JetBrains Mono',monospace;font-size:0.7rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;padding:0.75rem;border:none;cursor:pointer;transition:background 0.2s;" onmouseover="this.style.background='#00ffaa'" onmouseout="this.style.background='#00ff88'">
                    + Add to Queue →
                </button>
            </div>
        </div>

        {{-- Active Sequences --}}
        <div>
            <div class="font-mono" style="font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.2em;margin-bottom:1rem;">// SEQUENCES.getActive()</div>
            <div id="sequences-list" style="display:flex;flex-direction:column;gap:0.75rem;">

                @foreach([
                    ['Stripe Inc.','stripe@example.com','Post-Proposal','Day 3 of 7','Follow-up #2 due tomorrow','#00ff88','active'],
                    ['Notion Labs','hello@notion.so','Cold Outreach','Day 8 of 14','Follow-up #3 in 2 days','#00d4ff','active'],
                    ['Linear App','team@linear.app','Re-engagement','Day 21 of 21','Final email sent — awaiting reply','#a855f7','waiting'],
                ] as $seq)
                <div style="background:#050a0f;border:1px solid rgba(255,255,255,0.06);padding:1rem;position:relative;overflow:hidden;">
                    <div style="position:absolute;left:0;top:0;bottom:0;width:3px;background:{{$seq[5]}};"></div>
                    <div style="padding-left:0.5rem;">
                        <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:0.5rem;">
                            <div>
                                <div style="font-size:0.88rem;font-weight:700;color:#fff;">{{$seq[0]}}</div>
                                <div class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.25);">{{$seq[1]}}</div>
                            </div>
                            <span class="font-mono" style="font-size:0.55rem;padding:0.15rem 0.5rem;border:1px solid {{$seq[5]}}30;color:{{$seq[5]}};background:{{$seq[5]}}08;letter-spacing:0.1em;text-transform:uppercase;">{{$seq[6]}}</span>
                        </div>
                        <div style="display:flex;align-items:center;justify-content:space-between;">
                            <div>
                                <div class="font-mono" style="font-size:0.6rem;color:rgba(255,255,255,0.35);">{{$seq[2]}} · {{$seq[3]}}</div>
                                <div class="font-mono" style="font-size:0.6rem;color:{{$seq[5]}};margin-top:0.2rem;">⚡ {{$seq[4]}}</div>
                            </div>
                            <div style="display:flex;gap:0.5rem;">
                                <button style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.3);background:transparent;border:1px solid rgba(255,255,255,0.08);padding:0.25rem 0.6rem;cursor:pointer;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.3)'">Pause</button>
                                <button style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(239,68,68,0.5);background:transparent;border:1px solid rgba(239,68,68,0.15);padding:0.25rem 0.6rem;cursor:pointer;" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='rgba(239,68,68,0.5)'">Stop</button>
                            </div>
                        </div>
                        {{-- Progress bar --}}
                        @php $pct = $loop->index === 0 ? 43 : ($loop->index === 1 ? 57 : 100); @endphp
                        <div style="margin-top:0.75rem;height:2px;background:rgba(255,255,255,0.05);position:relative;">
                            <div style="position:absolute;left:0;top:0;height:100%;width:{{$pct}}%;background:{{$seq[5]}};transition:width 0.5s;"></div>
                        </div>
                        <div class="font-mono" style="font-size:0.52rem;color:rgba(255,255,255,0.2);margin-top:0.3rem;">{{$pct}}% complete</div>
                    </div>
                </div>
                @endforeach

                <div id="new-sequences"></div>
            </div>

            {{-- Email Preview Panel --}}
            <div style="margin-top:1.5rem;background:#050a0f;border:1px solid rgba(0,255,136,0.1);padding:1rem;">
                <div class="font-mono" style="font-size:0.58rem;color:rgba(0,255,136,0.4);letter-spacing:0.15em;margin-bottom:0.75rem;">// NEXT_EMAIL.preview()</div>
                <div style="font-size:0.78rem;color:rgba(255,255,255,0.5);line-height:1.7;">
                    <div style="margin-bottom:0.5rem;"><span class="font-mono" style="color:rgba(0,255,136,0.4);font-size:0.6rem;">TO:</span> stripe@example.com</div>
                    <div style="margin-bottom:0.5rem;"><span class="font-mono" style="color:rgba(0,255,136,0.4);font-size:0.6rem;">SUBJ:</span> Quick follow-up on the proposal</div>
                    <div style="border-top:1px solid rgba(255,255,255,0.05);padding-top:0.75rem;color:rgba(255,255,255,0.35);font-size:0.75rem;line-height:1.8;">
                        Hi [Name],<br><br>
                        Just checking in on the proposal I sent over. Happy to jump on a quick call to walk through any questions you have...<br><br>
                        <span style="color:rgba(0,255,136,0.4);">[ Personalized content continues ]</span>
                    </div>
                </div>
                <div style="display:flex;gap:0.75rem;margin-top:1rem;">
                    <button style="flex:1;font-family:'JetBrains Mono',monospace;font-size:0.62rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#000;background:#00ff88;padding:0.55rem;border:none;cursor:pointer;">Send Now</button>
                    <button style="flex:1;font-family:'JetBrains Mono',monospace;font-size:0.62rem;letter-spacing:0.1em;text-transform:uppercase;color:rgba(255,255,255,0.3);background:transparent;border:1px solid rgba(255,255,255,0.08);padding:0.55rem;cursor:pointer;">Edit Draft</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function addSequence() {
    const name = document.getElementById('fs-name').value.trim();
    const email = document.getElementById('fs-email').value.trim();
    const template = document.getElementById('fs-template');
    const templateText = template.options[template.selectedIndex].text;
    if (!name || !email) { alert('Please enter prospect name and email.'); return; }

    const colors = ['#00ff88','#00d4ff','#a855f7','#f59e0b'];
    const color = colors[Math.floor(Math.random() * colors.length)];

    const el = document.createElement('div');
    el.style.cssText = 'background:#050a0f;border:1px solid rgba(255,255,255,0.06);padding:1rem;position:relative;overflow:hidden;animation:fadeIn 0.3s ease;';
    el.innerHTML = `
        <div style="position:absolute;left:0;top:0;bottom:0;width:3px;background:${color};"></div>
        <div style="padding-left:0.5rem;">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:0.5rem;">
                <div>
                    <div style="font-size:0.88rem;font-weight:700;color:#fff;">${name}</div>
                    <div style="font-family:monospace;font-size:0.6rem;color:rgba(255,255,255,0.25);">${email}</div>
                </div>
                <span style="font-family:monospace;font-size:0.55rem;padding:0.15rem 0.5rem;border:1px solid ${color}30;color:${color};background:${color}08;letter-spacing:0.1em;text-transform:uppercase;">queued</span>
            </div>
            <div style="font-family:monospace;font-size:0.6rem;color:rgba(255,255,255,0.35);">${templateText}</div>
            <div style="margin-top:0.75rem;height:2px;background:rgba(255,255,255,0.05);"></div>
            <div style="font-family:monospace;font-size:0.52rem;color:rgba(255,255,255,0.2);margin-top:0.3rem;">0% complete — starts today</div>
        </div>`;
    document.getElementById('new-sequences').appendChild(el);
    document.getElementById('fs-name').value = '';
    document.getElementById('fs-email').value = '';
}
</script>
<style>
@keyframes fadeIn { from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:translateY(0)} }
</style>
