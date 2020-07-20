<?php

use App\Broadcasting\ConversationChannel;
use App\Conversation;
use App\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    // dd($user, $id);
    return (int) $user->id === (int) $id;
    // return true;
});

Broadcast::channel('chat', function () {
    return true;
});

// Broadcast::channel('conversations.{conversation}', function(){
//     return true;
// });
Broadcast::channel('conversations.{conversation}', ConversationChannel::class);
