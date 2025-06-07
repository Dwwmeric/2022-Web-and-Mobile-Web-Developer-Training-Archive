<?php

namespace App\Controller;

use App\Entity\Setting;
use App\Form\SettingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SettingController extends AbstractController
{

    ///////////////////////////
    /////////DELETE TABLE SETTING
    ///////////////////////////

    #[Route('/setting/delete/{settingkey}', name: 'delete_setting')]

    public function deletesetting($settingkey) {
        $em = $this->getDoctrine()->getManager();
        $settings = $this->getDoctrine()->getRepository(Setting::class);
        $setting = $settings->find($settingkey);
        if (!$setting) {
            throw $this->createNotFoundException(
                'No regulations for this: ' . $settingkey
            );
        }
       
        $em->remove($setting);
        $em->flush();
        return $this->redirect($this->generateUrl('home_listing'));
    }

    
    ///////////////////////////
    /////////ADD TABLE SETTING
    ///////////////////////////
    #[Route('/setting/add/', name: 'add_setting')]
    public function addsetting(Request $request): Response
    {
        $setting = new Setting();
        $form = $this->createForm(SettingType::class,$setting);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            //appel base de donée 
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($setting);
            $entityManager->flush();
            
            // attention 'menu_to_open' récupére une requet qui à l'init de la page joue l'ouverture des divers menus 
            return $this->redirectToRoute('home_listing', ['menu_to_open' => "settings" ]);
        }
        
        
        return $this->render('setting/settingForm.html.twig', [
            'SettingForm' => $form->createView(),
            'controller_name' => 'Add default',
        ]);
    }

    ///////////////////ROUTE EN AJAX POUR ADD
    #[Route('/setting/get-form', name: 'get_form_add_setting')]
    public function getFormAddSetting(Request $request): Response
    {
        $setting = new Setting();
        $form = $this->createForm(SettingType::class,$setting, [
            'action' => '/setting/add/',
        ]);
        $form_rendered = $form->createView();
        return $this->render('setting/settingForm.html.twig', [
            'SettingForm' => $form->createView(),
            'controller_name' => 'Add default',
        ]);
    }

    /////////////////////////////
    /////////UPDATE TABLE SETTING
    /////////////////////////////
    #[Route('/setting/update/{settingkey}', name: 'update_setting')]
    public function update($settingkey,Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $setting = $entityManager->getRepository(Setting::class)->find($settingkey);
       
        $form = $this->createForm(SettingType::class,$setting);
        $form->handleRequest($request);

        if (!$setting) {
            throw $this->createNotFoundException(
                'No product found for id '.$settingkey
            );
        }

        if ($form->isSubmitted() && $form->isValid()){
            //appel base de donée 
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($setting);
            $entityManager->flush();
            
            // attention 'menu_to_open' récupére une requet qui à l'init de la page joue l'ouverture des divers menus 
            return $this->redirectToRoute('home_listing', ['menu_to_open' => "settings" ]);
        }


        return $this->render('setting/settingForm.html.twig', [
            'SettingForm' => $form->createView(),
            'controller_name' => 'Changed default values',
        ]);
    }

       ////////////// ROUTE EN AJAX POUR UPDATE 
       #[Route('/setting/get-form/{settingkey}', name: 'get_form_upd_setting')]
       public function getFormUpdSetting(Request $request, $settingkey): Response
       {
           $settings = $this->getDoctrine()->getRepository(Setting::class);
           $user = $settings->find($settingkey);
           $form = $this->createForm(SettingType::class,$user, [
               'action' => '/setting/update/'.$settingkey,
           ]);
           return $this->render('setting/settingForm.html.twig', [
               'SettingForm' => $form->createView(),
               'controller_name' => 'Changed default values',
           ]);
       }
    
}
