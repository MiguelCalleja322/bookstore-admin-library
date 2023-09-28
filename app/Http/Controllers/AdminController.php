<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index() {
        $user = User::whereHas(['userRole' => function ($userRole) {
            $userRole->whereHas(['role' => function ($role) {
                $role->where('name', '!=', 'admin');
            }]);
        }]); 

        //return view here
    }

    public function store(Request $request) {
        $email = $request->input('email');
        $username = $request->input('username');

        $user = User::where('email', $email)->orWhere('username', $username)->first();

        if ($user) {
            return response()->json([
                'error' => 'Either email or username exists'
            ], 403);
        }

        $profilePic = time().'.'.$request->profile_pic->getClientOriginalExtension();
        $request->profile_pic->move(public_path('profile_pic'), $profilePic);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $email,
            'username' => $username,
            'password' => Hash::make($request->input('password')),
            'profile_pic' => $profilePic
        ]);
    }

    public function update(Request $request) {
        $id = $request->input('id');
        $email = $request->input('email');
        $username = $request->input('username');

        $user = User::where('id', $id)->first();

        if (! $user) {
            return response()->json([
                'error' => 'User does not exist'
            ], 404);
        }

        $profilePic = time().'.'.$request->profile_pic->getClientOriginalExtension();
        $request->profile_pic->move(public_path('profile_pic'), $profilePic);

        $user->update([
            'name' => $request->input('name'),
            'email' => $email,
            'username' => $username,
            'password' => Hash::make($request->input('password')),
            'profile_pic' => $profilePic
        ]);
    }   
}
