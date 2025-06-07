<?php

namespace App\Controller;

use App\Entity\Squares;
use App\Form\SquaresType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class SquaresController extends AbstractController
{
    ///////////////////////////
    /////////DELETE TABLE SQUARES
    ///////////////////////////
    #[Route('/squares/delete/{id}', name: 'delete_squares')]
    public function deleteSquare($id) {
        $em = $this->getDoctrine()->getManager();
        $squares = $this->getDoctrine()->getRepository(Squares::class);
        $square = $squares->find($id);
        if (!$square) {
            throw $this->createNotFoundException(
                'No box with this id: ' . $id
            );
        }
       
        $em->remove($square);
        $em->flush();
        return $this->redirect($this->generateUrl('home_listing'));
    }

    
    ///////////////////////////
    /////////ADD TABLE SQUARES
    ///////////////////////////
    #[Route('/squares/add', name: 'add_squares')]
    public function addSquares(Request $request, SluggerInterface $slugger): Response
    {
        
        $squares = new Squares();
        
        $form = $this->createForm(SquaresType::class,$squares);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            //appel base de donée 
            $entityManager = $this->getDoctrine()->getManager();
            $profileImage = $form->get('bodyImg')->getData();
            
            if ($profileImage) {
                $originalFilename = pathinfo($profileImage->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$profileImage->guessExtension();
                
                // Move the file to the directory where brochures are stored
                try {
                    $profileImage->move(
                        $this->getParameter('avatars_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                
                // updates the 'brochureFilename' property to store the file name
                // instead of its contents
                $squares->setBodyImg($newFilename);
            }
            $entityManager->persist($squares);
            $entityManager->flush();

            // attention 'menu_to_open' récupére une requet qui à l'init de la page joue l'ouverture des divers menus 
            return $this->redirectToRoute('home_listing', ['menu_to_open' => "squares" ]);
            
        }
        
        
        return $this->render('squares/squaresForm.html.twig', [
            'SquaresForm' => $form->createView(),
            'controller_name' => 'Adding a box',
        ]);
    }



    ///////////////////ROUTE EN AJAX POUR ADD
    #[Route('/squares/get-form', name: 'get_form_add_square')]
    public function getFormAddSquare(Request $request, SluggerInterface $slugger): Response
    {
        $square = new Squares();
        $form = $this->createForm(SquaresType::class,$square, [
            'action' => '/squares/add',
        ]);
        $form_rendered = $form->createView();
        return $this->render('squares/squaresForm.html.twig', [
            'SquaresForm' => $form->createView(),
            'controller_name' => 'Adding a box',
        ]);
    }



    /////////////////////////////
    /////////UPDATE TABLE SQUARES
    /////////////////////////////
    #[Route('/squares/update/{id}', name: 'update_squares')]
    public function update($id,Request $request,SluggerInterface $slugger): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $squares = $entityManager->getRepository(Squares::class)->find($id);
        
        $form = $this->createForm(SquaresType::class,$squares, array());
        $form->handleRequest($request);
        
        if (!$squares) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        
        if ($form->isSubmitted() && $form->isValid()){ 
            //appel base de donée 
            $entityManager = $this->getDoctrine()->getManager();
            $profileImage = $form->get('bodyImg')->getData();
            if ($profileImage) {
                $originalFilename = pathinfo($profileImage->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$profileImage->guessExtension();
                try {
                    $profileImage->move($this->getParameter('avatars_directory'),$newFilename);
				} catch (FileException $e) {
                }
                $squares->setBodyImg($newFilename);
            }
            $entityManager->persist($squares);
            $entityManager->flush();
            
            // attention 'menu_to_open' récupére une requet qui à l'init de la page joue l'ouverture des divers menus 
            return $this->redirectToRoute('home_listing', ['menu_to_open' => "squares" ]);
        }
        
        
        return $this->render('squares/squaresForm.html.twig', [
            'SquaresForm' => $form->createView(),
            'controller_name' => 'Modified the values of the boxes',
        ]);
    }
    
    ////////////// ROUTE EN AJAX POUR UPDATE 
    #[Route('/squares/get-form/{id}', name: 'get_form_upd_square')]
    public function getFormUpdSquare(Request $request, SluggerInterface $slugger, $id): Response
    {
        $squares = $this->getDoctrine()->getRepository(Squares::class);
        $square = $squares->find($id);
        $form = $this->createForm(SquaresType::class,$square, [
            'action' => '/squares/update/'.$id,
        ]);
        return $this->render('squares/squaresForm.html.twig', [
            'SquaresForm' => $form->createView(),
            'controller_name' => 'Modified the values of the boxes',
        ]);
    }
     
}
