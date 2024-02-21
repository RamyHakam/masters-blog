<?php


namespace App\Controller;


use App\Form\ChangePasswordFormType;
use App\Form\UserLoginType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter;
use Symfony\Component\Security\Core\Security;
use SymfonyCasts\Bundle\ResetPassword\Exception\ResetPasswordExceptionInterface;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;

#[Route(path: '/admin')]
class AdminAccountAuthController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    #[Route(path: '/login', name: 'admin_login')]
    public function loginAction(Request $request, Security $security): Response
    {
        if ($security->isGranted(AuthenticatedVoter::IS_AUTHENTICATED_REMEMBERED)) {
            return $this->redirectToRoute('account_list');
        }
        $form = $this->createForm(UserLoginType::class);
        return $this->render('admin.login.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route(path: '/reset_password/{token}', name: 'admin_reset_password')]
    public function resetPasswordAction(Request $request, ResetPasswordHelperInterface $resetPasswordHelper, UserPasswordHasherInterface $passwordHasher, string $token = null): Response
    {
        if (null === $token) {
            throw $this->createNotFoundException('No reset password token found in the URL.');
        }
        try {
            $user = $resetPasswordHelper->validateTokenAndFetchUser($token);
        } catch (ResetPasswordExceptionInterface $e) {
            $this->addFlash('error', sprintf('There was a problem validating your reset request - %s', $e->getReason()));

            return $this->redirectToRoute('add_admin');
        }
        // The token is valid; allow the user to change their password.
        $form = $this->createForm(ChangePasswordFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // A password reset token should be used only once, remove it.
            $resetPasswordHelper->removeResetRequest($token);

            // Encode(hash) the plain password, and set it.
            $encodedPassword = $passwordHasher->hashPassword(
                $user,
                $form->get('plainPassword')->getData()
            );

            $user->setPassword($encodedPassword);
            $this->entityManager->flush();
            $this->addFlash('success', 'Password reset successfully');
            return $this->redirectToRoute('admin_login');
        }
            return $this->render('reset_password/reset.html.twig', [
                'resetForm' => $form->createView(),
            ]);
        }
}