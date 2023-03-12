<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class food extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        // 'type',
        'image',
    ];

    public function Cart(){

        return $this->hasOne(Cart::class,'idPlat','id');
    }
}
