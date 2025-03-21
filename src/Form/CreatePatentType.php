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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreatePatentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('IRN', TextType::class)
            ->add('PatentNumber', TextType::class)
            ->add('Title', TextType::class)
            ->add('Descript', TextType::class)
            ->add('PatentsAreCategorized', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'Type',
            ])
            ->add('PatentsHaveLocalization', EntityType::class, [
                'class' => Localization::class,
                'choice_label' => 'Type',
            ])
            ->add('PatentsHaveLanguage', EntityType::class, [
                'class' => Language::class,
                'choice_label' => 'Name',
            ])
            ->add('PatentsHaveStatus', EntityType::class, [
                'class' => Stats::class,
                'choice_label' => 'Stat',
            ])
            // ->add('PatentHasBusinessType', EntityType::class, [
            //     'class' => BusinessType::class,
            //     'choice_label' => 'id',
            // ])
            // ->add('inventors', EntityType::class, [
            //     'class' => Inventor::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patent::class,
        ]);
    }
}
