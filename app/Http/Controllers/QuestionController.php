<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Resend;
use GuzzleHttp\Client;

class QuestionController extends Controller
{
    public function index(){
        // Get categories for the menu manually
        $categories = \App\Models\Category::pluck('categoryName', 'categoryId')->toArray();
        return view('contact.index', compact('categories'));
    }

    public function submit(Request $request)
    {
        // Validate the question form
        $validated = $request->validate([
            'firstName' => 'required|min:2',
            'lastName'  => 'required|min:2|max:50',
            'email'     => 'required|email',
            'phone'     => [
                'nullable',
                'regex:/^\+?[0-9\s\-\(\)]{7,15}$/'
            ],
            'comments'  => 'nullable',
        ]);

    // Send the email using Resend
    try {

        $resend = Resend::client(env('RESEND_API_KEY'),);

        $resend->emails->send([
            'from' => 'onboarding@resend.dev',
            'to' => ['tom_scollay@live.com.au'],
            'subject' => 'New Registration Submission',

            'html' => "
                <h1>New Registration</h1>
                <p>
                    <strong>Name:</strong>
                    {$validated['firstName']}
                    {$validated['lastName']}
                </p>
                <p>
                    <strong>Email:</strong>
                    {$validated['email']}
                </p>
                <p>
                    <strong>Phone:</strong>
                    {$validated['phone']}
                </p>
                <p>
                    <strong>Comments:</strong>
                </p>
                <p>
                    {$validated['comments']}
                </p>
            ",
        ]);

    } catch (\Exception $e) {

        // Return with error if email fails
        return back()
            ->withErrors([
                'email' => 'Unable to send email right now.'
            ])
            ->withInput();
    }

        // Get categories again for the confirmation page
        $categories = \App\Models\Category::pluck('categoryName', 'categoryId')->toArray();
        return view('contact.confirmation', array_merge($validated, ['categories' => $categories]));
    }
}