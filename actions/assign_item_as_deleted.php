<?php
require_once '../utils/buffer_session_init.php';
require_once '../helpers/UniqueGeneratorHelper.php';
require_once '../helpers/DateHelper.php';
require_once '../helpers/RedirectHelper.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    throw new Exception("Can't delete item without POST request.");
}
if (! key_exists('item_id', $_POST)) {
    throw new Exception("Should passing the item id within the request.");
}
if(! key_exists('delete_from', $_POST)) {
    throw new Exception("Have to declare from which list is deleting.");
}

$item_id = $_POST['item_id'];
$delete_from = $_POST['delete_from'];

if ($delete_from == "todo-list") {
    $item = $todoItems[$item_id];

    unset($_SESSION['items']['todo'][$item_id]);
    unset($todoItems[$item_id]);
} elseif ($delete_from == "completed-list") {
    $item = $completedItems[$item_id];

    unset($_SESSION['items']['completed'][$item_id]);
    unset($completedItems[$item_id]);
} else {
    throw new Exception("Deleting from $delete_from isn't supported!");
}


$_SESSION['items']['deleted'][$item_id] = [
    'id' => $item_id,
    'title' => $item['title'],
    'description' => $item['description'],
    'created_at' => $item['created_at'],
    'deleted_at' => DateHelper::humanDateFormat()
];

$_SESSION['redirect_message'] =
    sprintf(
        "`%s` has been deleted, you can find it in archived view.",
        ucfirst($item['title'])
    );

RedirectHelper::redirectToPreviousPage();