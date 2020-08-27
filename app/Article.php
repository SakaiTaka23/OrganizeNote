<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;


class Article extends Model
{

    protected $fillable = [
        'title', 'user_id','key','created_at',
    ];

    public $timestamps = false;

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

    public function first_time($name)
    {
        $user = new User;
        $auth = Auth::user();
        $count = $user->updateCount($name);
        $page = intval($count / 6);
        if ($page % 6 != 0) $page++;
        $url = 'https://note.com/api/v2/creators/' . $name . '/contents?kind=note&page=' . $page;
        $client = new Client();
        $response = $client->request("GET", $url);
        $posts = $response->getBody();
        $posts = json_decode($posts, true);
        $posts = $posts['data']['contents'];
        //dd($auth->id);

        for ($i = count($posts); $i >= 0; $i--) {
            $posts = $posts[$i-1];
            $article = new Article();
            $article->title = $posts['name'];
            $article->key = $posts['key'];
            $article->user_id = $auth->id;
            $article->created_at = $posts['publishAt'];
            $article->save();

            for ($j = 0; $j <= count($posts['hashtags']); $j++) {
                $posts = $posts['hashtags'];
                $tag = $posts[$j]['hashtag']['name'];
                $tags = Tag::firstOrCreate(['name'=>$tag]);
                //$article->tags()->attach($tags);
                $tags->articles()->attach($article);
            }

            for ($j = 0; $j <= count($posts); $j++) {
                $posts = $posts['additionalAttr']['index'];
                $content = $posts[$j]['body'];
                $contents = Content::firstOrCreate(['name'=>$content]);
                $article->contents()->attach($contents);
            }

            dd(Article::all());
        }
    }
}
