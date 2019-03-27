<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionsController extends Controller
{
    public function index()
    {
        $permissions = [];

        return view('admin.permissions.index', compact(
            'permissions'
        ));
    }

    public function create(Request $request, Permission $permission)
    {
        return view('admin.permissions.permission', compact(
            'permission'
        ));
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
