<?php
/*
Mysql database settings.
*/
$database_host =  "localhost:3307";
$database_user = "root";
$database_password = "";
$database_name = "torrent_directory";



/*Don't touch below this line, if you are not very familiar with php programming*/

define( "DATABASE_HOST", $database_host);
define( "DATABASE_USER", $database_user);
define ( "DATABASE_PASSWORD", $database_password);
define ( "DATABASE_NAME", $database_name);

require_once 'lib/meekrodb.2.3.class.php';
DB::$host = DATABASE_HOST;
DB::$user = DATABASE_USER;
DB::$password = DATABASE_PASSWORD;
DB::$dbName = DATABASE_NAME;

