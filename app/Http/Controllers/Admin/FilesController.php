<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\ImageUploadHandler;
use App\Models\File;
use App\Models\FileGroups;
use App\Supports\UploadToken;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class FilesController extends AdminController
{
    public function upload(Request $request, ImageUploadHandler $uploader)
    {
        $data = ['status' => false, 'msg' => '上传失败！', 'path' => ''];
        $group = $this->getFileGroup($request);

        /** @var \Illuminate\Http\UploadedFile $file */
        if ($file = $request->file) {
            $result = $uploader->upload($file, 'avatars', 'up');

            if ($result && $result['status']) {
                $data = array_merge($data, $result);
                $group['uri'] = $result['path'];
                $entity = $this->saveUploadedFile($file, $group);
                $request->session()->put('fileId', $entity['id']);

                return response()->json($data);
            }
        }

        return response()->json($data);
    }

    public function crop(Request $request)
    {
        $fileId = $request->session()->get('fileId');
        $file = File::find($fileId);

        $prefix = Auth::id();
        $ext = 'jpg';
        $folder = 'uploads/img/avatars/' . date('Ym/d');
        $filename = $prefix . '_' . time() . '_' . strtolower(Str::random()) . '.' . $ext;
        $path = "{$folder}/{$filename}";

        Image::make($file->uri)
            ->resize(250, 270)
            ->save($path);
        $path = config('app.url') . '/' . $path;

        return response()->json(['path' => $path]);
    }

    protected function getFileGroup(Request $request)
    {
        $token = $request->request->get('token');

        $uploadToken = new UploadToken();
        $token = $uploadToken->parse($token);

        $token['group'] = $token['group'] ?: 'default';

        return $token;
    }

    protected function saveUploadedFile(UploadedFile $uploadedFile, array $data)
    {
        $now = now();
        $file = new File();
        $code = Arr::get($data, 'group');
        $fileGroup = FileGroups::where('code', '=', $code)->first();
        $file->group_id = $fileGroup->id;
        $file->user_id = Arr::get($data, 'user_id', Auth::id());
        $file->uri = Arr::get($data, 'uri');
        $file->mime = $uploadedFile->getClientMimeType();
        $file->size = $uploadedFile->getSize();
        $file->created_at = $now;
        $file->updated_at = $now;
        $file->save();

        return $file->toArray();
    }
}