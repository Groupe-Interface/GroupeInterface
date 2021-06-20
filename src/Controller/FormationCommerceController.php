<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationCommerceController extends AbstractController
{
    /**
     * @Route("/formation/commerce", name="formation_commerce")
     */
    public function index(): Response
    {
        return $this->render('formation_commerce/index.html.twig', [
            'controller_name' => 'FormationCommerceController',
        ]);
    }
}
