<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amber extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'fridge_id',
    ];
    public $table="ambers"; 
    function fridges(){
        return $this->belongsTo('App\Models\Fridge','fridge_id','id');
    }
    function clients(){
        return $this->hasMany('App\Models\Client','amber_id','id');
    }
}
