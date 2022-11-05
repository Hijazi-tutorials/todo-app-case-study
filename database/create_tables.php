<?php
require_once '../helpers/DatabaseHelper.php';

$dir = "migrations";
$dir_handler = opendir($dir);

$mysqli = DatabaseHelper::mysqliConnection();

do {
    $file = readdir($dir_handler);

    $_ = explode(".", $file);
    if (end($_) != "php") {
        continue;
    }

    require_once "$dir/$file";
} while ($file != false);

closedir($dir_handler);
