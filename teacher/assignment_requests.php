<?php
//assignment requests
//request assignment topic
include_once('../protect.php');
protect(1);

//get course id
if (isset($_GET['id']) && $_GET['id']!="") {
    $id = $_GET['id'];
    }
//post
    if(isset($_POST['assign_topic'])){
        	extract($_POST);

        	//into database
	$data		=	array(
						'topic'=>$assign_topic,
						'approval'=>$approval
						);
	$where		=	array(
						'id'=>$id
						);
	$update		=	$db->update('assignment_course', $data,$where);
	header('location: assignment_requests.php');
        }

//template default for techer
include 'template_default.php';
//main datas
$main = file_get_contents('../templates/user/main.html');

//get the request details
$getAssign	=	$db->getRecFrmQry('SELECT *,assignment_course.id as rid FROM assignment_course LEFT JOIN courses ON courses.id = assignment_course.course AND teacher = '.$_SESSION['id'].' WHERE approval = -1');

	//include form
	include "../templates/materials/form2/form.php";

	$order = array('textarea', 'select' ,'button');
	$out = '';

for($i=0; $i<count($getAssign);$i++){
	//need to get student stat
	$data = array(['POST','assignment_requests.php?act=do&id='.$getAssign[$i]['rid']],
	  ['Topic:','assign_topic',$getAssign[0]['topic']],
	  ['Change Status','','approval',[[1,'Approve',''],[0,'Disapprove & Suggest Topic','']]],
	  ['submit','Save']);

		$out .= form_template($order, $data);
	}
$out .= '<a href="/teacher" class="btn btn-primary">Go Back</a>';
//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Assignment Requests', '', $out);
echo str_replace($mainpara, $maindata, $main);


//footer
include '../templates/user/footer.html';
?>