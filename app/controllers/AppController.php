<?php

namespace app\controllers;

use Slim\Http\Request;
use Slim\Http\Response;

final class AppController extends Controller {
    public function index(Request $request, Response $response, array $args): Response {
        return $response->withJson(['response' => true]);
    }

}