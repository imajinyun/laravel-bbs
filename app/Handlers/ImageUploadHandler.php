<?php

namespace App\Handlers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageUploadHandler
{
    /**
     * @var array
     */
    protected static $allowedExt = ['png', 'jpg', 'gif', 'jpeg'];

    /**
     * Upload image file.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param $folder
     * @param bool $maxWidth
     *
     * @return array|bool
     */
    public function upload(UploadedFile $file, $folder, $prefix, $maxWidth = false)
    {
        $folder = 'uploads/images/' . $folder . '/' . date('Ym/d');
        $ext = strtolower($file->getClientOriginalExtension()) ?: 'png';
        $filename = $prefix . '_' . time() . '_' . strtolower(Str::random()) . '.' . $ext;

        if (! in_array($ext, self::$allowedExt, true)) {
            return false;
        }
        $file->move($folder, $filename);

        return [
            'path' => config('app.url') . "/$folder/$filename",
        ];
    }
}
