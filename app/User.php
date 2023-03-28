<?php

namespace App;
use App\posr;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){

        return $this->hasOne("App\post");

    }

    public function comment(){

        return $this->hasMany("App\comment");

    }
    

    public function description(){
        return $this->hasMany('App\Description');
    }

    public function articles() {
        return $this->hasMany('App\Article');
    }

    public function reviews() {
        return $this->hasMany('App\Review');
    }

    public function replies(){
        return $this->hasMany('App\Reply');

}
}