<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'body','comment_id','post_id'
    ];

    public function reviews(){
        return $this->belongsTo('App\Review');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
