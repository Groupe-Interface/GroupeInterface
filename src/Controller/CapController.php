<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CapController extends AbstractController
{
    /**
     * @Route("/cap", name="cap")
     */
    public function index(): Response
    {
        return $this->render('Front/cap/index.html.twig', [
            'controller_name' => 'CapController',
        ]);
    }
}
