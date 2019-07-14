<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Comment extends Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content'
    ];

    public function text_post()
    {
        return $this->belongsTo('App\TextPost');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
