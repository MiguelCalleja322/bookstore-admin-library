<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller 
{
    public function index() {
        $authUser = Auth::user();
        $favorites = Favorite::where('user_id', $authUser->id)
        ->orderBy('created_at', 'DESC')->get();

        return view('User.Favorites.favorites', [
            'favorites' => $favorites
        ]);
    }
}
