<?php
session_start();

require_once __DIR__ . '/../core/Router.php';

$router = new Router();

// Register Photo Routes
$router->add('GET', '/', ['PhotoController', 'index']);
$router->add('GET', '/about', ['PhotoController', 'about']);
$router->add('GET', '/photo/create', ['PhotoController', 'create']);
$router->add('POST', '/photo/store', ['PhotoController', 'store']);
$router->add('GET', '/photo/{id}', ['PhotoController', 'show']);
$router->add('GET', '/photo/{id}/delete', ['PhotoController', 'delete']);

// Register Comment Route
$router->add('POST', '/comment/store', ['CommentController', 'store']);

// Register Authentication Routes
$router->add('GET', '/login', ['AuthController', 'showLogin']);
$router->add('POST', '/login', ['AuthController', 'login']);
$router->add('GET', '/register', ['AuthController', 'showRegister']);
$router->add('POST', '/register', ['AuthController', 'register']);
$router->add('GET', '/logout', ['AuthController', 'logout']);

// Handle request URI mapping for local subdirectories in XAMPP
$uri = $_SERVER['REQUEST_URI'];
$scriptName = dirname($_SERVER['SCRIPT_NAME']);
$uri = str_replace($scriptName, '', $uri);
$uri = rtrim($uri, '/');
if ($uri === '') {
    $uri = '/';
}

$router->dispatch($uri, $_SERVER['REQUEST_METHOD']);
?>