<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends  AbstractController
{
    /**
     * @Route("/home", name="home_page")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function Home()
    {
       return $this->render('home.html.twig');
    }

}