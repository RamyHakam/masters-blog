<?php

namespace App\Service;

use App\Entity\AbstractUser;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;
use Throwable;

class ResetPasswordService
{
    public function __construct( private ResetPasswordHelperInterface $resetPasswordHelper,private  MailerInterface $mailer, private  LoggerInterface $logger)
    {
    }

    public function sendResetPasswordEmail( AbstractUser $user): void
    {
        try {
            $resetToken = $this->resetPasswordHelper->generateResetToken($user);
            $email = (new TemplatedEmail())
                ->from(new Address('admin@mastersblog.com', 'Master Admin'))
                ->to($user->getEmail())
                ->subject('Your password reset request')
                ->htmlTemplate($user->isAdmin()? 'reset_password/admin_reset_email.html.twig' : 'reset_password/email.html.twig')
                ->context([
                    'resetToken' => $resetToken,
                ])
            ;
            $this->mailer->send($email);
        }
        catch (Throwable $e) {
            $this->logger->error(sprintf("Error in sending password reset email: %s", $e->getMessage()));
        }
    }
}