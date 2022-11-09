<?php
require_once '../config.php';

class DatabaseHelper
{
    private static $mysqli;

    public static $db_host;
    public static $db_user;
    public static $db_password;
    public static $db_name;

    public static $common_fields = [
        'id',
        'title',
        'description'
    ];

    /*
     * @throws Exception if connection by mysqli failed.
     */
    public static function mysqliConnection(): mysqli
    {
        if (self::$mysqli) {
            return self::$mysqli;
        }

        self::$mysqli =
            new mysqli(
                self::$db_host,
                self::$db_user,
                self::$db_password,
                self::$db_name
            );

        if (self::$mysqli->connect_error) {
            throw new Exception("Connection failed, " . self::$mysqli->connect_error);
        }

        return self::$mysqli;
    }

    public static function fetchItems($query, $fields): array
    {
        if (! is_array($fields)) {
            throw new Exception("`fields` param should be array.");
        }

        $items = [];
        $mysqli = self::mysqliConnection();
        $fetchedItems = $mysqli->query($query);

        if(! $fetchedItems) {
            throw new Exception("something wrong with query '$query', please run the query locally & fix it.");
        }

        while ($fetchedItem = $fetchedItems->fetch_assoc()) {
            $item = [];

            foreach ($fields as $field) {
                $item[$field] = $fetchedItem[$field];
            }

            $items[] = $item;
        }

        return $items;
    }

    public static function fetchResource($tableName, $itemId, $fields, $throwExceptionIfNotExist=false): array
    {
        $item = self::fetchItems(
            "SELECT * FROM `$tableName` WHERE `id`=$itemId",
            $fields
        );

        if(! $item & $throwExceptionIfNotExist) {
            throw new Exception("resource #$itemId does not exist in #$tableName");
        } elseif (! $item) {
            return [];
        } else {
            return $item[0];
        }
    }

    public static function createResource($tableName, $fields, $values)
    {
        if (! is_array($fields)) {
            throw new Exception("createResource accept fields as array.");
        } elseif (! is_array($values)) {
            throw new Exception("createResource accept values as array.");
        }

        // loop through $values array, & wrap each element with single-quotation (')
        $wrappedValues =
            array_map(function ($value) {
                return "'$value'";
            }, $values);

        $insertQuery =
            sprintf(
                "INSERT INTO $tableName (%s) VALUES (%s)",
                join(", ", $fields),
                join(", ", $wrappedValues)
            );

        if(! self::$mysqli->query($insertQuery))
        {
            throw new Exception(
                "something wrong with this query: '$insertQuery'." .
                " [HINT] make sure the table name, fields, and values all are correct."
            );
        }
    }

    public static function deleteResource($tableName, $itemId)
    {
        $deleteResourceQuery = "DELETE FROM $tableName WHERE id = $itemId";

        if(! self::$mysqli->query($deleteResourceQuery))
        {
            throw new Exception(
                "something wrong with this query: '$deleteResourceQuery'." .
                " [HINT] make sure the table name & item id both are correct."
            );
        }
    }
}

DatabaseHelper::$db_host = $db_host;
DatabaseHelper::$db_name = $db_name;
DatabaseHelper::$db_user = $db_user;
DatabaseHelper::$db_password = $db_password;