<?php

namespace App\Service;


use App\Contract\UploadFileInterface;

class PostService
{

    /**
     * @var UploadFileInterface
     */
    private $uploadFile;

    public function __construct(UploadFileInterface $uploadFile)
    {

        $this->uploadFile = $uploadFile;
    }

    public function createNewPost()
    {

    }

    public function getAllPosts()
    {

    }


    public function likePost()
    {

    }

    public function commentOnPost()
    {

    }
}