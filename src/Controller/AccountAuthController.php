<?php


namespace App\Controller;


use App\Form\UserLoginType;
use App\Service\AccountService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountAuthController extends  AbstractController
{
    /**
     * @var AccountService
     */
    private $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * @Route("/login",name="login_page")
     * @return Response
     */
    public function loginAction()
    {
        $form = $this->createForm(UserLoginType::class);

        return $this->render('login.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/register",name="register_page")
     * @return Response
     */
    public function registerAction()
    {
        return $this->render('register.html.twig');
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