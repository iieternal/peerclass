<?php
include_once('config.php');

function protect($level = -1){
 if(checklogin()){
 		if($level == 0 && $_SESSION['type'] == 1){
 			//found a teacher in students space
 			header('location: /teacher/');
 		} else if($level == 1 && $_SESSION['type'] == 0){
			//found a student in teachers space
 			header('location: /student/');
 		}
 } else {
 	logout();
 }
}
//checks if session exists
function checklogin(){
	if(isset($_SESSION['name'])){
		return true;
	}
	return false;
}
//logout
function logout(){
	session_destroy();
	header('location: /	index.php');
}
?>