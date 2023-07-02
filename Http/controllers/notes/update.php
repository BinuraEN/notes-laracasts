<?php

use Core\App;
use Core\Validator;

$db = App::resolve('Core\Database');
$currentUserId = 1;

$note = $db->query("select * from notes where id = :id", [
    'id' => $_POST['id'],
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$errors = [];

if (!Validator::string($_POST['body'], 1, 100)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required';
}

if (!empty($errors)) {
    view("notes/edit.view.php",[
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note,
    ]);
}


$db->query('update notes set body = :body where id = :id', [
    'body' => $_POST['body'],
    'id' => $_POST['id'],
]);

header('location: /notes');
die();
