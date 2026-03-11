<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Subscription Cancelled</title>
<style>
    * { margin:0; padding:0; box-sizing:border-box; }
    body { background:#050a0f; font-family:'Helvetica Neue',Arial,sans-serif; color:#fff; }
    .wrapper { max-width:580px; margin:0 auto; padding:40px 20px; }
    .logo-bar { padding:32px 40px; border-bottom:1px solid rgba(255,255,255,0.06); }
    .logo { font-size:18px; font-weight:900; letter-spacing:0.2em; color:#fff; }
    .logo span { color:#00ff88; }
    .body { background:#0a1520; border:1px solid rgba(255,255,255,0.06); }
    .hero { padding:48px 40px 32px; border-bottom:1px solid rgba(255,255,255,0.04); }
    .tag { font-family:monospace; font-size:10px; color:rgba(245,158,11,0.5); letter-spacing:0.2em; text-transform:uppercase; margin-bottom:16px; }
    .hero h1 { font-size:26px; font-weight:900; color:#fff; line-height:1.2; margin-bottom:12px; }
    .hero p { font-size:15px; color:rgba(255,255,255,0.45); line-height:1.7; }
    .info-box { margin:32px 40px; background:#050a0f; border:1px solid rgba(245,158,11,0.15); padding:20px; }
    .info-box p { font-family:monospace; font-size:12px; color:rgba(255,255,255,0.4); line-height:1.8; }
    .info-box strong { color:#f59e0b; }
    .content { padding:0 40px 32px; border-bottom:1px solid rgba(255,255,255,0.04); }
    .content p { font-size:14px; color:rgba(255,255,255,0.5); line-height:1.8; margin-bottom:12px; }
    .cta { padding:32px 40px; text-align:center; }
    .btn { display:inline-block; background:#00ff88; color:#000; font-weight:700; font-size:13px; letter-spacing:0.12em; text-transform:uppercase; padding:14px 36px; text-decoration:none; font-family:monospace; }
    .footer { padding:24px 40px; text-align:center; }
    .footer p { font-family:monospace; font-size:11px; color:rgba(255,255,255,0.15); line-height:1.8; }
    .footer a { color:rgba(0,255,136,0.4); text-decoration:none; }
    .accent-bar { height:3px; background:linear-gradient(90deg,#f59e0b,#ef4444); }
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
            <div class="tag">// SUBSCRIPTION.cancelled()</div>
            <h1>Subscription Cancelled</h1>
            <p>Hi {{ $user->name }}, your CyberWraith subscription has been cancelled as requested.</p>
        </div>

        <div class="info-box">
            <p>Your subscription has been cancelled but you still have full access until <strong>{{ $accessUntil }}</strong>. After that date your account will revert to the Free plan.</p>
        </div>

        <div class="content">
            <p>After your access expires you will still be able to:</p>
            <p style="font-family:monospace;font-size:12px;color:rgba(255,255,255,0.3);padding-left:12px;border-left:2px solid rgba(0,255,136,0.2);">
                ✓ &nbsp;Log into your account<br>
                ✓ &nbsp;Access {{ config('plans.free.tools') }} free tools<br>
                ✓ &nbsp;Re-subscribe at any time
            </p>
            <p style="margin-top:16px;">Changed your mind? You can re-subscribe at any time from your billing page.</p>
        </div>

        <div class="cta">
            <a href="{{ config('app.url') }}/billing" class="btn">Re-subscribe →</a>
        </div>

        <div class="footer">
            <p>
                Questions? Contact us at TheCyberWraith@proton.me<br>
                <a href="{{ config('app.url') }}/billing">Billing</a> &nbsp;·&nbsp;
                <a href="{{ config('app.url') }}">cyberwraith.com</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
