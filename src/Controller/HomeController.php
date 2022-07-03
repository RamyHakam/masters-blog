<?php


namespace App\Controller;


use App\Form\PostType;
use App\Service\AccountDataService;
use App\Service\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends  AbstractController
{
    /**
     * @var PostService
     */
    private PostService  $postService;
    private AccountDataService $accountDataService;

    public function __construct(PostService $postService, AccountDataService  $accountDataService)
    {
        $this->postService = $postService;
        $this->accountDataService = $accountDataService;
    }

    /**
     * @Route("/home", name="home_page")
     * @return Response
     */
    public function Home()
    {
        $account = $this->accountDataService->getUserData();
        $posts = $this->postService->getAllPosts();
        $postForm = $this->createForm(PostType::class,null,['action' => '#']);
       return $this->render('home.html.twig',['posts'=>$posts,'account'=>$account,'postForm'=>$postForm->createView()]);
    }
}