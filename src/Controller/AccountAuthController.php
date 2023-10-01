<?php


namespace App\Controller;


use App\Entity\Account;
use App\Form\ForgetPasswordType;
use App\Form\AccountType;
use App\Form\UserLoginType;
use App\Security\EmailVerifier;
use App\Service\AccountService;
use App\Service\PasswordHasherService;
use App\Service\UploadFileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\FormLoginAuthenticator;

class AccountAuthController extends AbstractController
{
    /**
     * @var AccountService
     */
    private $accountService;
    private EntityManagerInterface $entityManager;
    private EmailVerifier $emailVerifier;

    public function __construct(AccountService $accountService, EntityManagerInterface $entityManager, EmailVerifier $emailVerifier)
    {
        $this->accountService = $accountService;
        $this->entityManager = $entityManager;
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @Route("/login",name="login_page")
     * @return Response
     */
    public function loginAction(Request $request, Security $security): Response
    {
        if ($security->isGranted(AuthenticatedVoter::IS_AUTHENTICATED_REMEMBERED)) {
            return $this->redirectToRoute('home_page');
        }
        $form = $this->createForm(UserLoginType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            // log the user to db
            return $this->redirectToRoute('home_page');
        }
        return $this->render('login.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/register",name="register_page")
     * @return Response
     */
    public function registerAction(
        Request                     $request,
        UserPasswordHasherInterface $passwordHasher,
        UploadFileService           $uploadFileService,
        UserAuthenticatorInterface  $userAuthenticator,
        FormLoginAuthenticator      $formLoginAuthenticator): Response
    {
        $form = $this->createForm(AccountType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $userPhoto = $form->get('userPhoto')->getData();
                $userPhotoName = $uploadFileService->upload($userPhoto, UploadFileService::avatarType);
                $plainPassword = $form->get('plainPassword')->getData();
                /** @var Account $userAccountData */
                $userAccountData = $form->getData();
                $userAccountData->setPassword($passwordHasher->hashPassword($userAccountData, $plainPassword));
                $userAccountData->setAvatar($userPhotoName);
                $this->entityManager->persist($userAccountData);
                $this->entityManager->flush();

               $this->emailVerifier->sendEmailConfirmation('verify_email_page', $userAccountData,
                        (new TemplatedEmail())
                            ->from(new Address('  master@masterblog.com  ', 'Master Blog'))
                   ->to($userAccountData->getEmail())
                     ->subject('Please Confirm your Email')
                        ->htmlTemplate('registration/confirmation_email.html.twig'));

                $this->addFlash('success','Verification email has been sent to your email');
                return $userAuthenticator->authenticateUser(
                    $userAccountData,
                    $formLoginAuthenticator,
                    $request
                );
            } else {
                $errors = $form->getErrors(true);
                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }

        }
        return $this->render('register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/forget_password",name="forget_password_page")
     * @return Response
     */
    public function forgetPasswordAction(Request $request)
    {
        $form = $this->createForm(ForgetPasswordType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $account = $this->accountService->getAccountByEmail($data['email']);
            if ($account) {
                $this->accountService->sendPasswordResetLink($account);
                $this->addFlash('success', 'Password reset link has been sent to your email');
                return $this->redirectToRoute('login_page');
            } else {
                $this->addFlash('error', 'Invalid email');
                return $this->render('forget_password.html.twig', [
                    'form' => $form->createView()
                ]);
            }
        }
        return $this->render('forget_password.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/logout",name="logout_page")
     */
    public function logout()
    {
    }

    /**
     * @Route("/send_verification_email",name="send_verification_email")
     */
    public function sendVerificationEmail():  Response
    {
        $this->emailVerifier->sendEmailConfirmation('verify_email_page', $this->getUser(),
            (new TemplatedEmail())
                ->from(new Address('  master@masterblog.com  ', 'Master Blog'))
                ->to($this->getUser()->getEmail())
                ->subject('Please Confirm your Email')
                ->htmlTemplate('registration/confirmation_email.html.twig'));
        $this->addFlash('success','Verification email has been sent to your email');
        return $this->redirectToRoute('home_page');
    }

    /**
     * @Route("/verify_email",name="verify_email_page")
     */
    public function VerifyEmail()
    {

        // TO Do : verify email
    }
}