<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller 
{
    public function index(){
        return view('Auth.login');
    }

    public function login(LoginRequest $request)
    {

        $username = $request->input('username');

        $user = User::where('username', $username)
        ->orWhere('email', $username)->exists();

        if(! $user) {
            return response()->json([
                'error' => 'Email or username is not associated to any user.'
            ], 404);
        }

        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials)):
            return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        if($user->userRole->role->name == 'admin') {
            return redirect()->route('admin.book.index');
        }else{
            return redirect()->route('user.book.index');
        }
    }

    public function logout()
    {
        if(Auth::check()) {
            Session::flush();
        
            Auth::logout();

            return redirect()->route('auth.index');
        }
    }
}