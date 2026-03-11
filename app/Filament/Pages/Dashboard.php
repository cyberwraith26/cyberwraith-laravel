<?php

namespace App\Filament\Pages;

use App\Models\ContactSubmission;
use App\Models\ToolUsage;
use App\Models\User;
use Filament\Pages\Page;
use Filament\Actions\Action;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Command Center';
    protected static ?int $navigationSort = 0;
    protected static string $view = 'filament.pages.dashboard';

    public function getTitle(): string
    {
        return 'Command Center';
    }

    public function getViewData(): array
    {
        $totalUsers    = User::count();
        $newToday      = User::whereDate('created_at', today())->count();
        $newThisWeek   = User::where('created_at', '>=', now()->subWeek())->count();
        $proUsers      = User::where('tier', 'pro')->count();
        $agencyUsers   = User::where('tier', 'agency')->count();
        $freeUsers     = User::where('tier', 'free')->count();
        $payingUsers   = $proUsers + $agencyUsers;
        $revenue       = ($proUsers * 49) + ($agencyUsers * 129);
        $unread        = ContactSubmission::where('status', 'unread')->count();
        $totalMessages = ContactSubmission::count();
        $toolLaunches  = ToolUsage::count();
        $todayLaunches = ToolUsage::whereDate('created_at', today())->count();
        $convRate      = $totalUsers > 0 ? round(($payingUsers / $totalUsers) * 100, 1) : 0;

        $recentUsers   = User::latest()->take(6)->get();
        $recentMessages = ContactSubmission::latest()->take(5)->get();

        $toolStats = collect(config('tools'))->map(function ($tool) {
            return [
                'tool'    => $tool,
                'count'   => ToolUsage::where('tool_slug', $tool['slug'])->count(),
            ];
        })->sortByDesc('count');

        $usersByTier = [
            ['label' => 'Free',   'count' => $freeUsers,   'color' => '#4b5563', 'pct' => $totalUsers > 0 ? round($freeUsers / $totalUsers * 100) : 0],
            ['label' => 'Pro',    'count' => $proUsers,    'color' => '#f59e0b', 'pct' => $totalUsers > 0 ? round($proUsers / $totalUsers * 100) : 0],
            ['label' => 'Agency', 'count' => $agencyUsers, 'color' => '#00ff88', 'pct' => $totalUsers > 0 ? round($agencyUsers / $totalUsers * 100) : 0],
        ];

        return compact(
            'totalUsers', 'newToday', 'newThisWeek', 'proUsers', 'agencyUsers',
            'freeUsers', 'payingUsers', 'revenue', 'unread', 'totalMessages',
            'toolLaunches', 'todayLaunches', 'convRate', 'recentUsers',
            'recentMessages', 'toolStats', 'usersByTier'
        );
    }
}
