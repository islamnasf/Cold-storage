<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    use HasFactory;
    protected $fillable = [
        'vegetable_name',
        'ton',
        'small_shakara',
        'big_shakara',
        'user_id'
    ];
    function users(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    function clients(){
        return $this->hasMany('App\Models\Client','price_list_id','id');
    }
    public $table="price_lists";
}
