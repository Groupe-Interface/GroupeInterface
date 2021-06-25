<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdmissionController extends AbstractController
{
    /**
     * @Route("/admission", name="admission")
     */
    public function index(): Response
    {
        return $this->render('admission/index.html.twig', [
            'controller_name' => 'AdmissionController',
        ]);
    }
}
