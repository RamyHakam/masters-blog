<?php


namespace App\Controller;


use App\Service\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends  AbstractController
{
    /**
     * @var PostService
     */
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @Route("/home", name="home_page")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function Home()
    {
       return $this->render('home.html.twig');
    }

}