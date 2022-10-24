<?php
require_once '../utils/buffer_session_init.php';

class UniqueGeneratorHelper
{
    public static $todoItems;
    public static $completedItems;
    public static $deletedItems;

    static function generateUniqueId($prefix = ""): string
    {
        return $prefix . "" . uniqid();
    }

    static function generateAutoIncrementId($prefix = ""): string
    {
        $lastTodoItem = end(static::$todoItems);
        $lastCompletedItem = end(static::$completedItems);
        $lastDeletedItem = end(static::$deletedItems);

        $idsList = [
            $lastTodoItem['id'] ?? 0,
            $lastCompletedItem['id'] ?? 0,
            $lastDeletedItem['id'] ?? 0
        ];

        $autoIncrementedId = max($idsList) + 1;

        return $prefix . "" . $autoIncrementedId;
    }
}

UniqueGeneratorHelper::$todoItems = $todoItems;
UniqueGeneratorHelper::$completedItems = $completedItems;
UniqueGeneratorHelper::$deletedItems = $deletedItems;
