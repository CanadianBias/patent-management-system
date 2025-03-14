<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Repository\PersonTypeRepository;
use App\Entity\Inventor;
use App\Entity\PersonType;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $personType = new PersonType();
        $personType->setName('Inventor');
        $manager->persist($personType);
        
        $inventor = new Inventor();
        $inventor->setFirstName('Thomas');
        $inventor->setLastName('Edison');
        $inventor->setInventorIsPersonType($personType);
        $manager->persist($inventor);

        $inventor = new Inventor();
        $inventor->setFirstName('Nikola');
        $inventor->setLastName('Tesla');
        $inventor->setInventorIsPersonType($personType);
        $manager->persist($inventor);
        
        $personType = new PersonType();
        $personType->setName('Attorney');
        $manager->persist($personType);

        $inventor = new Inventor();
        $inventor->setFirstName('Saul');
        $inventor->setLastName('Goodman');
        $inventor->setInventorIsPersonType($personType);
        $manager->persist($inventor);
        
        $manager->flush();
    }
}
