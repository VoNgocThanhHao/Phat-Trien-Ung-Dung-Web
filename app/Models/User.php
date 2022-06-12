<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'permission', 'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(){
        return $this->belongsTo(profileModel::class,'id','user_id');
    }

    public function favourite(){
        return $this->hasMany(favouriteModel::class,'user_id','id');
    }

    public function message(){
        return $this->hasMany(messageModel::class,'user_id','id');
    }

    public function bill(){
        return $this->hasMany(billModel::class,'user_id','id');
    }

    public function verify(){
        return $this->hasMany(verifyModel::class,'user_id','id');
    }

    public function resetPass(){
        return $this->hasMany(passwordResetsModel::class,'email','email');
    }
}
