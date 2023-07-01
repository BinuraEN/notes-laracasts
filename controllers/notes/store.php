<?php

use Core\App;
use Core\Validator;

$db = App::resolve('Core\Database');

$errors = [];

if (!Validator::string($_POST['body'], 1, 100)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required';
}

if (!empty($errors)) {
    view("notes/create.view.php",[
        'heading' => 'Create a Note',
        'errors' => $errors,
    ]);
    die();
}

$db->query('INSERT INTO notes(body,user_id) VALUES(:body,:user_id)', [
    'body' => $_POST['body'],
    'user_id' => 1
]);

header('location: /notes');
die();



