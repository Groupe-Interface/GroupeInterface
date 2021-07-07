<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationInformatiqueController extends AbstractController
{
    /**
     * @Route("/formation/informatique", name="formation_informatique")
     */
    public function index(): Response
    {
        return $this->render('Front/formation_informatique/index.html.twig', [
            'controller_name' => 'FormationInformatiqueController',
        ]);
    }
}
