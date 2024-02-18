<?php


namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 */
#[Route(path: '/post')]
class PostController extends AbstractController
{

    #[Route(path: '/list-deleted', name: 'list_delete_posts_request')]
    #[Security('is_granted("IS_AUTHENTICATED")')]
    public function listDeleteRequestAction(): Response
    {
        return $this->render('delete_request.html.twig');
    }


    #[Route(path: '/post/{id}', name: 'single_post', methods: ['GET'])]
    #[Security('is_granted("IS_AUTHENTICATED")')]
    public function getPostAction(int $id): Response
    {
        return $this->render('single_post.html.twig',['id' => $id]);
    }


}