<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $articles = new Article();
        $articles = $articles->getIndex();
        $noteurl = Auth::user()->noteurl;
        return view('user.index',compact('articles','noteurl'));
    }

    public function search(Request $request)
    {
        $title = $request->title;
        $articles = new Article();
        $articles = $articles->findArticle($request);
        $noteurl = Auth::user()->noteurl;
        $dates['from'] = $request->datefrom;
        $dates['to'] = $request->dateto;
        return view('user.index',compact('articles','noteurl','title','dates'));
    }

}
