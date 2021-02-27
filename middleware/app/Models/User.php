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
        'name',
        'email',
        'password',
        'role_id',
        'permission',
        'refreshtoken'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
    public function isAdmin()
    {
        if($this->role->name=='administrator')
        {
            return true;
        }
        return false;
    }
    public function isInfluencer()
    {
        if($this->role->name=='influencer')
        {
            return true;
        }
        return false;
    }
    public function service()
    {
        return $this->hasMany('App\Models\Service');
    }
    public function cartitems()
    {
        return $this->hasMany('App\Models\CartItems');
    }
    public function sociallink()
    {
        return $this->hasMany('App\Models\Sociallinks');
    }
}
