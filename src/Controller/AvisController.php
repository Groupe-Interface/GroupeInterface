<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use App\Repository\AvisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AvisController extends AbstractController
{
    /**
     * @Route("/etudiant/avis/", name="etudiant_avis_index", methods={"GET"})
     */
    public function indexEtudiant(AvisRepository $avisRepository): Response
    {
        return $this->render('Back/avis/index.html.twig', [
            'avis' => $avisRepository->findAll(),
        ]);
    }
    /**
     * @Route("/enseignant/avis/", name="enseignant_avis_index", methods={"GET"})
     */
    public function indexEnseignant(AvisRepository $avisRepository): Response
    {
        return $this->render('Back/avis/index.html.twig', [
            'avis' => $avisRepository->findAll(),
        ]);
    }
    /**
     * @Route("/admin/avis/", name="admin_avis_index", methods={"GET"})
     */
    public function indexAdmin(AvisRepository $avisRepository): Response
    {
        return $this->render('Back/avis/index.html.twig', [
            'avis' => $avisRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/avis/new", name="admin_avis_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $avi = new Avis();
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avi->setDateAvis(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($avi);
            $entityManager->flush();

            return $this->redirectToRoute('admin_avis_index');
        }

        return $this->render('Back/avis/new.html.twig', [
            'avi' => $avi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/avis/{id}", name="admin_avis_show", methods={"GET"})
     */
    public function show(Avis $avi): Response
    {
        return $this->render('Back/avis/show.html.twig', [
            'avi' => $avi,
        ]);
    }

    /**
     * @Route("/admin/avis/{id}/edit", name="admin_avis_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Avis $avi): Response
    {
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_avis_index');
        }

        return $this->render('Back/avis/edit.html.twig', [
            'avi' => $avi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/avis/{id}", name="admin_avis_delete", methods={"POST"})
     */
    public function delete(Request $request, Avis $avi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($avi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_avis_index');
    }
}
