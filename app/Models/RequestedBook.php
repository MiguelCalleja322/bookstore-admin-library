<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestedBook extends Model
{
    protected $fillable = [
        'user_id',
        'book_name',
        'book_author',
        'book_cover',
        'status',
        'reason'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
