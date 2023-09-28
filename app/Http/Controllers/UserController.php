<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowedBook;
use App\Models\Favorite;
use App\Models\RequestedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        $books = Book::where('stocks', '!=', '0')->get();
        
        return view('User.Books.books', [
            'books' => $books,
        ]);
    }

    public function borrow(Request $request) {
        $authUser = Auth::user();
        $id = $request->input('id');

        $borrowed = BorrowedBook::where('book_id', $id)->first();

        if($borrowed) {
            return response()->json([
                'error' => 'Book already Borrowed'
            ], 403);
        }

        $book = Book::where('id', $id)->first();

        if(!$book) {
            return response()->json([
                'error' => 'Book not found'
            ], 404);
        }

        $stocks = intval($book->stocks) - 1;
 
        BorrowedBook::create([
            'user_id' => $authUser->id,
            'book_id' => $book->id
        ]);

        $book->update([
            'stocks' => $stocks,
        ]);
    }

    public function addToFavorite(Request $request) {
        $authUser = Auth::user();

        $id = $request->input('id');
        
        $favorite = Favorite::where('book_id', $id)->first();

        if($favorite) {
            return response()->json([
                'error' => 'Book already added to favorite'
            ], 403);
        }

        $book = Book::where('id', $id)->first();

        if(!$book) {
            return response()->json([
                'error' => 'Book not found'
            ], 404);
        }

        Favorite::create([
            'user_id' => $authUser->id,
            'book_id' => $book->id
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
}
