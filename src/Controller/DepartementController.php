<?php

namespace App\Controller;

use App\Entity\Departement;
use App\Form\DepartementType;
use App\Repository\DepartementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DepartementController extends AbstractController
{
    /**
     * @Route("/departement/admin", name="admin_departement_index", methods={"GET"})
     */
    public function index(DepartementRepository $departementRepository): Response
    {
        return $this->render('Back/departement/index.html.twig', [
            'departements' => $departementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/departement/new/admin", name="admin_departement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $departement = new Departement();
        $form = $this->createForm(DepartementType::class, $departement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($departement);
            $entityManager->flush();

            return $this->redirectToRoute('admin_departement_index');
        }

        return $this->render('Back/departement/new.html.twig', [
            'departement' => $departement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/departement/{id}/admin", name="admin_departement_show", methods={"GET"})
     */
    public function show(Departement $departement): Response
    {
        return $this->render('Back/departement/show.html.twig', [
            'departement' => $departement,
        ]);
    }

    /**
     * @Route("/departement/{id}/edit/admin", name="admin_departement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Departement $departement): Response
    {
        $form = $this->createForm(DepartementType::class, $departement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_departement_index');
        }

        return $this->render('Back/departement/edit.html.twig', [
            'departement' => $departement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/departement/{id}/admin", name="admin_departement_delete", methods={"POST"})
     */
    public function delete(Request $request, Departement $departement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$departement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($departement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_departement_index');
    }
}
