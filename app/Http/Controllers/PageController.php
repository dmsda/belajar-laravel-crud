<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
        $title = "Selamat datang di website saya";
        return view('home', compact('title'));
    }

    public function about() {
        $name = "Dimas Aditya";
        $job = "Backend Developer";
        return view('about', compact('name', 'job'));
    }

    public function contact() {
        return view('contact');
    }
}
