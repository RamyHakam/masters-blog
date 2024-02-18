<?php


namespace App\Controller;


use App\Service\AccountDataService;
use App\Service\NotificationService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends AbstractController
{

    #[Route(path: '/notification', name: 'notification_page')]
    #[Security('is_granted("IS_AUTHENTICATED")')]
    public function listAction(NotificationService  $notificationService): Response
    {
        $notificationList = $notificationService->fetchNotification($this->getUser());
        return $this->render('notifications.html.twig',['notificationList'=>$notificationList,'account' => $this->getUser()]);
    }
}