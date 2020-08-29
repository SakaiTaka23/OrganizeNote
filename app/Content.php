<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }
}
