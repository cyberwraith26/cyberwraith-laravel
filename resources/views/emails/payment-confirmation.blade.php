<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Confirmed</title>
<style>
    * { margin:0; padding:0; box-sizing:border-box; }
    body { background:#050a0f; font-family:'Helvetica Neue',Arial,sans-serif; color:#fff; }
    .wrapper { max-width:580px; margin:0 auto; padding:40px 20px; }
    .logo-bar { padding:32px 40px; border-bottom:1px solid rgba(0,255,136,0.1); }
    .logo { font-size:18px; font-weight:900; letter-spacing:0.2em; color:#fff; }
    .logo span { color:#00ff88; }
    .body { background:#0a1520; border:1px solid rgba(255,255,255,0.06); }
    .hero { padding:48px 40px 32px; border-bottom:1px solid rgba(255,255,255,0.04); }
    .tag { font-family:monospace; font-size:10px; color:rgba(0,255,136,0.5); letter-spacing:0.2em; text-transform:uppercase; margin-bottom:16px; }
    .hero h1 { font-size:26px; font-weight:900; color:#fff; line-height:1.2; margin-bottom:12px; }
    .hero p { font-size:15px; color:rgba(255,255,255,0.45); line-height:1.7; }
    .receipt { margin:32px 40px; background:#050a0f; border:1px solid rgba(0,255,136,0.1); }
    .receipt-header { padding:12px 20px; border-bottom:1px solid rgba(0,255,136,0.08); }
    .receipt-header span { font-family:monospace; font-size:10px; color:rgba(0,255,136,0.4); letter-spacing:0.2em; text-transform:uppercase; }
    .receipt-row { display:flex; justify-content:space-between; padding:12px 20px; border-bottom:1px solid rgba(255,255,255,0.03); }
    .receipt-row:last-child { border-bottom:none; }
    .receipt-label { font-family:monospace; font-size:11px; color:rgba(255,255,255,0.3); letter-spacing:0.08em; }
    .receipt-value { font-family:monospace; font-size:11px; color:rgba(255,255,255,0.7); }
    .receipt-value.green { color:#00ff88; }
    .content { padding:0 40px 32px; border-bottom:1px solid rgba(255,255,255,0.04); }
    .content p { font-size:14px; color:rgba(255,255,255,0.5); line-height:1.8; margin-bottom:12px; }
    .feature-list { list-style:none; display:flex; flex-direction:column; gap:8px; margin:16px 0; }
    .feature-list li { font-family:monospace; font-size:12px; color:rgba(255,255,255,0.4); display:flex; align-items:center; gap:8px; }
    .feature-list li span { color:#00ff88; }
    .cta { padding:32px 40px; text-align:center; }
    .btn { display:inline-block; background:#00ff88; color:#000; font-weight:700; font-size:13px; letter-spacing:0.12em; text-transform:uppercase; padding:14px 36px; text-decoration:none; font-family:monospace; }
    .footer { padding:24px 40px; text-align:center; }
    .footer p { font-family:monospace; font-size:11px; color:rgba(255,255,255,0.15); line-height:1.8; }
    .footer a { color:rgba(0,255,136,0.4); text-decoration:none; }
    .accent-bar { height:3px; background:linear-gradient(90deg,#00ff88,#00d4ff); }
</style>
</head>
<body>
<div class="wrapper">
    <div class="body">
        <div class="accent-bar"></div>

        <div class="logo-bar">
            <span class="logo">CYBER<span>WRAITH</span></span>
        </div>

        <div class="hero">
            <div class="tag">// PAYMENT.confirmed()</div>
            <h1>Payment Confirmed ✓</h1>
            <p>Thank you, {{ $user->name }}. Your payment was successful and your plan has been upgraded.</p>
        </div>

        <div class="receipt">
            <div class="receipt-header"><span>// RECEIPT</span></div>
            <div class="receipt-row">
                <span class="receipt-label">PLAN</span>
                <span class="receipt-value green">{{ ucfirst($plan) }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">AMOUNT</span>
                <span class="receipt-value">GHS {{ $amount }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">STATUS</span>
                <span class="receipt-value green">PAID</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">DATE</span>
                <span class="receipt-value">{{ now()->format('M d, Y') }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">NEXT BILLING</span>
                <span class="receipt-value">{{ now()->addMonth()->format('M d, Y') }}</span>
            </div>
        </div>

        <div class="content">
            <p>Your account has been upgraded to the <strong style="color:#fff;">{{ ucfirst($plan) }} plan</strong>. You now have access to:</p>
            <ul class="feature-list">
                @foreach(config('plans.' . $plan . '.features', []) as $feature)
                    <li><span>✓</span> {{ $feature }}</li>
                @endforeach
            </ul>
        </div>

        <div class="cta">
            <a href="{{ config('app.url') }}/dashboard" class="btn">Go to Dashboard →</a>
        </div>

        <div class="footer">
            <p>
                Questions? Reply to this email or contact us at TheCyberWraith@proton.me<br>
                <a href="{{ config('app.url') }}/billing">Manage Billing</a> &nbsp;·&nbsp;
                <a href="{{ config('app.url') }}">cyberwraith.com</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
