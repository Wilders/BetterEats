<?php

namespace app\controllers;

use app\helpers\Auth;
use Exception;
use Slim\Http\Request;
use Slim\Http\Response;

final class UserController extends Controller {

    public function login(Request $request, Response $response, array $args): Response {
        $this->view->render($response, 'pages/login.twig', [
            'active' => 'login'
        ]);
        return $response;
    }

    public function loginPost(Request $request, Response $response, array $args): Response {
        try {
            $email = filter_var($request->getParsedBodyParam('email'), FILTER_SANITIZE_EMAIL);
            $password = filter_var($request->getParsedBodyParam('password'), FILTER_SANITIZE_STRING);

            if (!Auth::attempt($email, $password)) throw new Exception('Adresse e-mail ou mot de passe incorrect.');

            $response = $response->withRedirect($this->router->pathFor('app.home'));
        } catch (Exception $e) {
            $this->flash->addMessage('error', $e->getMessage());
            $response = $response->withRedirect($this->router->pathFor('app.login'));
        }
        return $response;
    }


    public function logout(Request $request, Response $response, array $args): Response {
        Auth::logout();
        $this->flash->addMessage('success', "Vous avez été déconnecté.");
        $response = $response->withRedirect($this->router->pathFor('app.login'));
        return $response;
    }


}