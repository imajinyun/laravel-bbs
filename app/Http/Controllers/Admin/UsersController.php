<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Web\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        return redirect()
            ->with('success', '个人资料更新成功。');
    }

    public function resetPassword(Request $request, User $user)
    {
        if ($request->ajax() && $request->isMethod('patch')) {
            $data = $request->all();
            $password = Arr::get($data, 'newPassword');
            $user->password = Hash::make($password);
            $user->setRememberToken(Str::random(60));
            $user->save();

            return response()->json([
                'status' => true,
                'msg' => '密码修改成功！',
                'data' => [],
            ], 201);
        }

        return view('admin.users.password_reset', compact(
            'user'
        ));
    }
}
