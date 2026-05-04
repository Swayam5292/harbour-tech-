<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        // Here you would typically send an email or save to DB
        // For now, we'll just return a success response as per the original requirement
        
        return response()->json([
            'success' => true,
            'message' => 'Thank you for your message! We will get back to you shortly.'
        ]);
    }
}
