<?php
session_start();

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';


spl_autoload_register(function ($class) {
    //replacing backward \ with forward /
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require base_path("{$class}.php");
});

require base_path('bootstrap.php');

$router = new \Core\Router();

require base_path("routes.php");

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

try {
    $router->route($uri, $_POST['_method'] ?? $_SERVER['REQUEST_METHOD']);
} catch (\Core\ValidationException $e) {
    \Core\Session::flash('errors', $e->errors);
    \Core\Session::flash('old', $e->old);

    return redirect($router->previousUrl());

}


\Core\Session::unflash();
















