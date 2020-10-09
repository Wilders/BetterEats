<?php

namespace app\controllers;

use app\helpers\Auth;
use Slim\Http\Request;
use Slim\Http\Response;

final class AppController extends Controller {
    public function index(Request $request, Response $response, array $args): Response {
        if(Auth::check()) {
            $response = $response->withRedirect($this->router->pathFor('app.home'));
        } else {
            $response = $response->withRedirect($this->router->pathFor('app.login'));
        }
        return $response;
    }

}