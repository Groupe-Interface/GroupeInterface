<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Matiere;
use App\Entity\Publication;
use App\Form\CoursType;
use App\Form\MatiereType;
use App\Form\PublicationType;
use App\Repository\ClasseRepository;
use App\Repository\CoursRepository;
use App\Repository\EtudiantRepository;
use App\Repository\MatiereRepository;
use App\Repository\PublicationRepository;
use App\Repository\SpecialiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/matiere")
 */
class MatiereController extends AbstractController
{
    /**
     * @Route("/", name="matiere_index", methods={"GET"})
     */
    public function index(MatiereRepository $matiereRepository,EtudiantRepository $etudiantRepository,SpecialiteRepository $specialiteRepository, ClasseRepository  $classeRepository): Response
    {   $classe=null;
        $roles = $this->getUser()->getRoles();
        if ($roles[0] == 'ROLE_ETUDIANT')
        {   $user= $this->getUser();
            $email=$user->getEmail();


            foreach($etudiantRepository->findAll() as $service)
            {
                if ($email == $service->getEmailEtudiant()){
                  $classe= $service->getClasse();

                }
            }
        }

        return $this->render('Back/matiere/index.html.twig', [
            'matieres' => $matiereRepository->findAll(),
            'classe'=>$classe,
            'specialites' => $specialiteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="matiere_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $matiere = new Matiere();
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $matiere->setMoyenneMatiere(0);
            $matiere->setNoteExamen(0);
            $matiere->setNoteTest(0);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($matiere);
            $entityManager->flush();

            return $this->redirectToRoute('matiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/matiere/new.html.twig', [
            'matiere' => $matiere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="matiere_show", methods={"GET","POST"})
     */
    public function show(Matiere $matiere,Request $request,CoursRepository $coursRepository): Response
    {
        //form Ajout d'un cours
        $cour = new Cours();
        $formcour = $this->createForm(CoursType::class, $cour);
        $formcour->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();

        if ($formcour->isSubmitted() && $formcour->isValid()) {
            $file = $cour->getSupportCours();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $matiere = $entityManager->getRepository(Matiere::class)->find($request->get('matiere'));
            $cour->setMatiere($matiere) ;
            $file->move($this->getParameter('upload_directory'),$fileName);
            $cour->setSupportCours($fileName);
            $cour->setDateCours(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cour);
            $entityManager->flush();

            return $this->redirectToRoute('matiere_show', array('id'=>$matiere->getId()));
        }

        return $this->render('Back/matiere/show.html.twig', [
            'matiere' => $matiere,
            'cours' => $coursRepository->findAll(),
            'cour' => $cour,
            'formcour' => $formcour->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="matiere_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Matiere $matiere): Response
    {
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('matiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/matiere/edit.html.twig', [
            'matiere' => $matiere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="matiere_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Matiere $matiere): Response
    {
        if ($this->isCsrfTokenValid('delete'.$matiere->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($matiere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('matiere_index', [], Response::HTTP_SEE_OTHER);
    }
}
