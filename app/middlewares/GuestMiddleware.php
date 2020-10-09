<?php

namespace app\middlewares;

use app\helpers\Auth;
use Exception;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class AuthMiddleware
 * @package app\middlewares
 */
final class GuestMiddleware extends Middleware {

    /**
     * Check if the user is connected
     */
    public function __invoke(Request $request, Response $response, $next) {
        try {
            if (Auth::check()) throw new Exception();
        } catch (Exception $e) {
            return $response->withRedirect($this->container->router->pathFor('app.home'));
        }

        $response = $next($request, $response);
        return $response;
    }
}