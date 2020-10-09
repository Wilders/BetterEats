<?php

namespace app\controllers;

use app\helpers\Auth;
use app\models\Restaurant;
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

}