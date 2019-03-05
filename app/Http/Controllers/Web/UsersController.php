<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Web\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends WebController
{
    public function show(Request $request, User $user)
    {
        return view('web.users.show', compact('user'));
    }

    public function edit(Request $request, User $user)
    {
        return view('web.users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());

        return redirect()
            ->route('users.show', $user->id)
            ->with('success', '个人资料更新成功。');
    }
}
