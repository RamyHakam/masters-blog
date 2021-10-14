<?php


namespace App\Controller;


use App\Service\AccountDataService;
use App\Service\FollowService;
use App\Service\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @var PostService
     */
    private $postService;
    /**
     * @var AccountDataService
     */
    private $accountDataService;
    /**
     * @var FollowService
     */
    private $followService;

    public function __construct(PostService $postService, AccountDataService $accountDataService, FollowService $followService)
    {
        $this->postService = $postService;
        $this->accountDataService = $accountDataService;
        $this->followService = $followService;
    }

    /**
     * @Route("/profile",name="profile_page")
     * @return Response
     */
    public function getProfile()
    {
        return $this->render('profile.html.twig');
    }

    /**
     * @Route("/profile/{id}",name="profile_page_view")
     * @return Response
     */
    public function viewProfile(int $id)
    {
        return $this->render('profile_view.html.twig', ['id' => $id]);
    }

    /**
     * @Route("/account_list",name="account_list")
     * @return Response
     */
    public function listAction()
    {
        return $this->render('account_list.html.twig');
    }
}