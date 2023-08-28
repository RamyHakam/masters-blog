<?php

namespace App\Service;

use App\Contract\UploadFileInterface;
use App\Entity\Account;
use App\Repository\AccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AccountDataService
{
    /**
     * @var UploadFileInterface
     */
    private UploadFileInterface  $uploadFile;
    private AccountRepository $accountRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(UploadFileInterface $uploadFile , AccountRepository  $accountRepository,EntityManagerInterface  $entityManager)
    {
        $this->uploadFile = $uploadFile;
        $this->accountRepository = $accountRepository;
        $this->entityManager = $entityManager;
    }

    public function getUserData(?Account $user = null ): ?Account
    {
        return $this->accountRepository->findAll()[0];
    }

    public function updateAccount(Account  $account)
    {
        $this->entityManager->persist($account);
        $this->entityManager->flush();
    }
}