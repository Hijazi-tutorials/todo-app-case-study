<?php
// should create `local.config` that returns array of configurations (keys used bellow)
$localConfigurations = require_once 'local.config.php';
require_once 'helpers/ListHelper.php';


$db_host = ListHelper::getConfigurationValue('db_host', $localConfigurations);
$db_name = ListHelper::getConfigurationValue('db_name', $localConfigurations);
$db_user = ListHelper::getConfigurationValue('db_user', $localConfigurations);
$db_password = ListHelper::getConfigurationValue('db_password', $localConfigurations);
