<?php

namespace App\Utils;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Request;
use JetBrains\PhpStorm\Pure;

class FileManager
{
    const FILE_TYPE_DOC = 'doc';
    const FILE_TYPE_IMAGE = 'image';
    const FILE_TYPE_AUDIO = 'audio';
    const FILE_TYPE_VIDEO = 'video';

    /**
     * Retrieve a file from the request.
     *
     * @param UploadedFile $file
     * @param $filePath
     * @param null $fileName
     * @return string
     */
    public static function upload(UploadedFile $file, $filePath, $fileName = null): string
    {
        if ($fileName == null) $file_name = microtime(true) * 10000;
        else $file_name = $fileName;
        $file_name .= '.' . $file->getClientOriginalExtension();
        $file->move(public_path($filePath), $file_name);
        return ($filePath . $file_name);
    }

    public static function getFileType(UploadedFile $file): string
    {
        $fileExtension = $file->getClientOriginalExtension();

        return match ($fileExtension) {
            'jpg', 'jpeg', 'png', 'gif' => self::FILE_TYPE_IMAGE,
            'm4a', 'mp3', 'ogg' => self::FILE_TYPE_AUDIO,
            'mp4', 'mkv' => self::FILE_TYPE_VIDEO,
            default => self::FILE_TYPE_DOC,
        };
    }
}
