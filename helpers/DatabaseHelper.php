<?php
require_once '../config.php';

class DatabaseHelper
{
    private static $mysqli;

    public static $db_host;
    public static $db_user;
    public static $db_password;
    public static $db_name;

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
}

DatabaseHelper::$db_host = $db_host;
DatabaseHelper::$db_name = $db_name;
DatabaseHelper::$db_user = $db_user;
DatabaseHelper::$db_password = $db_password;