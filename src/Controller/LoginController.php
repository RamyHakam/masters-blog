<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends  AbstractController
{
    /**
     * @Route("/login",name="login_page")
     * @return Response
     */
    public function loginAction()
    {
        return $this->render('login.html.twig');
    }
}