<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'noteurl', 'password', 'article_count',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function updateCount($name)
    {
        $url = 'https://note.com/api/v2/creators/' . $name;
        $client = new Client();
        $response = $client->request("GET", $url);
        $posts = $response->getBody();
        $posts = json_decode($posts, true);
        $count = $posts['data']['noteCount'];
        $user = User::find(Auth::user()->id);

        $user->fill(['article_count' => $count])->update();
        return $count;
    }

}
