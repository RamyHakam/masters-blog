<?php

namespace App\Service;

use App\Contract\UploadFileInterface;
use App\Entity\Account;
use App\Repository\AccountRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class AccountDataService
{
    /**
     * @var UploadFileInterface
     */
    private UploadFileInterface  $uploadFile;
    private AccountRepository $accountRepository;

    public function __construct(UploadFileInterface $uploadFile , AccountRepository  $accountRepository)
    {
        $this->uploadFile = $uploadFile;
        $this->accountRepository = $accountRepository;
    }

    public function getUserData(?Account $user = null ): ?Account
    {
        return $this->accountRepository->find(1);
    }

    public function updateUserData()
    {

    }

}