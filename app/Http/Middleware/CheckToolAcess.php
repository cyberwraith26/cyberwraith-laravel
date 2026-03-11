<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckToolAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $slug = $request->route('slug');
        if (!$slug || !$user) return $next($request);

        $tool = collect(config('tools'))->firstWhere('slug', $slug);
        if (!$tool) abort(404);

        if ($user->tier === 'agency') return $next($request);

        if (!$user->hasToolAccess($slug)) {
            $selectedCount = count($user->selected_tools ?? []);
            $allowedCount  = config('plans.' . $user->tier . '.tools', 4);
            $message = $selectedCount < $allowedCount
                ? 'Add "' . $tool['name'] . '" to your selected tools.'
                : 'All ' . $allowedCount . ' slots used. Swap a tool to access "' . $tool['name'] . '".';
            return redirect()->route('tools.select')->with('info', $message);
        }

        return $next($request);
    }
}
