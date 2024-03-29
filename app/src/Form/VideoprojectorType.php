<?php

namespace App\Form;

use App\Entity\Videoprojector;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class VideoprojectorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model', TextType::class, [
                'constraints' => new NotBlank(),
                'label' => 'Modèle du videoprojecteur',
            ])
            ->add('purchaseDate', DateType::class, [
                'constraints' => new NotBlank(),
                'input' => 'datetime',
                'widget' => 'single_text',
                'label' => 'Date d\'achat',
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Disponibilité du matériel',
                'choices' => [
                    'Disponible' => 'Available',
                    'Indisponible' => 'Not Available',
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
            'data_class' => Videoprojector::class,
        ]);
    }
}
