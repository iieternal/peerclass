<?php
//profile redirect
include 'protect.php';
protect();

//redirecting user based on their profile id's
if(isset($_GET['id'])){
	header('Location: /user/user.php?id='.$_GET['id']);
} else {
	if($_SESSION['type'] == 0)
		header('Location: /user/student.php');
	else
		header('Location: /user/teacher.php');
}
?>