<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class messageModel extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'content','type','user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
