<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\post;
use App\User;
use App\Description;

class comment extends Model
{
    protected $fillable = [
        'comment_body','comment_id','post_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

}
