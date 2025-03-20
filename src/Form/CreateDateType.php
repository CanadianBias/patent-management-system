<?php

namespace App\Form;

use App\Entity\Dates;
use App\Entity\DateTypes;
use App\Entity\Patent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('DateShort', null, [
                'widget' => 'single_text',
            ])
            ->add('DateLong', null, [
                'widget' => 'single_text',
            ])
            ->add('GracePeriod', null, [
                'widget' => 'single_text',
            ])
            ->add('DatesHaveTypes', EntityType::class, [
                'class' => DateTypes::class,
                'choice_label' => 'id',
            ])
            ->add('PatentID', EntityType::class, [
                'class' => Patent::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dates::class,
        ]);
    }
}
