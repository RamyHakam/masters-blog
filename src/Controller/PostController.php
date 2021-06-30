<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post")
 * Class PostController
 * @package App\Controller
 */
class PostController extends AbstractController
{
    /**
     * @Route("/list-deleted",name="list_delete_posts_request")
     * @return Response
     */
    public function listDeleteRequestAction()
    {
        return $this->render('delete_request.html.twig');
    }


    /**
     * @Route("/post/{id}",name="single_post",methods={"GET"})
     * @return Response
     */
    public function getPostAction(int $id)
    {
        return $this->render('single_post.html.twig',['id' => $id]);
    }


}