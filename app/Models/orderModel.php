<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderModel extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'quantity', 'product_id', 'bill_id',
    ];

    public function product(){
        return $this->hasOne(productModel::class,'id','product_id');
    }

    public function bill(){
        return $this->belongsTo(billModel::class,'bill_id','id');
    }
}
