<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Link;
use Illuminate\Http\Request;

class LinksController extends AdminController
{
    public function index(Link $link)
    {
        $links = $link->paginate(20);

        return view('admin.systems.links.index', compact(
            'links'
        ));
    }

    public function create(Request $request, Link $link)
    {
        return view('admin.systems.links.link', compact(
            'link'
        ));
    }

    public function store(Request $request, Link $link)
    {
        $link->fill($request->all());
        $link->status = $request->get('isOpen') ? 1 : 2;
        if ($link->save()) {
            return self::successResponse('友情链接添加成功！');
        }

        return self::errorResponse('友情链接添加失败！');
    }

    public function edit(Request $request, Link $link)
    {
        return view('admin.systems.links.link', compact(
            'link'
        ));
    }

    public function update(Request $request, Link $link)
    {
        $link->fill($request->all());
        $link->status = $request->get('isOpen') ? 1 : 2;

        if ($link->update()) {
            return self::successResponse('友情链接编辑成功！');
        }

        return self::errorResponse('友情链接编码失败！');
    }
}
