<?php

namespace App\Controller;

use App\Entity\Specialite;
use App\Form\SpecialiteType;
use App\Repository\SpecialiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SpecialiteController extends AbstractController
{
    /**
     * @Route("/specialite/admin", name="admin_specialite_index", methods={"GET"})
     */
    public function index(SpecialiteRepository $specialiteRepository): Response
    {
        return $this->render('Back/specialite/index.html.twig', [
            'specialites' => $specialiteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/specialite/new/admin", name="admin_specialite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $specialite = new Specialite();
        $form = $this->createForm(SpecialiteType::class, $specialite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($specialite);
            $entityManager->flush();

            return $this->redirectToRoute('admin_specialite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/specialite/new.html.twig', [
            'specialite' => $specialite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/specialite/{id}/admin", name="admin_specialite_show", methods={"GET"})
     */
    public function show(Specialite $specialite): Response
    {
        return $this->render('Back/specialite/show.html.twig', [
            'specialite' => $specialite,
        ]);
    }

    /**
     * @Route("/specialite/{id}/edit/admin", name="admin_specialite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Specialite $specialite): Response
    {
        $form = $this->createForm(SpecialiteType::class, $specialite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_specialite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/specialite/edit.html.twig', [
            'specialite' => $specialite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/specialite/{id}/admin", name="admin_specialite_delete", methods={"POST"})
     */
    public function delete(Request $request, Specialite $specialite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$specialite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($specialite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_specialite_index', [], Response::HTTP_SEE_OTHER);
    }
}
