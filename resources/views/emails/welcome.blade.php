<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome to CyberWraith</title>
<style>
    * { margin:0; padding:0; box-sizing:border-box; }
    body { background:#050a0f; font-family:'Helvetica Neue',Arial,sans-serif; color:#fff; }
    .wrapper { max-width:580px; margin:0 auto; padding:40px 20px; }
    .logo-bar { padding:32px 40px; border-bottom:1px solid rgba(0,255,136,0.1); }
    .logo { font-size:18px; font-weight:900; letter-spacing:0.2em; color:#fff; text-decoration:none; }
    .logo span { color:#00ff88; }
    .body { background:#0a1520; border:1px solid rgba(255,255,255,0.06); }
    .hero { padding:48px 40px 32px; border-bottom:1px solid rgba(255,255,255,0.04); }
    .tag { font-family:monospace; font-size:10px; color:rgba(0,255,136,0.5); letter-spacing:0.2em; text-transform:uppercase; margin-bottom:16px; }
    .hero h1 { font-size:28px; font-weight:900; color:#fff; line-height:1.2; margin-bottom:12px; }
    .hero h1 span { color:#00ff88; }
    .hero p { font-size:15px; color:rgba(255,255,255,0.45); line-height:1.7; }
    .content { padding:32px 40px; border-bottom:1px solid rgba(255,255,255,0.04); }
    .content p { font-size:14px; color:rgba(255,255,255,0.5); line-height:1.8; margin-bottom:16px; }
    .feature-list { list-style:none; display:flex; flex-direction:column; gap:10px; margin:24px 0; }
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
            <div class="tag">// WELCOME.init()</div>
            <h1>Welcome aboard,<br><span>{{ $user->name }}</span></h1>
            <p>Your account has been created. You now have access to CyberWraith's suite of freelancer tools.</p>
        </div>

        <div class="content">
            <p>You're currently on the <strong style="color:#fff;">Free plan</strong> with access to {{ config('plans.free.tools') }} tools. Here's what you can do right now:</p>
            <ul class="feature-list">
                <li><span>✓</span> Access your dashboard and manage your tools</li>
                <li><span>✓</span> Use {{ config('plans.free.tools') }} free tools immediately</li>
                <li><span>✓</span> Upgrade anytime to unlock more tools</li>
                <li><span>✓</span> Manage your profile and account settings</li>
            </ul>
            <p>Ready to get started? Head to your dashboard and explore what's available to you.</p>
        </div>

        <div class="cta">
            <a href="{{ config('app.url') }}/dashboard" class="btn">Go to Dashboard →</a>
        </div>

        <div class="footer">
            <p>
                You're receiving this because you created an account at CyberWraith.<br>
                <a href="{{ config('app.url') }}">cyberwraith.com</a> &nbsp;·&nbsp;
                <a href="{{ config('app.url') }}/settings">Manage Account</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
