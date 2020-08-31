<?php

namespace App\Http\Controllers;

use App\Content;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $noteurl = Auth::user()->noteurl;
        $contents = new Content();
        $contents = $contents->getRandomContents();
        return view('user.content',compact('contents','noteurl'));
    }

    public function search(Request $request)
    {
        $noteurl = Auth::user()->noteurl;
        $content = $request->content;
        $contents = new Content();
        $contents = $contents->findContents($request);
        return view('user.content',compact('noteurl','content','contents'));
    }
}
