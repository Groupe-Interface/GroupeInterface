<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    /**
     * @Route("/", name="acceuil")
     */
    public function index(): Response
    {
        //$date=new \DateTime('now');
       // $date('h:i');
        return $this->render('Front/acceuil/index.html.twig', [
            'controller_name' => 'AcceuilController',
        ]);
    }
}
