<?php

namespace App\Controller;

use App\Entity\Abscence;
use App\Entity\Etudiant;
use App\Entity\Seance;
use App\Form\AbscenceType;
use App\Repository\AbscenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/abscence")
 */
class AbscenceController extends AbstractController
{
    /**
     * @Route("/", name="abscence_index", methods={"GET"})
     */
    public function index(AbscenceRepository $abscenceRepository): Response
    {
        return $this->render('Back/abscence/index.html.twig', [
            'abscences' => $abscenceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/etudiant/{ide}/seance/{id}", name="abscence_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {

        $abscence = new Abscence();
       $form = $this->createForm(AbscenceType::class, $abscence);

        $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
            
           $entityManager = $this->getDoctrine()->getManager();
           $etudiant = $entityManager->getRepository(Etudiant::class)->find($request->get('ide'));
           $seance = $entityManager->getRepository(Seance::class)->find($request->get('id'));

           $abscence->setIdSeance($seance);
           $abscence->setIdEtudiant($etudiant);

            $entityManager->persist($abscence);

            $entityManager->flush();

           return $this->redirectToRoute('abscence_index', [], Response::HTTP_SEE_OTHER);
         }

        return $this->render('Back/abscence/new.html.twig', [
         'abscence' => $abscence,
          'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="abscence_show", methods={"GET"})
     */
    public function show(Abscence $abscence): Response
    {
        return $this->render('Back/abscence/show.html.twig', [
            'abscence' => $abscence,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="abscence_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Abscence $abscence): Response
    {
        $form = $this->createForm(AbscenceType::class, $abscence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('abscence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/abscence/edit.html.twig', [
            'abscence' => $abscence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="abscence_delete", methods={"POST"})
     */
    public function delete(Request $request, Abscence $abscence): Response
    {
        if ($this->isCsrfTokenValid('delete'.$abscence->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($abscence);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Back/abscence_index', [], Response::HTTP_SEE_OTHER);
    }
}
