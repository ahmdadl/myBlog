<?php declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadImage
{
    const IMAGE_URI = 'public/storage/img';

    public static function upload(
        Request $request,
        string $fileName
    ) : ?string {
        if ($request->hasFile($fileName)
        && $request->file($fileName)->isValid()) {
            $filePath = $request->img->store(self::IMAGE_URI);
            return Str::replaceFirst(self::IMAGE_URI, '', $filePath);
        }

        return null;
    }
}