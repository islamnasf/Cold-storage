<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'password',
        'active',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    function fridges(){
        return $this->hasMany('App\Models\Fridge','user_id','id');
    }
    function price_lists(){
        return $this->hasMany('App\Models\PriceList','user_id','id');
    }
    function terms(){
        return $this->hasMany('App\Models\Term','user_id','id');
    }
    function clients(){
        return $this->hasMany('App\Models\Client','user_id','id');
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function getJWTIdentifier()   
   		 {
       			 return $this->getKey();
    		 }

		public function getJWTCustomClaims()
    	{
        return [];
    	}
}