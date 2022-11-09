<?php
require_once '../utils/buffer_session_init.php';
require_once '../helpers/RedirectHelper.php';
require_once '../helpers/DatabaseHelper.php';
require_once '../constants/ListTypes.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    throw new Exception("Can't delete item without POST request.");
}
if (! key_exists('item_id', $_POST)) {
    throw new Exception("Should passing the item id within the request.");
}
if (! key_exists('delete_from', $_POST)) {
    throw new Exception("Have to declare from which list is deleting.");
}

$item_id = $_POST['item_id'];
$delete_from = $_POST['delete_from'];

if ($delete_from == ListTypes::TODO) {
    $delete_from_table = $fetch_from_table = "todo_items";
}
elseif ($delete_from == ListTypes::COMPLETED) {
    $delete_from_table = $fetch_from_table = "completed_items";
} else {
    throw new Exception("Deleting from $delete_from isn't supported!");
}

$item =
    DatabaseHelper::fetchResource(
        $fetch_from_table,
        $item_id,
        ["title", "description"],
        true
    );

DatabaseHelper::deleteResource(
    $delete_from_table,
    $item_id
);

DatabaseHelper::createResource(
    "deleted_items",
    ['title', 'description', 'deleted_from'],
    [$item['title'], $item['description'], $delete_from]
);

$_SESSION['redirect_message'] =
    sprintf(
        "`%s` has been deleted, you can find it in archived view.",
        ucfirst($item['title'])
    );

RedirectHelper::redirectToPreviousPage();