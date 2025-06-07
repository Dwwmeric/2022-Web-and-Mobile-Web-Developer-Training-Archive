<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UsersController extends AbstractController
{

    
    ///////////////////////////
    /////////DELETE TABLE USERS
    ///////////////////////////
    #[Route('/users/delete/{id}', name: 'users_delete')]
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $users = $this->getDoctrine()->getRepository(User::class);
        $user = $users->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                'No user with' . $id
            );
        }
       
        $em->remove($user);
        $em->flush();
        return $this->redirect($this->generateUrl('home_listing'));
    }

    ///////////////////////////
    /////////ADD TABLE USERS
    ///////////////////////////
    #[Route('/users/add/', name: 'add_user', methods: ['POST'])]
    public function addUser(Request $request,UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
       
       if ($form->isSubmitted() && $form->isValid()){
               $entityManager = $this->getDoctrine()->getManager();
               //encodage du mot de passe
               $user->setPassword(
               $passwordEncoder->encodePassword($user, $user->getPassword()));
               // On génère un token et on l'enregistre
               $entityManager->persist($user);
               $entityManager->flush();
               
               // attention 'menu_to_open' récupére une requet qui à l'init de la page joue l'ouverture des divers menus 
                return $this->redirectToRoute('home_listing', ['menu_to_open' => "user" ]);
            
       
       }


        return $this->render('users/userForm.html.twig', [
            'UserForm' => $form->createView(),
            'controller_name' => 'Adding a user',
        ]);
    }

     ///////////////////ROUTE EN AJAX POUR ADD
     #[Route('/users/get-form', name: 'get_form_add_users',methods: ['POST'])]
     public function getFormAddUser(Request $request): Response
     {
         $user = new User();
         $form = $this->createForm(UserType::class,$user, [
             'action' => '/users/add/',
         ]);
         $form_rendered = $form->createView();
         return $this->render('users/userForm.html.twig', [
             'UserForm' => $form->createView(),
             'controller_name' => 'Adding a user',
         ]);
     }

    ///////////////////////////
    /////////UPDATE TABLE USERS
    ///////////////////////////
    #[Route('/users/update/{id}', name: 'update_users')]
    public function update($id,Request $request,UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
       
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id'.$id
            );
        }

        if ($form->isSubmitted() && $form->isValid()){
            //appel base de donée 
            $entityManager = $this->getDoctrine()->getManager();
            //encode password
            $user->setPassword(
            $passwordEncoder->encodePassword($user, $user->getPassword()));
            $entityManager->persist($user);
            $entityManager->flush();
            
            // attention 'menu_to_open' récupére une requet qui à l'init de la page joue l'ouverture des divers menus 
            return $this->redirectToRoute('home_listing', ['menu_to_open' => "user" ]);
            
        }


        return $this->render('users/userForm.html.twig', [
            'UserForm' => $form->createView(),
            'controller_name' => 'Modify a user',
            'translation_domain'=>'messages',
        ]);
    }

       ////////////// ROUTE EN AJAX POUR UPDATE 
       #[Route('/users/get-form/{id}', name: 'get_form_upd_user')]
       public function getFormUpdUser(Request $request, $id): Response
       {
           $users = $this->getDoctrine()->getRepository(User::class);
           $user = $users->find($id);
           $form = $this->createForm(UserType::class,$user, [
               'action' => '/users/update/'.$id,
           ]);
           return $this->render('users/userForm.html.twig', [
               'UserForm' => $form->createView(),
               'controller_name' => 'Modify a user',
           ]);
       }
 
}
