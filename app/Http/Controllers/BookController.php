<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Csv\Writer;

class BookController extends Controller 
{
    public function index() {
        $books = Book::all();

        return view('Admin.Books.books', [
            'books' => $books
        ]);
    }

    public function store(Request $request) {

        $book = new Book();
        $name = $request->input('book_name');
        $author = $request->input('book_author');
        $cover = $request->input('book_cover');
        $stock = $request->input('stock');
        
        $checkBook = $book
        ->where('book_name', $name)
        ->where('book_author', $author)
        ->exists();

        if($checkBook) {
            return response()->json([
                'error' => 'Both book and author already exists!'
            ]);
        }

        Book::create([
            'book_name' => $name,
            'book_author' => $author,
            'book_cover' => $cover,
            'stock' => $stock,
        ]);
    }

    public function update(Request $request) {
        $book = Book::where('id', $request->input('id'))->first();

        if (! $book) {
            return response()->json([
                'error' => 'Book not found!'
            ]);
        }

        $book->update([
            'book_name' => $request->input('book_name') ?? $book->book_name,
            'book_author' => $request->input('book_author') ?? $book->book_author,
            'book_cover' => $request->input('book_cover') ?? $book->book_cover,
            'stock' => $request->input('stock') ?? $book->stock,
        ]);
    }

    public function delete(Request $request) {
        $book = Book::where('id', $request->input('book_id'))->first();

        if (! $book) {
            return response()->json([
                'error' => 'Book not found!'
            ]);
        }

        $book->delete();
    }

    public function import(Request $request) {
        if ($request->hasFile('csv_file')) {
            $path = $request->file('csv_file')->getRealPath();
            $data = array_map('str_getcsv', file($path));

            foreach ($data as $row) {
                Book::create([
                    'book_name' => $row[0],
                    'book_author' => $row[1],
                    'book_cover' => $row[2],
                ]);
            }
    
            return redirect()->back();
        }
    }

    public function export()
    {
        $data = Book::all();

        $csv = Writer::createFromString('');

        $csv->insertOne(['Book Name', 'Author', 'Cover', 'Stock']);

        foreach ($data as $row) {
            $csv->insertOne([$row->book_name, $row->book_author, $row->book_cover, $row->stock]);
        }

        $filename = 'exported_book.csv';

        return Response::make($csv->__toString(), 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
