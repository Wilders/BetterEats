<?php

namespace app\controllers;

use app\helpers\Auth;
use app\models\Commande;
use app\models\Restaurant;
use http\Exception;
use Slim\Http\Request;
use Slim\Http\Response;

final class RestaurantController extends Controller {

    public function restaurants(Request $request, Response $response, array $args): Response {
        $restaurants = Restaurant::all();
        $this->view->render($response, 'app/login.twig', [
            'active' => 'login',
            'restaurants' => $restaurants
        ]);
        return $response;
    }

    public function commandes(Request $request,Response $response,array $args): Response {
        $restaurant = new Restaurant();
        try {
            if ($restaurant->proprietaire() == Auth::user()->idt){
                $commande = $restaurant->commandes();
                $this->view->render($response,'app/login.twig',['commande' => $commande]);
            }
        }catch (Exception $e) {
            $this->flash->addMessage('error', $e->getMessage());
            $response = $response->withRedirect($this->router->pathFor('app.adresse'));
        }
    }

}