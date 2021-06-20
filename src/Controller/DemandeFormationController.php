<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemandeFormationController extends AbstractController
{
    /**
     * @Route("/demande/formation", name="demande_formation")
     */
    public function index(): Response
    {
        return $this->render('demande_formation/index.html.twig', [
            'controller_name' => 'DemandeFormationController',
        ]);
    }
}
