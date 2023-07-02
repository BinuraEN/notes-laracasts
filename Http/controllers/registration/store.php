<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password= $_POST['password'];

$errors = [];

if(! Validator::email($email)){
    $errors['email'] = 'Please provide a valid email address';
}

if(! Validator::string($password,7,255)){
    $errors['password'] = 'Please provide a password of at least 7 characters';
}

if(! empty($errors)){
    view('registration/create.view.php',[
        'errors' => $errors,
    ]);
    die();
}

$db = App::resolve(Database::class);

$user = $db->query('select * from users where email = :email',[
    'email' => $email,
])->find();

if($user){

    header('location: /');
    die();

}else{
    $db->query('insert into users(email,password) values(:email,:password)',[
        'email' => $email,
        'password' => password_hash($password,PASSWORD_BCRYPT),
    ]);

    login([
        'email' => $email,
    ]);

    header('location: /');
    die();

}






