<?php

namespace App\Service;

use App\Contract\UploadFileInterface;

class LocalFileUploadService implements UploadFileInterface
{

    public function uploadFile(): string
    {
       // upload the file to our server
        return  "URL";
    }
}