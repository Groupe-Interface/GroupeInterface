<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Enseignant;
use App\Entity\Matiere;
use App\Entity\Publication;
use App\Form\CoursType;
use App\Form\PublicationType;
use App\Repository\CoursRepository;
use App\Repository\EnseignantRepository;
use App\Repository\EtudiantRepository;
use App\Repository\MatiereRepository;
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
    public function show(Cours $cour,Request $request,PublicationRepository  $publicationRepository,EnseignantRepository $enseignantRepository): Response
    {
        $classe=$cour->getIdClasse();
        //$entityManager = $this->getDoctrine()->getManager();
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

        $publication = new Publication();
        $formpub = $this->createForm(PublicationType::class, $publication);
        $formpub->handleRequest($request);
        $matiere=$cour->getMatiere();


        if ($formpub->isSubmitted() && $formpub->isValid()) {
            $publication->setCours($cour);

            $publication->setDatePublication(new \DateTime('now'));
            $publication->setNbComment(0);
            $publication->setNbVue(0);
            $publication->setEnseignant($enseignantUser);
            $entityManager = $this->getDoctrine()->getManager();

            // $cour = $entityManager->getRepository(Cours::class)->find($request->get('Cours'));

            $entityManager->persist($publication);
            $entityManager->flush();

            return $this->redirectToRoute('cours_show', array('id'=>$cour->getId()));
        }

        return $this->render('Back/cours/show.html.twig', [
            'classe'=>$classe,
            'cour' => $cour,
            'formpub' => $formpub->createView(),
            'publications'=>$publicationRepository->findAll(),
            'publication'=>$publication,
            'matiere'=>$matiere,
            'classes'=>$classeEnseignant
        ]);
    }

    /**
     * @Route("/{id}/enseignant", name="enseignant_cours_show", methods={"GET","POST"})
     */
    public function showEnseignant(Cours $cour,Request $request,PublicationRepository  $publicationRepository,EnseignantRepository $enseignantRepository): Response
    {
        $classe=$cour->getIdClasse();
        //$entityManager = $this->getDoctrine()->getManager();
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

        $publication = new Publication();
        $formpub = $this->createForm(PublicationType::class, $publication);
        $formpub->handleRequest($request);
        $matiere=$cour->getMatiere();


        if ($formpub->isSubmitted() && $formpub->isValid()) {
            $publication->setCours($cour);

            $publication->setDatePublication(new \DateTime('now'));
            $publication->setNbComment(0);
            $publication->setNbVue(0);
            $publication->setEnseignant($enseignantUser);
            $entityManager = $this->getDoctrine()->getManager();

           // $cour = $entityManager->getRepository(Cours::class)->find($request->get('Cours'));

            $entityManager->persist($publication);
            $entityManager->flush();

            return $this->redirectToRoute('cours_show', array('id'=>$cour->getId()));
        }

        return $this->render('Back/cours/show.html.twig', [
            'classe'=>$classe,
            'cour' => $cour,
            'formpub' => $formpub->createView(),
            'publications'=>$publicationRepository->findAll(),
            'publication'=>$publication,
            'matiere'=>$matiere,
            'classes'=>$classeEnseignant
        ]);
    }
    /**
     * @Route("/{id}/etudiant", name="etudiant_cours_show", methods={"GET","POST"})
     */
    public function showEtudiant(Cours $cour,MatiereRepository $matiereRepository,EtudiantRepository $etudiantRepository,Request $request,PublicationRepository  $publicationRepository,EnseignantRepository $enseignantRepository): Response
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

            return $this->redirectToRoute('etudiant_cours_show', array('id'=>$cour->getId()));
        }

        return $this->render('Back/cours/show.html.twig', [
            'classe'=>$classe,
            'cour' => $cour,
            'formpub' => $formpub->createView(),
            'publications'=>$publicationRepository->findAll(),
            'publication'=>$publication,
            'matiere'=>$matiere,
            'matieres' => $matiereRepository->findAll(),

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
        $classe=$cour->getIdClasse();

        $matiere = $cour->getMatiere();
      if ($this->isCsrfTokenValid('delete'.$cour->getId(), $request->request->get('_token'))) {
           $entityManager = $this->getDoctrine()->getManager();
          $entityManager->remove($cour);
            $entityManager->flush();
       }
      return $this->redirectToRoute('enseignant_classe_show',array('id'=>$classe->getId()));
       // return $this->redirectToRoute('matiere_show', array('id'=>$matiere->getId()));
    }
}
