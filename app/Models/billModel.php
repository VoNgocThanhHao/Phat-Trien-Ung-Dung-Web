<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class billModel extends Model
{
    use HasFactory;
    protected $table = 'bills';
    protected $fillable = [
        'name','address','phone_number','description','type','code','payment','user_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'payment'
    ];

    public function order(){
        return $this->hasMany(orderModel::class,'bill_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
