<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Trajet;
use App\Entity\Etape;
use App\Entity\Utilisateur;
use App\Form\TrajetType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TrajetController extends AbstractController
{
    #[Route('/trajet', name: 'trajet')]
    public function index(): Response
    {
        return $this->render('trajet/index.html.twig', [
            'controller_name' => 'trajetController',
        ]);
    }
	
		/**
		* @Route("/add/trajet", name="add_trajet")
		*/
		public function add(Request $request): Response
    {

		$userId = $this->getUser()->getIdUtilisateur();
		$trajet = new Trajet();
        $trajet->setIdVilleDepart('');
		$trajet->setIdVilleRetour('');
		$trajet->setNbrePlace(0);
        $trajet->setDateDepart(new \DateTime('tomorrow'));
		$trajet->setIdUtilisateur($userId);
		$trajet->setPrixTrajet('');
		$trajet->setDistanceTrajet('');
		
        $form = $this->createForm(TrajetType::class,$trajet);
            
		$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
			$coordonnees=$form->get('coordonnees')->getData();
			$trajet = $form->getData();
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($trajet);
			$entityManager->flush();
			$repository=$this->getDoctrine()->getRepository(Trajet::class);
			$last_trajet = $repository->findAll();
				foreach($last_trajet as $trajet){
					$trajet_last = $trajet->getIdTrajet();
				}
				$cordAll = explode("/", $coordonnees);
				foreach($cordAll as $etape){
					$cordLL = explode(',', $etape);
					$etapeN = new Etape();
					$etapeN->setIdTrajet($trajet_last);
					$etapeN->setLatitude($cordLL[0]);
					$etapeN->setLongitude($cordLL[1]);
					$etapeN->setEtapeTime($cordLL[2]);
					$entityManager = $this->getDoctrine()->getManager();
					$entityManager->persist($etapeN);
					$entityManager->flush();
				}
			$this->addFlash(
				'notice',
				'Trajet bien ajouté!'
			);
			return $this->redirectToRoute('recherche');
        }
			
        return $this->render('trajet/add.html.twig', [
           'form' => $form->createView(),
		   'title'=>'Ajout d\'un trajet'
        ]);
    }
	
	
	
		/**
		* @Route("/trajet/update/{id}", name="update_trajet")
		*/
	public function update($id,Request $request): Response
    {
		$entityManager = $this->getDoctrine()->getManager();
        $trajet = $entityManager->getRepository(Trajet::class)->find($id);
		
        $form = $this->createForm(TrajetType::class,$trajet,array());
            
		$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
			$trajet = $form->getData();
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($trajet);
			$entityManager->flush();
			$this->addFlash(
				'notice',
				'Trajet bien modifiée!'
			);
			return $this->redirectToRoute('recherche');
        }
			
        return $this->render('trajet/add.html.twig', [
           'form' => $form->createView(),
		   'title'=>'Modification d\'un trajet'
        ]);
    }
	
	/**
		* @Route("/trajet/delete/{id}", name="delete_trajet")
		*/
	public function delete($id): Response
    {
		$entityManager = $this->getDoctrine()->getManager();
        $trajet = $entityManager->getRepository(Trajet::class)->find($id);
		
			$entityManager->remove($trajet);
			$entityManager->flush();
			$this->addFlash(
				'notice',
				'Trajet bien supprimé!'
			);
			return $this->redirectToRoute('recherche');
        }
       
}
	
	
	

