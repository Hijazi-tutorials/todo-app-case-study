<?php
require_once '../utils/buffer_session_init.php';
require_once '../helpers/UniqueGeneratorHelper.php';
require_once '../helpers/DateHelper.php';
require_once '../helpers/RedirectHelper.php';
require_once '../helpers/DatabaseHelper.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    throw new Exception("You can't create new todo item without POST request!");
}
if (! key_exists('title', $_POST)) {
    throw new Exception("Can't create todo item without title");
}
if (! key_exists('description', $_POST)) {
    throw new Exception("Can't create todo item without description");
}

DatabaseHelper::createResource(
    'todo_items',
    ['title', 'description'],
    [$_POST['title'], $_POST['description']]
);

$incrementedId = UniqueGeneratorHelper::generateAutoIncrementId();

$_SESSION['items']['todo'][$incrementedId] = [
  'id' => $incrementedId,
  'title' => $_POST['title'],
  'description' => $_POST['description'],
  'created_at' => DateHelper::humanDateFormat()
];

RedirectHelper::redirectToPreviousPage();







