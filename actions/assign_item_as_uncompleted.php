<?php
require_once '../utils/buffer_session_init.php';
require_once '../helpers/RedirectHelper.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    throw new Exception("the request method should be POST.");
}
if (! key_exists('item_id', $_POST)) {
    throw new Exception("item id is required field to send with request.");
}

$item_id = $_POST['item_id'];
$item = $completedItems[$item_id];

// this like move item from to.do array (by remove item from the list) to completed array (by add item to the list)
unset($_SESSION['items']['completed'][$item_id]);
unset($completedItems[$item_id]);

$_SESSION['items']['todo'][$item_id] = [
    'id' => $item_id,
    'title' => $item['title'],
    'description' => $item['description'],
    'created_at' => $item['created_at'],
];

$_SESSION['redirect_message'] =
    sprintf(
        "`%s` isn't completed any more, you can find it in todo view.",
        ucfirst($item['title'])
    );

RedirectHelper::redirectToPreviousPage();