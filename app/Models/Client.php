<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',          
        'address',
        'vegetable_name',
        'amber',
        'fridge',
        'location',
        'status',
        //
        'price_all',
        //
        'ton',
        'small_shakara',
        'big_shakara',
        'price_list_id',
        //
        'avrage',
        'shakayir',
        'price_one',
        //
        'term_id',
        'user_id',
        'amber_id',
        'fridge_id',
    ];
    function ambers(){
        return $this->belongsTo('App\Models\Amber','amber_id','id');
    }
    function fridges(){
        return $this->belongsTo('App\Models\Fridge','fridge_id','id'); 
    }
    function price_lists(){
        return $this->belongsTo('App\Models\PriceList','price_list_id','id');
    }
    function terms(){
        return $this->belongsTo('App\Models\Term','term_id','id');
    }
    function users(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public $table="clients"; 
}
