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

class InternalLocationFrontType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InternalLocation::class,
        ]);
    }
}
