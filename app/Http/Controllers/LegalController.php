<?php

namespace App\Http\Controllers;

class LegalController extends Controller
{
    public function privacy()
    {
        return view('landing.legal.privacy');
    }

    public function terms()
    {
        return view('landing.legal.terms');
    }

    public function cookies()
    {
        return view('landing.legal.cookies');
    }
}
