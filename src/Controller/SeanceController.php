<?php

namespace App\Controller;

use App\Entity\Seance;
use App\Form\SeanceType;
use App\Repository\ClasseRepository;
use App\Repository\EtudiantRepository;
use App\Repository\SeanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SeanceController extends AbstractController
{
    /**
     * @Route("/seance/admin", name="admin_seance_index", methods={"GET"})
     */
    public function index(SeanceRepository $seanceRepository): Response
    {
        return $this->render('Back/seance/index.html.twig', [
            'seances' => $seanceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/seance/new/admin", name="admin_seance_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $seance = new Seance();
        $form = $this->createForm(SeanceType::class, $seance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($seance);
            $entityManager->flush();

            return $this->redirectToRoute('admin_seance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/seance/new.html.twig', [
            'seance' => $seance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/seance/{id}/admin", name="admin_seance_show", methods={"GET"})
     */
    public function show(Seance $seance): Response
    {
        return $this->render('Back/seance/show.html.twig', [
            'seance' => $seance,
        ]);
    }
    /**
     * @Route("/seance/{id}/enseignant", name="enseignant_seance_show", methods={"GET"})
     */
    public function showEnseignant(Seance $seance,ClasseRepository $classeRepository,EtudiantRepository $etudiantRepository): Response
    {

        return $this->render('Back/seance/show.html.twig', [
            'seance' => $seance,
            'etudiants'=>$etudiantRepository->findAll(),
            'classes'=>$classeRepository->findAll()
        ]);
    }

    /**
     * @Route("/seance/{id}/edit/admin", name="admin_seance_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Seance $seance): Response
    {
        $form = $this->createForm(SeanceType::class, $seance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_seance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/seance/edit.html.twig', [
            'seance' => $seance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/seance/{id}/admin", name="admin_seance_delete", methods={"POST"})
     */
    public function delete(Request $request, Seance $seance): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seance->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($seance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_seance_index', [], Response::HTTP_SEE_OTHER);
    }
}
