<?php
require_once '../utils/buffer_session_init.php';
require_once '../helpers/RedirectHelper.php';
require_once '../helpers/DatabaseHelper.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    throw new Exception("Can't assign todo-item as completed without POST request.");
}
if (!key_exists('item_id', $_POST)) {
    throw new Exception("Can't create todo item without title.");
}

$item_id = $_POST['item_id'];

$item =
    DatabaseHelper::fetchItem(
        "SELECT * FROM todo_items WHERE id = $item_id",
        [...DatabaseHelper::$common_fields, 'created_at']
    );

if (! $item) {
    throw new Exception("item #$item_id not exist.");
}

// delete todo item from `todo_items` table
DatabaseHelper::mysqliConnection()->query("DELETE FROM `todo_items` WHERE id = $item_id");

// add the fetched fields to `completed_items` table
DatabaseHelper::mysqliConnection()->query(
    sprintf(
        "INSERT INTO `completed_items` (`%s`, `%s`) VALUES ('%s', '%s')",
        "title", "description", $item['title'], $item['description']
    )
);

$_SESSION['redirect_message'] =
    sprintf(
        "Assign `%s` item as completed, you can find it in completed view.",
        $item['title']
    );

RedirectHelper::redirectToPreviousPage();