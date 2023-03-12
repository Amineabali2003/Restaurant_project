<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'idUser',
        'idPlat',

        'Quantity',
    ];

    public function food(){

        // return $this->hasOne(food::class,'id','idPlat');
        return $this->hasOne(food::class,'id','idPlat');
    }
    // public function user(){

    //     return $this->hasOne(User::class,'id','idUser');
    // }
}
