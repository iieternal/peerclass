<?php
//add new course
include_once('../protect.php');
protect(1);

//post parameters
if(isset($_REQUEST['course_name']) and $_REQUEST['course_name']!=""){
	extract($_REQUEST);
//assuming test app every field is perfect
//into database
	$data		=	array(
						'name'=>$course_name,
						'type'=>$course_type,
						'category'=>$course_category,
						'tags'=>$course_tags,
						'description'=>$course_description,
						'teacher'=>$_SESSION['id']
						);
	$insert		=	$db->insert('courses',$data);
	header('Location: course_page.php?id='.$db->lastInsertId($insert));
}
//template default for techer
include 'template_default.php';

//main datas
$main = file_get_contents('../templates/user/main.html');

//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');

//include form
include "../templates/materials/form/form.php";

$order = array('input', 'input', 'input', 'textarea', 'textarea', 'button');

$data = array(['#'],
 ['Course Name','input','course_name','Course Name'],
 ['Course Type','input','course_type','Course Type'],
 ['Course Category','input','course_category','Course Category'],
 ['Course Description','course_description'],
  ['Course Tags','course_tags'],
  ['submit','Add']);

$form = form_template($order, $data);

//autocomplete
$autocomplete_cdn = file_get_contents('../templates/cdn/jquery.html');
$autocomplete_main = file_get_contents('../templates/materials/autocomplete.html');
$autocomplete_para = array('{{name}}' , '{{link}}');
//Add to form var
$form .= $autocomplete_cdn;
$form .= str_replace($autocomplete_para, array('course_type','/assets/autocomplete/course-type.json'), $autocomplete_main);
$form .= str_replace($autocomplete_para, array('course_category','/assets/autocomplete/course-category.json'), $autocomplete_main);

//main output
$maindata = array('Add Course', "", $form);
echo str_replace($mainpara, $maindata, $main);

//footer
include '../templates/user/footer.html';
?>
