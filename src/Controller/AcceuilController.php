<?php

namespace App\Controller;

use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    /**
     * @Route("/", name="acceuil")
     */
    public function index(ImageRepository $imageRepository): Response
    {
        $date=new \DateTime('now');
        $m=$date->format('m');
        $y= $date->format('y');


        return $this->render('Front/acceuil/index.html.twig', [
            'controller_name' => 'AcceuilController',
            'moisSysteme'=>$m,
            'yearSysteme'=>$y,
            'images'=>$imageRepository->findAll()


        ]);
    }
}
