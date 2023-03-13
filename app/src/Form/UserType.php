<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

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
                'constraints' => new NotBlank(),
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
                    /*new Length([
                        'min' => 12,
                        'minMessage' => 'Votre mot de passe doit contenir 12 caractères'
                    ]),
                    new Regex([
                        "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/",
                        "Votre mot de passe n'est pas assez sécurisé.veuillez recommencer"
                    ]),*/
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
