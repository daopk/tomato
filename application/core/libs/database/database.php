<?php

require_once 'NotORM.php';

extract(JsonConfig::GetConfigByName('database'));

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 

$connection = new PDO('mysql:host='.$host.';dbname='.$dbname, $username, $password, $options);

$db = new NotORM($connection);