<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commentModel extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'content','user_id','product_id',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function product(){
        return $this->belongsTo(productModel::class,'product_id','id');
    }
}
