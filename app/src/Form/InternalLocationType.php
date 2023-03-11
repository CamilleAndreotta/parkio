<?php

namespace App\Form;

use App\Entity\InternalLocation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InternalLocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateStart')
            ->add('dateEnd')
            ->add('information')
            ->add('externalLocations')
            ->add('material')
            ->add('user')
            ->add('laptop')
            ->add('computer')
            ->add('monitor')
            ->add('videoprojector')
            ->add('mouse')
            ->add('keyboard')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InternalLocation::class,
        ]);
    }
}