<?php

namespace App\Http\Controllers;

use App\Models\RequestedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestBookController extends Controller 
{
    //admin
    public function index() {
        $requestedBooks = RequestedBook::orderBy('created_at', 'DESC')->get();

        return view('Admin.RequestedBooks.requested-books', [
            'requestedBooks' => $requestedBooks
        ]);
    }

    //user



    public function user_index() {
        $authUser = Auth::user();
        $requestedBooks = RequestedBook::where('user_id', $authUser->id)
        ->orderBy('created_at', 'DESC')->get();

        return view('User.RequestedBooks.requested-books', [
            'requestedBooks' => $requestedBooks
        ]);
    }

    public function requestABook(Request $request) {
        $authUser = Auth::user();

        RequestedBook::create([
            'user_id' => $authUser->id,
            'book_name' => $request->input('book_name'),
            'book_author' => $request->input('book_author')
        ]);
    }

    public function approveOrDisapprove(Request $request) {

        
        $status = $request->input('status');
        $id = $request->input('id');

        $requestedBook = RequestedBook::where('id', $id)->first();

        if (! $requestedBook) {
            return response()->json([
                'error' => 'Book does not exist'
            ], 404);
        }

        $requestedBook->update([
            'status' => $status
        ]);

        self::index();
    }
}
