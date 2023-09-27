<?php

namespace Database\Seeders;

use App\BookGenre;
use Illuminate\Database\Seeder;

class BookGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lists = [
            'Fantasy',
            'Adventure',
            'Romance',
            'Contemporary',
            'Dystopian',
            'Mystery',
            'Horror',
            'Thriller',
            'Paranormal',
            'Historical Fiction',
            'Science Fiction',
            'Children',
            'Memoir',
            'Cookbook',
            'Art',
            'Self-help',
            'Development',
            'Motivational',
            'Health',
            'History',
            'Travel',
            'Guide',
            'Families & Relationships',
            'Humor'
        ];

        foreach ($lists as $list) {
            BookGenre::create([
                'genres' => $list
            ]);
        }
    }
}
