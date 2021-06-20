<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationLangueController extends AbstractController
{
    /**
     * @Route("/formation/langue", name="formation_langue")
     */
    public function index(): Response
    {
        return $this->render('formation_langue/index.html.twig', [
            'controller_name' => 'FormationLangueController',
        ]);
    }
}
