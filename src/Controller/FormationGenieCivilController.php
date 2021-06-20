<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationGenieCivilController extends AbstractController
{
    /**
     * @Route("/formation/genie/civil", name="formation_genie_civil")
     */
    public function index(): Response
    {
        return $this->render('formation_genie_civil/index.html.twig', [
            'controller_name' => 'FormationGenieCivilController',
        ]);
    }
}
