<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //
    public function send(Request $request)
    {
        //Logic will go here
        $title = $request->input('title');
        $content = $request->input('content');

        Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message) {

            $message->from('admin@upschool.com', 'UPSCHOOL Admin');

            $message->to('gideonpeters85@gmail.com');
        });


        return response()->json(['message' => 'Request completed']);
    }
}
