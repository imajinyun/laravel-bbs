<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;

class UsersController extends AdminController
{
    public function register()
    {
        return view('admin.settings.user.register');
    }

    public function login()
    {
        return view('admin.settings.user.login');
    }
}
