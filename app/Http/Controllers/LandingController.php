<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function home()
    {
        $plans = config('plans');
        return view('landing.home', compact('plans'));
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

    public function blog()
    {
        // When you add a Blog model/table later, replace null with:
        // $posts = \App\Models\Post::published()->latest()->paginate(9);
        $posts = collect(); // empty for now — renders the coming soon state
        return view('landing.blog.index', compact('posts'));
    }

    public function blogPost(string $slug)
    {
        // $post = \App\Models\Post::where('slug', $slug)->firstOrFail();
        // return view('landing.blog-post', compact('post'));
        abort(404); // placeholder until posts exist
    }

    public function newsletterSubscribe(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        // TODO: integrate with Resend / Mailchimp / ConvertKit
        return back()->with('success', 'You are subscribed! We will be in touch.');
    }
}
