<?php
//course_attend
include_once('../protect.php');
protect(0);

if(isset($_GET['cid'])){

	$id = $_GET['cid'];

	if($_GET['action'] == "attend"){
	
		//check if duplicate
		$getTotalRecords	=	$db->getQueryCount('s_courses','id',' AND (student="'.$_SESSION['id'].'" AND course = '.$id.') ');
    	$total_count = $getTotalRecords[0]['total'];
		//add to s_courses table
		//into database
		$data		=	array(
						'student' => $_SESSION['id'],
						'course' => $id,
						'completed' => 0
						);
		if($total_count == 0){
		$insert		=	$db->insert('s_courses',$data);
		}

		header('Location: courses_attending.php?alert=success&msg=Course%20Added');
	} else if($_GET['action'] == "unattend"){
						$where1 = array(
							'course' => $id,
							'student' => $_SESSION['id']
							
						);
						$db->delete('s_courses', $where1);
						header('Location: courses_attending.php?alert=success&msg=Course%20Removed');
	}
}
?>