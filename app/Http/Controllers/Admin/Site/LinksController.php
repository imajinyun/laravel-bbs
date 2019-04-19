<?php

namespace App\Http\Controllers\Admin\Site;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Link;
use Illuminate\Http\Request;

class LinksController extends AdminController
{
    public function index(Link $link)
    {
        $links = $link->paginate(20);

        return view('admin.settings.site.links.index', compact(
            'links'
        ));
    }

    public function create(Request $request, Link $link)
    {
        return view('admin.settings.site.links.link', compact(
            'link'
        ));
    }

    public function store(Request $request, Link $link)
    {
        $link->fill($request->all());
        $link->status = $request->get('isOpen') ? 1 : 2;
        if ($link->save()) {
            return self::successResponse('友情链接添加成功');
        }

        return self::errorResponse('友情链接添加失败');
    }
}
