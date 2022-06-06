<?php


namespace App\Controller;


use App\Entity\Account;
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
    private PostService  $postService;
    /**
     * @var AccountDataService
     */
    private  AccountDataService  $accountDataService;
    /**
     * @var FollowService
     */
    private FollowService  $followService;

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
        $userAccount  = $this->accountDataService->getUserData();
        return $this->render('profile.html.twig',['account'=>$userAccount]);
    }

    /**
     * @Route("/profile/{id}",name="profile_page_view")
     * @return Response
     */
    public function viewProfile(Account $account)
    {
        return $this->render('profile_view.html.twig', ['account' => $account]);
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