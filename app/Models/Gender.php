<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = 'genders';
    protected $fillable = ['name'];

    public function book()  {
        return $this->hasMany(
            Book::class,
            'book_id',
            'id'
        );
    }
}
