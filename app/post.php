<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\post;

class post extends Model
{
    protected $fillable = [
        'title','body'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

}
