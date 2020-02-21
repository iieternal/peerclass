<?php
session_start();
include_once('includes/db/Database.php');


$DB_NAME = 'peerclass';
$DB_USER = 'root';
$DB_PASSWORD = '';
$DB_HOST = 'localhost:3308';

//global
$base_dir = __DIR__;

/**
** Change below url with your url
**/

$home_url = 'http://localhost/';

$dsn	= 	"mysql:dbname=".$DB_NAME.";host=".$DB_HOST."";
$pdo	=	"";
try {
	$pdo	=	new PDO($dsn, $DB_USER, $DB_PASSWORD);
}catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}
$db 	=	new Database($pdo);


?>
