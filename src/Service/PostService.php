<?php

namespace App\Service;


use App\Contract\UploadFileInterface;
use Symfony\Component\Security\Core\User\UserInterface;

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

    public function getAllPosts(UserInterface $user = null )
    {

    }


    public function likePost()
    {

    }

    public function commentOnPost()
    {

    }
}