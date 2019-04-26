<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\Models\File;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Hash;
use Validator;

class UsersController extends AdminController
{
    public function __construct()
    {
    }

    public function index(Request $request, User $user)
    {
        $keyword = $request->query('keyword');
        $request->offsetSet($request->query('keywordType'), $keyword);
        $users = $user->searchUsers($request);

        return view('admin.users.index', compact(
            'users'
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
        try {
            $this->authorize('update', $user);
        } catch (AuthorizationException $e) {
            return redirect()->with('danger', '你没有权限执行此操作！');
        }
        if ($user->update($request->all())) {
            return self::successResponse('用户个人资料编辑成功！');
        }

        return self::errorResponse('用户个人资料编辑失败！');
    }

    public function avatar(Request $request, User $user)
    {
        return view('admin.users.avatar', compact(
            'user'
        ));
    }

    public function crop(Request $request, User $user)
    {
        if ($request->ajax() && $request->isMethod('post')) {
            $data = $request->all();
            $data['file_id'] = $request->session()->get('fileId');

            return response()->json([
                'status' => true,
                'msg' => '裁剪头像保存成功！',
                'data' => $data,
            ]);
        }
        $fileId = $request->session()->get('fileId');
        $file = File::find($fileId);
        $uri = $file->uri;

        return view('admin.users.avatar_crop', compact(
            'user',
            'uri'
        ));
    }

    public function resetPassword(Request $request, User $user)
    {
        if ($request->ajax() && $request->isMethod('patch')) {
            $data = $request->all();
            $validator = Validator::make($data, [
                'newPassword' => 'required|min:6|max:20',
                'confirmPassword' => 'required_with:password|same:newPassword|min:6|max:20',
            ], [
                'newPassword.required' => '新密码 不能为空。',
                'newPassword.min' => '新密码 至少 6 个字符。',
                'newPassword.max' => '新密码 最多 20 个字符。',
                'confirmPassword.required_with' => '确认密码 不能为空。',
                'confirmPassword.same' => '确认密码和新密码 必须相同。',
                'confirmPassword.min' => '确认密码 至少 6 个字符。',
                'confirmPassword.max' => '确认密码 至多 20 个字符。',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'msg' => $validator->errors()->first(),
                    'data' => $validator->errors(),
                ]);
            }
            $password = Arr::get($data, 'newPassword');
            $user->password = Hash::make($password);
            $user->setRememberToken(Str::random(60));
            $user->save();

            return response()->json([
                'status' => true,
                'msg' => '密码修改成功！',
                'data' => [],
            ]);
        }

        return view('admin.users.password_reset', compact(
            'user'
        ));
    }
}
