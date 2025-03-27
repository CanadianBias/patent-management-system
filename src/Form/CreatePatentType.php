<?php

namespace App\Form;

use App\Entity\BusinessType;
use App\Entity\Category;
use App\Entity\Inventor;
use App\Entity\Language;
use App\Entity\Localization;
use App\Entity\Patent;
use App\Entity\Stats;
use App\Repository\InventorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreatePatentType extends AbstractType
{
    public function __construct(Security $security, EntityManagerInterface $entityManager)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('IRN', TextType::class, [
                'label' => 'IRN: ',
            ])
            ->add('PatentNumber', TextType::class, [
                'label' => 'Patent Number: ',
            ])
            ->add('Title', TextType::class, [
                'label' => 'Title: ',
            ])
            ->add('Descript', TextType::class, [
                'label' => 'Description: ',
            ])
            ->add('PatentHasBusinessType', EntityType::class, [
                'class' => BusinessType::class,
                'label' => 'Business Type: ',
                'required' => false,
                'choice_label' => 'Title',
            ])
            ->add('PatentsAreCategorized', EntityType::class, [
                'class' => Category::class,
                'label' => 'Category: ',
                'choice_label' => 'Type',
            ])
            ->add('PatentsHaveLocalization', EntityType::class, [
                'class' => Localization::class,
                'label' => 'Localization: ',
                'choice_label' => 'Type',
            ])
            ->add('PatentsHaveLanguage', EntityType::class, [
                'class' => Language::class,
                'label' => 'Language: ',
                'choice_label' => 'Name',
            ])
            ->add('PatentsHaveStatus', EntityType::class, [
                'class' => Stats::class,
                'label' => 'Status: ',
                'choice_label' => 'Stat',
            ])
            // this adds the relationship in the database, but doesn't actually add the relationship in the ORM
            ->add('Inventors', EntityType::class, [
                'class' => Inventor::class,
                'choice_label' => 'username',
                'choices' => $this->entityManager->createQuery('SELECT u from App\Entity\Inventor u WHERE u.username = :username')
                    ->setParameter('username', $this->security->getUser()->getUsername())
                    ->getResult(),
                'multiple' => true,
            ])
            // ->add('PatentHasBusinessType', EntityType::class, [
            //     'class' => BusinessType::class,
            //     'choice_label' => 'id',
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
