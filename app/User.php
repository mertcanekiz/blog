<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use App\UserProfile;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->embedsOne('App\UserProfile');
    }

    public function posts()
    {
        return $this->hasMany('App\TextPost');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likedPosts()
    {
        return $this->hasMany('App\TextPost', 'likedBy');
    }

    public function bookmarkedPosts()
    {
        return $this->hasMany('App\TextPost', 'bookmarkedBy');
    }
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

}
