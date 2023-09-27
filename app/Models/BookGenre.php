<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookGenre extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'genres'
    ];

    public function books() {
        return $this->hasMany('id', 'genre_id');
    }
}
