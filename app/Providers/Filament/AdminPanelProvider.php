<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\RecentActivityWidget;
use App\Filament\Widgets\RecentUsersWidget;
use App\Filament\Widgets\StatsOverview;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::hex('#00ff88'),
                'gray'    => Color::Zinc,
                'danger'  => Color::hex('#ef4444'),
                'info'    => Color::hex('#00d4ff'),
                'success' => Color::hex('#00ff88'),
                'warning' => Color::hex('#f59e0b'),
            ])
            ->font('JetBrains Mono', provider: \Filament\FontProviders\GoogleFontProvider::class)
            ->brandName('')
            ->darkMode(true)
            ->theme(asset('css/filament/admin/theme.css'))
            ->widgets([
                StatsOverview::class,
                RecentUsersWidget::class,
                RecentActivityWidget::class,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->renderHook(
                'panels::sidebar.header.end',
                fn () => '<a href="/" style="display:flex;align-items:center;gap:0.75rem;padding:0 1.25rem;text-decoration:none;width:100%;height:64px;border-bottom:1px solid rgba(255,255,255,0.05);">
                    <div style="width:28px;height:28px;background:linear-gradient(135deg,#00ff88,#00d4ff);clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);flex-shrink:0;"></div>
                    <span style="font-family:\'JetBrains Mono\',monospace;font-size:0.8rem;letter-spacing:0.2em;color:#fff;">CYBER<span style="color:#00ff88;">WRAITH</span></span>
                </a>'
            )
            ->renderHook(
                'panels::topbar.end',
                function () {
                    $initial = strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1));
                    return '
                    <div style="display:flex;align-items:center;gap:0.75rem;padding-right:1rem;">
                        <a href="/dashboard" style="display:inline-flex;align-items:center;gap:0.4rem;font-family:\'JetBrains Mono\',monospace;font-size:0.62rem;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.4);border:1px solid rgba(255,255,255,0.08);padding:0.4rem 0.875rem;text-decoration:none;" onmouseover="this.style.color=\'#00ff88\';this.style.borderColor=\'rgba(0,255,136,0.3)\'" onmouseout="this.style.color=\'rgba(255,255,255,0.4)\';this.style.borderColor=\'rgba(255,255,255,0.08)\'">
                            ⬡ Dashboard
                        </a>
                        <a href="/" style="display:inline-flex;align-items:center;gap:0.4rem;font-family:\'JetBrains Mono\',monospace;font-size:0.62rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#000;background:#00ff88;padding:0.4rem 0.875rem;text-decoration:none;" onmouseover="this.style.background=\'#00ffaa\'" onmouseout="this.style.background=\'#00ff88\'">
                            ↗ View Site
                        </a>
                        <div style="width:30px;height:30px;background:rgba(0,255,136,0.1);border:1px solid rgba(0,255,136,0.2);display:flex;align-items:center;justify-content:center;font-family:\'JetBrains Mono\',monospace;font-size:0.7rem;font-weight:700;color:#00ff88;">
                            ' . $initial . '
                        </div>
                    </div>';
                }
            )
            ->renderHook(
                'panels::page.start',
                function () {
                    $hour     = now()->format('H');
                    $greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');
                    $name     = auth()->user()?->name ?? 'Admin';
                    return '
                    <div style="background:#0a1520;border:1px solid rgba(0,255,136,0.15);padding:1.25rem 2rem;margin-bottom:1.5rem;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden;">
                        <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#00ff88,#00d4ff,#a855f7);opacity:0.6;"></div>
                        <div>
                            <div style="font-family:\'JetBrains Mono\',monospace;font-size:0.58rem;color:rgba(0,255,136,0.5);letter-spacing:0.25em;text-transform:uppercase;margin-bottom:0.25rem;">// ADMIN.DASHBOARD</div>
                            <div style="font-size:1.1rem;font-weight:800;color:#fff;">' . $greeting . ', ' . $name . '</div>
                            <div style="font-size:0.75rem;color:rgba(255,255,255,0.3);margin-top:0.15rem;">' . now()->format('l, F j, Y · H:i') . ' UTC</div>
                        </div>
                        <div style="display:flex;align-items:center;gap:0.5rem;">
                            <div style="width:6px;height:6px;border-radius:50%;background:#00ff88;box-shadow:0 0 8px #00ff88;animation:pulse 2s infinite;"></div>
                            <span style="font-family:\'JetBrains Mono\',monospace;font-size:0.6rem;color:rgba(0,255,136,0.6);letter-spacing:0.15em;text-transform:uppercase;">ALL SYSTEMS OPERATIONAL</span>
                        </div>
                    </div>
                    <style>@keyframes pulse{0%,100%{opacity:1}50%{opacity:0.4}}</style>';
                }
            )
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([Authenticate::class]);
    }
}
