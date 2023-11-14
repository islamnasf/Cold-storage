<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'start',
        'end',
        'user_id',
    ];
    function users(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    function clients(){
        return $this->hasMany('App\Models\Client','term_id','id');
    }
    public $table="terms"; 
}
