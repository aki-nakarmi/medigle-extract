<?php

namespace App\Utilities;

use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileUpload
 * @package App\Utils
 */
class FileUpload
{

    /**
     * @param UploadedFile $file
     * @param string       $path
     * @param null         $fileName
     *
     * @param bool         $encryptFileName
     *
     * @return array
     * @throws \Exception
     */
    public function handle(UploadedFile $file, string $path = 'uploads', $fileName = null, $encryptFileName = false): array
    {
        if ( is_null($fileName) ) {
            $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $fileName = preg_replace('#([0-9_]+)x([0-9_]+)#', "$1-$2", $fileName);
        }
        $fileName = $encryptFileName ? md5($fileName) : $fileName;

        $input              = [];
        $input['path']      = $path;
        $input['extension'] = $file->getClientOriginalExtension();
        $input['filesize']  = $file->getSize();
        $input['mimetype']  = $file->getClientMimeType();
        $input['filename']  = sprintf("%s.%s", $fileName, $input['extension']);
        $fileCounter        = 1;
        while (file_exists($input['path'].'/'.$input['filename'])) {
            $input['filename'] = sprintf("%s_%d.%s", $fileName, $fileCounter++, $input['extension']);
        }
        try {
            $file->move($input['path'], $input['filename']);
        } catch (FileException $e) {
            logger($e->getmessage());

            throw new \Exception($e->getMessage());
        }

        $input['path'] = str_ireplace(public_path(), '', $input['path']);

        return $input;
    }
}
