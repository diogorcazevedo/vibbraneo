<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Deal;
use App\Models\Message;
use App\Models\Messages;
use Illuminate\Http\Request;


class MessageController extends Controller
{
    public function getAllFromDeal($id)
    {
        $messages = Message::where('deal_id',$id)->with('user','deal')->get();
        return response()->json([
            'messages'  =>$messages,
        ]);

    }

    public function getAllFromDealAndUser($deal,$user)
    {
        $messages = Message::where('deal_id',$deal)->where('user_id',$user)->with('user','deal')->get();
        return response()->json([
            'messages'  =>$messages,
        ]);

    }

    public function getById($id)
    {
        $message = Message::where('id',$id)->with('user','deal')->first();
        return response()->json([
            'message'  =>$message,
        ]);

    }

    public function store(Request $request, $deal_id,$user_id)
    {
        $request->validate([
            'deal_id'      => 'required',
            'user_id'      => 'required',
            'title'        => 'required|max:255',
        ]);


        $message                = new Message;
        $message->deal_id       = $deal_id;
        $message->user_id       = $user_id;
        $message->title         = $request->input('title');
        $message->message       = null;
        $message->save();

        return response()->json([
            'status'    => 'success',
            'message'   => 'Register updated successfully',
            'msn'       => $message->load(['user','deal']),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'message_id'      => 'required',
            'message'        => 'required|max:255',
        ]);


        $msn                  = Message::find($id);
        $msn->message          = $request->input('message');
        $msn->save();

        return response()->json([
            'status'    => 'success',
            'message'   => 'Register updated successfully',
            'msn'       => $msn->load(['user','deal']),
        ]);
    }
}
