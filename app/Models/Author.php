<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';
    protected $fillable = ['name', 'birth_date', 'biography'];

    public function book()  {
        return $this->hasMany(
            Book::class,
            'book_id',
            'id'
        );
    }
}
