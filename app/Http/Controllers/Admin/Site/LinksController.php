<?php

namespace App\Http\Controllers\Admin\Site;

use App\Http\Controllers\Controller;
use App\Models\Link;

class LinksController extends Controller
{
    public function index(Link $link)
    {
        $links = $link->paginate(20);

        return view('admin.settings.site.links.index', compact(
            'links'
        ));
    }

    public function create()
    {
        return view('admin.settings.site.links.link');
    }
}
