<x-filament-panels::page>

{{-- KPI Row --}}
<div style="display:grid;grid-template-columns:repeat(6,1fr);gap:1rem;margin-bottom:1.5rem;">
    @foreach([
        ['Est. MRR', '$'.number_format($revenue), '+'.($proUsers+$agencyUsers).' paying', '#00ff88', '💰'],
        ['Total Users', $totalUsers, '+'.$newThisWeek.' this week', '#00d4ff', '👥'],
        ['New Today', $newToday, 'registrations', '#a855f7', '✨'],
        ['Conversion', $convRate.'%', 'free → paid', '#f59e0b', '📈'],
        ['Tool Launches', $toolLaunches, $todayLaunches.' today', '#00d4ff', '🚀'],
        ['Unread Msgs', $unread, $totalMessages.' total', $unread > 0 ? '#ef4444' : '#00ff88', '✉'],
    ] as $kpi)
    <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.25rem;position:relative;overflow:hidden;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:{{ $kpi[3] }};opacity:0.4;"></div>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.5rem;">
            <span style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.25);letter-spacing:0.15em;text-transform:uppercase;">{{ $kpi[0] }}</span>
            <span style="font-size:1rem;">{{ $kpi[4] }}</span>
        </div>
        <div style="font-size:1.5rem;font-weight:900;color:{{ $kpi[3] }};line-height:1;margin-bottom:0.3rem;">{{ $kpi[1] }}</div>
        <div style="font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(255,255,255,0.2);">{{ $kpi[2] }}</div>
    </div>
    @endforeach
</div>

{{-- Middle Row: User Distribution + Tool Usage + Recent Messages --}}
<div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:1rem;margin-bottom:1.5rem;">

    {{-- User Tier Distribution --}}
    <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.5rem;position:relative;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#00ff88;opacity:0.3;"></div>
        <div style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(0,255,136,0.5);letter-spacing:0.2em;text-transform:uppercase;margin-bottom:1rem;">// USER DISTRIBUTION</div>
        <div style="display:flex;flex-direction:column;gap:1rem;">
            @foreach($usersByTier as $tier)
            <div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.35rem;">
                    <span style="font-family:'JetBrains Mono',monospace;font-size:0.65rem;color:rgba(255,255,255,0.5);letter-spacing:0.1em;text-transform:uppercase;">{{ $tier['label'] }}</span>
                    <span style="font-family:'JetBrains Mono',monospace;font-size:0.65rem;color:{{ $tier['color'] }};">{{ $tier['count'] }} ({{ $tier['pct'] }}%)</span>
                </div>
                <div style="height:4px;background:rgba(255,255,255,0.05);width:100%;">
                    <div style="height:4px;background:{{ $tier['color'] }};width:{{ $tier['pct'] }}%;transition:width 0.5s;opacity:0.8;"></div>
                </div>
            </div>
            @endforeach
        </div>
        <div style="margin-top:1.5rem;padding-top:1rem;border-top:1px solid rgba(255,255,255,0.05);">
            <div style="font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(255,255,255,0.2);margin-bottom:0.5rem;letter-spacing:0.1em;">REVENUE BREAKDOWN</div>
            <div style="display:flex;align-items:center;justify-content:space-between;">
                <span style="font-size:0.75rem;color:rgba(255,255,255,0.4);">Pro ({{ $proUsers }} × $49)</span>
                <span style="font-family:'JetBrains Mono',monospace;font-size:0.75rem;color:#f59e0b;">${{ number_format($proUsers * 49) }}</span>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-top:0.35rem;">
                <span style="font-size:0.75rem;color:rgba(255,255,255,0.4);">Agency ({{ $agencyUsers }} × $129)</span>
                <span style="font-family:'JetBrains Mono',monospace;font-size:0.75rem;color:#00ff88;">${{ number_format($agencyUsers * 129) }}</span>
            </div>
        </div>
    </div>

    {{-- Tool Usage Stats --}}
    <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.5rem;position:relative;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#00d4ff;opacity:0.3;"></div>
        <div style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(0,212,255,0.5);letter-spacing:0.2em;text-transform:uppercase;margin-bottom:1rem;">// TOOL USAGE</div>
        <div style="display:flex;flex-direction:column;gap:0.875rem;">
            @foreach($toolStats as $stat)
            @php $maxCount = $toolStats->max('count') ?: 1; @endphp
            <div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.35rem;">
                    <div style="display:flex;align-items:center;gap:0.5rem;">
                        <span style="font-size:0.9rem;">{{ $stat['tool']['icon'] }}</span>
                        <span style="font-size:0.72rem;color:rgba(255,255,255,0.5);">{{ $stat['tool']['name'] }}</span>
                    </div>
                    <span style="font-family:'JetBrains Mono',monospace;font-size:0.65rem;color:{{ $stat['tool']['color'] }};">{{ $stat['count'] }}</span>
                </div>
                <div style="height:3px;background:rgba(255,255,255,0.05);">
                    <div style="height:3px;background:{{ $stat['tool']['color'] }};width:{{ $maxCount > 0 ? round($stat['count'] / $maxCount * 100) : 0 }}%;opacity:0.7;"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Recent Messages --}}
    <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.5rem;position:relative;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#ef4444;opacity:0.3;"></div>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
            <div style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(239,68,68,0.6);letter-spacing:0.2em;text-transform:uppercase;">// INBOX</div>
            @if($unread > 0)
                <span style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;background:rgba(239,68,68,0.15);border:1px solid rgba(239,68,68,0.3);color:#ef4444;padding:0.15rem 0.5rem;letter-spacing:0.1em;">{{ $unread }} UNREAD</span>
            @endif
        </div>
        @forelse($recentMessages as $msg)
        <div style="padding:0.75rem;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.04);margin-bottom:0.5rem;border-left:2px solid {{ $msg->status === 'unread' ? '#ef4444' : 'rgba(255,255,255,0.08)' }};">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.25rem;">
                <span style="font-size:0.75rem;font-weight:600;color:rgba(255,255,255,0.6);">{{ $msg->name }}</span>
                <span style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.2);">{{ $msg->created_at->diffForHumans() }}</span>
            </div>
            <div style="font-size:0.7rem;color:rgba(255,255,255,0.25);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ Str::limit($msg->message, 55) }}</div>
        </div>
        @empty
        <div style="text-align:center;padding:2rem 0;">
            <div style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(255,255,255,0.15);letter-spacing:0.1em;">NO MESSAGES YET</div>
        </div>
        @endforelse
        <a href="/admin/contact-submissions" style="display:block;text-align:center;margin-top:0.75rem;font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(255,255,255,0.2);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;border-top:1px solid rgba(255,255,255,0.05);padding-top:0.75rem;transition:color 0.2s;" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='rgba(255,255,255,0.2)'">
            View All Messages →
        </a>
    </div>

</div>

{{-- Bottom Row: Recent Users + Quick Actions --}}
<div style="display:grid;grid-template-columns:2fr 1fr;gap:1rem;">

    {{-- Recent Users Table --}}
    <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.5rem;position:relative;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#a855f7;opacity:0.3;"></div>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
            <div style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(168,85,247,0.6);letter-spacing:0.2em;text-transform:uppercase;">// RECENT SIGNUPS</div>
            <a href="/admin/users" style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(168,85,247,0.5);text-decoration:none;letter-spacing:0.1em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#a855f7'" onmouseout="this.style.color='rgba(168,85,247,0.5)'">View All →</a>
        </div>
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="border-bottom:1px solid rgba(255,255,255,0.05);">
                    @foreach(['User','Email','Tier','Role','Joined'] as $h)
                    <th style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;color:rgba(255,255,255,0.2);letter-spacing:0.15em;text-transform:uppercase;padding:0.5rem 0.75rem;text-align:left;font-weight:400;">{{ $h }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($recentUsers as $user)
                <tr style="border-bottom:1px solid rgba(255,255,255,0.03);transition:background 0.15s;" onmouseover="this.style.background='rgba(168,85,247,0.03)'" onmouseout="this.style.background='transparent'">
                    <td style="padding:0.75rem;display:flex;align-items:center;gap:0.5rem;">
                        <div style="width:26px;height:26px;background:rgba(168,85,247,0.1);border:1px solid rgba(168,85,247,0.2);display:flex;align-items:center;justify-content:center;font-family:'JetBrains Mono',monospace;font-size:0.6rem;font-weight:700;color:#a855f7;flex-shrink:0;">{{ strtoupper(substr($user->name,0,1)) }}</div>
                        <span style="font-size:0.78rem;color:rgba(255,255,255,0.6);">{{ $user->name }}</span>
                    </td>
                    <td style="padding:0.75rem;font-size:0.72rem;color:rgba(255,255,255,0.3);">{{ $user->email }}</td>
                    <td style="padding:0.75rem;">
                        @php $tierColors = ['free'=>'#4b5563','pro'=>'#f59e0b','agency'=>'#00ff88']; @endphp
                        <span style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;padding:0.15rem 0.5rem;border:1px solid {{ $tierColors[$user->tier] ?? '#4b5563' }}30;color:{{ $tierColors[$user->tier] ?? '#4b5563' }};letter-spacing:0.1em;text-transform:uppercase;">{{ $user->tier }}</span>
                    </td>
                    <td style="padding:0.75rem;">
                        <span style="font-family:'JetBrains Mono',monospace;font-size:0.55rem;padding:0.15rem 0.5rem;border:1px solid {{ $user->role === 'admin' ? 'rgba(0,212,255,0.3)' : 'rgba(255,255,255,0.08)' }};color:{{ $user->role === 'admin' ? '#00d4ff' : 'rgba(255,255,255,0.3)' }};letter-spacing:0.1em;text-transform:uppercase;">{{ $user->role }}</span>
                    </td>
                    <td style="padding:0.75rem;font-family:'JetBrains Mono',monospace;font-size:0.62rem;color:rgba(255,255,255,0.2);">{{ $user->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Quick Actions --}}
    <div style="background:#0a1520;border:1px solid rgba(255,255,255,0.05);padding:1.5rem;position:relative;">
        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#f59e0b;opacity:0.3;"></div>
        <div style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:rgba(245,158,11,0.6);letter-spacing:0.2em;text-transform:uppercase;margin-bottom:1.25rem;">// QUICK ACTIONS</div>
        <div style="display:flex;flex-direction:column;gap:0.625rem;">
            @foreach([
                ['/admin/users/create','➕ New User','Create a new user account','#00ff88'],
                ['/admin/users','👥 Manage Users','View and edit all users','#00d4ff'],
                ['/admin/contact-submissions','✉ View Messages','Check contact submissions','#ef4444'],
                ['/dashboard','⬡ User Dashboard','Go to the main dashboard','#a855f7'],
                ['/','🌐 View Website','Open the public homepage','rgba(255,255,255,0.3)'],
            ] as $action)
            <a href="{{ $action[0] }}" style="display:flex;align-items:center;gap:0.875rem;padding:0.875rem;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.04);text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.04)';this.style.borderColor='rgba(255,255,255,0.08)'" onmouseout="this.style.background='rgba(255,255,255,0.02)';this.style.borderColor='rgba(255,255,255,0.04)'">
                <div style="width:32px;height:32px;background:{{ $action[3] }}12;border:1px solid {{ $action[3] }}25;display:flex;align-items:center;justify-content:center;font-size:0.9rem;flex-shrink:0;">{{ explode(' ',$action[1])[0] }}</div>
                <div>
                    <div style="font-size:0.78rem;font-weight:600;color:rgba(255,255,255,0.6);">{{ implode(' ', array_slice(explode(' ',$action[1]),1)) }}</div>
                    <div style="font-size:0.65rem;color:rgba(255,255,255,0.2);margin-top:0.1rem;">{{ $action[2] }}</div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- System Status --}}
        <div style="margin-top:1.25rem;padding-top:1.25rem;border-top:1px solid rgba(255,255,255,0.05);">
            <div style="font-family:'JetBrains Mono',monospace;font-size:0.58rem;color:rgba(255,255,255,0.2);letter-spacing:0.15em;margin-bottom:0.75rem;">SYSTEM STATUS</div>
            @foreach([['Database','Online','#00ff88'],['Mail Service','Online','#00ff88'],['Storage','Online','#00ff88'],['Queue','Idle','#f59e0b']] as $s)
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.4rem;">
                <span style="font-size:0.7rem;color:rgba(255,255,255,0.3);">{{ $s[0] }}</span>
                <div style="display:flex;align-items:center;gap:0.35rem;">
                    <div style="width:5px;height:5px;border-radius:50%;background:{{ $s[2] }};"></div>
                    <span style="font-family:'JetBrains Mono',monospace;font-size:0.6rem;color:{{ $s[2] }};letter-spacing:0.05em;">{{ $s[1] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

</x-filament-panels::page>
