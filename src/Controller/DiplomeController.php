<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiplomeController extends AbstractController
{
    /**
     * @Route("/diplome", name="diplome")
     */
    public function index(): Response
    {
        return $this->render('Front/diplome/index.html.twig', [
            'controller_name' => 'DiplomeController',
        ]);
    }
}
