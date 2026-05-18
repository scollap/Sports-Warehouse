<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Resend;
use GuzzleHttp\Client;

class QuestionController extends Controller
{
     
    private $categories = [
        1 => 'Shoes',
        2 => 'Helmets',
        3 => 'Pants',
        4 => 'Tops',
        5 => 'Balls',
        6 => 'Equipment',
        7 => 'Training gear',
    ];



    public function index(){
    return view('register', [
        'categories' => $this->categories,
    ]);
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

    //send email
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

        // dd($e->getMessage()); //just to debug and see the error

        return back()
            ->withErrors([
                'email' => 'Unable to send email right now.'
            ])
            ->withInput();
    }

        return view('registerConfirmation', array_merge(
            $validated,
            ['categories' => $this->categories]
        ));
    }
}