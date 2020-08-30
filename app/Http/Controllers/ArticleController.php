<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $articles = User::find(Auth::user()->id)->articles()->orderBy('created_at','desc')->paginate(10);

        return view('user.index',compact('articles'));
    }
}
