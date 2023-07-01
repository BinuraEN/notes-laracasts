<?php

use Core\App;

$db = App::resolve('Core\Database');

$currentUserId = 1;

$note = $db->query("select * from notes where  id = :id", [
    'id' => $_POST['note_id'],
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$db->query('delete from notes where id = :id', [
    'id' => $_POST['note_id']
]);

header('location: /notes');
exit();

