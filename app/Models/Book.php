<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = ['title', 'synopsis', 'author_id', 'gender_id'];

    public function review()  {
        return $this->hasMany(
            Review::class,
            'book_id',
            'id'
        );
    }

    public function gender(){
        return $this->belongsTo(
            Gender::class,
            'book_id',
            'id'
        );
    }

    public function author(){
        return $this->belongsTo(
            Author::class,
            'book_id',
            'id'
        );
    }
}
