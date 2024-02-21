<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\AdminAccount;
use App\Form\AccountType;
use App\Form\AdminAccountType;
use App\Service\ResetPasswordService;
use App\Service\UploadFileService;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin')]
#[Security('is_granted("ROLE_ADMIN")')]
class AdminController extends AbstractController
{
    const adminRole = 'ROLE_ADMIN';
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

    #[Route(path: '/add-admin', name: 'add_admin')]
    #[Security('is_granted("ROLE_SUPER_ADMIN")')]
    public function addNewAdmin(
        Request                     $request,
        UserPasswordHasherInterface $passwordHasher,
        UploadFileService           $uploadFileService,
        EntityManagerInterface      $entityManager,
        ResetPasswordService       $resetPasswordService
    ): Response
    {
        $form = $this->createForm(AdminAccountType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $adminPhoto = $form->get('userPhoto')->getData();
                $adminPhotoName = $uploadFileService->upload($adminPhoto, UploadFileService::avatarType);
                $plainPassword = $form->get('plainPassword')->getData();
                /** @var AdminAccount $adminAccount */
                $adminAccount = $form->getData();
                $adminAccount->setPassword($passwordHasher->hashPassword($adminAccount, $plainPassword));
                $adminAccount->setAvatar($adminPhotoName);
                // add the admin role
                $adminAccount->addRole(self::adminRole);
                $adminAccount->setIsVerified(true);
                $entityManager->persist($adminAccount);
                $entityManager->flush();
                $resetPasswordService->sendResetPasswordEmail($adminAccount);
                $this->addFlash('success', ' new Admin added successfully');
                return $this->redirectToRoute('add_admin');
            } else {
                $errors = $form->getErrors(true);
                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }
        }
        return $this->render('add_admin.html.twig', [
            'form' => $form->createView()
        ]);
    }
}