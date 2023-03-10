<?php

namespace App\Form;

use App\Entity\InternalLocation;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class InternalLocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateStart', DateType::class, [
                'input'=> 'datetime',
                'constraints' => new NotBlank(),
                'widget' => 'single_text',
                'label' => 'Date de début de mise à disposition',
            ])
            ->add('dateEnd', DateType::class, [
                'input'=> 'datetime',
                'widget' => 'single_text',
                'label' => 'Date de fin de mise à disposition',
            ])
            ->add('information', TextareaType::class, [
                'label' => 'Indiquez si besoin les informations supplémentaires', 
            ])
            ->add('material', EntityType::class, [
                'label' => 'Affecter un matériel',
                'choice_label' => 'model',
                'query_builder' => function(EntityRepository $er) {
                    $er->findAvailableComputerForExternalLocation();
                }
            ])
            ->add('user', EntityType::class, [
                'label' => 'Selectionner un utilisateur',
                'choice_label' => 'name',
                'class' => User::class, 
                'multiple' => false, 
                'expanded' => false, 
                'required' => true, 
                'mapped' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InternalLocation::class,
        ]);
    }
}
