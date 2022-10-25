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
        $maxTodoItemId = max(array_keys(static::$todoItems));
        $maxCompletedIItemId = max(array_keys(static::$completedItems));
        $maxDeletedItemId = max(array_keys(static::$deletedItems));

        $idsList = [
            $maxTodoItemId,
            $maxCompletedIItemId,
            $maxDeletedItemId
        ];

        $autoIncrementedId = max($idsList) + 1;

        return $prefix . "" . $autoIncrementedId;
    }
}

UniqueGeneratorHelper::$todoItems = $todoItems;
UniqueGeneratorHelper::$completedItems = $completedItems;
UniqueGeneratorHelper::$deletedItems = $deletedItems;
