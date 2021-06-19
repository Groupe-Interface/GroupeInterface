<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GaleriePhotosController extends AbstractController
{
    /**
     * @Route("/galerie/photos", name="galerie_photos")
     */
    public function index(): Response
    {
        return $this->render('galerie_photos/index.html.twig', [
            'controller_name' => 'GaleriePhotosController',
        ]);
    }
}
