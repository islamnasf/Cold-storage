<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fridge extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'size',
        'user_id',
    ];
    function users(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    function clients(){
        return $this->hasMany('App\Models\Client','fridge_id','id');
    }
    function ambers(){
        return $this->hasMany('App\Models\Amber','fridge_id','id');
    }
    public $table="fridges"; 
}
