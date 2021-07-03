<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemandeFormationInitialeController extends AbstractController
{
    /**
     * @Route("/demande/formation/initiale", name="demande_formation_initiale")
     */
    public function index(): Response
    {
        return $this->render('demande_formation_initiale/index.html.twig', [
            'controller_name' => 'DemandeFormationInitialeController',
        ]);
    }
}
