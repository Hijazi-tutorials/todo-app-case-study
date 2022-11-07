<?php
require_once '../utils/buffer_session_init.php';
require_once '../helpers/RedirectHelper.php';
require_once '../constants/ListTypes.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    throw new Exception("the request method should be POST.");
}
if (!key_exists('item_id', $_POST)) {
    throw new Exception("`item_id` is required field to send with request.");
}
if (!key_exists('recover_to', $_POST)) {
    throw new Exception("`recover_to` is required field to send with request.");
}

$item_id = $_POST['item_id'];
$recover_to = $_POST['recover_to'];
$item = $deletedItems[$item_id];

if ($recover_to == ListTypes::TODO) {
    $_SESSION['items']['todo'][$item_id] = $item;

} elseif ($recover_to == ListTypes::COMPLETED) {
    $_SESSION['items']['completed'][$item_id] = $item;

} else {
    throw new Exception("Recover to $recover_to isn't supported.");
}

unset($_SESSION['items']['deleted'][$item_id]);
unset($deletedItems[$item_id]);

$_SESSION['redirect_message'] =
    sprintf(
        "`%s` has been recovered, you can find it in %s view.",
        ucfirst($item['title']),
        explode("-", $recover_to)[0]
    );

RedirectHelper::redirectToPreviousPage();
