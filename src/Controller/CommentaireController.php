<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Enseignant;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use App\Repository\EnseignantRepository;
use App\Repository\EtudiantRepository;
use App\Repository\MatiereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commentaire")
 */
class CommentaireController extends AbstractController
{
    /**
     * @Route("/", name="commentaire_index", methods={"GET"})
     */
    public function index(CommentaireRepository $commentaireRepository): Response
    {
        return $this->render('Back/commentaire/index.html.twig', [
            'commentaires' => $commentaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="commentaire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire->setDateCommentaire(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('commentaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/commentaire/new.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commentaire_show", methods={"GET"})
     */
    public function show(Commentaire $commentaire): Response
    {
        return $this->render('Back/commentaire/show.html.twig', [
            'commentaire' => $commentaire,
        ]);
    }

    /**
     * @Route("/{id}/edit/enseignant", name="commentaire_edit", methods={"GET","POST"})
     */
    public function editEnseignant(Request $request, Commentaire $commentaire,EnseignantRepository $enseignantRepository): Response
    { $user= $this->getUser();
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
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);
        $publication = $commentaire->getPublication();
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('publication_show', array('id'=>$publication->getId()));
        }

        return $this->render('Back/commentaire/edit.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form->createView(),
            'classes'=>$classeEnseignant
        ]);
    }
    /**
     * @Route("/{id}/edit/etudiant", name="etudiant_commentaire_edit", methods={"GET","POST"})
     */
    public function editEtudiant(Request $request, Commentaire $commentaire,EtudiantRepository $etudiantRepository,MatiereRepository $matiereRepository): Response
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
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);
        $publication = $commentaire->getPublication();
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etudiant_publication_show', array('id'=>$publication->getId()));
        }

        return $this->render('Back/commentaire/edit.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form->createView(),
            'matieres' => $matiereRepository->findAll(),
            'classe'=>$classe,
        ]);
    }

    /**
     * @Route("/{id}", name="commentaire_delete",  methods={"DELETE"})
     */
    public function delete(Request $request, Commentaire $commentaire): Response
    {
        $publication = $commentaire->getPublication();
        if ($this->isCsrfTokenValid('delete'.$commentaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            $publication->setNbComment($publication->getNbComment()-1);
            $entityManager->remove($commentaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('publication_show', array('id'=>$publication->getId()));
    }
}
