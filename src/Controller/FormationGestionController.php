<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationGestionController extends AbstractController
{
    /**
     * @Route("/formation/gestion", name="formation_gestion")
     */
    public function index(): Response
    {
        return $this->render('formation_gestion/index.html.twig', [
            'controller_name' => 'FormationGestionController',
        ]);
    }
}
