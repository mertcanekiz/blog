<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class TextPost extends Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likedBy()
    {
        return $this->belongsToMany('App\User', null, 'likedPosts', 'likedBy');
    }
    public function bookmarkedBy()
    {
        return $this->belongsToMany('App\User', null, 'bookmarkedPosts', 'bookmarkedBy');
    }
    // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();

        static::deleting(function($post) { // before delete() method call this
            $post->comments()->delete();
            // do the rest of the cleanup...
        });
    }
}
