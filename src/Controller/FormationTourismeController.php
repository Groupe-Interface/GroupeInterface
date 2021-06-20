<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationTourismeController extends AbstractController
{
    /**
     * @Route("/formation/tourisme", name="formation_tourisme")
     */
    public function index(): Response
    {
        return $this->render('formation_tourisme/index.html.twig', [
            'controller_name' => 'FormationTourismeController',
        ]);
    }
}
