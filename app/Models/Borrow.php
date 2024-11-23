<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id', 
        'member_id', 
        'tanggal_pinjam', 
        'tanggal_kembali',
    ];

    //each borrow is dibawah e member
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    //each borrow is dibawah e book
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
