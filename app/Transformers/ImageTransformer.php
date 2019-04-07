<?php

namespace App\Transformers;

use App\Models\File;
use League\Fractal\TransformerAbstract;

class ImageTransformer extends TransformerAbstract
{
    public function transform(File $file)
    {
        return [
            'id' => $file->id,
            'group_id' => $file->group_id,
            'user_id' => $file->user_id,
            'uri' => $file->uri,
            'mime' => $file->mime,
            'size' => $file->size,
            'status' => $file->status,
            'created_at' => $file->created_at->toDateTimeString(),
            'updated_at' => $file->updated_at->toDateTimeString(),
        ];
    }
}
