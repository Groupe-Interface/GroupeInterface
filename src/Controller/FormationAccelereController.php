<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationAccelereController extends AbstractController
{
    /**
     * @Route("/formation/accelere", name="formation_accelere")
     */
    public function index(): Response
    {
        return $this->render('Front/formation_accelere/index.html.twig', [
            'controller_name' => 'FormationAccelereController',
        ]);
    }
}
