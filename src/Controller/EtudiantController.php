<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\Users;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class EtudiantController extends AbstractController
{
    /**
     * @Route("/etudiant/admin", name="admin_etudiant_index", methods={"GET"})
     */
    public function index(EtudiantRepository $etudiantRepository): Response
    {
        return $this->render('Back/etudiant/index.html.twig', [
            'etudiants' => $etudiantRepository->findAll(),
        ]);
    }

    /**
     * @
     * @Route("/etudiant/new/admin", name="admin_etudiant_new", methods={"GET","POST"})
     */
    public function new(Request $request,UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $etudiant = new Etudiant();
        $user =new Users();
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setEmail($etudiant->getEmailEtudiant());
            //$user->setPassword($etudiant->getCin());



            $user->setRoles(["ROLE_ETUDIANT"]);
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('cin')->getData()
                )
            );
            $entityManager1 = $this->getDoctrine()->getManager();
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($etudiant);
            $entityManager1->persist($user);

            $entityManager1->flush();
            $entityManager->flush();

            return $this->redirectToRoute('admin_etudiant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/etudiant/new.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/etudiant/{id}/admin", name="admin_etudiant_show", methods={"GET"})
     */
    public function show(Etudiant $etudiant): Response
    {
        return $this->render('Back/etudiant/show.html.twig', [
            'etudiant' => $etudiant,
        ]);
    }

    /**
     * @Route("/etudiant/{id}/edit/admin", name="admin_etudiant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Etudiant $etudiant): Response
    {
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_etudiant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/etudiant/edit.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/etudiant/{id}/admin", name="admin_etudiant_delete", methods={"POST"})
     */
    public function delete(Request $request, Etudiant $etudiant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etudiant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($etudiant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_etudiant_index', [], Response::HTTP_SEE_OTHER);
    }
}
