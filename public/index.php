<?php

use app\controllers\AppController;
use app\extensions\TwigMessages;
use app\helpers\Auth;
use app\middlewares\AuthMiddleware;
use app\middlewares\GuestMiddleware;
use Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager;
use Slim\App;
use Slim\Flash\Messages;
use Slim\Http\Uri;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Twig\Environment;

require_once(__DIR__ . '/../vendor/autoload.php');
session_start();
date_default_timezone_set('Europe/Paris');

$env = Dotenv::createImmutable(__DIR__ . '/../');
$env->load();
$env->required(['DB_DRIVER', 'DB_HOST', 'DB_PORT', 'DB_USER', 'DB_PWD', 'DB_NAME']);

$db = new Manager();
$db->addConnection([
    'driver' => $_ENV['DB_DRIVER'],
    'host' => $_ENV['DB_HOST'],
    'database' => $_ENV['DB_NAME'],
    'username' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PWD']
]);
$db->setAsGlobal();
$db->bootEloquent();

$app = new App(['settings' => ['displayErrorDetails' => 1]]);

$container = $app->getContainer();

$container['flash'] = function () {
    return new Messages();
};
$container['view'] = function () use ($container) {
    $view = new Twig(__DIR__ . '/../templates', [
        'cache' => false
    ]);


    $view->getEnvironment()->addGlobal('auth', [
        'check' => Auth::check(),
        'user' => Auth::user()
    ]);

    $view->addExtension(new TwigExtension($container->router, Uri::createFromEnvironment(new Environment($_SERVER))));
    $view->addExtension(new TwigMessages(new Messages()));

    return $view;
};

$app->get('/', AppController::class . ':index')->setName('app.index');

$app->group('', function (App $app) {
    $app->get('/login', AppController::class . ':login')->setName('app.login');
    $app->post('/login', AppController::class . ':loginPost')->setName('app.login.submit');
})->add(new GuestMiddleware($container));

$app->group('', function (App $app) {
    $app->get('/home', AppController::class . ':home')->setName('app.home');
    $app->get('/logout', AppController::class . ':logout')->setName('app.logout');
})->add(new AuthMiddleware($container));

/**
 * Run App
 */
$app->run();
