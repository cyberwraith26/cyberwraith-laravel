<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $email = strtolower(trim($request->email));

        // Prevent duplicate subscriptions silently
        $exists = DB::table('newsletter_subscribers')
            ->where('email', $email)
            ->exists();

        if (!$exists) {
            DB::table('newsletter_subscribers')->insert([
                'email'      => $email,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with('newsletter_success', 'You\'re subscribed! We\'ll be in touch.');
    }
}
