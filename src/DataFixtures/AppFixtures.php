<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Entity\Stage;
use App\Entity\User;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
		 // création d'un génrateur de données 
		 $faker = \Faker\Factory::create('fr_FR');
		 
		 
		 //Création d'entreprises
		    $Dassault = new Entreprise();
			$Dassault ->setNom("Dassault");
			$Dassault -> setAdresse($faker->streetAddress());
			$Dassault -> setMilieu($faker->realText($maxNbChars= 40, $indexSize = 2));
			
			$Safran = new Entreprise();
			$Safran-> setNom("Safran");
			$Safran-> setAdresse($faker->streetAddress());
			$Safran-> setMilieu($faker->realText($maxNbChars= 40, $indexSize = 2));
			
			$Thales = new Entreprise();
			$Thales-> setNom("Thales");
			$Thales-> setAdresse($faker->streetAddress());
			$Thales-> setMilieu($faker->realText($maxNbChars= 40, $indexSize = 2));
			
			$Geomatika = new Entreprise();
			$Geomatika-> setNom("Geomatika");
			$Geomatika->setAdresse($faker->streetAddress());
			$Geomatika->setMilieu($faker->realText($maxNbChars= 40, $indexSize = 2));
			
			
			//"validation" des entreprises
			$manager->persist($Geomatika);
			$manager->persist($Thales);
		    $manager->persist($Dassault);
			$manager->persist($Safran);
		 
			//Création d'un tableau recensant les entreprises
			$tableauEntreprises = array($Dassault ,$Safran, $Thales, $Geomatika);
		 
		 //Création de variables dont nous aurons ensuite besoin
		 $nbDonnées = 10;
		 $tableauFormation = array ();
		 
		 
		 for ($i=0; $i<= $nbDonnées; $i++){//boucle de création des formations et des stages
			 
			$formation = new Formation();
			$formation->setIntitule($faker->realText($maxNbChars = 40, $indexSize = 2));
			$formation->setNiveau($faker->regexify('Bac \+[1-7]'));
			$formation->setVille($faker->city);
			
			$tableauFormation[$i]=$formation;//on crée ici un tableau des formations

			$stage = new Stage();
			$stage ->setIntitule($faker->realText($maxNbChars = 15, $indexSize = 2));
			$stage-> setDescription($faker->realText($maxNbChars = 35, $indexSize = 2));
			$stage-> setDateDebut($faker->dateTimeThisCentury);
			$stage-> setDuree($faker-> regexify('[0-6] mois'));
			$stage-> setCompetenceRequise("Aucune compétence requise jusqu'a maintenant");
			$stage-> setExperienceRequise("Aucune expérience requise jusqu'a maintenant");
			
			$numeroFormation = $faker->numberBetween($min=0, $i);//on va séléctionner une formation deja crée
			
			$stage-> setFormation($tableauFormation[$numeroFormation]);//le stage prends l'id de la formation 
			$tableauFormation[$numeroFormation]->addStage($stage);//la formation prends l'id du stage
			
			
			$numEntreprise =$faker->numberBetween($min=0, $max=3);//on va sélectionner une des entreprises crées précédement
			
			$stage->setEntreprises($tableauEntreprises[$numEntreprise]);//le stage prends l'id de l'entreprise 
			$tableauEntreprises[$numEntreprise]->addStage($stage);// l'entreprise prends l'id du stage
			
			
			//"validation" des modifications apportées
			$manager->persist($stage);
			$manager->persist($formation);
			$manager->persist($tableauEntreprises[$numEntreprise]);
			$manager->persist($tableauFormation[$numeroFormation]);
		 }
		 
		 
		 
		 $paul= new User();
		 $paul->setUsername("DSide");
		 $paul->setPrenom("Paul");
		 $paul->setNom("Massias");
		 $paul->setRoles(['ROLE_USER','ROLE_ADMIN']);
		 $paul->setPassword('$2y$10$HoPQqa0QgZzcozCmf.LPbO70uhoBErBRR1nWG84/nmzuJdj35Hbja');
		 $manager->persist($paul);
		 
		 $romain= new User();
		 $romain->setUsername("RoroElRigolo");
		 $romain->setPrenom("Romain");
		 $romain->setNom("Vache");
		 $romain->setRoles(['ROLE_USER']);
		 $romain->setPassword('$2y$10$HoPQqa0QgZzcozCmf.LPbO70uhoBErBRR1nWG84/nmzuJdj35Hbja');
		 $manager->persist($romain);

			
			
		 
		 //envoi en base de données
        $manager->flush();
    }
}
