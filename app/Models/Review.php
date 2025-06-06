<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = ['grade', 'text', 'user_id', 'book_id'];
    
    public function user(){
        return $this->belongsTo(
            User::class,
            'review_id',
            'id'
        );
    }

    public function book(){
        return $this->belongsTo(
            Book::class,
            'review_id',
            'id'
        );
    }
}
