<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
    public function create(){
        return view('email.email');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
          'email' => 'required|email',
          'subject' => 'required',
          'name' => 'required',
          'content' => 'required',
        ]);

        $data = [
          'subject' => $request->subject,
          'name' => $request->name,
          'email' => $request->email,
          'content' => $request->content
        ];

        Mail::send('email.email-template', $data, function($message) use ($data) {
          $message->to('sabbir.saad00@gmail.com')->subject($data['subject']);
        });

        return back()->with(['message' => 'Email successfully sent!']);
    }
}
