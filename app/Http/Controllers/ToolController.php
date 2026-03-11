<?php

namespace App\Http\Controllers;

use App\Models\ToolUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToolController extends Controller
{
    public function index()
    {
        $user         = Auth::user();
        $tools        = collect(config('tools'));
        $allowedCount = config('plans.' . $user->tier . '.tools', 4);
        return view('dashboard.tools.index', compact('user', 'tools', 'allowedCount'));
    }

    public function show(string $slug)
    {
        $user = Auth::user();
        $tool = collect(config('tools'))->firstWhere('slug', $slug);
        if (!$tool) abort(404);

        if (!$user->hasToolAccess($slug)) {
            $selectedCount = count($user->selected_tools ?? []);
            $allowedCount  = config('plans.' . $user->tier . '.tools', 4);
            $message = $selectedCount < $allowedCount
                ? 'Add "' . $tool['name'] . '" to your selected tools to access it.'
                : 'You have used all ' . $allowedCount . ' tool slots. Your selection is locked.';
            return redirect()->route('tools.select')->with('info', $message);
        }

        ToolUsage::create(['user_id' => $user->id, 'tool_slug' => $slug, 'action' => 'open']);
        return view('dashboard.tools.show', compact('user', 'tool'));
    }

    public function select()
    {
        $user         = Auth::user();
        $allTools     = collect(config('tools'));
        $allowedCount = config('plans.' . $user->tier . '.tools', 4);
        $selected     = $user->selected_tools ?? [];
        $isLocked     = $this->isSelectionLocked($user, $allowedCount, $selected);
        $tags         = $allTools->pluck('tag')->unique()->sort()->values();

        return view('dashboard.tools.select', compact('user', 'allTools', 'allowedCount', 'selected', 'tags', 'isLocked'));
    }

    public function saveSelection(Request $request)
    {
        $user         = Auth::user();
        $allowedCount = config('plans.' . $user->tier . '.tools', 4);

        if ($user->tier === 'agency') {
            return redirect()->route('tools.index')->with('success', 'You have access to all tools.');
        }

        $existing = $user->selected_tools ?? [];

        if ($this->isSelectionLocked($user, $allowedCount, $existing)) {
            return redirect()->route('tools.select')
                ->with('error', 'Your tool selection is locked. Upgrade your plan to make changes.');
        }

        $selected = collect($request->input('tools', []))
            ->unique()
            ->take($allowedCount)
            ->values()
            ->toArray();

        $user->update(['selected_tools' => $selected]);

        $filled = count($selected) >= $allowedCount;

        return redirect()->route('tools.index')
            ->with('success', $filled
                ? 'Tools saved and selection is now locked. Upgrade to change your tools.'
                : 'Tools saved. You have ' . ($allowedCount - count($selected)) . ' slot(s) remaining.'
            );
    }

    private function isSelectionLocked($user, int $allowedCount, array $selected): bool
    {
        if ($user->tier === 'agency') return false;
        return count($selected) >= $allowedCount;
    }
}
