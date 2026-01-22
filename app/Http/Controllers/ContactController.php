<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    /**
     * Show the contact form
     */
    public function create()
    {
        return view('pages.contact');
    }

    /**
     * Store the contact form submission
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        try {
            // Send email notification (optional)
            // Mail::to(config('mail.from.address'))->send(new ContactMail($validated));

            // You can also save to database here if needed
            // ContactSubmission::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message. We will get back to you soon!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request.'
            ], 500);
        }
    }
}
