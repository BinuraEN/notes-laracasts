<?php

use Core\Response;

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = Response::NOT_FOUND)
{
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
}

function login($user)
{
    $_SESSION['user'] = [
        'email' => $user['email'],
    ];
}

function logout(){
    $_SESSION = [];
    session_destroy();

    $cookieParams = session_get_cookie_params();
    setcookie('PHPSESSID','',time()-3600,$cookieParams['path'],$cookieParams['domain'],$cookieParams['secure'],$cookieParams['httponly']);

    session_regenerate_id(true);
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    require base_path('views/' . $path);
}
