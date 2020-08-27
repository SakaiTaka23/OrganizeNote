<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function contents()
    {
        return $this->hasMany('App\Content');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }
}
