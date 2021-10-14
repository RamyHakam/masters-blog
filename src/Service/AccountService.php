<?php

namespace App\Service;

use Symfony\Component\Security\Core\User\UserInterface;

class AccountService
{
    /**
     * @var SendEmailService
     */
    private $emailService;

    public function __construct(SendEmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function registerNewUser()
    {
    }

    public function forgetPassword()
    {

    }

}