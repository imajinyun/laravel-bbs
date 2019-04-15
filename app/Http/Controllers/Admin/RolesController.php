<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Validator;
use Illuminate\Support\Str;

class RolesController extends AdminController
{
    public function index(Request $request)
    {
        $count = 0;
        $roles = Role::paginate(20);

        return view('admin.roles.index', compact(
            'roles',
            'count'
        ));
    }

    public function create(Request $request, Role $role)
    {
        $menus = config('menu');
        $menus['admin']['children'] = array_values($menus['admin']['children']);
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
        $role->slug = Arr::get($data, 'slug');

        if ($role->save()) {
            $menus = Str::replaceFirst('[', '', $menus);
            $menus = Str::replaceLast(']', '', $menus);
            $menus = explode(',', $menus);
            $role->givePermissionTo($menus);

            return self::successResponse('角色添加成功！');
        }

        return self::errorResponse('角色添加失败！');
    }

    public function show(Request $request, Role $role)
    {
        $menus = config('menu');
        $menus['admin']['children'] = array_values($menus['admin']['children']);
        $permission = $role->permissions();
        $ids = $permission->getResults()->pluck('id')->toArray();
        $menus = each_tree_menu($menus, $ids, true);
        $menus = json_encode([$menus['web'], $menus['admin']]);

        return view('admin.roles.role', compact(
            'role',
            'menus'
        ));
    }

    public function edit(Request $request, Role $role)
    {
        $menus = config('menu');
        $menus['admin']['children'] = array_values($menus['admin']['children']);
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

    public function update(Request $request, Role $role)
    {
        $data = $request->all();
        $menus = Arr::get($data, 'menus');
        $role->name = Arr::get($data, 'name');
        $role->slug = Arr::get($data, 'slug');

        if ($role->update()) {
            $menus = Str::replaceFirst('[', '', $menus);
            $menus = Str::replaceLast(']', '', $menus);
            $menus = explode(',', $menus);

            $permissions = Permission::all();
            foreach ($permissions as $permission) {
                $role->revokePermissionTo($permission);
            }

            foreach ($menus as $menu) {
                $permission = Permission::where('id', '=', $menu)->firstOrFail();
                $role->givePermissionTo($permission);
            }

            return self::successResponse('角色更新成功！');
        }

        return self::errorResponse('角色更新失败！');
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
