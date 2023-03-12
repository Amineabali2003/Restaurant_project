<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'idUser',
        'Fullname',
        'Phone',
        'Address',
        'City',
        'Zip',
        'totalOrder',
    ];
    // public function user(){
    //     // return $this->BelongsTo
    //     return $this->hasOne(User::class,'id','idUser');
    // }
    public function items(){
        // return $this->BelongsTo
        return $this->hasMany(ConfirmedOrders::class,'idForm','id');
    }
    public function user(){

        return $this->hasOne(User::class,'id','idUser');
    }

}
