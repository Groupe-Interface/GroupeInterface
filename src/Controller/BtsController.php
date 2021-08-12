<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BtsController extends AbstractController
{
    /**
     * @Route("/formation/bts/tunisie", name="bts")
     */
    public function index(): Response
    {
        return $this->render('Front/bts/index.html.twig', [
            'controller_name' => 'BtsController',
        ]);
    }
}
