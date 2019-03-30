<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;

class UserSettingsController extends AdminController
{
    public function register()
    {
        $setting = Setting::where('name', '=', 'register');

        return view('admin.settings.user.register', compact(
            'setting'
        ));
    }

    public function login()
    {
        return view('admin.settings.user.login');
    }
}
