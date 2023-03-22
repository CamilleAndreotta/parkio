<?php

namespace App\Form;

use App\Entity\ExternalLocation;
use App\Entity\Keyboard;
use App\Entity\Laptop;
use App\Entity\Mouse;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ExternalLocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('externalUser', TextType::class, [
                'constraints' => new NotBlank(),
                'label' => 'Nom et prénom de l\'utilisateur'
            ])
            ->add('email', EmailType::class, [
                'constraints' => new NotBlank(),
                'label'=> 'Email de l\'emprunteur',
            ])
            ->add('phone', TextType::class, [
                'constraints' => new NotBlank(),
                'label' => 'Numéro de téléphone de l\'emprunteur ',
            ])
            ->add('user', EntityType::class, [
                'label' => 'Référent de la demande',
                'choice_label' => 'internalUser',
                'class' => User::class, 
                'multiple' => false, 
                'expanded' => false, 
                'required' => true, 
                'mapped' => true,
            ])
            ->add('message', TextareaType::class, [
                'constraints' => new NotBlank(),
                'label' => 'Indiquez le matériel souhaité', 
            ])
            ->add('dateStart', DateType::class, [
                'constraints' => new NotBlank(),
                'input' => 'datetime',
                'widget' => 'single_text',
                'label' => 'Date de début de location',
            ])
            ->add('dateEnd', DateType::class, [
                'constraints' => new NotBlank(),
                'input' => 'datetime',
                'widget' => 'single_text',
                'label' => 'Date de fin de location',
            ])
            ->add('laptop', EntityType::class, [
                'class' => Laptop::class,
                'label' => 'Affecter un ordinateur portable',
                'choice_label' => 'model',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('l')
                    ->WHERE('l.status=:available')
                    ->ANDWHERE('l.affectation = :externe' )
                    ->setParameter('available', 'Available' )
                    ->setParameter('externe', 'Externe' );
                },
                'multiple' => false,
                'required' => false,
            ])
            ->add('mouse', EntityType::class, [
                'class' => Mouse::class,
                'label' => 'Affecter une souris',
                'choice_label' => 'model',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('m')
                    ->WHERE('m.status=:available')
                    ->ANDWHERE('m.affectation = :externe' )
                    ->setParameter('available', 'Available' )
                    ->setParameter('externe', 'Externe' );
                },
                'multiple' => false,
                'required' => false
            ])
            ->add('accepted', ChoiceType::class, [
                'label' => 'Demande traitée',
                'choices' => [
                    'Oui' => 'Oui',
                    'Non' => 'Non',
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
            'data_class' => ExternalLocation::class,
        ]);
    }
}
