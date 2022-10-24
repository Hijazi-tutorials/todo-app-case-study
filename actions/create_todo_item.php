<?php
require_once '../utils/buffer_session_init.php';
require_once '../helpers/UniqueGeneratorHelper.php';
require_once '../helpers/DateHelper.php';
require_once '../helpers/RedirectHelper.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    throw new Exception("You can't create new todo item without POST request!");
}
if (! key_exists('title', $_POST)) {
    throw new Exception("Can't create todo item without title");
}
if (! key_exists('description', $_POST)) {
    throw new Exception("Can't create todo item without description");
}

$_SESSION['items']['todo'][] = [
  'id' => UniqueGeneratorHelper::generateAutoIncrementId(),
  'title' => $_POST['title'],
  'description' => $_POST['description'],
  'created_at' => DateHelper::humanDateFormat()
];

RedirectHelper::redirectToPreviousPage();







