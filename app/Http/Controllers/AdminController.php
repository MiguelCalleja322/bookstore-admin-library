<?php

namespace App\Http\Controllers;

use App\Mail\UserAddedMail;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class AdminController extends Controller
{

    public function index()
    {
        $role = Role::where('name', 'user')->first();
        $userRoles = UserRole::where('role_id', $role->id)->get();
        // $users = User::whereHas(['userRole' => function ($userRole) {
        //     $userRole->whereHas(['role' => function ($role) {
        //         $role->where('name', '!=', 'admin');
        //     }]);
        // }]);

        return view('Admin.User.users', [
            'userRoles' => $userRoles
        ]);
    }

    public function store(Request $request)
    {
        $email = $request->input('email');
        $username = $request->input('username');
        $newProfilePic = null;
        $user = User::where('email', $email)->orWhere('username', $username)->first();

        if ($user) {
            return response()->json([
                'error' => 'Either email or username exists'
            ], 403);
        }

        $image = $request->file('profile_pic');

        $newProfilePicName = time().'.'. $image->getClientOriginalExtension();
        
        $imageFullPath = $image->storeAs('images', $newProfilePicName, 'public');

        $imageURLPath = asset('storage/' . $imageFullPath);
        
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $email,
            'username' => $username,
            'password' => Hash::make($request->input('password')),
            'profile_pic' => $imageURLPath
        ]);
        
        UserRole::create([
            'user_id' => $user->id,
            'role_id' => 2
        ]);

        Mail::to($user->email)->send(new UserAddedMail($user));

        return self::index();
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $email = $request->input('email');
        $username = $request->input('username');

        $user = User::where('id', $id)->first();

        if (! $user) {
            return response()->json([
                'error' => 'User does not exist'
            ], 404);
        }

        $image = $request->file('profile_pic');

        if($image) {
            $newProfilePicName = time().'.'. $image->getClientOriginalExtension();
        
            $imageFullPath = $image->storeAs('images', $newProfilePicName, 'public');

            $imageURLPath = asset('storage/' . $imageFullPath);
        }
      
        $user->update([
            'name' => $request->input('name'),
            'email' => $email,
            'username' => $username,
            'password' => Hash::make($request->input('password')),
            'profile_pic' => $imageURLPath ?? $user->profile_pic
        ]);

        return self::index();
    }

    public function delete(Request $request)
    {
        $user = User::where('id', $request->input('user_id'))->first();

        if (! $user) {
            return response()->json([
                'error' => 'User does not exist'
            ], 404);
        }

        $user->delete();
    }
}
