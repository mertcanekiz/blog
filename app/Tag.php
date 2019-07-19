<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Tag extends Eloquent
{
    protected $fillable = [
        'name','category'
    ];

    public function posts()
    {
        return $this->belongsToMany('App\TextPost', null, 'post_ids', 'tag_ids');
    }
}
