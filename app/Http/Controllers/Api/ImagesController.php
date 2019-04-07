<?php

namespace App\Http\Controllers\Api;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\Api\ImageRequest;
use App\Models\File;
use App\Models\FileGroups;
use App\Transformers\ImageTransformer;

class ImagesController extends ApiController
{
    public function store(ImageRequest $request, ImageUploadHandler $uploader, File $file)
    {
        $user = $this->user();
        $type = $request->type;
        $width = $type === 'avatar' ? 350 : 1024;
        $folder = str_plural($type);

        /** @var \Illuminate\Http\UploadedFile $image */
        $image = $request->image;
        $size = $image->getSize();
        $result = $uploader->upload($image, $folder, $user->id, $width);

        $now = now();
        $group = FileGroups::where('code', '=', $type)->first();
        $file->group_id = $group->id;
        $file->user_id = $user->id;
        $file->uri = $result['path'];
        $file->mime = $image->getClientMimeType();
        $file->size = $size;
        $file->created_at = $now;
        $file->updated_at = $now;
        $file->save();

        return $this->response
            ->item($file, new ImageTransformer())
            ->setStatusCode(201);
    }
}
