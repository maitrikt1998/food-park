<?php

namespace App\Http\Controllers\Frontend;

use App\Events\ChatEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use Auth;
use Illuminate\Http\Response;

class ChatController extends Controller
{
    //
    function sendMessage(Request $request)
    {
        $request->validate([
            'message' => ['required', 'max:1000'],
            'receiver_id' => ['required', 'integer']
        ]);

        $chat = new Chat();
        $chat->sender_id = Auth::user()->id;
        $chat->receiver_id = $request->receiver_id;
        $chat->message = $request->message;
        $chat->save();

        $avatar = asset(auth()->user()->avatar);
        $senderId = Auth::user()->id;
        broadcast(new ChatEvent($request->message, $avatar, $request->receiver_id, $senderId))->toOthers();

        return response(['status' => 'success', 'MsgId' => $request->msg_temp_id], 200);
    }

    function getConversation(string $senderId) : Response
    {
        $receiverId = auth()->user()->id;

        $messages = Chat::whereIn('sender_id',[$senderId, $receiverId])
            ->with(['sender'])
            ->whereIn('receiver_id', [$senderId, $receiverId])
            ->orderBy('created_at','asc')
            ->get();

        Chat::where('sender_id', $senderId)->where('receiver_id',$receiverId)
            ->where('seen' , 0) -> update(['seen' => 1]);
        return response($messages);
    }
}
