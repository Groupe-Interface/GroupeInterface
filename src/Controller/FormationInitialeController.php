<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationInitialeController extends AbstractController
{
    /**
     * @Route("/formation/initiale", name="formation_initiale")
     */
    public function index(): Response
    {
        return $this->render('formation_initiale/index.html.twig', [
            'controller_name' => 'FormationInitialeController',
        ]);
    }
}
