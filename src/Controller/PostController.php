<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 */
#[Route(path: '/post')]
class PostController extends AbstractController
{
    /**
     * @return Response
     */
    #[Route(path: '/list-deleted', name: 'list_delete_posts_request')]
    public function listDeleteRequestAction()
    {
        return $this->render('delete_request.html.twig');
    }


    /**
     * @return Response
     */
    #[Route(path: '/post/{id}', name: 'single_post', methods: ['GET'])]
    public function getPostAction(int $id)
    {
        return $this->render('single_post.html.twig',['id' => $id]);
    }


}