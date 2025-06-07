<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Form\UserUpdateForm;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'utilisateur')]
    public function index(): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }
	
		/**
		* @Route("/utilisateur/update/{id}", name="update_user")
		*/
        public function update($id,Request $request, SluggerInterface $slugger, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
		$entityManager = $this->getDoctrine()->getManager();
        $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($id);
		

        $form = $this->createForm(UserUpdateForm::class, $utilisateur, array());
		
			
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
			$utilisateur = $form->getData();
			$entityManager = $this->getDoctrine()->getManager();
			$profileImage = $form->get('profileImage')->getData();
            if ($profileImage) {
                $originalFilename = pathinfo($profileImage->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$profileImage->guessExtension();
                try {
                    $profileImage->move($this->getParameter('avatars_directory'),$newFilename);
				} catch (FileException $e) {
					}
                $utilisateur->setProfileImage($newFilename);
            }
			if ( $form->get('plainPassword')->getData()) {
			
            // Encode(hash) the plain password, and set it.
            $encodedPassword = $userPasswordHasherInterface->hashPassword(
                $utilisateur,
                $form->get('plainPassword')->getData()
            );

            $utilisateur->setPassword($encodedPassword);
			}
			
			$entityManager->persist($utilisateur);
			$entityManager->flush();
			$this->addFlash('notice', 'Votre profil est bien modifié!');
			
			return $this->redirectToRoute('recherche');
        }

        return $this->render('utilisateur/update.html.twig', [
            'form' => $form->createView(),
            'title'=>'Modification de votre profil'
		]);
    }

	
}
