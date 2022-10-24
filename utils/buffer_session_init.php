<?php
ob_start();

if (!session_id()) {
    session_start();
}

if (! $_SESSION['items']) {
    $_SESSION['items'] = [];
}

if (! $_SESSION['items']['todo']) {
    $_SESSION['items']['todo'] = [];
}

if (! $_SESSION['items']['completed']) {
    $_SESSION['items']['completed'] = [];
}

if (! $_SESSION['items']['deleted']) {
    $_SESSION['items']['deleted'] = [];
}

$todoItems = $_SESSION['items']['todo'];
$completedItems = $_SESSION['items']['completed'];
$deletedItems = $_SESSION['items']['deleted'];
