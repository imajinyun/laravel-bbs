<?php

namespace App\Http\Controllers\Web;

class DefaultsController extends WebController
{
    public function index()
    {
        return view('web.defaults.home');
    }
}
