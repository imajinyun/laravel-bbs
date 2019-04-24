<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;

class UsersController extends AdminController
{
    public function register()
    {
        return view('admin.systems.users.register');
    }

    public function login()
    {
        return view('admin.systems.users.login');
    }
}
