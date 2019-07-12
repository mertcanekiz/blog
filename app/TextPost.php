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

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }
}
