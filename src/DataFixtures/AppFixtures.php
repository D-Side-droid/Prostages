<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Formation;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $DUTinformatique = new Formation();
		 $DUTinformatique->setIntitule("DUT Informatique");
		 $DUTinformatique->setNiveau("Bac +2");
		 $DUTinformatique->setVille("Anglet");
         $manager->persist($DUTinformatique);

        $manager->flush();
    }
}
