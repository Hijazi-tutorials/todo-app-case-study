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
    $item =
        DatabaseHelper::fetchItem(
            "SELECT * FROM `todo_items` WHERE `id` = $item_id",
            [...DatabaseHelper::$common_fields, 'created_at']
        );

    if (! $item) {
        throw new Exception("todo-item #$item_id isn't exist.");
    }

    DatabaseHelper::mysqliConnection()->query(
        "DELETE FROM `todo_items` WHERE  `id` = $item_id"
    );
} elseif ($delete_from == ListTypes::COMPLETED) {
    $item =
        DatabaseHelper::fetchItem(
            "SELECT * FROM `completed_items` WHERE `id` = $item_id",
            [... DatabaseHelper::$common_fields, 'completed_at']
        );

    if (! $item) {
        throw new Exception("completed-item #$item_id isn't exist.");
    }

    DatabaseHelper::mysqliConnection()->query("DELETE FROM `completed_item` WHERE `id` = $item_id");
} else {
    throw new Exception("Deleting from $delete_from isn't supported!");
}


DatabaseHelper::mysqliConnection()->query(
    sprintf(
        "INSERT INTO `deleted_items` (`%s`, `%s`, `%s`) VALUES ('%s', '%s', '%s')",
        'title', 'description', 'deleted_from', $item['title'], $item['description'], $delete_from
    )
);

$_SESSION['redirect_message'] =
    sprintf(
        "`%s` has been deleted, you can find it in archived view.",
        ucfirst($item['title'])
    );

RedirectHelper::redirectToPreviousPage();