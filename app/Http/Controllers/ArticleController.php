<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Article;
use App\User;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $articles = User::find(Auth::user()->id)->articles()->orderBy('created_at','desc')->paginate(10);
        //dd($articles);
        //$articles = DB::table('articles')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('user.index',compact('articles'));
    }
}
