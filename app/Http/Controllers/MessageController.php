<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewMessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(NewMessageRequest $request, $discussion_id){
        Message::create([
            'content' => $request->message,
            'sender_id' => auth()->id(),
            'receiver_id' => ($request->receiver) ?? NULL,
            'discussion_id' => $discussion_id
        ]);
        return redirect()->back()->with('success', "You've entered the discussion");
    }
}
