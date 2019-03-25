<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RolesController extends AdminController
{
    public function index(Request $request)
    {
        $count = 0;
        $roles = Role::paginate(20);
        $role = Role::find(1);
        $role->givePermissionTo([201, 202, 203]);

        return view('admin.roles.index', compact(
            'roles',
            'count'
        ));
    }

    public function create(Request $request, Role $role)
    {
        $menus = config('menu');
        $menus = json_encode([$menus['web'], $menus['admin']]);

        return view('admin.roles.role', compact(
            'role',
            'menus'
        ));
    }

    public function store(Request $request, Role $role)
    {
        $data = $request->all();
        $menus = Arr::get($data, 'menus');
        $role->name = Arr::get($data, 'name');

        if ($role->save()) {
            $menus = Str::replaceFirst('[', '', $menus);
            $menus = Str::replaceLast(']', '', $menus);
            $menus = explode(',', $menus);
            $role->givePermissionTo($menus);

            return self::successResponse('角色添加成功！');
        }

        return self::errorResponse('角色添加失败！');
    }

    public function edit(Request $request, Role $role)
    {
        $menus = config('menu');
        $permissions = $role->permissions();
        $ids = $permissions->getResults()->pluck('id')->toArray();
        $menus = each_tree_menu($menus, $ids);
        $menus = json_encode([$menus['web'], $menus['admin']]);

        return view('admin.roles.role', compact(
            'role',
            'menus',
            'ids'
        ));
    }

    public function checkName(Request $request, $id = null)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'value' => 'required|max:64|unique:roles,name' . ($id ? ",{$id}" : ''),
        ], [
            'value.max' => '角色名称至多 64 个字符。',
            'value.unique' => '角色名称已经存在。',
        ]);

        if ($validator->fails()) {
            return self::errorResponse($validator->errors()->first(), $validator->errors());
        }

        return self::successResponse('角色名称验证通过！');
    }

    public function checkSlug(Request $request, $id = null)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'value' => 'required|max:64|unique:roles,slug' . ($id ? ",{$id}" : ''),
        ], [
            'value.max' => '角色编码至多 64 个字符。',
            'value.unique' => '角色编码已经存在。',
        ]);

        if ($validator->fails()) {
            return self::errorResponse($validator->errors()->first(), $validator->errors());
        }

        return self::successResponse('角色编码验证通过！');
    }
}
