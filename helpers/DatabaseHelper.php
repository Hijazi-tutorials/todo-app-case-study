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

    public static function fetchItem($query, $field): array
    {
        return self::fetchItems($query, $field)[0] ?? [];
    }
}

DatabaseHelper::$db_host = $db_host;
DatabaseHelper::$db_name = $db_name;
DatabaseHelper::$db_user = $db_user;
DatabaseHelper::$db_password = $db_password;