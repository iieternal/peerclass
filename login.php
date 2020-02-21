<?php
include 'config.php';
//login
if(isset($_POST['username'])){
	extract($_REQUEST);
	$getUsers	=	$db->getAllRecords('tb_user','id,username,useremail,userpassword,teacher',' AND ((useremail="'.$username.'") OR (username="'.$username.'")) AND userstatus=1 ');
	$md5_password = md5($password);

	if($md5_password == $getUsers[0]['userpassword']){
		$_SESSION['id'] = $getUsers[0]['id'];
		$_SESSION['name'] = $getUsers[0]['username'];
		$_SESSION['type']  = $getUsers[0]['teacher'];
		header('location: /first/survey.php');
	} else {
		header('location: /index.php?alert=1');
	}

}