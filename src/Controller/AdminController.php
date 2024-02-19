<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin')]
class AdminController extends  AbstractController
{
    #[Route(path: '/account_list', name: 'account_list')]
    #[Security('is_granted("IS_AUTHENTICATED")')]
    public function listAction(): Response
    {
        return $this->render('account_list.html.twig');
    }

}