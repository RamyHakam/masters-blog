<?php

namespace App\Service;


use App\Contract\UploadFileInterface;
use App\Repository\PostRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class PostService
{

    /**
     * @var UploadFileInterface
     */
    private UploadFileInterface  $uploadFile;
    private PostRepository $postRepository;

    public function __construct(UploadFileInterface $uploadFile, PostRepository  $postRepository)
    {

        $this->uploadFile = $uploadFile;
        $this->postRepository = $postRepository;
    }

    public function createNewPost()
    {

    }

    public function getAllPosts(UserInterface $user = null ):array
    {
        return $this->postRepository->findAll();
    }

    public function likePost()
    {

    }

    public function commentOnPost()
    {

    }
}