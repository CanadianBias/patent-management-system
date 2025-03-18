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
        
        $manager->flush();
    }
}
