<?php
//add new lesson
include_once('../protect.php');
protect(1);

//post parameters
if(isset($_REQUEST['lesson_name']) and $_REQUEST['lesson_name']!=""){
	extract($_REQUEST);
//assuming test app every field is perfect
//into database
	$data		=	array(
						'name'=>$lesson_name,
						'course'=>$_REQUEST['cid'],
						'tags'=>$lesson_tags,
						'description'=>$lesson_description,
						'assignment' => $lesson_assignment,
						'assignment_due' => $assignment_due
						);
	$insert		=	$db->insert('lessons',$data);
	header('Location: lesson_page.php?cid='.$_REQUEST['cid'].'&id='.$db->lastInsertId($insert));
}
//template default for techer
include 'template_default.php';

//main datas
$main = file_get_contents('../templates/user/main.html');

//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');

//include form
include "../templates/materials/form/form.php";

$order = array('input', 'textarea', 'textarea', 'select', 'datepicker', 'button');

$data = array(['#'],
 ['Lesson Name','input','lesson_name','Lesson Name'],
 ['Lesson Description','lesson_description'],
  ['Lesson Tags','lesson_tags'],
  ['Assignment','','lesson_assignment',[[0,'No'],[1,'Yes']]],
 ['Assignment Due On','input','assignment_due','Select date'],
  ['submit','Add']);
//before submit button
$datepicker = file_get_contents('../templates/materials/datepicker/datepicker.html');

$form = form_template($order, $data);

//main output
$maindata = array('Add Lesson', '', $form);
echo str_replace($mainpara, $maindata, $main);

//footer
echo $datepicker; //datepicker call files
include '../templates/user/footer.html';
?>
