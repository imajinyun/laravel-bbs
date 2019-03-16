<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends AdminController
{
    public function __construct()
    {
    }

    public function index(Request $request, User $user)
    {
        $count = $user->count();
        $users = $user->withUpdatedAt($request->order)->paginate(10);

        return view('admin.users.index', compact(
            'users',
            'count'
        ));
    }

    public function show(Request $request, User $user)
    {
        return view('admin.users.show', compact(
            'user'
        ));
    }

    public function edit(Request $request, User $user)
    {
        return view('admin.users.edit', compact(
            'user'
        ));
    }
}
