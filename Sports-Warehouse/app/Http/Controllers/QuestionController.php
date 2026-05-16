<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function submit(Request $request)
    {
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

        // send email

        return view('registerConfirmation');
    }
}