<?php
require_once __DIR__ . '/../helpers/DatabaseHelper.php';

if(! session_id()) {
    session_start();
}

ob_start();

$todoItems =
    DatabaseHelper::fetchItems(
        "SELECT * FROM todo_items",
        [...DatabaseHelper::$common_fields, 'created_at']
    );

$completedItems =
    DatabaseHelper::fetchItems(
        "SELECT * FROM completed_items",
        [...DatabaseHelper::$common_fields, 'completed_at']
    );

$deletedItems =
    DatabaseHelper::fetchItems(
        "SELECT * FROM deleted_items",
        [...DatabaseHelper::$common_fields, 'deleted_at']
    );
