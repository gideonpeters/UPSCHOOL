<?php

namespace App\Http\Controllers;

use App\Mail\TestedMail;
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

        Mail::to('gideonpeters85@gmail.com')->send(new TestedMail($title, $content));


        return new TestedMail($title, $content);
    }
}
