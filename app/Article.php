<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;


class Article extends Model
{

    protected $fillable = [
        'title', 'user_id', 'key', 'created_at',
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

        for ($page; $page >= 0; $page--) {
            $url = 'https://note.com/api/v2/creators/' . $name . '/contents?kind=note&page=' . $page;
            $client = new Client();
            $response = $client->request("GET", $url);
            $posts = $response->getBody();
            $posts = json_decode($posts, true);
            $posts = $posts['data']['contents'];
            //dd(count($posts),$posts);

            for ($i = count($posts); $i > 0; $i--) {
                $anarticle = $posts[$i - 1];
                if ($anarticle['type'] != 'TextNote') {
                    continue;
                }
                $article = new Article();
                $article->title = $anarticle['name'];
                $article->key = $anarticle['key'];
                $article->user_id = $auth->id;
                $article->created_at = $anarticle['publishAt'];
                $article->save();

                if (isset($anarticle['hashtags'])) {
                    $hashtags = $anarticle['hashtags'];
                    for ($j = 0; $j < count($anarticle['hashtags']); $j++) {
                        $tag = $hashtags[$j]['hashtag']['name'];
                        $tags = Tag::firstOrCreate(['name' => $tag]);
                        $tags->articles()->attach($article);
                    }
                }

                if (isset($anarticle['additionalAttr']['index'])) {
                    $contentstable = $anarticle['additionalAttr']['index'];
                    for ($j = 0; $j < count($contentstable); $j++) {
                        $content = $contentstable[$j]['body'];
                        $contents = Content::firstOrCreate(['name' => $content]);
                        $contents->articles()->attach($article);
                    }
                }
            }
            sleep(1);
        }
    }
}
