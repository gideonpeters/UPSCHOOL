<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Message;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
        $sender_id = auth()->user()->id;
        $receiver = User::find($request->receiver_id);

        if (!$receiver) {
            return response()->json([
                'status' => true,
                'message' => 'User does not exist',
                'data' => null
            ], 201);
        }

        $conversation = Conversation::whereSenderId($sender_id)->whereReceiverId($request->receiver_id)->first();

        if (!$conversation) {
            $conversation = new Conversation();
            $conversation->sender_id = $sender_id;
            $conversation->receiver_id = $receiver->id;
            $conversation->save();
        }
        $message = new Message();
        $message->sender_id = $sender_id;
        // $message->
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
