<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Article extends Model
{

    protected $fillable = [
        'title', 'user_id', 'key', 'created_at',
    ];

    protected $dates = [
        'created_at',
    ];

    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function contents()
    {
        return $this->belongsToMany('App\Content');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function first_time($name)
    {
        $user = new User;
        $auth = Auth::user();
        $count = $user->updateCount($name);
        $page = intval($count / 6);
        if ($page % 6 != 0) $page++;

        for ($page; $page >= 1; $page--) {
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

    public function login_check($user)
    {
        $last_date = DB::table('articles')->select('created_at')->latest()->first();

        $user = new User;
        $auth = Auth::user();
        $name = $auth->noteurl;
        $count = $user->updateCount($name);
        $page_max = intval($count / 6);
        if ($page_max % 6 != 0) $page_max++;
        $page = 1;
        $found = false;

        for ($page; $page <= $page_max; $page++) {
            $url = 'https://note.com/api/v2/creators/' . $name . '/contents?kind=note&page=' . $page;
            $client = new Client();
            $response = $client->request("GET", $url);
            $posts = $response->getBody();
            $posts = json_decode($posts, true);
            $posts = $posts['data']['contents'];

            for ($i = 0; $i < count($posts); $i++) {
                $anarticle = $posts[$i];
                if ($last_date >= $anarticle['publishAt']) {
                    $found = true;
                    break;
                }
            }

            if ($found) {
                break;
            }
            sleep(1);
        }

        for ($page; $page >= 1; $page--) {
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
                $article->key = $anarticle['key'];
                $exists = DB::table('articles')->where('key', $article->key)->exists();
                if ($exists) {
                    continue;
                }

                $article->title = $anarticle['name'];
                //$article->key = $anarticle['key'];
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
