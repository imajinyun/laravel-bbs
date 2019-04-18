<?php

namespace App\Http\Controllers\Admin;

class LinkSettingsController extends AdminController
{
    public function index()
    {
        $links = [];

        return view('admin.settings.site.link', compact(
            'links'
        ));
    }
}
