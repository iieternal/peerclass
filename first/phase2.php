<?php
//survey : phase 2
include '../templates/materials/form/form.php';

//get data from post
if(isset($_POST['selectedID'])){
	extract($_REQUEST);
	//insert into database
	for($i=0; $i < count($selectedID); $i++){
	$data		=	array(
						'phase'=> 2,
						'ans'=>$selectedID[$i],
						'student'=>$_SESSION['id']
						);
	if(!empty($selectedID[$i]))
		$insert		=	$db->insert('survey_results',$data);
	}
	header('location: /first/survey.php?phase=3');
}



//get all branches from database
//assuming computer science
$getType = $db->getAllRecords('courses','*',' AND (branch LIKE "Computer Science") GROUP BY type');

//start arrays
$checkbox = '';
$order = array();
$data = array();
$data[0] = array('post','/first/survey.php?phase=2');
//load form
for($i = 0; $i < count($getType); $i++){
	$order[$i] = 'checkbox';
	$data[$i+1] = array($getType[$i]['type'],'selectedID[]', $getType[$i]['type']);

}
$order[$i] = 'button';
$data[$i+1] = array('submit', 'Submit');
//load
$checkbox = form_template($order, $data);

//load main template
$main = file_get_contents('../templates/main/main.html');
//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Intrested Field', '', $checkbox);
echo str_replace($mainpara, $maindata, $main);