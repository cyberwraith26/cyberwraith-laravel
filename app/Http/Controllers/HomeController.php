<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $tools = config('tools');
        $plans = config('plans');
        return view('landing.home', compact('tools', 'plans'));
    }

    public function pricing()
    {
        $plans = config('plans');
        return view('landing.pricing', compact('plans'));
    }

    public function services()
    {
        return view('landing.services.index');
    }

    public function service(string $slug)
    {
        return view('landing.services.show', compact('slug'));
    }
}
