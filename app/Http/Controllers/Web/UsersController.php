<?php

namespace App\Http\Controllers\Web;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Web\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends WebController
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    public function show(Request $request, User $user)
    {
        return view('web.users.show', compact('user'));
    }

    public function edit(Request $request, User $user)
    {
        $this->authorize('update', $user);

        return view('web.users.edit', compact('user'));
    }

    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user);
        $data = $request->all();

        if ($request->avatar) {
            $result = $uploader->upload($request->avatar, 'avatars', $user->id, 300);

            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
        $user->update($data);

        return redirect()
            ->route('users.show', $user->id)
            ->with('success', '个人资料更新成功。');
    }
}
