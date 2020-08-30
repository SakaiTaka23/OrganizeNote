<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Article;
use App\Tag;


class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tags = Tag::select('name')->where('user_id',Auth::user()->id)->get();
    
        return view('user.tag', compact('tags'));
    }
}
