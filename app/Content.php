<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Content extends Model
{

    protected $fillable = [
        'name', 'user_id',
    ];

    public $timestamps = false;

    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function getRandomContents()
    {
        return Content::where('user_id', Auth::user()->id)->inRandomOrder()->with('articles')->paginate(30);
    }

    public function findContents($request)
    {
        $contents = Content::where('user_id', Auth::user()->id)->with('articles')->where('name', 'like', '%' . $request->content . '%')->orderBy('name', 'asc')->paginate(30);
        return $contents;
    }
}
