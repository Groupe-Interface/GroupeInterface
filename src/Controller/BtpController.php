<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BtpController extends AbstractController
{
    /**
     * @Route("/btp", name="btp")
     */
    public function index(): Response
    {
        return $this->render('btp/index.html.twig', [
            'controller_name' => 'BtpController',
        ]);
    }
}
