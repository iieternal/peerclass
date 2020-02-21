<?php
//request assignmnet topic
include_once('../protect.php');
protect(0);

//get course id
if (isset($_GET['id']) && $_GET['id']!="") {
    $id = $_GET['id'];
    } else {
        header('Location : courses_attendings.php');
        }
//post
    if(isset($_POST['assign_topic'])){
        	extract($_POST);
        	//into database
	$data		=	array(
						'course'=>$_REQUEST['id'],
						'topic'=>$assign_topic,
						);
	$insert		=	$db->insert('assignment_course',$data);
	header('location: request_assignment.php?id='.$id);
        }

//template default for techer
include 'template_default.php';
//upload var
$upload = '';
//main datas
$main = file_get_contents('../templates/user/main.html');

//check if a request exists
$getTotalRecords	=	$db->getQueryCount('assignment_course','id',' AND (course="'.$id.'") ');

if($getTotalRecords[0]['total'] == 0){
	//include form
	include "../templates/materials/form/form.php";

	$order = array('textarea', 'button');

	$data = array(['#'],
	  ['Topic:','assign_topic'],
	  ['submit','Request for approval']);

	$out = form_template($order, $data);
} else {
	$getAssign	=	$db->getAllRecords('assignment_course','*',' AND (course="'.$id.'") ');
	switch($getAssign[0]['approval']){
		case '-1':
		$out = '<p class="alert alert-info">Awaiting Approval</p>';
		break;
		case '0':
		$out = '<p class="alert alert-warning">Suggestion Declined</p>';
		$out .= 'Recommended by teacher: '.$getAssign[0]['topic'];
		//display upload form
		break;
		case '1':
		$out = '<p class="alert alert-success">Suggestion Approved</p>';
		//display upload form
		break;
	}
	if($getAssign[0]['approval'] != -1){
		//file uploader
		ob_start();
		$extra_link = '?assign=true&cid='.$getAssign[0]['id'];
		include '../templates/upload/upload.php';
		$upload = ob_get_clean();
	}
}
$out .= $upload.'<br/><a href="course_page.php?cid='.$id.'" class="btn btn-primary">Go Back</a>';
//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Assignment Status', '', $out);
echo str_replace($mainpara, $maindata, $main);


//footer
include '../templates/user/footer.html';
?>