<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryBook extends Model
{
    use HasFactory;

    //specify table name
    protected $table = 'book_category';

    // No timestamps
    public $timestamps = false;
}
