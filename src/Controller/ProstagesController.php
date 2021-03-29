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
	 public function stagesParEntreprises(Entreprise $entreprise, EntrepriseRepository $repositoryEntreprise): Response
	 {
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
}
