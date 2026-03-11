<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'type' => 'required|in:saas,consult,security,dev',
            'message' => 'required|string|min:10|max:2000',
        ]);

        ContactSubmission::create($validated);

        return back()->with('success', 'Message sent successfully. We will respond within 24 hours.');
    }
}
