<?php

namespace App\Http\Controllers;

use App\Content;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $content = new Content();
        return view('user.content');
    }
}
