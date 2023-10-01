<?php

namespace App\Http\Controllers;

use App\Mail\BookRequestStatusMail;
use App\Models\Book;
use App\Models\RequestedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RequestBookController extends Controller
{
    //admin
    public function index()
    {
        $requestedBooks = RequestedBook::orderBy('created_at', 'DESC')->get();

        return view('Admin.RequestedBooks.requested-books', [
            'requestedBooks' => $requestedBooks
        ]);
    }

    //user

    public function user_index()
    {
        $authUser = Auth::user();
        $requestedBooks = RequestedBook::where('user_id', $authUser->id)
        ->orderBy('created_at', 'DESC')->get();

        return view('User.RequestedBooks.requested-books', [
            'requestedBooks' => $requestedBooks
        ]);
    }

    public function requestABook(Request $request)
    {
        $authUser = Auth::user();

        $image = $request->file('book_cover');

        $newBookCover = time().'.'. $image->getClientOriginalExtension();
        
        $imageFullPath = $image->storeAs('images', $newBookCover, 'public');

        $imageURLPath = asset('storage/' . $imageFullPath);

        $requestedBook = RequestedBook::create([
            'user_id' => $authUser->id,
            'book_name' => $request->input('book_name'),
            'book_author' => $request->input('book_author'),
            'book_cover' => $imageURLPath,
            'status' => 'PENDING'
        ]);
        
        Mail::to($authUser->email)->send(new BookRequestStatusMail($requestedBook, $authUser));

        return redirect()->route('user.book.index');
    }

    public function approveOrDisapprove(Request $request)
    {
        $status = $request->input('status');
        $id = $request->input('id');
        $stocks = $request->input('stocks');
        $reason = $request->input('reason');

        $requestedBook = RequestedBook::where('id', $id)->first();

        if (! $requestedBook) {
            return response()->json([
                'error' => 'Book does not exist'
            ], 404);
        }

        $requestedBook->update([
            'status' => $status
        ]);

        if ($requestedBook->status == 'APPROVED') {
            Book::create([
                'book_name' => $requestedBook->book_name,
                'book_author' => $requestedBook->book_author,
                'book_cover' => $requestedBook->book_cover,
                'stocks' => $stocks
            ]);
        } else {
            $requestedBook->update([
                'reason' => $reason
            ]);
        }

        Mail::to($requestedBook->user->email)->send(new BookRequestStatusMail($requestedBook, $requestedBook->user));

        return redirect()->route('admin.book.index');
    }
}
