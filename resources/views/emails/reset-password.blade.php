<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your CyberWraith Password</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #050a0f; font-family: 'Inter', Arial, sans-serif; padding: 2rem 1rem; }
        .container { max-width: 520px; margin: 0 auto; }
        .card { background: #0a1520; border: 1px solid rgba(0,255,136,0.15); position: relative; overflow: hidden; }
        .accent { height: 2px; background: linear-gradient(90deg, #00ff88, #00d4ff); }
        .header { padding: 2rem 2rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .body { padding: 2rem; }
        .footer { padding: 1.5rem 2rem; border-top: 1px solid rgba(255,255,255,0.05); }
        .logo { display: flex; align-items: center; gap: 0.75rem; text-decoration: none; margin-bottom: 1.5rem; }
        .logo-mark { width: 24px; height: 24px; background: linear-gradient(135deg, #00ff88, #00d4ff); clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); }
        .logo-text { font-family: monospace; font-size: 0.9rem; letter-spacing: 0.2em; color: #fff; }
        .logo-text span { color: #00ff88; }
        h1 { font-size: 1.25rem; font-weight: 800; color: #fff; margin-bottom: 0.4rem; }
        .label { font-family: monospace; font-size: 0.58rem; color: rgba(0,255,136,0.5); letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 0.5rem; }
        p { font-size: 0.85rem; color: rgba(255,255,255,0.4); line-height: 1.7; margin-bottom: 1.25rem; }
        .btn { display: inline-block; background: #00ff88; color: #000; font-family: monospace; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; padding: 0.875rem 2rem; text-decoration: none; margin-bottom: 1.5rem; }
        .url-box { background: #050a0f; border: 1px solid rgba(255,255,255,0.06); padding: 0.75rem 1rem; margin-bottom: 1.25rem; }
        .url-text { font-family: monospace; font-size: 0.65rem; color: rgba(0,255,136,0.4); word-break: break-all; line-height: 1.6; }
        .warning { font-size: 0.75rem; color: rgba(255,255,255,0.2); line-height: 1.6; }
        .footer-text { font-family: monospace; font-size: 0.6rem; color: rgba(255,255,255,0.15); letter-spacing: 0.1em; text-align: center; }
    </style>
</head>
<body>
    <div class="container">

        <div style="text-align:center;margin-bottom:1.5rem;">
            <div style="display:inline-flex;align-items:center;gap:0.75rem;text-decoration:none;">
                <div class="logo-mark"></div>
                <span class="logo-text">CYBER<span>WRAITH</span></span>
            </div>
        </div>

        <div class="card">
            <div class="accent"></div>

            <div class="header">
                <div class="label">// AUTH.resetPassword()</div>
                <h1>Reset Your Password</h1>
            </div>

            <div class="body">
                <p>We received a request to reset the password for your CyberWraith account. Click the button below to choose a new password.</p>

                <div style="text-align:center;margin-bottom:1.5rem;">
                    <a href="{{ $url }}" class="btn">Reset My Password &rarr;</a>
                </div>

                <p style="font-size:0.78rem;color:rgba(255,255,255,0.25);margin-bottom:0.75rem;">If the button doesn't work, copy and paste this link into your browser:</p>

                <div class="url-box">
                    <div class="url-text">{{ $url }}</div>
                </div>

                <p class="warning">This link expires in <strong style="color:rgba(255,255,255,0.4);">60 minutes</strong>. If you didn't request a password reset, you can safely ignore this email — your password will not be changed.</p>
            </div>

            <div class="footer">
                <p class="footer-text">© {{ date('Y') }} CyberWraith. All rights reserved.</p>
            </div>
        </div>

    </div>
</body>
</html>
