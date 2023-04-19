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
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ExternalLocationFrontType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('externalUser', TextType::class, [
                'constraints' => new NotBlank(),
                'label' => 'Nom et prénom de l\'utilisateur'
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir l\'adresse mail du demandeur'
                    ]),
                    new Regex([
                        'pattern' => "/^([a-z-0-9]*[-|.|_][a-z-0-9]*@[a-z]*.[a-z]*)|([a-z-0-9]*@[a-z]*.[a-z]*)$/",
                        'message' => "Email invalide"
                    ])
                ],
                'label'=> 'Email de l\'emprunteur',
            ])
            ->add('phone', TextType::class, [
                'constraints' => [
                    new NotBlank(['message'=>'Veuillez saisir le numéro de téléphone du demandeur']),
                    new Regex([
                        'pattern' => '/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/',
                        'message' => 'Numéro de téléphone invalide'
                    ])
            ],
                'label' => 'Numéro de téléphone de l\'emprunteur ',
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ExternalLocation::class,
        ]);
    }
}
