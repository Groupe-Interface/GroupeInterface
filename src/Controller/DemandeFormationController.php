<?php

namespace App\Controller;

use App\Entity\DemandeFormation;
use App\Form\DemandeFormationType;
use App\Repository\DemandeFormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/demande/formation")
 */
class DemandeFormationController extends AbstractController
{
    /**
     * @Route("/index", name="demande_formation_index", methods={"GET"})
     */
    public function index(DemandeFormationRepository $demandeFormationRepository): Response
    {
        return $this->render('Front/demande_formation/index.html.twig', [
            'demande_formations' => $demandeFormationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/", name="demande_formation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $demandeFormation = new DemandeFormation();
        $form = $this->createForm(DemandeFormationType::class, $demandeFormation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($demandeFormation);
            $entityManager->flush();

            return $this->redirectToRoute('demande_formation_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Front/demande_formation/new.html.twig', [
            'demande_formation' => $demandeFormation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="demande_formation_show", methods={"GET"})
     */
    public function show(DemandeFormation $demandeFormation): Response
    {
        return $this->render('Front/demande_formation/show.html.twig', [
            'demande_formation' => $demandeFormation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="demande_formation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DemandeFormation $demandeFormation): Response
    {
        $form = $this->createForm(DemandeFormationType::class, $demandeFormation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('demande_formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Front/demande_formation/edit.html.twig', [
            'demande_formation' => $demandeFormation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="demande_formation_delete", methods={"POST"})
     */
    public function delete(Request $request, DemandeFormation $demandeFormation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandeFormation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($demandeFormation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('demande_formation_index', [], Response::HTTP_SEE_OTHER);
    }
}
