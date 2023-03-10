<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Material;
use App\Entity\Status;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class MaterialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model', TextType::class, [
                'constraints' => new NotBlank(),
                'label' => 'Modèle du matériel',
            ])
            ->add('serialNumber', TextType::class, [
                'label' => 'Numéro de série du matériel',
            ])
            ->add('password', TextType::class, [
                'label' => 'Mot de passe du matériel',
            ])
            ->add('purchaseDate', DateType::class, [
                'input' => 'datetime',
                'widget' => 'single_text',
                'label' => 'Date d\'achat du matériel',
            ])
            ->add('category', ChoiceType::class, [
                'label' => 'Catégorie du matériel',
                'constraints' => new NotBlank(),
                'choices' => [
                    'Ordinateur Portable' => 'ordinateurPortable',
                    'Ordinateur Fixe' => 'ordinateurFixe',
                    'Moniteur' => 'moniteur',
                    'Clavier' => 'clavier',
                    'Souris' => 'souris'
                ],
                'multiple' => false, 
                'expanded' => false,
                'required' => true,
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Disponibilité du matériel',
                'constraints' => new NotBlank(),
                'choices' => [
                    'Disponible' => 'available',
                    'Not Disponible' => 'notAvailable'
                ],
                'multiple' => false, 
                'expanded' => false,
                'required' => true,
            ])
            ->add('affectation', ChoiceType::class, [
                'label' => 'Affectation du matériel',
                'constraints' => new NotBlank(),
                'choices' => [
                    'Interne' => 'interne',
                    'Externe' => 'externe'
                ],
                'multiple' => false, 
                'expanded' => true, 
                'required' => true, 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Material::class,
        ]);
    }
}
