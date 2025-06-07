<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TrajetRepository;
use App\Entity\Etape;
use App\Entity\Trajet;
use App\Entity\Utilisateur;
use App\Entity\Participants;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RechercheController extends AbstractController
{
    private $trajetRepository;

    public function __construct(TrajetRepository $trajetRepository)
    {
    $this->trajetRepository = $trajetRepository;
    }

    /**
     * @Route("/recherche", name="recherche", methods={"GET"})
     */
    public function index()
    {
        return $this->render('recherche/recherche.html.twig', [
            'controller_name' => 'RechercheController',
        ]);
    }
    /** 
     * @Route("/recherches", name="get_trajets", methods={"GET"}) 
     */ 
    public function get_all_trajets(): JsonResponse 
    {      
        $repository=$this->getDoctrine()->getRepository(Etape::class);
        $trajets = $repository->findAll();
        $data = array();
        foreach($trajets as $trajet){
            array_push($data,[
                'lat' => $trajet->getLatitude(),
                'long' => $trajet->getLongitude(),
                'id_trajet' => $trajet->getIdTrajet(),
                'etape_time' => $trajet->getEtapeTime(),
            ]);
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }

       /** 
     * @Route("/recherches/trajet/{id}", name="get_trajet", methods={"GET"}) 
     */ 
    public function rechercheTrajet($id): JsonResponse 
    {   
        $userId= $this->getUser()->getIdutilisateur();
        $repository=$this->getDoctrine()->getRepository(Trajet::class);
        $trajets = $repository->findBy(['idTrajet' => $id]);
        foreach($trajets as $trajet){
            $conducteur = $trajet->getIdUtilisateur();
         }
        $repository1=$this->getDoctrine()->getRepository(Utilisateur::class);
        $trajet1 = $repository1->findBy(['idUtilisateur' => $conducteur]);
        $data1 = array();

        foreach($trajet1 as $trajet_){
            array_push($data1, $trajet_->getUsername().",".$trajet_->getProfileImage());
        }
        $data = array();
        foreach($trajets as $trajet){
            array_push($data,[
                'idTrajet_db' => $trajet->getIdTrajet(),
                'villeDepart' => $trajet->getIdVilleDepart(),
                'villeArrivee' => $trajet->getIdVilleRetour(),
                'idCreateur' => $trajet->getIdUtilisateur(),
                'places' => $trajet->getNbrePlace(),
                'utilisateur'=> $userId,
                'prixTrajet' => $trajet->getPrixTrajet(),
                'distanceTrajet' => $trajet->getDistanceTrajet(),
                'heureDepart' => $trajet->getDateDepart()->format("H:i"),
                'conducteur' =>  implode(",", $data1),                
            ]);
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }

        /** 
     * @Route("/recherches/trajet/", name="get_trajet_loading", methods={"GET"}) 
     */ 
    public function filmCatUrl(): JsonResponse 
    { 
        $data = array();
        return new JsonResponse($data, Response::HTTP_OK); 
    }
	
    
	   /** 
     * @Route("/reservation/{idTrajet}", name="booking_trajet", methods={"GET"}) 
     */ 
    public function reservationTrajet($idTrajet): Response 
    {
      
		$participant = new Participants;
        $participant -> setIdUser($this->getUser()->getIdUtilisateur());
		$participant -> setIdTrajet($idTrajet);
        
        $repository=$this->getDoctrine()->getRepository(Trajet::class);
        $trajets = $repository->findBy(['idTrajet' => $idTrajet]);
        
        $data=array();
        foreach($trajets as $place){
            array_push($data, $place->getNbreplace());
        }
        $placeDispo=$data[0];

		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($participant);
		$entityManager->flush();

        $placeDispo--;
        $place->setNbrePlace($placeDispo);
        
		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($place);
		$entityManager->flush();

        $this->addFlash(
			'notice',
			'Votre réservation a bien été pris en compte!'
		);

        return $this->redirectToRoute('recherche');
        // return new JsonResponse($data, Response::HTTP_OK);
    }
	

	/**
     * @Route("/reservation", name="recherche_url", methods={"GET"})
     */
    public function reservationTrajetUrl()
    {
        $data = array();
        return new JsonResponse($data, Response::HTTP_OK); 
    }
	
	
	
	

}