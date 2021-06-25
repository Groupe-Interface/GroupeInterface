<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationArtDesignController extends AbstractController
{
    /**
     * @Route("/formation/art/design", name="formation_art_design")
     */
    public function index(): Response
    {
        return $this->render('formation_art_design/index.html.twig', [
            'controller_name' => 'FormationArtDesignController',
        ]);
    }
}
