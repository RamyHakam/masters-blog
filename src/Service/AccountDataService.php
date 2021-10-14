<?php

namespace App\Service;

use App\Contract\UploadFileInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AccountDataService
{
    /**
     * @var UploadFileInterface
     */
    private $uploadFile;

    public function __construct(UploadFileInterface $uploadFile)
    {
        $this->uploadFile = $uploadFile;
    }

    public function getUserData(UserInterface $user)
    {

    }

    public function updateUserData()
    {

    }

}