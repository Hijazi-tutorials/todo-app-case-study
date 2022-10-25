<?php
require_once '../utils/buffer_session_init.php';
require_once '../helpers/UniqueGeneratorHelper.php';
require_once '../helpers/DateHelper.php';
require_once '../helpers/RedirectHelper.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    throw new Exception("You can't assign todo-item as completed without POST request!");
}
if (! key_exists('item_id', $_POST)) {
    throw new Exception("Can't create todo item without title");
}

$item_id = $_POST['item_id'];
$item = $todoItems[$item_id];

// this like move item from to.do array (by remove item from the list) to completed array (by add item to the list)
unset($_SESSION['items']['todo'][$item_id]);
unset($todoItems[$item_id]);

$_SESSION['items']['completed'][$item_id] = [
    'id' => $item_id,
    'title' => $item['title'],
    'description' => $item['description'],
    'created_at' => $item['created_at'],
    'completed_at' => DateHelper::humanDateFormat()
];

$_SESSION['redirect_message'] =
    sprintf(
        "Assign `%s` item as completed, you can find it in completed list.",
        $item['title']
    );

RedirectHelper::redirectToPreviousPage();