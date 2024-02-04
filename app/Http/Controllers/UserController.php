<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $authUser = \Auth::user();

        return view('profile')->with(['authUser'=>$authUser]);
    }

    public function addresses()
    {
        $addresses = \Auth::user()->addresses;

        return view('addresses')->with(['addresses'=>$addresses]);
    }
}
