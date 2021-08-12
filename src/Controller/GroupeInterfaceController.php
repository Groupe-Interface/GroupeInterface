<?php

namespace App\Controller;

use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupeInterfaceController extends AbstractController
{
    /**
     * @Route("/groupe/interface", name="groupe_interface")
     */
    public function index(ImageRepository $imageRepository): Response
    {
        return $this->render('Front/groupe_interface/index.html.twig', [
            'controller_name' => 'GroupeInterfaceController',
            'image_1'=>$imageRepository->findOneBy(['nomImage' => 'Groupe_Interface_1'])
        ]);
    }
}
