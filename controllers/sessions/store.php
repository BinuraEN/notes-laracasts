<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

if(!Validator::email($email)){
$errors['email'] = 'Please provide a valid email address';
}

if (!Validator::string($password,)) {
    $errors['password'] = 'Please provide a valid password';
}

if (!empty($errors)) {
    view('sessions/create.view.php', [
        'errors' => $errors,
    ]);
    die();
}

$db = App::resolve(Database::class);

$user = $db->query('select * from users where email = :email', [
    'email' => $email,
])->find();


if ($user) {
    if(password_verify($password,$user['password']))
    {
        login([
            'email' => $email,
        ]);

        header('location: /notes');
        die();
    }
}

view('sessions/create.view.php', [
    'errors' => [
        'email' => 'No matching account found for entered email address and password'
    ],
]);
die();




