<?php
session_start();
include_once('includes/db/Database.php');


$DB_NAME = 'flipclass';
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

include_once('includes/login/class.phpmailer.php');
include_once('includes/login/class.smtp.php');
$mail	=	new PHPMailer;


/*
*** You can set SMTP if you want
*** Change below code as per your need
*/

/*
$mail->IsSMTP();													// Set mailer to use SMTP
$mail->SMTPDebug	=	2;											// debugging: 1 = errors and messages, 2 = messages only
$mail->Host 		=	'YOUR_HOST';								// Specify main and backup server
$mail->Port 		=	587;										// Set the SMTP port
$mail->SMTPAuth 	=	true;										// Enable SMTP authentication
$mail->Username 	=	'YOUR@EMAIL>COM';							// SMTP username
$mail->Password 	=	'YOUR_PASS';								// SMTP password
$mail->SMTPSecure	=	'tls';										// Enable encryption, 'ssl' also accepted
*/
?>
