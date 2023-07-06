<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class InviteController extends Controller
{
    public function show($id)
    {
        $invite = Invite::where('id',$id)->with('host','guest')->first();
        return response()->json([
            'invite'  =>$invite,
        ]);

    }
    public function getAllFromUser($id)
    {
        $invites = Invite::where('user_invited',$id)->with('host','guest')->get();
        return response()->json([
            'invites'  =>$invites,
        ]);

    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'user_invited' => 'required',
        ]);

        $user             = new User;
        $user->name       = $request->input('name');
        $user->email      = $request->input('email');
        $user->password   = Hash::make(123456);
        $user->save();

        //$token = Auth::login($user);

        $invite                 = new Invite;
        $invite->user_id        = $user->id;
        $invite->user_invited   = $request->input('user_invited');
        $invite->name           = $request->input('name');
        $invite->email          = $request->input('email');


        $invite->save();


        return response()->json([
            'status' => 'success',
            'message' => 'created successfully',
            'invite' => $invite,
        ]);
    }

    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required|string|max:255',
            'user_invited' => 'required',
            'user_id' => 'required',
        ]);




        $invite                 = Invite::find($id);
        $invite->user_id        = $request->input('user_id');
        $invite->user_invited   = $request->input('user_invited');
        $invite->name           = $request->input('name');
        $invite->save();

        $user                   = User::find($request->input('user_id'));;
        $user->name             = $request->input('name');
        $user->save();

        //$token = Auth::login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'created successfully',
            'invite' => $invite,
        ]);
    }

}
