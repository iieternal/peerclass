<?php
//lesson comments
include_once('../protect.php');
protect(0);

//template default for techer
include 'template_default.php';

//main datas
$main = file_get_contents('../templates/user/main.html');

//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');

//start
if(isset($_GET['id'])){
	$id = $_GET['id'];
}else{
	header('Location: courses_attending.php');
}
//got lesson id
//templates
$comment = file_get_contents('../templates/comment/comment.html');
$comment = str_replace('{{lesson}}', $id, $comment);  //added lesson id

//go back
$Btn = '<br><a href="lesson_page.php?cid='.$_GET['cid'].'&id='.$_GET['id'].'" class="btn btn-primary">Go back</a>';
//end
$maindata = array('Discussion', '', $comment.$Btn);
echo str_replace($mainpara, $maindata, $main);

//footer
include '../templates/user/footer.html';