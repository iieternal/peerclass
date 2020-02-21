<?php
//survey
include '../protect.php';
protect(0);

//load templates
include 'template_default.php';

//phase 1
//asks for stream of choice
if(!isset($_REQUEST['phase'])){
 include 'phase1.php';
}
//phase2
//asks for topic
else if($_REQUEST['phase'] == 2){
	include 'phase2.php';
}

//phase3
//asks for language
else if($_REQUEST['phase'] == 3){
	include 'phase3.php';
}

//phase4
//redirect to suggestions
else if($_REQUEST['phase'] == 4){
	include 'phase4.php';
} else {
	header('location: /student');
}

//load footer
include '../templates/main/footer.html';
?>