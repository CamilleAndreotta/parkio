<?php

namespace App\Form;

use App\Entity\Laptop;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class LaptopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model', TextType::class, [
                'constraints' => new NotBlank(),
                'label' => 'Modèle de l\'ordinateur portable',
            ])
            ->add('serialNumber', TextType::class, [
                'constraints' => new NotBlank(),
                'label' => 'Numéro de série de l\'ordinateur portable',
            ])
            ->add('password', TextType::class, [
                'constraints' => new NotBlank(),
                'label' => 'Mot de passe de l\'ordinateur portable',
            ])
            ->add('purchaseDate', DateType::class, [
                'constraints' => new NotBlank(),
                'input' => 'datetime',
                'widget' => 'single_text',
                'label' => 'Date d\'achat',
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
            'data_class' => Laptop::class,
        ]);
    }
}
