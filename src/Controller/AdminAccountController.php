<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 */
#[Route(path: '/admin')]
class AdminAccountController extends AbstractController
{

    /**
     * @return Response
     */
    #[Route(path: '/login', name: 'admin_login')]
    public function loginAction()
    {
        return $this->render('admin.login.html.twig');
    }

}