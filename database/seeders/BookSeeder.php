<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        $rawBookLists = '[
            { "name": "Harry Potter - Prisoner of Azkaban", "author": "JK Rowling", "cover": "https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1630547330i/5.jpg"},
            { "name": "Harry Potter - Deathly Hallows Part 1", "author": "JK Rowling", "cover": "https://cdn.kobo.com/book-images/e4c269f5-2af6-4a33-8069-8e21d7395de1/1200/1200/False/harry-potter-and-the-deathly-hallows-3.jpg"},
            { "name": "Harry Potter - Deathly Hallows Part 2", "author": "JK Rowling", "cover": "https://ph-test-11.slatic.net/p/fe3581062eaab5f5dc1ae01d888c3456.jpg"},
            { "name": "Harry Potter - Philosophers Stone", "author": "JK Rowling", "cover": "https://cdn.kobo.com/book-images/e2d594d6-a7e2-4caa-8644-52ba74ea1cca/1200/1200/False/harry-potter-and-the-sorcerer-s-stone-3.jpg"},
            { "name": "Harry Potter - Chamber of Secrets", "author": "JK Rowling", "cover": "https://static.wikia.nocookie.net/harrypotter/images/6/6d/Chamber_of_Secrets_New_UK_Cover.jpg/revision/latest?cb=20170109045927"}
        ]';
 
        $bookLists = json_decode($rawBookLists, true);
  
        foreach($bookLists as $list) {
            Book::create([
                'book_name' => $list['name'],
                'book_author' => $list['author'],
                'book_cover' => $list['cover']
            ]);
        }
    }
}
