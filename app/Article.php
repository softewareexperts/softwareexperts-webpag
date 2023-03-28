<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title','body','user_id'
    ];
    
public function user()
{
    return $this->belongsTo('App\User'); 
}
public function reviews()
{
    return $this->hasMany('App\Review');
}

}
