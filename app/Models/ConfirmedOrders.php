<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmedOrders extends Model
{
    use HasFactory;
    protected $fillable=[
        'idPlat',
        'Quantity',
        'idForm',
    ];

    public function OfForm(){

        return $this->BelongsTo(FormOrder::class,'id','idForm');
    }
    public function food(){

        return $this->hasOne(food::class,'id','idPlat');
    }

}
