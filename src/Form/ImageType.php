<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomImage', ChoiceType::class, [
                'choices'  => [
                    'Accueil_1' => 'Accueil_1',
                    'Accueil_2' => 'Accueil_2',
                    'Accueil_3' => 'Accueil_3',
                    'Groupe_Interface_1' => 'Groupe_Interface_1',
                ],
            ])
            ->add('numImage')
            ->add('imageFile',FileType::class,['required'=>false])
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'Accueil' => 'Accueil',
                    'Groupe Interface' => 'Groupe_Interface',
                    'No' => 'no',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
