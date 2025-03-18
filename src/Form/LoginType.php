<?php

namespace App\Form;

use App\Entity\Inventor;
use App\Entity\Patent;
use App\Entity\PersonType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('FirstName')
            ->add('LastName')
            ->add('Email')
            ->add('PhoneNumber')
            ->add('PassHash')
            ->add('InventorIsPersonType', EntityType::class, [
                'class' => PersonType::class,
                'choice_label' => 'id',
            ])
            ->add('InventorsHavePatents', EntityType::class, [
                'class' => Patent::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('Login', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inventor::class,
        ]);
    }
}
