<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;

class SiteSettingsController extends AdminController
{
    public function basic(Request $request)
    {
        $setting = Setting::where('name', '=', 'site');

        return view('admin.settings.site.basic', compact(
            'setting'
        ));
    }
}
