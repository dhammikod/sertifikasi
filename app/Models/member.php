<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class member extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address'];
    protected $table = 'member';

    public function borrows()
    {
        return $this->hasMany(Borrow::class, 'member_id', 'id');
    }
}
