<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends  AbstractController
{
    /**
     * @Route("/profile",name="profile_page")
     * @return Response
     */
    public function viewProfile()
    {
      return  $this->render('profile.html.twig');
    }
}