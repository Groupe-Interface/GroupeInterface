<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Enseignant;
use App\Entity\Matiere;
use App\Entity\Publication;
use App\Form\CoursType;
use App\Form\MatiereType;
use App\Form\PublicationType;
use App\Repository\ClasseRepository;
use App\Repository\CoursRepository;
use App\Repository\EnseignantRepository;
use App\Repository\EtudiantRepository;
use App\Repository\MatiereRepository;
use App\Repository\PublicationRepository;
use App\Repository\SpecialiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class MatiereController extends AbstractController
{
    /**
     * @Route("/matiere/admin", name="admin_matiere_index", methods={"GET"})
     */
    public function indexAdmin(MatiereRepository $matiereRepository): Response
    {
        return $this->render('Back/matiere/index.html.twig', [
            'matieres' => $matiereRepository->findAll(),
        ]);
    }
    /**
     * @Route("/matiere", name="matiere_index", methods={"GET"})
     */
    public function index(MatiereRepository $matiereRepository,EtudiantRepository $etudiantRepository,SpecialiteRepository $specialiteRepository, ClasseRepository  $classeRepository): Response
    {   $classe=null;
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

        return $this->render('Back/matiere/index.html.twig', [
            'matieres' => $matiereRepository->findAll(),
            'classe'=>$classe,
            'specialites' => $specialiteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/matiere/new/admin", name="admin_matiere_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $matiere = new Matiere();
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($matiere);
            $entityManager->flush();

            return $this->redirectToRoute('admin_matiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/matiere/new.html.twig', [
            'matiere' => $matiere,
            'form' => $form->createView(),
        ]);
    }

    /*/**
     * @Route("/{id}", name="matiere_show", methods={"GET","POST"})

    public function show(Matiere $matiere,Request $request,CoursRepository $coursRepository): Response
    {
        //form Ajout d'un cours
        $cour = new Cours();
        $formcour = $this->createForm(CoursType::class, $cour);
        $formcour->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();

        if ($formcour->isSubmitted() && $formcour->isValid()) {
            $file = $cour->getSupportCours();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $matiere = $entityManager->getRepository(Matiere::class)->find($request->get('matiere'));
            $cour->setMatiere($matiere) ;
            $file->move($this->getParameter('upload_directory'),$fileName);
            $cour->setSupportCours($fileName);
            $cour->setDateCours(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cour);
            $entityManager->flush();

            return $this->redirectToRoute('matiere_show', array('id'=>$matiere->getId()));
        }

        return $this->render('Back/matiere/show.html.twig', [
            'matiere' => $matiere,
            'cours' => $coursRepository->findAll(),
            'cour' => $cour,
            'formcour' => $formcour->createView(),
        ]);
    }*/
    /**
     * @Route("/matiere/{id}/etudiant", name="etudiant_matiere_show", methods={"GET","POST"})
     */
    public function showEtudiant(Matiere $matiere,Request $request,CoursRepository $coursRepository,EtudiantRepository $etudiantRepository): Response
    {$etudiant=null;
        $roles = $this->getUser()->getRoles();
        if ($roles[0] == 'ROLE_ETUDIANT')
        {   $user= $this->getUser();
            $email=$user->getEmail();


            foreach($etudiantRepository->findAll() as $service)
            {
                if ($email == $service->getEmailEtudiant()){
                    $etudiant= $service;

                }
            }
        }

        return $this->render('Back/matiere/show.html.twig', [
            'matiere' => $matiere,
            'cours' => $coursRepository->findAll(),
            'etudiant'=>$etudiant

        ]);
    }
    /**
     * @Route("/matiere/{id}/admin", name="admin_matiere_show", methods={"GET","POST"})
     */
    public function showadmin(Matiere $matiere, NormalizerInterface $Normalizer ,MatiereRepository $matiereRepository,Request $request,CoursRepository $coursRepository,EnseignantRepository $enseignantRepository): Response
    {


        $entityManager = $this->getDoctrine()->getManager();
        $matiere = $entityManager->getRepository(Matiere::class)->find($request->get('matiere'));

      $em=$this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT p FROM App\Entity\Enseignant p WHERE p.matiere = :id  ');
        //$query = $em->createQuery('SELECT p FROM App\Entity\Enseignant p INNER JOIN p.classe c
          //  WHERE p.id = :id AND p.matiere =  :matiere ');
        $query->setParameter('id',$matiere->getId());
        //$query->setParameter('id',$matiere->getId());
        $enseignants = $query->getResult();

        foreach($enseignants as $service)
        {$em1=$this->getDoctrine()->getManager();
            $query1 = $em1->createQuery('SELECT p, c
            FROM App\Entity\Enseignant p
            INNER JOIN p.classe c
            WHERE p.id = :id  ');

            $query1->setParameter('id',$service);
            //$query->setParameter('id',$matiere->getId());
            $classes = $query1->getResult();
            dd($classes);
            die();
            //    $enseignant = $this->getDoctrine()
                //    ->getRepository(Enseignant::class)
               //     ->findOneByIdJoinedToClasse($service->getId());

               // $classeEnseignant = $enseignant->getClasse();
           // dd($classeEnseignant);



        }
       // echo($service->getId());
        die();

        //dd($service->getId());
        die();
        //dd($classeEnseignant);
        die();
       /* $a=arry(NULL);
        foreach ($matieres as $a) {
            $em1=$this->getDoctrine()->getManager();
            $query1 = $em1->createQuery('SELECT p,c
            FROM App\Entity\Classe p
            INNER JOIN p.enseignants c
            WHERE c.id = :id');
            $query1->setParameter('id',$s->getId());

            $m = $query1->getResult();
            foreach ($m as $s) {
                echo($s->getId());
                // dd($s->getId());
            }

        }
        die();

        return $this->render('Back/matiere/show.html.twig', [
            'matiere' => $matiere,
            'cours' => $coursRepository->findAll(),
            'enseignants'=>$enseignantRepository->findAll(),
            'matieres'=>$matiereRepository->findAll(),
            'classes' => $m


        ]);*/

    }
    /**
     * @Route("/matiere/{id}/edit/admin", name="admin_matiere_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Matiere $matiere): Response
    {
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_matiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/matiere/edit.html.twig', [
            'matiere' => $matiere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/matiere/{id}/admin", name="admin_matiere_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Matiere $matiere): Response
    {
        if ($this->isCsrfTokenValid('delete'.$matiere->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($matiere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_matiere_index', [], Response::HTTP_SEE_OTHER);
    }
}
