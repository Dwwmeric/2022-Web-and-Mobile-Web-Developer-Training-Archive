<?php

namespace App\Controller;

use App\Entity\Setting;
use App\Entity\Squares;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends AbstractController
{
    ///////////////////////////////////////////
    ///LIAISON AVEC BDD EST LECTURE DES DONNEES DANS LES TABLES
    ///(UTILISATEUR="users", APPLICATION= "setting", PLATEAU="squares")
    ///////////////////////////////////////////
    #[Route('/home', name: 'home_listing')]
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findall();

        $repose = $this->getDoctrine()->getRepository(Setting::class);
        $setting = $repose->findall();
       
        $repair = $this->getDoctrine()->getRepository(Squares::class);
        $squares= $repair->findall();

    
        return $this->render('home/index.html.twig', [
            'users'=> $users,
            'setting'=> $setting,
            'squares'=> $squares,
            'menu_to_open' => (isset($_GET["menu_to_open"])) ? $_GET["menu_to_open"] : NULL, ////récupération du paramétre de requet
        ]);
    }

    
      ///////////////////////////////////////////
    ///LIAISON AVEC BDD EST LECTURE DES DONNEES DANS LES TABLES
    ///(UTILISATEUR= PLATEAU="squares") EN JSON
    ///////////////////////////////////////////
    #[Route('/home/users', name: 'users_jsons')]
    public function usersJson()
    {
        $em = $this->getDoctrine()->getManager();
        $user= $em->getRepository(User::class)->findBy(array());

        $datas = array();
        foreach ($user as $key => $users){
            $datas[$key]['id'] = $users->getId();
            $datas[$key]['email'] = $users->getEmail();
            $datas[$key]['roles'] = $users->getRole();
        }
        
        return new JsonResponse($datas);
    }





      ///////////////////////////////////////////
    ///LIAISON AVEC BDD EST LECTURE DES DONNEES DANS LES TABLES
    ///(UTILISATEUR= PLATEAU="squares") EN JSON
    ///////////////////////////////////////////
    #[Route('/home/setting', name: 'setting_jsons')]
    public function settingJson()
    {
        $em = $this->getDoctrine()->getManager();
        $setting= $em->getRepository(Setting::class)->findBy(array());

        $datas = array();
        foreach ($setting as $key => $settings){
            $datas[$key]['key'] = $settings->getSettingKey();
            $datas[$key]['value'] = $settings->getValue();
        }
        
        return new JsonResponse($datas);
    }
    
    ///////////////////////////////////////////
    ///LIAISON AVEC BDD EST LECTURE DES DONNEES DANS LES TABLES
    ///(UTILISATEUR= PLATEAU="squares") EN JSON
    ///////////////////////////////////////////
    #[Route('/home/squares', name: 'squares_jsons')]
    public function Squaresjson()
    {
        $em = $this->getDoctrine()->getManager();
        $square= $em->getRepository(Squares::class)->findBy(array());

        $datas = array();
        foreach ($square as $key => $squares){
            $datas[$key]['order'] = $squares->getOrder();
            $datas[$key]['name'] = $squares->getName();
            $datas[$key]['type'] = $squares->getType();
            $datas[$key]['description'] = $squares->getDescription();
            $datas[$key]['headerColorText'] = $squares->getHeaderColorText();
            $datas[$key]['headerColorBg'] = $squares->getHeaderColorBg();
            $datas[$key]['headerDisplay'] = $squares->getHeaderDisplay();
            $datas[$key]['bodyColorText'] = $squares->getBodyColorText();
            $datas[$key]['bodyColorBg'] = $squares->getBodyColorBg();
            $datas[$key]['bodyImg'] = $squares->getBodyImg();
            $datas[$key]['bodyText'] = $squares->getBodyText();
            $datas[$key]['footerColorText'] = $squares->getFooterColorText();
            $datas[$key]['footerColorBg'] = $squares->getFooterColorBg();
            $datas[$key]['footerValue'] = $squares->getFooterValue();
            $datas[$key]['footerDisplay'] = $squares->getFooterDisplay();
            $datas[$key]['id'] = $squares->getId();

        }
        
        return new JsonResponse($datas);
    }

    
}
