<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('internalUser', TextType::class, [
                'constraints' => new NotBlank(),
                'label' => 'Nom et Prénom l\'utilisateur',
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir votre adresse mail'
                    ]),
                    new Regex([
                        'pattern' => "/^([a-z-0-9]*[-|.|_][a-z-0-9]*@[a-z]*.[a-z]*)|([a-z-0-9]*@[a-z]*.[a-z]*)$/",
                        'message' => "Email invalide"
                    ])
                ],
                'label'=> 'Email de l\'utilisateur',
                'mapped'=> true, 
                'required' => true,
            ])
            ->add('roles',ChoiceType::class, [
                'label' => 'Role de l\'utilisateur', 
                'choices' => [
                    'User' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                ],
                'multiple' => true, 
                'expanded' => true, 
                'required' => true,
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe de l\'utilisateur',
                'constraints' => [
                    new NotBlank([
                        'message'=> 'Veuillez entrer un mot de passe'
                    ]),
                    new Length([
                        'min' => 12,
                        'minMessage' => 'Votre mot de passe doit contenir 12 caractères'
                    ]),
                    new Regex([
                        'pattern' => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/",
                        'message' => "Le mot de passe doit contenir au minimum 12 caractères, une majuscule, un chiffre et un caractère spécial"
                        ])
                ],
                'mapped'=> true, 
                'required' => true, 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
