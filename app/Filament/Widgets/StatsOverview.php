<?php

namespace App\Filament\Widgets;

use App\Models\ContactSubmission;
use App\Models\ToolUsage;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalUsers     = User::count();
        $newThisWeek    = User::where('created_at', '>=', now()->subWeek())->count();
        $payingUsers    = User::whereIn('tier', ['pro', 'agency'])->count();
        $freeUsers      = User::where('tier', 'free')->count();
        $agencyUsers    = User::where('tier', 'agency')->count();
        $proUsers       = User::where('tier', 'pro')->count();
        $unread         = ContactSubmission::where('status', 'unread')->count();
        $totalMessages  = ContactSubmission::count();
        $toolLaunches   = ToolUsage::count();
        $todayLaunches  = ToolUsage::where('created_at', '>=', now()->startOfDay())->count();
        $revenue        = ($proUsers * 49) + ($agencyUsers * 129);

        return [
            Stat::make('Total Users', $totalUsers)
                ->description("+{$newThisWeek} this week")
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([
                    User::where('created_at', '>=', now()->subDays(6)->startOfDay())->whereDate('created_at', now()->subDays(6))->count(),
                    User::where('created_at', '>=', now()->subDays(5)->startOfDay())->whereDate('created_at', now()->subDays(5))->count(),
                    User::where('created_at', '>=', now()->subDays(4)->startOfDay())->whereDate('created_at', now()->subDays(4))->count(),
                    User::where('created_at', '>=', now()->subDays(3)->startOfDay())->whereDate('created_at', now()->subDays(3))->count(),
                    User::where('created_at', '>=', now()->subDays(2)->startOfDay())->whereDate('created_at', now()->subDays(2))->count(),
                    User::where('created_at', '>=', now()->subDays(1)->startOfDay())->whereDate('created_at', now()->subDays(1))->count(),
                    User::whereDate('created_at', today())->count(),
                ]),

            Stat::make('Monthly Revenue (Est.)', '$' . number_format($revenue))
                ->description("Pro: {$proUsers} · Agency: {$agencyUsers}")
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),

            Stat::make('Paying Subscribers', $payingUsers)
                ->description("{$freeUsers} on free plan")
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),

            Stat::make('Unread Messages', $unread)
                ->description("{$totalMessages} total submissions")
                ->descriptionIcon('heroicon-m-envelope')
                ->color($unread > 0 ? 'danger' : 'success'),

            Stat::make('Tool Launches', $toolLaunches)
                ->description("{$todayLaunches} today")
                ->descriptionIcon('heroicon-m-rocket-launch')
                ->color('success'),

            Stat::make('Conversion Rate',
                $totalUsers > 0 ? round(($payingUsers / $totalUsers) * 100, 1) . '%' : '0%'
            )
                ->description('Free → Paid')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('warning'),
        ];
    }
}
