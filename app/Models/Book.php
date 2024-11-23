<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['book_title', 'author'];

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'book_category', 'book_id', 'category_id');
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class, 'book_id', 'id');
    }
}
