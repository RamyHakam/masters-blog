<?php


namespace App\Controller;


use App\Service\NotificationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends AbstractController
{
    /**
     * @Route("/notification",name="notification_page")
     * @return Response
     */
    public function listAction(NotificationService  $notificationService)
    {
        return $this->render('notifications.html.twig');
    }
}