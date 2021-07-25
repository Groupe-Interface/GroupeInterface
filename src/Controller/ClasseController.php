<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Entity\Enseignant;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use App\Repository\EnseignantRepository;
use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/classe")
 */
class ClasseController extends AbstractController
{
    /**
     * @Route("/", name="classe_index", methods={"GET"})
     */
    public function index(ClasseRepository $classeRepository,EnseignantRepository $enseignantRepository,EtudiantRepository $etudiantRepository,Request $request): Response
    {$classe= null;
        $user= $this->getUser();
        $email=$user->getEmail();


        foreach($enseignantRepository->findAll() as $service)
        {
          if ($email == $service->getEmailEnseignant()){
              $enseignant = $this->getDoctrine()
                  ->getRepository(Enseignant::class)
                  ->findOneByIdJoinedToClasse($service->getId());

              $classe = $enseignant->getClasse();

          }

        }

        return $this->render('Back/classe/index.html.twig', [

            'etudiants' => $etudiantRepository->findAll(),
            'enseignants' => $enseignantRepository->findAll(),
            'classes' => $classe
        ]);
    }

    /**
     * @Route("/new", name="classe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($classe);
            $entityManager->flush();

            return $this->redirectToRoute('classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/classe/new.html.twig', [
            'classe' => $classe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="classe_show", methods={"GET"})
     */
    public function show(Classe $classe,EtudiantRepository $etudiantRepository): Response
    {
        return $this->render('Back/classe/show.html.twig', [
            'classe' => $classe,
            'etudiants' => $etudiantRepository->findAll()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="classe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Classe $classe): Response
    {
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/classe/edit.html.twig', [
            'classe' => $classe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="classe_delete", methods={"POST"})
     */
    public function delete(Request $request, Classe $classe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$classe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($classe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('classe_index', [], Response::HTTP_SEE_OTHER);
    }
}
