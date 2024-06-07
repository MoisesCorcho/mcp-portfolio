<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request) {


        $validated = $request->validate([
            'name'    => 'required',
            'email'   => ['email', 'required'],
            'body'    => 'required'
        ]);

        //Send Email
        Mail::to('mcorchoperez@gmail.com')
            ->send(new ContactMail(
                $validated['name'],
                $validated['email'],
                $validated['body'])
            );

        return ['success' => true];

    }
}
