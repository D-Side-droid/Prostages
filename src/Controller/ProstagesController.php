<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Entity\Stage;
use App\Repository\StageRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\FormationRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ProstagesController extends AbstractController
{
    /**
	 * @Route("/",name="prostages_Accueil")
	 */
    public function index(StageRepository $repositoryStage): Response
    {	
		
		//$repositoryStage = $this->getDoctrine()->getRepository(Stage::class);
		$stages = $repositoryStage->findAll();
		return $this->render('prostages/index.html.twig', ['stages'=>$stages]);
        
    }
	

    /**
	 * @Route("/lesEntreprises",name="prostages_Entreprises")
	 */
	public function Fentreprises(EntrepriseRepository $repositoryEntreprise): Response
	{
		$entreprises = $repositoryEntreprise->findAll();
		return $this->render('prostages/entreprises.html.twig',['entreprises'=>$entreprises]);
	}	
	
	
	/**
	 * @Route("/lesFormations",name="prostages_Formations")
	 */
	public function formations(FormationRepository $repositoryFormation): Response
	{
		$formations = $repositoryFormation->findAll();
		return $this->render('prostages/formations.html.twig',['formations'=>$formations]);
	}	
	
	/**
	 * @Route("/leStage/{id}",name="prostages_Stages")
	 */
	public function stages(Stage $stage , StageRepository $repositoryStage): Response
	{
		return $this->render('prostages/stages.html.twig', 
		['stage' => $stage]);
	}	
	
	/**
	 * @Route("/StageParEntreprise/{id}",name="prostages_StagesParEntreprises")
	 */
	 public function stagesParEntreprises(Entreprise $entreprise, StageRepository $repositoryStage): Response
	 {
		$stages = $repositoryStage->findByEntreprise($entreprise);
		return $this->render('prostages/stagesParEntreprise.html.twig',
		['entreprise'=>$entreprise]);
		
		
	 }
	 
	 
	/**
	 * @Route("/StageParFormations/{id}",name="prostages_StagesParFormations")
	 */
	 public function stagesParFormations(Formation $formation, FormationRepository $repositoryFormation): Response
	 {
		return $this->render('prostages/stagesParFormations.html.twig',
		['formation'=>$formation]);
		
		
	 }
	 
	 
	/**
     * @Route("/lesEntreprises/ajouter", name="prostages_AjoutEntreprise")
     */
    public function ajouterEntreprise(Request $request, EntityManagerInterface $manager)
    {
		 //Création d'une entreprise vierge qui sera remplie par le formulaire
        $entreprise = new Entreprise();

        // Création du formulaire permettant de saisir une entreprise
        $formulaireEntreprise = $this->createFormBuilder($entreprise)
        ->add('nom')
        ->add('adresse')
        ->add('milieu')
        ->getForm();
		
		 /* On demande au formulaire d'analyser la dernière requête Http. Si le tableau POST contenu
        dans cette requête contient des variables nom, adresse, etc. alors la méthode handleRequest()
        récupère les valeurs de ces variables et les affecte à l'objet $entreprise*/
        $formulaireEntreprise->handleRequest($request);

         if ($formulaireEntreprise->isSubmitted() )
         {
            // Enregistrer l'entreprise en base de données
            $manager->persist($entreprise);
            $manager->flush();

            // Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('prostages_Accueil');
         }
        
        // Afficher la page présentant le formulaire d'ajout d'une entreprise
        return $this->render('prostages/ajoutEntreprise.html.twig',['vueFormulaire'=>$formulaireEntreprise->createView()]);
    }

}
