<?php

$router->get('/','index.php');
$router->get('/about','about.php');
$router->get('/contact','contact.php');

$router->get('/note','notes/show.php');
$router->get('/notes','notes/index.php')->only('auth');
$router->get('/notes/create','notes/create.php');
$router->get('/notes/edit','notes/edit.php');
$router->post('/notes','notes/store.php');
$router->patch('/note','notes/update.php');
$router->delete('/note','notes/destroy.php');

$router->get('/register','registration/create.php')->only('guest');
$router->post('/register','registration/store.php')->only('guest');

$router->get('/login','sessions/create.php')->only('guest');
$router->post('/sessions','sessions/store.php')->only('guest');
$router->delete('/session','sessions/destroy.php')->only('auth');
