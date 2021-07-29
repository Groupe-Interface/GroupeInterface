<?php

namespace App\Controller;

use App\Entity\Enseignant;
use App\Entity\Users;
use App\Form\EnseignantType;
use App\Repository\ClasseRepository;
use App\Repository\EnseignantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class EnseignantController extends AbstractController
{
    /**
     * @Route("/enseignant/admin/", name="admin_enseignant_index", methods={"GET"})
     */
    public function index(EnseignantRepository $enseignantRepository): Response
    {


        return $this->render('Back/enseignant/index.html.twig', [

            'enseignants' => $enseignantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/enseignant/new/admin", name="admin_enseignant_new", methods={"GET","POST"})
     */
    public function new(Request $request,ClasseRepository $classeRepository,UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user =new Users();
        $enseignant = new Enseignant();
        $form = $this->createForm(EnseignantType::class, $enseignant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setEmail($enseignant->getEmailEnseignant());
            //$user->setPassword($enseignant->getPhoneEnseignant());
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('phoneEnseignant')->getData()
                )
            );
            $user->setRoles(["ROLE_ENSEIGNANT"]);

            $entityManager1 = $this->getDoctrine()->getManager();
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager1->persist($user);
            $entityManager->persist($enseignant);

            $entityManager->flush();
            $entityManager1->flush();

            return $this->redirectToRoute('admin_enseignant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/enseignant/new.html.twig', [
            'enseignant' => $enseignant,
            'form' => $form->createView(),
            'classes'=>$classeRepository->findAll()
        ]);
    }

    /**
     * @Route("/enseignant/{id}/admin", name="admin_enseignant_show", methods={"GET"})
     */
    public function show(int $id): Response
    {
        $enseignant = $this->getDoctrine()
            ->getRepository(Enseignant::class)
            ->findOneByIdJoinedToClasse($id);

        $classe = $enseignant->getClasse();

        return $this->render('Back/enseignant/show.html.twig', [
            'enseignant' => $enseignant,
            'classes'=>$classe,
        ]);
    }

    /**
     * @Route("/enseignant/{id}/edit/admin", name="admin_enseignant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Enseignant $enseignant): Response
    {
        $form = $this->createForm(EnseignantType::class, $enseignant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_enseignant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/enseignant/edit.html.twig', [
            'enseignant' => $enseignant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/enseignant/{id}/admin", name="admin_enseignant_delete", methods={"POST"})
     */
    public function delete(Request $request, Enseignant $enseignant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enseignant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($enseignant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_enseignant_index', [], Response::HTTP_SEE_OTHER);
    }
}
