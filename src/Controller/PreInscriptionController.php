<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PreInscriptionController extends AbstractController
{
    /**
     * @Route("/pre/inscription", name="pre_inscription")
     */
    public function index(): Response
    {
        return $this->render('pre_inscription/index.html.twig', [
            'controller_name' => 'PreInscriptionController',
        ]);
    }
}
