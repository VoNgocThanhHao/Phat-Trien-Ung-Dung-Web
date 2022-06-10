<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productModel extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name', 'brand', 'description', 'specification', 'price', 'discount', 'image', 'image_list', 'view',
    ];

    public function brand(){
        return $this->belongsTo(brandModel::class,'brand_id','id');
    }

    public function comment(){
        return $this->hasMany(commentModel::class,'product_id','id');
    }
}
