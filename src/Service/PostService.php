<?php

namespace App\Service;


use App\Contract\UploadFileInterface;
use App\Entity\Account;
use App\Entity\Comment;
use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class PostService
{

    /**
     * @var UploadFileInterface
     */
    private UploadFileInterface  $uploadFile;
    private PostRepository $postRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(UploadFileInterface $uploadFile, PostRepository  $postRepository,EntityManagerInterface  $entityManager)
    {

        $this->uploadFile = $uploadFile;
        $this->postRepository = $postRepository;
        $this->entityManager = $entityManager;
    }

    public function addPost(Post $post)
    {
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }

    public function getRecentPosts(UserInterface $user = null ):array
    {
        return $this->postRepository->findRecentPosts(350);
    }

    public function likePost()
    {

    }
    public function commentOnPost(Post $post , Account  $account, string $commentText): Comment
    {
        $comment = new Comment();
        $comment->setAccount($account);
        $comment->setPost($post);
        $comment->setCommentText($commentText);
        $this->entityManager->persist($comment);
        $this->entityManager->flush();
        return $comment;
    }
}