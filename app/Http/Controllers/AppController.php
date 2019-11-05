<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AppController extends Controller
{
    //
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {

        if (Auth::check()) {
            return view('mypage');
        }
        return view('home');
    }

    public function home()
    {
        return view('home');
    }
    
    public function information()
    {
        return view('home');
    }
}
