<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 * Class AdminAccountController
 * @package App\Controller
 */
class AdminAccountController extends AbstractController
{

    /**
     * @Route("/login",name="admin_login")
     * @return Response
     */
    public function loginAction()
    {
        return $this->render('admin.login.html.twig');
    }

}