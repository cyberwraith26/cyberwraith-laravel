<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tools = collect(config('tools'));
        $plans = config('plans');

        $accessibleTools = $tools->filter(function ($tool) use ($user) {
            return $user->hasToolAccess($tool['slug']);
        });

        $recentUsages = $user->toolUsages()
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'user',
            'tools',
            'accessibleTools',
            'recentUsages',
            'plans'
        ));
    }
}
