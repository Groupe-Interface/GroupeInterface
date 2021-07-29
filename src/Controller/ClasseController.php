<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Entity\Cours;
use App\Entity\Enseignant;
use App\Entity\Matiere;
use App\Form\ClasseType;
use App\Form\CoursType;
use App\Repository\ClasseRepository;
use App\Repository\CoursRepository;
use App\Repository\EnseignantRepository;
use App\Repository\EtudiantRepository;
use App\Repository\SeanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ClasseController extends AbstractController
{
    /**
     * @Route("/classe/admin", name="admin_classe_index", methods={"GET"})
     */
    public function indexAdmin(ClasseRepository $classeRepository,EnseignantRepository $enseignantRepository,EtudiantRepository $etudiantRepository,Request $request): Response
    {

        return $this->render('Back/classe/index.html.twig', [

            'classes' => $classeRepository->findAll()


        ]);
    }

    /**
     * @Route("/classe/enseignant", name="enseignant_classe_index", methods={"GET"})
     */
    public function indexEnseignant(ClasseRepository $classeRepository,EnseignantRepository $enseignantRepository,EtudiantRepository $etudiantRepository,Request $request): Response
    {   $classe= null;
        $user= $this->getUser();
        $email=$user->getEmail();


        foreach($enseignantRepository->findAll() as $service)
        {
            if ($email == $service->getEmailEnseignant()){
                $enseignant = $this->getDoctrine()
                    ->getRepository(Enseignant::class)
                    ->findOneByIdJoinedToClasse($service->getId());

                $classe = $enseignant->getClasse();

            }

        }

        return $this->render('Back/classe/index.html.twig', [

            'etudiants' => $etudiantRepository->findAll(),
            'enseignants' => $enseignantRepository->findAll(),
            'classes' => $classe
        ]);
    }

    /**
     * @Route("/classe/new/admin", name="admin_classe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($classe);
            $entityManager->flush();

            return $this->redirectToRoute('admin_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/classe/new.html.twig', [
            'classe' => $classe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/classe/{id}/enseignant", name="enseignant_classe_show", methods={"GET","POST"})
     */
    public function show(Classe $classe,Request $request,SeanceRepository $seanceRepository,CoursRepository $coursRepository,EtudiantRepository $etudiantRepository,EnseignantRepository $enseignantRepository): Response
    {


        $matiere=null;

        $user= $this->getUser();
        $email=$user->getEmail();


        foreach($enseignantRepository->findAll() as $service)
        {
            if ($email == $service->getEmailEnseignant()){
                $matiere= $service->getMatiere();
                $enseignantUser=$service;
                $enseignant = $this->getDoctrine()
                    ->getRepository(Enseignant::class)
                    ->findOneByIdJoinedToClasse($service->getId());

                $classeEnseignant = $enseignant->getClasse();

            }

        }
        $cour = new Cours();
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {

            $file = $cour->getSupportCours();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'),$fileName);
            $cour->setSupportCours($fileName);
            $cour->setDateCours(new \DateTime('now'));
            $cour->setMatiere($matiere);
            $classe = $entityManager->getRepository(Classe::class)->find($request->get('id'));
            $cour->setIdClasse($classe);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cour);
            $entityManager->flush();

            return $this->redirectToRoute('enseignant_classe_show',array('id'=>$classe->getId()));
        }
        /*$date= new \DateTime::$Years()('now');
        dd($date);
        die();*/
        return $this->render('Back/classe/show.html.twig', [
            'matiere'=>$matiere,
            'classe' => $classe,
            'etudiants' => $etudiantRepository->findAll(),
            'form' => $form->createView(),
            'cour' => $cour,
            'cours' => $coursRepository->findAll(),
            'seances'=>$seanceRepository->findAll(),
            'enseignant'=>$enseignantUser,
            'classes' => $classeEnseignant
            //'date'=>$date
        ]);
    }
    /**
     * @Route("/show/{id}/admin", name="admin_classe_show", methods={"GET"})
     */
    public function showEtudiant(Classe $classe,EtudiantRepository $etudiantRepository): Response
    {
        return $this->render('Back/classe/show.html.twig', [
            'classe' => $classe,
            'etudiants' => $etudiantRepository->findAll()
        ]);
    }
    /**
     * @Route("/classe/{id}/edit/admin", name="admin_classe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Classe $classe): Response
    {
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Back/classe/edit.html.twig', [
            'classe' => $classe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/classe/delete/{id}/admin", name="admin_classe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Classe $classe): Response
    {

        if ($this->isCsrfTokenValid('delete'.$classe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($classe);
            $entityManager->flush();
        }
        return $this->redirectToRoute('admin_classe_index', [], Response::HTTP_SEE_OTHER);
    }
}
