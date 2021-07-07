<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupeInterfaceController extends AbstractController
{
    /**
     * @Route("/groupe/interface", name="groupe_interface")
     */
    public function index(): Response
    {
        return $this->render('Front/groupe_interface/index.html.twig', [
            'controller_name' => 'GroupeInterfaceController',
        ]);
    }
}
