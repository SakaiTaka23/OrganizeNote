<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Tag;


class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tags = new Tag();
        $tags = $tags->getTags(); 
        return view('user.tag', compact('tags'));
    }

    public function show($id)
    {
        $noteurl = Auth::user()->noteurl;
        $articles = new tag();
        $name = $articles->getTagName($id);
        $articles = $articles->getArticles($id);
        return view('user.tagshow',compact('noteurl','name','articles'));
    }
}
