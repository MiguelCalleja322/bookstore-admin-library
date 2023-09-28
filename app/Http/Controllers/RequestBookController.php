<?php

namespace App\Http\Controllers;

use App\Models\RequestedBook;
use Illuminate\Support\Facades\Auth;

class RequestBookController extends Controller 
{
    public function index() {
        $authUser = Auth::user();
        $requestedBooks = RequestedBook::where('user_id', $authUser->id)
        ->orderBy('created_at', 'DESC')->get();

        return view('User.RequestedBooks.requested-books', [
            'requestedBooks' => $requestedBooks
        ]);
    }
}
