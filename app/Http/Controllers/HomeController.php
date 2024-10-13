<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() // home admin
    {
        return view('home'); 
    }

    public function homedivisi()
    {
        return view('homedivisi');
    }

    public function homesupplier()
    {
        return view('homesupplier');
    }

    public function homeheadga()
    {
        return view ('homeheadga');
    }

    public function homestaffga()
    {
        return view ('homestaffga');
    }


}
