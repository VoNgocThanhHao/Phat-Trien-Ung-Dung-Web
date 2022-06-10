<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favouriteModel extends Model
{
    use HasFactory;
    protected $table = 'favourites';
    protected $fillable = [
        'user_id', 'product_id',
    ];

    public function product(){
        return $this->hasOne(productModel::class,'id','product_id');
    }
}
