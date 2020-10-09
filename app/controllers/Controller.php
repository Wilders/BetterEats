<?php

namespace app\controllers;

use app\models\Utilisateur;
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

    public function adresse(){

    }
    public function updateAdresse(){
        $utilisateur = new Utilisateur();

    }
}
