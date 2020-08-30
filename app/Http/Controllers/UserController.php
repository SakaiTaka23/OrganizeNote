<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $profile = new User;
        $profile = $profile->getProfile(Auth::user()->noteurl);
        return view('user.profile',compact('profile'));
    }
}
