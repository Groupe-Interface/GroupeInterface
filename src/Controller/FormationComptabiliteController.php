<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationComptabiliteController extends AbstractController
{
    /**
     * @Route("/formation/comptabilite", name="formation_comptabilite")
     */
    public function index(): Response
    {
        return $this->render('Front/formation_comptabilite/index.html.twig', [
            'controller_name' => 'FormationComptabiliteController',
        ]);
    }
}
