<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index(Request $request, Role $role)
    {
        $count = $role->count();
        $roles = $role->paginate(20);

        return view('admin.roles.index', compact(
            'roles',
            'count'
        ));
    }

    public function create(Request $request, Topic $topic)
    {
        $categories = Category::all();

        return view('web.roles.role', compact(
            'topic',
            'categories'
        ));
    }
}
