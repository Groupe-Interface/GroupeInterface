<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationContinueController extends AbstractController
{
    /**
     * @Route("/formation/continue", name="formation_continue")
     */
    public function index(): Response
    {
        return $this->render('Front/formation_continue/index.html.twig', [
            'controller_name' => 'FormationContinueController',
        ]);
    }
}
