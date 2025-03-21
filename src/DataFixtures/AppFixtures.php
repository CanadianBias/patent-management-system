<?php

namespace App\DataFixtures;

use App\Factory\ClassificationFactory;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        ClassificationFactory::new()->createMany(10);
        
        $manager->flush();
    }
}
