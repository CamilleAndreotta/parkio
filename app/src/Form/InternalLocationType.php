<?php

namespace App\Form;

use App\Entity\Computer;
use App\Entity\InternalLocation;
use App\Entity\Keyboard;
use App\Entity\Laptop;
use App\Entity\Monitor;
use App\Entity\Mouse;
use App\Entity\User;
use App\Entity\Videoprojector;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            ->add('user', EntityType::class, [
                'label' => 'Utilisateur interne',
                'choice_label' => 'internalUser',
                'class' => User::class, 
                'multiple' => false, 
                'expanded' => false, 
                'required' => true, 
                'mapped' => true,
            ])
            ->add('dateStart', DateType::class, [
                'constraints' => new NotBlank(),
                'input' => 'datetime',
                'widget' => 'single_text',
                'label' => 'Date de début de location',
            ])
            ->add('dateEnd', DateType::class, [
                'input' => 'datetime',
                'widget' => 'single_text',
                'label' => 'Date de fin de location',
                'required' => 'false',
            ])
            ->add('information',TextareaType::class, [
                'constraints' => new NotBlank(),
                'label' => 'Informations complémentaires', 
            ])
            ->add('laptop', EntityType::class, [
                'class' => Laptop::class,
                'label' => 'Affecter un ordinateur portable',
                'choice_label' => 'model',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('l')
                    ->WHERE('l.status=:available')
                    ->ANDWHERE('l.affectation = :interne' )
                    ->setParameter('available', 'available' )
                    ->setParameter('interne', 'interne' );
                },
                'multiple' => true,
                'required' => false,
            ])
            ->add('computer', EntityType::class, [
                'class' => Computer::class,
                'label' => 'Affecter un ordinateur fixe',
                'choice_label' => 'model',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                    ->WHERE('c.status=:available')
                    ->setParameter('available', 'available' );
                },
                'multiple' => true,
                'required' => false,
            ])
            ->add('monitor', EntityType::class, [
                'class' => Monitor::class,
                'label' => 'Affecter un écran',
                'choice_label' => 'model',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                    ->WHERE('e.status=:available')
                    ->setParameter('available', 'available' );
                },
                'multiple' => true,
                'required' => false,
            ])
            ->add('videoprojector', EntityType::class, [
                'class' => Videoprojector::class,
                'label' => 'Affecter un videoprojecteur',
                'choice_label' => 'model',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('v')
                    ->WHERE('v.status=:available')
                    ->setParameter('available', 'available' );
                },
                'multiple' => true,
                'required' => false,
            ])
            ->add('mouse', EntityType::class, [
                'class' => Mouse::class,
                'label' => 'Affecter une souris',
                'choice_label' => 'model',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                    ->WHERE('s.status=:available')
                    ->ANDWHERE('s.affectation = :interne' )
                    ->setParameter('available', 'available' )
                    ->setParameter('interne', 'interne' );
                },
                'multiple' => true,
                'required' => false,
            ])
            ->add('keyboard', EntityType::class, [
                'class' => Keyboard::class,
                'label' => 'Affecter un clavier',
                'choice_label' => 'model',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('k')
                    ->WHERE('k.status=:available')
                    ->ANDWHERE('k.affectation = :interne' )
                    ->setParameter('available', 'available' )
                    ->setParameter('interne', 'interne' );
                },
                'multiple' => true,
                'required' => false,
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
