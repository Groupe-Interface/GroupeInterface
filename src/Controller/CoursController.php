<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Matiere;
use App\Entity\Publication;
use App\Form\CoursType;
use App\Form\PublicationType;
use App\Repository\CoursRepository;
use App\Repository\PublicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cours")
 */
class CoursController extends AbstractController
{
    /**
     * @Route("/", name="cours_index", methods={"GET"})
     */
    public function index(CoursRepository $coursRepository): Response
    {
        return $this->render('Back/cours/index.html.twig', [
            'cours' => $coursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cours_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cour = new Cours();
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $cour->getSupportCours();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'),$fileName);
            $cour->setSupportCours($fileName);
            $cour->setDateCours(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cour);
            $entityManager->flush();

            return $this->redirectToRoute('cours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/cours/new.html.twig', [
            'cour' => $cour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cours_show", methods={"GET","POST"})
     */
    public function show(Cours $cour,Request $request,PublicationRepository  $publicationRepository): Response
    {
        //$entityManager = $this->getDoctrine()->getManager();
        $publication = new Publication();
        $formpub = $this->createForm(PublicationType::class, $publication);
        $formpub->handleRequest($request);
       $matiere=$cour->getMatiere();


        if ($formpub->isSubmitted() && $formpub->isValid()) {
            $publication->setCours($cour);

            $publication->setDatePublication(new \DateTime('now'));
            $publication->setNbComment(0);
            $publication->setNbVue(0);
            $entityManager = $this->getDoctrine()->getManager();

           // $cour = $entityManager->getRepository(Cours::class)->find($request->get('Cours'));
            $entityManager->persist($publication);
            $entityManager->flush();

            return $this->redirectToRoute('cours_show', array('id'=>$cour->getId()));
        }

        return $this->render('Back/cours/show.html.twig', [
            'cour' => $cour,
            'formpub' => $formpub->createView(),
            'publications'=>$publicationRepository->findAll(),
            'publication'=>$publication,
            'matiere'=>$matiere,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cours_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cours $cour): Response
    {
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);
$matiere = $cour->getMatiere();
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('matiere_show', array('id'=>$matiere->getId()));
        }

        return $this->render('Back/cours/edit.html.twig', [
            'cour' => $cour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cours_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cours $cour): Response
    {
        $matiere = $cour->getMatiere();
        if ($this->isCsrfTokenValid('delete'.$cour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('matiere_show', array('id'=>$matiere->getId()));
    }
}
