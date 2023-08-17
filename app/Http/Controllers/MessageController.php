<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewMessageRequest;
use App\Models\Message;
use App\Models\Chapter;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function store(NewMessageRequest $request, $discussion_id){
        Message::create([
            'content' => $request->message,
            'sender_id' => auth()->id(),
            'receiver_id' => ($request->receiver) ?? NULL,
            'discussion_id' => $discussion_id
        ]);
        // Increment the number of discussions_involved (Messages Sent)
        $chapter = Chapter::findOrFail(Discussion::findOrFail($discussion_id)->chapter_id);
        auth()->user()->coursesEnrolled()->updateExistingPivot($chapter->course_id, ['discussions_involved' => DB::raw('discussions_involved + 1')]);
        return redirect()->back()->with('success', __('success.message_inserted'));
    }

    public function destroy($id){
        $message = Message::findOrFail($id);
        $chapter = Chapter::findOrFail(Discussion::findOrFail($message->discussion_id)->chapter_id);
        auth()->user()->coursesEnrolled()->updateExistingPivot($chapter->course_id, ['discussions_involved' => DB::raw('discussions_involved - 1')]);
        Message::destroy($id);
        return redirect()->back()->with('success', __('success.message_deleted'));
    }
}
