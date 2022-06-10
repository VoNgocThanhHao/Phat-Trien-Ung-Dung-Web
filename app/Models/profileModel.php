<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profileModel extends Model
{
    use HasFactory;

    protected $table = 'profiles';
    protected $fillable = [
        'image', 'description', 'phone_number', 'address',
    ];

}
