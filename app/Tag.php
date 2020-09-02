<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tag extends Model
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

    public function getTags()
    {
        $tags = Tag::select('id', 'name')->where('user_id', Auth::user()->id)->withCount('articles')->orderBy('articles_count', 'desc')->orderBy('name', 'asc')->paginate(30);
        return $tags;
    }

    public function getTagName($id)
    {
        $name =  Tag::select('name')->where('id', $id)->get();
        $name = $name[0]->name;
        return $name;
    }

    public function getArticles($id)
    {
        $articles =  Tag::with('articles')->where('user_id', Auth::user()->id)->where('id', $id)->orderBy('name', 'asc')->get();
        $articles = $articles[0]['articles'];
        return $articles;
    }
}
