<?php

namespace App\Http\Controllers\Frontend\Pages;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:newsletters,email'],
        ]);

        if (Newsletter::where('email', $request->email)->exists()) {
            throw ValidationException::withMessages([
                'email' => 'This email is already subscribed.'
            ]);
        }

        Newsletter::create([
            'email' => $request->email,
            'is_verified' => false
        ]);

        return response()->json(['message' => 'Subscribed successfully.']);
    }
}
