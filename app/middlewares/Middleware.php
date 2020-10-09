<?php

namespace app\middlewares;

use Slim\Container;

/**
 * Class Middleware
 * @package app\middlewares
 */
class Middleware {

    protected Container $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }
}
