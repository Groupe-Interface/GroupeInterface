<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\EnseignantRepository;
use App\Repository\EtudiantRepository;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;



class ReclamationController extends AbstractController
{

    //******************* etudiant
    /**
     * @Route("/etudiant/reclamation/", name="etudiant_reclamation_index", methods={"GET"})
     */
    public function indexEtudiant(ReclamationRepository $reclamationRepository,EtudiantRepository $etudiantRepository): Response
    {$user=$this->getUser();
        return $this->render('Back/reclamation/index.html.twig', [
            'user'=>$user,
            'etudiants'=>$etudiantRepository->findAll(),
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }
    /**
     * @Route("/etudiant/reclamation/new", name="etudiant_reclamation_new", methods={"GET","POST"})
     */
    public function newEtudiant(Request $request,EtudiantRepository $etudiantRepository): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);
        $user=$this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setDateReclamation(new \DateTime('now'));
            $reclamation->setUsers($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('etudiant_reclamation_index');
        }

        return $this->render('Back/reclamation/new.html.twig', [
            'user'=>$user,
            'reclamation' => $reclamation,
            'etudiants'=>$etudiantRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/etudiant/reclamation/{id}", name="etudiant_reclamation_show", methods={"GET"})
     */
    public function showEtudiant(Reclamation $reclamation): Response
    {
        return $this->render('Back/reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }
    /**
     * @Route("/etudiant/{id}/edit", name="etudiant_reclamation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reclamation $reclamation): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etudiant_reclamation_index');
        }

        return $this->render('Back/reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/etudiant/reclamation/{id}", name="etudiant_reclamation_delete", methods={"POST"})
     */
    public function delete(Request $request, Reclamation $reclamation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('etudiant_reclamation_index');
    }

    //*****************enseignant
    /**
     * @Route("/enseignant/reclamation/", name="enseignant_reclamation_index", methods={"GET"})
     */
    public function indexEnseignant(ReclamationRepository $reclamationRepository,EnseignantRepository $enseignantRepository): Response
    {$user=$this->getUser();
        return $this->render('Back/reclamation/index.html.twig', [
            'user'=>$user,
            'enseignants'=>$enseignantRepository->findAll(),
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }
    /**
     * @Route("/enseignant/reclamation/new", name="enseignant_reclamation_new", methods={"GET","POST"})
     */
    public function newEnseignant(Request $request,EnseignantRepository $enseignantRepository): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);
        $user=$this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setDateReclamation(new \DateTime('now'));
            $reclamation->setUsers($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('enseignant_reclamation_index');
        }

        return $this->render('Back/reclamation/new.html.twig', [
            'user'=>$user,
            'reclamation' => $reclamation,
            'enseignants'=>$enseignantRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/enseignant/reclamation/{id}", name="enseignant_reclamation_show", methods={"GET"})
     */
    public function showEnseignant(Reclamation $reclamation): Response
    {
        return $this->render('Back/reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }


    /**
     * @Route("/enseignant/{id}/edit", name="enseignant_reclamation_edit", methods={"GET","POST"})
     */
    public function editEnseignant(Request $request, Reclamation $reclamation): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enseignant_reclamation_index');
        }

        return $this->render('Back/reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/enseignant/reclamation/{id}", name="enseignant_reclamation_delete", methods={"POST"})
     */
    public function deleteEnseignant(Request $request, Reclamation $reclamation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('enseignant_reclamation_index');
    }
    //************ admin
    /**
     * @Route("/admin/reclamation/", name="admin_reclamation_index", methods={"GET"})
     */
    public function indexAdmin(ReclamationRepository $reclamationRepository,EnseignantRepository $enseignantRepository,EtudiantRepository $etudiantRepository): Response
    {
        return $this->render('Back/reclamation/index.html.twig', [
            'etudiants'=>$etudiantRepository->findAll(),
            'enseignants'=>$enseignantRepository->findAll(),
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }
    /**
     * @Route("/admin/reclamation/{id}", name="admin_reclamation_show", methods={"GET"})
     */
        public function showAdmin(Reclamation $reclamation): Response
    {
        return $this->render('Back/reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }
    /**
     * @Route("/admin/reclamation/{id}", name="admin_reclamation_delete", methods={"POST"})
     */
    public function deleteAdmin(Request $request, Reclamation $reclamation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_reclamation_index');
    }
    public function __invoke(HubInterface $hub): Response
    {
        $update = new Update(
            'http://example.com/books/1',
            json_encode(['status' => 'OutOfStock'])
        );

        $hub->publish($update);

        return new Response('published!');
    }
}
