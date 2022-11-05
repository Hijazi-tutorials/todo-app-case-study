<?php
/*
 * This script assumes that you have defined a variable called `$mysqli`
 * `$mysqli` represents an actual mysqli connection with database
 * If you don't! then will @throws Exception
 */

if (! isset($mysqli)) {
    throw new Exception("Should define `\$mysqli` variable that contains an actual mysqli connection.");
}

$create_table_query =
    sprintf(
        "CREATE TABLE `%s` (%s, %s, %s, %s, %s)",
        "todo_items",
        "`id` INT NOT NULL AUTO_INCREMENT",
        "`title` VARCHAR(255) NOT NULL",
        "`description` VARCHAR(255)",
        "`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP",
        "PRIMARY KEY (`id`)"
    );

$mysqli->query($create_table_query);
