<?php

namespace App\Form;

use App\Entity\Mouse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class MouseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model', TextType::class, [
                'constraints' => new NotBlank(),
                'label' => 'Modèle de souris',
            ])
            ->add('affectation', ChoiceType::class, [
                'label' => 'Usage du matériel',
                'choices' => [
                    'Interne' => 'interne',
                    'Externe' => 'externe',
                ],
                'multiple' => false, 
                'expanded' => true, 
                'required' => true
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Disponibilité du matériel',
                'choices' => [
                    'Disponible' => 'available',
                    'Indisponible' => 'notAvailable',
                ],
                'multiple' => false, 
                'expanded' => true, 
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mouse::class,
        ]);
    }
}
