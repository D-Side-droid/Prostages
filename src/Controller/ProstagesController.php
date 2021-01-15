<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Entity\Stage;

class ProstagesController extends AbstractController
{

    public function index(): Response
    {	
		
		$repositoryStage = $this->getDoctrine()->getRepository(Stage::class);
		$stages = $repositoryStage->findAll();
		return $this->render('prostages/index.html.twig', ['stages'=>$stages]);
        
    }
	
	public function Fentreprises(): Response
	{
		$repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);
		$entreprises = $repositoryEntreprise->findAll();
		return $this->render('prostages/entreprises.html.twig',['entreprises'=>$entreprises]);
	}	
	
	
	public function formations(): Response
	{
		return $this->render('prostages/formations.html.twig');
	}	
	
	
	public function stages($id): Response
	{
		
		
		return $this->render('prostages/stages.html.twig', 
		['idStage' => $id]);
	}	
}
