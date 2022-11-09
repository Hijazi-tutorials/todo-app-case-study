<?php
require_once '../utils/buffer_session_init.php';
require_once '../helpers/RedirectHelper.php';
require_once '../helpers/DatabaseHelper.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    throw new Exception("the request method should be POST.");
}
if (! key_exists('item_id', $_POST)) {
    throw new Exception("item id is required field to send with request.");
}

$item_id = $_POST['item_id'];
$item =
    DatabaseHelper::fetchResource(
        "completed_items",
        $item_id,
        ["title", "description"],
        true
    );

// this like move item from to.do array (by remove item from the list) to completed array (by add item to the list)
DatabaseHelper::deleteResource(
    "completed_items",
    $item_id,
);

DatabaseHelper::createResource(
    "todo_items",
    ["title", "description"],
    [$item['title'], $item['description']]
);

$_SESSION['redirect_message'] =
    sprintf(
        "`%s` isn't completed any more, you can find it in todo view.",
        ucfirst($item['title'])
    );

RedirectHelper::redirectToPreviousPage();