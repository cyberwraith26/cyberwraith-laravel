<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;

class PortfolioController extends Controller
{
    public function index()
    {
        return view('landing.portfolio.index');
    }

    public function show(string $slug)
    {
        $study = CaseStudy::published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('landing.portfolio.show', compact('study'));
    }
}
