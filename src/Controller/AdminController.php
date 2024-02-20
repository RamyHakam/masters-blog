<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin')]
#[Security('is_granted("ROLE_ADMIN")')]
class AdminController extends  AbstractController
{
    #[Route(path: '/account_list', name: 'account_list')]
    public function listAction(): Response
    {
        return $this->render('account_list.html.twig');
    }

    #[Route(path: '/list-deleted', name: 'list_delete_posts_request')]
    public function listDeleteRequestAction(): Response
    {
        return $this->render('delete_request.html.twig');
    }

}