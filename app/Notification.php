<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Notification extends Eloquent
{
    public function user(){
        return $this->belongsTo('App\User');

    }
    protected $fillable = [
        'content','is_read','url'
    ];
}
