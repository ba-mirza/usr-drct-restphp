<?php
$config = require 'config_db.php';

$db_user = $config['db_user'];
$db_pass = $config['db_pass'];
$db_name = $config['db_name'];

$db = new PDO('mysql:host=127.0.0.1;dbname='.$db_name.';charset=utf8', $db_user, $db_pass);

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

define('APP_NAME', 'PHP REST API TEST');

