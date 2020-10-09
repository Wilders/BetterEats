<?php

namespace app\controllers;

use app\helpers\Auth;
use app\models\Utilisateur;
use Exception;
use Slim\Http\Request;
use Slim\Http\Response;

final class UserController extends Controller {

    public function login(Request $request, Response $response, array $args): Response {
        $this->view->render($response, 'app/login.twig', [
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

    public function register(Request $request, Response $response, array $args): Response {
        $this->view->render($response, 'app/register.twig', [
            'active' => 'register'
        ]);
        return $response;
    }

    public function registerPost(Request $request, Response $response, array $args): Response {
        try {
            $firstname = filter_var($request->getParsedBodyParam('firstname'), FILTER_SANITIZE_STRING);
            $lastname = filter_var($request->getParsedBodyParam('lastname'), FILTER_SANITIZE_STRING);
            $address = filter_var($request->getParsedBodyParam('address'), FILTER_SANITIZE_STRING);
            $email = filter_var($request->getParsedBodyParam('email'), FILTER_SANITIZE_EMAIL);
            $password = filter_var($request->getParsedBodyParam('password'), FILTER_SANITIZE_STRING);
            $status = filter_var($request->getParsedBodyParam('status'), FILTER_SANITIZE_STRING);

            $user = new Utilisateur();
            $user->nom = $firstname;
            $user->prenom = $lastname;
            $user->email = $email;
            $user->mdp = password_hash($password, PASSWORD_DEFAULT);;
            $user->adresse = $address;
            $user->statut = $status;
            $user->save();

            $this->flash->addMessage('success', "$firstname, votre compte a été créé! Vous pouvez dès à présent vous connecter.");
            $response = $response->withRedirect($this->router->pathFor('app.login'));
        } catch (Exception $e) {
            $this->flash->addMessage('error', $e->getMessage());
            $response = $response->withRedirect($this->router->pathFor("app.register"));
        }
        return $response;
    }

    public function logout(Request $request, Response $response, array $args): Response {
        Auth::logout();
        $this->flash->addMessage('success', "Vous avez été déconnecté.");
        $response = $response->withRedirect($this->router->pathFor('app.login'));
        return $response;
    }

    public function updateAdresse(Request $request, \http\Env\Response $response, array $args): \http\Env\Response
    {
        $this->view->render($response, 'app/updateAdresse.twig');
        return $response;
    }
    public function updateAdressePost(Request $request, Response $response, array $args): Response{
        try {
            $adresse = filter_var($request->getParsedBodyParam('inputAdresse'), FILTER_SANITIZE_EMAIL);

            if (!Auth::attempt($adresse)) throw new Exception('Adresse non valide');

            $response = $response->withRedirect($this->router->pathFor('app.home'));
        } catch (Exception $e) {
            $this->flash->addMessage('error', $e->getMessage());
            $response = $response->withRedirect($this->router->pathFor('app.adresse'));
        }
        return $response;
    }
}