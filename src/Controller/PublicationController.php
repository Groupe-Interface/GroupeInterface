<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Cours;
use App\Entity\Enseignant;
use App\Entity\Publication;
use App\Form\CommentaireType;
use App\Form\PublicationType;
use App\Repository\CommentaireRepository;
use App\Repository\EnseignantRepository;
use App\Repository\EtudiantRepository;
use App\Repository\MatiereRepository;
use App\Repository\PublicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\directoryExists;

/**
 * @Route("/publication")
 */
class PublicationController extends AbstractController
{
    /**
     * @Route("/", name="publication_index", methods={"GET"})
     */
    public function index(PublicationRepository $publicationRepository): Response
    {
        return $this->render('Back/publication/index.html.twig', [
            'publications' => $publicationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="publication_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $publication = new Publication();
        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $publication->setDatePublication(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($publication);
            $entityManager->flush();

            return $this->redirectToRoute('publication_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/publication/new.html.twig', [
            'publication' => $publication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/enseignant", name="publication_show",methods={"GET","POST"})
     */
    public function show(EnseignantRepository $enseignantRepository,Publication $publication,Request $request ,CommentaireRepository $commentaireRepository): Response
    {
        $user= $this->getUser();
        $email=$user->getEmail();

        foreach($enseignantRepository->findAll() as $service)
        {
            if ($email == $service->getEmailEnseignant()){
                $enseignantUser=$service;
                $enseignant = $this->getDoctrine()
                    ->getRepository(Enseignant::class)
                    ->findOneByIdJoinedToClasse($service->getId());
                $classeEnseignant = $enseignant->getClasse();
            }

        }
        $entityManager = $this->getDoctrine()->getManager();
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);
        $publication->setNbVue($publication->getNbVue()+1);
        $cour=$publication->getCours();
        if ($form->isSubmitted() && $form->isValid()) {


            $commentaire->setDateCommentaire(new \DateTime('now'));
            $publication->setNbComment($publication->getNbComment()+1);
            $entityManager = $this->getDoctrine()->getManager();
            $publication = $entityManager->getRepository(Publication::class)->find($request->get('publication'));
            $commentaire->setPublication($publication) ;
            $commentaire->setEnseignant($enseignantUser);
            $entityManager->persist($commentaire);
            $entityManager->flush();
           
            return $this->redirectToRoute('publication_show', array('id'=>$publication->getId()));
        }
        $entityManager->flush();
        return $this->render('Back/publication/show.html.twig', [
            'publication' => $publication,
            'commentaire' => $commentaire,
            'commentaires'=>$commentaireRepository->findAll(),
            'form' => $form->createView(),
            'cour'=>$cour,
            'classes'=>$classeEnseignant
        ]);
    }
    /**
     * @Route("/{id}/etudiant", name="etudiant_publication_show",methods={"GET","POST"})
     */
    public function showEtudiant(EtudiantRepository $etudiantRepository,MatiereRepository $matiereRepository,Publication $publication,Request $request ,CommentaireRepository $commentaireRepository): Response
    {
        $roles = $this->getUser()->getRoles();
        if ($roles[0] == 'ROLE_ETUDIANT')
        {   $user= $this->getUser();
            $email=$user->getEmail();
            foreach($etudiantRepository->findAll() as $service)
            {
                if ($email == $service->getEmailEtudiant()){
                    $classe= $service->getClasse();

                }
            }
        }
        $entityManager = $this->getDoctrine()->getManager();
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);
        $publication->setNbVue($publication->getNbVue()+1);
        $cour=$publication->getCours();
        if ($form->isSubmitted() && $form->isValid()) {


            $commentaire->setDateCommentaire(new \DateTime('now'));
            $publication->setNbComment($publication->getNbComment()+1);
            $entityManager = $this->getDoctrine()->getManager();
            $publication = $entityManager->getRepository(Publication::class)->find($request->get('publication'));
            $commentaire->setPublication($publication) ;
            //$commentaire->setEnseignant($enseignantUser);
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('etudiant_publication_show', array('id'=>$publication->getId()));
        }
        $entityManager->flush();
        return $this->render('Back/publication/show.html.twig', [
            'publication' => $publication,
            'commentaire' => $commentaire,
            'commentaires'=>$commentaireRepository->findAll(),
            'form' => $form->createView(),
            'cour'=>$cour,
            'matieres' => $matiereRepository->findAll(),
            'classe'=>$classe,

        ]);
    }
    /**
     * @Route("/{id}/edit/enseignant", name="enseignant_publication_edit", methods={"GET","POST"})
     */
    public function editEnseignant(Request $request, Publication $publication , EnseignantRepository $enseignantRepository): Response
    {
        $formpub = $this->createForm(PublicationType::class, $publication);
        $formpub->handleRequest($request);
        $cour =$publication->getCours();

        $user= $this->getUser();
        $email=$user->getEmail();


        foreach($enseignantRepository->findAll() as $service)
        {
            if ($email == $service->getEmailEnseignant()){
                $enseignant = $this->getDoctrine()
                    ->getRepository(Enseignant::class)
                    ->findOneByIdJoinedToClasse($service->getId());

                $classeEnseignant = $enseignant->getClasse();

            }

        }
        if ($formpub->isSubmitted() && $formpub->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cours_show', array('id'=>$cour->getId()));
        }

        return $this->render('Back/publication/edit.html.twig', [
            'publication' => $publication,
            'formpub' => $formpub->createView(),
            'classes'=>$classeEnseignant
        ]);
    }
    /**
     * @Route("/{id}/edit/etudiant", name="etudiant_publication_edit", methods={"GET","POST"})
     */
    public function editEtudiant(Request $request,MatiereRepository $matiereRepository,Publication $publication , EtudiantRepository $etudiantRepository): Response
    {
        $formpub = $this->createForm(PublicationType::class, $publication);
        $formpub->handleRequest($request);
        $cour =$publication->getCours();
        $roles = $this->getUser()->getRoles();
        if ($roles[0] == 'ROLE_ETUDIANT')
        {   $user= $this->getUser();
            $email=$user->getEmail();
            foreach($etudiantRepository->findAll() as $service)
            {
                if ($email == $service->getEmailEtudiant()){
                    $classe= $service->getClasse();

                }
            }
        }
        if ($formpub->isSubmitted() && $formpub->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etudiant_cours_show', array('id'=>$cour->getId()));
        }

        return $this->render('Back/publication/edit.html.twig', [
            'publication' => $publication,
            'formpub' => $formpub->createView(),
            'matieres' => $matiereRepository->findAll(),
            'classe'=>$classe,
        ]);
    }

    /**
     * @Route("/{id}", name="publication_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Publication $publication): Response
    {
        $cour =$publication->getCours();
        if ($this->isCsrfTokenValid('delete'.$publication->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($publication);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cours_show', array('id'=>$cour->getId()));
    }
}
