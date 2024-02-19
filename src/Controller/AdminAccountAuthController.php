<?php


namespace App\Controller;


use App\Form\UserLoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter;
use Symfony\Component\Security\Core\Security;

#[Route(path: '/admin')]
class AdminAccountAuthController extends AbstractController
{
    #[Route(path: '/login', name: 'admin_login')]
    public function loginAction( Request $request, Security $security): Response
    {
        if ($security->isGranted(AuthenticatedVoter::IS_AUTHENTICATED_REMEMBERED)) {
            return $this->redirectToRoute('account_list');
        }
        $form = $this->createForm(UserLoginType::class);
        return $this->render('admin.login.html.twig', [
            'form' => $form->createView()
        ]);
    }
}