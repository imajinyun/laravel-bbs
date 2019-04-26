<?php

namespace App\Http\Controllers\Web;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Web\UserRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
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
        try {
            $this->authorize('update', $user);
        } catch (AuthorizationException $e) {
            return redirect()
                ->route('users.show', $user->id)
                ->with('danger', $e->getMessage());
        }

        return view('web.users.edit', compact('user'));
    }

    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        try {
            $this->authorize('update', $user);
        } catch (AuthorizationException $e) {
            return redirect()
                ->route('users.show', $user->id)
                ->with('danger', $e->getMessage());
        }
        $data = $request->all();

        if ($request->avatar) {
            $result = $uploader->upload($request->avatar, 'avatars', $user->id, 320);

            if ($result && $result['status']) {
                $data['avatar'] = $result['path'];
            }
        }
        $user->update($data);

        return redirect()
            ->route('users.show', $user->id)
            ->with('success', '个人资料更新成功。');
    }
}
