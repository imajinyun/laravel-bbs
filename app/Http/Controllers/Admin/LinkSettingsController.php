<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkSettingsController extends Controller
{
    public function index()
    {
        $links = [];

        return view('admin.settings.site.basic', compact(
            'links'
        ));
    }
}
