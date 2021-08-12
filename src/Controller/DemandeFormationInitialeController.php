<?php

namespace App\Controller;

use App\Entity\DemandeFormationInitiale;
use App\Form\DemandeFormationInitialeType;
use App\Repository\DemandeFormationInitialeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/demande/formationinitiale")
 */
class DemandeFormationInitialeController extends AbstractController
{
    /**
     * @Route("/", name="demande_formation_initiale_index", methods={"GET"})
     */
    public function index(DemandeFormationInitialeRepository $demandeFormationInitialeRepository): Response
    {
        return $this->render('Front/demande_formation_initiale/index.html.twig', [
            'demande_formation_initiales' => $demandeFormationInitialeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="demande_formation_initiale_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $demandeFormationInitiale = new DemandeFormationInitiale();
        $form = $this->createForm(DemandeFormationInitialeType::class, $demandeFormationInitiale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($demandeFormationInitiale);
            $entityManager->flush();

            return $this->redirectToRoute('demande_formation_initiale_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Front/demande_formation_initiale/new.html.twig', [
            'demande_formation_initiale' => $demandeFormationInitiale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="demande_formation_initiale_show", methods={"GET"})
     */
    public function show(DemandeFormationInitiale $demandeFormationInitiale): Response
    {
        return $this->render('Front/demande_formation_initiale/show.html.twig', [
            'demande_formation_initiale' => $demandeFormationInitiale,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="demande_formation_initiale_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DemandeFormationInitiale $demandeFormationInitiale): Response
    {
        $form = $this->createForm(DemandeFormationInitialeType::class, $demandeFormationInitiale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('demande_formation_initiale_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Front/demande_formation_initiale/edit.html.twig', [
            'demande_formation_initiale' => $demandeFormationInitiale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="demande_formation_initiale_delete", methods={"POST"})
     */
    public function delete(Request $request, DemandeFormationInitiale $demandeFormationInitiale): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandeFormationInitiale->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($demandeFormationInitiale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('demande_formation_initiale_index', [], Response::HTTP_SEE_OTHER);
    }
}
