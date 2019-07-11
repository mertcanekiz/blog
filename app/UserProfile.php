<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UserProfile extends Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bio', 'avatar'
    ];

    public function user()
    {
        return $this->belongsTo('User');
    }
}
