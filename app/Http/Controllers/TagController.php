<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Article;
use Illuminate\Support\Facades\DB;


class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //$tags = DB::table('articles')->where('user_id',Auth::user()->id)->orderBy('created_at','desc');
        $tags = Article::where('user_id',Auth::user()->id)->with('tags')->first();
    
        dd($tags);
        return view('index', compact('articles'));
    }
}
