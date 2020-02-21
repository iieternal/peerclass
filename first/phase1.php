<?php
//survey : phase 1
include '../templates/materials/form/form.php';

//get data from post
if(isset($_POST['selectedID'])){
	extract($_REQUEST);
	//insert into database
	$data		=	array(
						'phase'=> 1,
						'ans'=>$selectedID[0],
						'student'=>$_SESSION['id']
						);
	$insert		=	$db->insert('survey_results',$data);
	//assuming just comp. science
	header('location: /first/survey.php?phase=2');
}



//get all branches from database
$getBranches = $db->getAllRecords('branches','*',' ');

//start arrays
$checkbox = '';
$order = array();
$data = array();
$data[0] = array('post','#');
//load form
for($i = 0; $i < count($getBranches); $i++){
	$order[$i] = 'checkbox';
	$data[$i+1] = array($getBranches[$i]['name'],'selectedID['.$i.']', $getBranches[$i]['name']);

}
$order[$i] = 'button';
$data[$i+1] = array('submit', 'Submit');
//load
$checkbox = form_template($order, $data);

//load main template
$main = file_get_contents('../templates/main/main.html');
//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Choose Branch', '', $checkbox);
echo str_replace($mainpara, $maindata, $main);