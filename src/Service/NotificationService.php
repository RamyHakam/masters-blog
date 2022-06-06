<?php

namespace App\Service;

use App\Entity\Account;
use App\Repository\NotificationRepository;

class NotificationService
{
    private NotificationRepository $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function fetchNotification(Account  $account) :?array
    {
        return  $this->notificationRepository->findBy(['owner' => $account]);
    }
}