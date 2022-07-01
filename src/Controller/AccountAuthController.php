<?php


namespace App\Controller;


use App\Entity\Account;
use App\Form\RegisterAccountType;
use App\Form\UserLoginType;
use App\Service\AccountService;
use App\Service\PasswordHasherService;
use App\Service\UploadFileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountAuthController extends  AbstractController
{
    /**
     * @var AccountService
     */
    private $accountService;
    private EntityManagerInterface $entityManager;

    public function __construct(AccountService $accountService ,EntityManagerInterface  $entityManager)
    {
        $this->accountService = $accountService;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/login",name="login_page")
     * @return Response
     */
    public function loginAction( Request  $request)
    {
        $form = $this->createForm(UserLoginType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if($data['email'] ==='test@test.com'&&$data['password']==='test')
            {
                return $this->redirectToRoute('home_page');
            }
            else{
                $this->addFlash('error','Invalid email or password');
                return $this->render('login.html.twig', [
                    'form' => $form->createView()
                ]);
            }
        }
        return $this->render('login.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/register",name="register_page")
     * @return Response
     */
    public function registerAction(Request  $request, PasswordHasherService  $passwordHasher, UploadFileService  $uploadFileService)
    {
        $form = $this->createForm(RegisterAccountType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userPhoto = $form->get('userPhoto')->getData();
            $userPhotoName = $uploadFileService->upload($userPhoto);
            $plainPassword = $form->get('plainPassword')->getData();
            /** @var Account $userAccountData */
            $userAccountData = $form->getData();
            $userAccountData->setPassword($passwordHasher->hashPassword($plainPassword));
            $userAccountData->setAvatar($userPhotoName);
            $this->entityManager->persist($userAccountData);
            $this->entityManager->flush();
            return $this->redirectToRoute('home_page');
        }
        return $this->render('register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/forget_password",name="forget_password_page")
     * @return Response
     */
    public function forgetPasswordAction()
    {
        return $this->render('forget_password.html.twig');
    }
}