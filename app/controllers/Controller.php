<?php

namespace app\controllers;

use app\helpers\Auth;
use app\models\Restaurant;
use app\models\Utilisateur;
use http\Env\Response;
use Slim\Container;

/**
 * Class Controller
 * @abstract
 * @package app\controllers
 */
abstract class Controller {

    protected Container $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function __get($property) {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }

}
