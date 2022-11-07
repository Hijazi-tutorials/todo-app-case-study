<?php
require_once __DIR__ . '/../helpers/DatabaseHelper.php';

ob_start();

$commonFields = [
    'id',
    'title',
    'description',
];

$todoItems =
    DatabaseHelper::fetchItems(
        "SELECT * FROM todo_items",
        [...$commonFields, 'created_at']
    );

$completedItems =
    DatabaseHelper::fetchItems(
        "SELECT * FROM completed_items",
        [...$commonFields, 'completed_at']
    );

$deletedItems =
    DatabaseHelper::fetchItems(
        "SELECT * FROM deleted_items",
        [...$commonFields, 'deleted_at']
    );
