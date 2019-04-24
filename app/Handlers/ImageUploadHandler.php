<?php

namespace App\Handlers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Image;

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
     * @param string $folder
     * @param string $prefix
     * @param int $maxWidth
     *
     * @return array|bool
     */
    public function upload(UploadedFile $file, $folder, $prefix, $maxWidth = 0)
    {
        $folder = 'uploads/img/' . $folder . '/' . date('Ym/d');
        $ext = strtolower($file->getClientOriginalExtension()) ?: 'png';
        $filename = $prefix . '_' . time() . '_' . strtolower(Str::random()) . '.' . $ext;

        if (! in_array($ext, self::$allowedExt, true)) {
            return false;
        }
        $file->move($folder, $filename);

        if ($maxWidth > 0 && $ext !== 'gif') {
            $this->resize("$folder/$filename", $maxWidth);
        }

        return [
            'status' => true,
            'msg' => '上传成功！',
            'path' => config('app.url') . "/$folder/$filename",
        ];
    }

    private function resize($path, $width): void
    {
        $image = Image::make($path);
        $image->resize($width, null, static function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image->save();
    }
}
