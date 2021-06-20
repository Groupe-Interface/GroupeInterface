<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BtsController extends AbstractController
{
    /**
     * @Route("/bts", name="bts")
     */
    public function index(): Response
    {
        return $this->render('bts/index.html.twig', [
            'controller_name' => 'BtsController',
        ]);
    }
}
