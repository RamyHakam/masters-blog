<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountAuthController extends  AbstractController
{
    /**
     * @Route("/login",name="login_page")
     * @return Response
     */
    public function loginAction()
    {
        return $this->render('login.html.twig');
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