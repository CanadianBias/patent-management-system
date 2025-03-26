<?php

namespace App\Form;

use App\Entity\Dates;
use App\Entity\DateTypes;
use App\Entity\Patent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateDateType extends AbstractType
{
    public function __construct(Security $security, EntityManagerInterface $entityManager)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

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
                'choice_label' => 'DateType',
            ])
            ->add('PatentID', EntityType::class, [
                'class' => Patent::class,
                'choice_label' => 'irn',
                'choices' => $this->entityManager->createQuery('SELECT p FROM App\Entity\Patent p WHERE :user MEMBER OF p.Inventors')
                    ->setParameter('user', $this->security->getUser())
                    ->getResult(),
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dates::class,
        ]);
    }
}
