<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BorrowedBook extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'book_id'
    ];

    public function book() {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
