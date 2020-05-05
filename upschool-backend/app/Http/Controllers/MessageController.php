<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Events\MessageWasSent;
use App\Events\WebSocketDemoEvent;
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

        $conversation = Conversation::find($request->conversation_id);

        if (!$conversation) {
            $receiver = User::find($request->receiver_id);

            if (!$receiver) {
                return response()->json([
                    'status' => false,
                    'message' => 'User does not exist',
                    'data' => null
                ], 201);
            }

            $conversation = new Conversation();
            $conversation->name = $request->name;
            $conversation->save();
            $conversation->users()->attach([$sender_id, $receiver->id]);
        }

        $message = new Message();
        $message->sender_id = $sender_id;
        $message->conversation_id = $conversation->id;
        $message->body = $request->body;
        $message->save();

        broadcast(new MessageWasSent($message));
        // broadcast(new WebSocketDemoEvent('Yoooo'));

        return response()->json([
            'status' => true,
            'message' => 'Message sent successfully',
            'data' => $message
        ], 201);
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
