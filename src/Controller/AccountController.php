<?php


namespace App\Controller;


use App\Entity\Account;
use App\Form\AccountType;
use App\Service\AccountDataService;
use App\Service\FollowService;
use App\Service\PostService;
use App\Service\UploadFileService;
use \Symfony\Component\HttpFoundation\Request;
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
    public function getProfile(Request  $request,UploadFileService  $uploadFileService)
    {
        $userAccount  = $this->accountDataService->getUserData();
        $form = $this->createForm(AccountType::class,$userAccount);
        $form->remove('plainPassword');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userPhoto = $form->get('userPhoto')->getData();
            if($userPhoto)
            {
                $userPhotoName = $uploadFileService->upload($userPhoto,UploadFileService::avatarType);
                $userAccount->setAvatar($userPhotoName);
            }
            $this->accountDataService->updateAccount($userAccount);
            $this->addFlash('success','Profile updated successfully');
        }
        return $this->render('profile.html.twig',['account'=>$userAccount,'form'=>$form->createView()]);
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