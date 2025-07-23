<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->take(5)->get();
        return view('review/index', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Review::create([
            'email' => auth()->user()->email,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Review submitted!');
    }
}
