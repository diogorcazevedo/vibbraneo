<?php

namespace App\Http\Controllers;


use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    protected $user;


    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => ['show']]);
        $this->middleware('auth:api');
    }

    public function show($id)
    {
        $user= User::where('id',$id)->with('bids','location','deals','messages')->first();
        return response()->json([
            'user'  =>$user,
        ]);

    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user->with('location'),
            'token'=>$token,
            'token_type'=>'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);

        $user = User::find($id);
        $user->name     = $request->input('name');
        $user->email    = $request->input('email');
        $user->save();

        return response()->json([
            'status'    => 'success',
            'message'   => 'Register updated successfully',
            'user'      => $user->load(['location']),
        ]);
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|max:255',
        ]);

        $user = User::find($id);
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully',
            'user' => $user,
        ]);
    }
    public function updateLocation(Request $request, $id)
    {
        $request->validate([
            'zip_code'  => 'required|integer',
            'state'     => 'required|string|max:2',
            'city'      => 'required|string|max:191',
            'address'   => 'required|string|max:191',
        ]);

        $location = Location::where('user_id',$id)->first();
        $location->zip_code         = $request->input('zip_code');
        $location->state            = $request->input('state');
        $location->city             = $request->input('city');
        $location->address          = $request->input('address');
        $location->save();

        $user = User::find($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Address updated successfully',
            'user' => $user,
        ]);
    }
}
