<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function home()
    {
        return view("home.home");
    }
    public function about()
    {
        return view("home.about");
    }
}
