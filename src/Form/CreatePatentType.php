<?php

namespace App\Form;

use App\Entity\BusinessType;
use App\Entity\Category;
use App\Entity\Inventor;
use App\Entity\Language;
use App\Entity\Localization;
use App\Entity\Patent;
use App\Entity\Stats;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreatePatentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('IRN')
            ->add('PatentNumber')
            ->add('Title')
            ->add('Descript')
            ->add('PatentsAreCategorized', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'id',
            ])
            ->add('PatentsHaveLocalization', EntityType::class, [
                'class' => Localization::class,
                'choice_label' => 'id',
            ])
            ->add('PatentsHaveLanguage', EntityType::class, [
                'class' => Language::class,
                'choice_label' => 'id',
            ])
            ->add('PatentsHaveStatus', EntityType::class, [
                'class' => Stats::class,
                'choice_label' => 'id',
            ])
            ->add('PatentHasBusinessType', EntityType::class, [
                'class' => BusinessType::class,
                'choice_label' => 'id',
            ])
            ->add('inventors', EntityType::class, [
                'class' => Inventor::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patent::class,
        ]);
    }
}
