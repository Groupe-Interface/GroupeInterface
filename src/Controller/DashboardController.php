<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\AdminRepository;
use App\Repository\AvisRepository;
use App\Repository\EnseignantRepository;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EtudiantRepository;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard", methods={"GET"})
     */
    public function indexAdmin(EtudiantRepository $etudiantRepository,AdminRepository $adminRepository,Request $request,EnseignantRepository  $enseignantRepository): Response
    {
        $user=$this->getUser();

        //$forum = $entityManager->getRepository(Forum::class)->find($request->get('forum_id'));
      //  return $this->redirectToRoute('home_forum_show',array('id'=>$forum->getId()));
            return $this->render('Back/Profil/profil.html.twig', [
                'user' => $user,
                'etudiants'=>$etudiantRepository->findAll(),
                'enseignants'=>$enseignantRepository->findAll(),
                'admins'=>$adminRepository->findAll()
            ]);


    }
    /**
     * @IsGranted("ROLE_ETUDIANT")
     * @Route("/dashboard/etudiant", name="dashboard_etudiant")
     */
    public function indexEtudiant(ReclamationRepository $reclamationRepository): Response
    {


        return $this->render('Back/reclamation/index.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);


    }
}
