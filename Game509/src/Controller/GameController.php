<?php

namespace App\Controller;

use App\Entity\Setting;
use App\Entity\Squares;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

class GameController extends AbstractController
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    } 

    ///////////////////////////////////////////
    ///LIAISON AVEC BDD EST LECTURE DES DONNEES DANS LES TABLES
    ///(UTILISATEUR="users", APPLICATION= "setting", PLATEAU="squares")
    ///////////////////////////////////////////
    #[Route('/game', name: 'game_listing')]
    public function index(): Response
    {
        $session = $this->requestStack->getSession();

        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findall();

        $repose = $this->getDoctrine()->getRepository(Setting::class);
        $setting = $repose->findall();
       
        $repair = $this->getDoctrine()->getRepository(Squares::class);
        $squares= $repair->findall();

    
        return $this->render('game/index.html.twig', [
            'setting'=> $setting,
            'squares'=> $squares,
        ]);
    }

     ///////////////////////////////////////////
    ///création des donées session de la partie 
    ///////////////////////////////////////////
    #[Route('/game/session/', name: 'game_play', methods: "POST")]
    public function gameSession()
    {
        
        $session = $this->requestStack->getSession(); ///connection à la session de la partie 

        //condition pour la création des sessions de la partie 
        if (isset($_POST['players']) && ($_POST['turns'] !=0)) {
            
           //création des sessions joueurs  
            $players = $_POST["players"];
            
            foreach( $players as $k_players => $v_player){
                $user [] = [
                    "name"=>$v_player["value"],
                    "pos"=> 1,
                    "score"=>0,
                    "turn"=>0,
                ];
            }
            
            $session->set('user',$user);

           
            $game=  [
                "turnMax"=> $_POST["turns"],
                "playerMax"=> count($_POST['players']) - 1 ,
                "Square"=> 0,
                "player"=>0,
            ];
           
        
        $session->set('game',$game);
        $play = $session->get('game')["player"];
        }else{ 
          

        $session = $this->requestStack->getSession(); 


        $play = $session->get('game')["player"];
       
        }
       
        
        return new JsonResponse (
             $this->renderView('game/gameSlide3.html.twig', [
            'player' => $session->get('user')[$play],
            'Play' => $session->get('game'),
             ]),
        );
        
    }
    
    ///////////////////////////////////////////
    ///gestiion des donées session du résultat
    ///////////////////////////////////////////
    #[Route('/game/result/', name: 'game_result', methods: "POST")]
    public function gameResult()
    {
        //connection des données $session et case=$square 
        $session = $this->requestStack->getSession(); 

        $repair = $this->getDoctrine()->getRepository(Squares::class); 
        $squares= $repair->findall();

        $throwdice = $_POST["dice"]; // valeur du dé 

        $play = $session->get('game')["player"]; // valeur du joueur actuel
        
        
        /// modification des donnée session joueur à l'action de la case 
        $users = $session->get('user'); 
        
        $users[$play]["pos"] += $throwdice ;//somme du dé avec la position du joueur    A modiver direct aprés  type déplacement effectuer !!!!!

    

        ////// le conpte tour du plateau avec retrait des cases max du plateau 
        $squareMax = count($squares);//récupére le max de case automatiquement 

        //joue l'ajout des tours en automatique 
        if($users[$play]["pos"] > $squareMax){
            $users[$play]["pos"] -= $squareMax;
            $users[$play]["turn"] += 1;
            // dump($users[$play]["pos"]); afficche la possition du joueur 
            // dump($users[$play]["turn"]); affiche les turn du joueur 
        }
        
        
        //ajout d'un +1 sur le game player pour recréer la boucle de jeu 
        $gamesession = $session->get('game');
        
        /// joue automatiquement les + 1 des tour du joueur 
        if ($gamesession['playerMax'] == $gamesession['player']){
            $gamesession['player'] = 0 ;
            
        }else {
            $gamesession['player'] += 1 ;  
        }
        
        /// joue automatiquement les + 1 des tour du joueur 
        if ($users[$play]["turn"] ==  $gamesession['turnMax']){
            $users[$play]["pos"] = 0 ;
            
        }
        
        /// affichage des donné de la case suivante 
        for($i = 0 ; $i< count($squares); ++$i) {
            if ($squares[$i]->getOrder() == $users[$play]["pos"]){
                $square = $squares[$i];
            }
        }

        
        /// modification du score 
        if($square -> getType() === "bonus"){
            $users[$play]["score"] += intval($square -> getFooterValue());//ajout des bonus 
        }elseif ($square -> getType() === "malus"){
            $users[$play]["score"] -= intval($square -> getFooterValue());//retrait des malus ////attention modif 
        }elseif ($square -> getType() === "collaboration"){
           foreach($users as $key => $value){
             $users[$key]["score"] += intval($square -> getFooterValue());//ajout des points de collaboration de tous les joueurs 
           }
        }elseif ($square -> getType() === "deplacement"){
            $users[$play]["pos"] = 1 ;
            $users[$play]["turn"] += 1 ;
        }
        
        switch($square -> getType()){
            case "bonus":
                $users[$play]["score"] += intval($square -> getFooterValue());//ajout des bonus 
                break;
            case "malus":
                $users[$play]["score"] -= intval($square -> getFooterValue());//retrait des malus ////attention modif 
                break;
            case "collaboration":
                $users[$key]["score"] += intval($square -> getFooterValue());//ajout des points de collaboration de tous les joueurs 
                break;
            case "deplacement":
                $users[$play]["pos"] = 1 ;
                $users[$play]["turn"] += 1 ;
                break;
        }
        
       
       
        // set des nouvel donnée game
        $session->set('game', $gamesession);

        // set des nouvel donnée user
        $session->set('user', $users);

        return new JsonResponse (
            $this->renderView('game/gameSlide4.html.twig',[
                'player' => $session->get('user')[$play], 
                'square' => $square,
                'play'   => $session->get('game'),
             ])
        );
        
    }

      ///////////////////////////////////////////
    ///création des donées score pendant la partie 
    ///////////////////////////////////////////
    #[Route('/game/get-score/', name: 'game_score', methods: "GET")]
    public function gameScore()
    {
       
        $session = $this->requestStack->getSession(); 
        
        $session->get('user');


     
        return new JsonResponse (
             $this->renderView('game/gameScoreModal.html.twig',[
                 "score"=> $session->get('user'),
             ])
        );
        
    }

    
      ///////////////////////////////////////////
    ///création des donées session de la partie 
    ///////////////////////////////////////////
    #[Route('/game/finish/', name: 'game_finish', methods: "POST")]
    public function gameFinish()
    {
        $session = $this->requestStack->getSession(); 
        
        $session->get('user');
        
       $users = $session->get('user');

       asort($users);/////classement des données par ordre de la clée score 

       $price = array();
       foreach ($users as $key => $row)
       {
           $price[$key] = $row['score'];
       }
       array_multisort($price, SORT_DESC, $users);
       

       $session->set('user', $users);

    
        return new JsonResponse (
             $this->renderView('game/gameSlide5.html.twig', [
                 "player" => $session->get('user'),
                 "pos1" => $session->get('user')[0],
                 "pos2" => (isset($session->get('user')[1])) ? $session->get('user')[1] : NULL,
                 "pos3" => (isset($session->get('user')[2])) ? $session->get('user')[2] : NULL,
             ])
        );
        
    }

    


    
}
