<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class passwordResetsModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'email';
    public $timestamps = false;
    protected $table = 'password_resets';
    protected $fillable = [
        'email', 'token','created_at',
    ];
}
