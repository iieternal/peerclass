<?php
//add lesson files
include_once('../protect.php');
protect(1);

//post parameters
if(isset($_REQUEST['lesson_explanation']) and $_REQUEST['lesson_explanation']!=""){
	extract($_REQUEST);
//assuming test app every field is perfect
//into database
	$data		=	array(
						'lesson'=>$_REQUEST['id'],
						'data'=>$lesson_explanation,
						'type'=>"text"
						);
	$insert		=	$db->insert('lesson_files',$data);
	header('Location: lesson_page.php?cid='.$_REQUEST['cid'].'&id='.$_REQUEST['id']);
}
//template default for techer
include 'template_default.php';

//main datas
$main = file_get_contents('../templates/user/main.html');

//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');

//include form
include "../templates/materials/form/form.php";

$order = array('textarea', 'button');

$data = array(['#'],
  ['Explanation:','lesson_explanation'],
  ['submit','Add']);

$form = form_template($order, $data);

//file uploader
ob_start();
$extra_link = '?cid='.$_REQUEST['cid'].'&id='.$_REQUEST['id'];
include '../templates/upload/upload.php';
$upload = ob_get_clean();

//form + upload
//cheat : added row div
//note: remove this cheat and output as extras
$form_upload = $upload.'</div><br/><div class="row">'.$form;

//main output
$maindata = array('Add Lesson Files', $form_upload, '<a href="lesson_page.php?cid='.$_GET['cid'].'&id='.$_GET['id'].'" class="btn btn-primary">Go back</a>');
echo str_replace($mainpara, $maindata, $main);

//footer
include '../templates/user/footer.html';
?>
