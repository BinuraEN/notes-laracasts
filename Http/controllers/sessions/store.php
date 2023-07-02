<?php

use Core\App;
use Core\Database;
use Core\ValidationException;
use Http\Forms\LoginForm;
use Core\Authenticator;
use Core\Session;


$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password'],
]);

$signedIn = (new Authenticator())->attempt($attributes['email'], $attributes['password']);

if (!$signedIn) {
    $form->error(
        'email',
        'No matching account found for given email address and password')
        ->throw();

}

redirect('/');

















