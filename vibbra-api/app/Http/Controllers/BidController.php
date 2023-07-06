<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Deal;
use Illuminate\Http\Request;


class BidController extends Controller
{

    public function getAllFromDeal($id)
    {
        $bids = Bid::where('deal_id',$id)->with('user')->with('deal')->get();
        return response()->json([
            'bids'  =>$bids,
        ]);

    }
    public function getAllFromUser($id)
    {
        $bids = Bid::where('user_id',$id)
                    ->with('user')
                    ->with(['deal' => function ($q) {
                        $q->with('user');
                    }])
                    ->get();
        return response()->json([
            'bids'  =>$bids,
        ]);

    }
    public function getById($id)
    {
        $bid = Bid::where('id',$id)->with('user')->with('deal')->first();
        return response()->json([
            'bid'  =>$bid,
        ]);

    }

    public function store(Request $request, $deal_id,$user_id)
    {
        $request->validate([
            'accepted'      => 'required|string',
            'value'         => 'required|max:255',
           // 'description'   => 'required|string|max:255',
        ]);

        $v1 =  str_replace('.', '', $request->input('value'));
        $value =  str_replace(',', '.', $v1);

        $bid                    = new Bid;
        $bid->deal_id           = $deal_id;
        $bid->user_id           = $user_id;
        $bid->accepted          = $request->input('accepted');
        $bid->value             = $value;
        $bid->description       = $request->input('description');
        $bid->save();

        return response()->json([
            'status'    => 'success',
            'message'   => 'Register updated successfully',
            'bid'       => $bid->load(['user','deal']),
        ]);
    }
    public function accepted(Request $request, $bid_id)
    {
        $request->validate([
            'accepted'      => 'required|string',
        ]);

        $bid                    = Bid::find($bid_id);
        $bid->accepted          = $request->input('accepted');
        $bid->save();

        $deal                   = Deal::find($bid->deal_id);
        $deal->accepted         = $request->input('accepted');
        $deal->save();


        return response()->json([
            'status'    => 'success',
            'message'   => 'Register updated successfully',
            'bid'       => $bid->load(['user','deal']),
        ]);
    }
}
