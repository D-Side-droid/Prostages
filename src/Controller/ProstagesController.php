<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProstagesController extends AbstractController
{

    public function index(): Response
    {	
		return $this->render('prostages/index.html.twig');
        
    }
	
	public function entreprises(): Response
	{
		return new Response('<html><body><h1>Cette page affichera la liste des entreprises proposant un stage</h1></body></html>');
	}	
	
	
	public function formations(): Response
	{
		return new Response('<html><body><h1>Cette page affichera la liste des formations de l\'IUT</h1></body></html>');
	}	
	
	
	public function stages($id): Response
	{
		
		//return new Response('<html><body><h1>Cette page affichera le descriptif du stage ayant pour identidiant.'$id'.</h1></body></html>');
		
		return $this->render('prostages/stages.html.twig', 
		['idStage' => $id]);
	}	
}
