<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin')]
class AdminAccountController extends AbstractController
{

    #[Route(path: '/login', name: 'admin_login')]
    public function loginAction(): Response
    {
        return $this->render('admin.login.html.twig');
    }
}