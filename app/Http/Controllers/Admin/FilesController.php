<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\ImageUploadHandler;
use Illuminate\Http\Request;

class FilesController extends AdminController
{
    public function upload(Request $request, ImageUploadHandler $uploader)
    {
        $data = ['status' => false, 'msg' => '上传失败！', 'path' => ''];

        /** @var \Illuminate\Http\UploadedFile $file */
        if ($file = $request->file) {
            $result = $uploader->upload($file, 'avatars', 'up');

            if ($result && $result['status']) {
                $data = array_merge($data, $result);

                return response()->json($data);
            }
        }

        return response()->json($data);
    }
}
