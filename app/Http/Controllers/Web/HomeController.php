<?php

namespace App\Http\Controllers\Web;

class HomeController extends WebController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['homepage', 'deny']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('web.defaults.home');
    }

    public function deny()
    {
        return view('web.defaults.deny');
    }

    public function homepage()
    {
        return view('welcome');
    }
}
