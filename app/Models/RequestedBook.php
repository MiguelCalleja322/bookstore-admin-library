<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestedBook extends Model
{
    protected $fillable = [
        'user_id',
        'book_name',
        'book_author'
    ];

    public function user() {
        return $this->belongsTo('user_id', 'id');
    }
}
