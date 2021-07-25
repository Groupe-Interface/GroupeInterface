<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nationalite')
            ->add('num_passport')
            ->add('cin')
            ->add('nom_etudiant')
            ->add('prenom_etudiant')
            ->add('paye_naiss')
            ->add('paye_etudiant')
            ->add('ville_etudiant')
            ->add('photo_etudiant')
            ->add('email_etudiant')
            ->add('phone_etudiant')
            ->add('phone_urgence')
            ->add('classe')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
