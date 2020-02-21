<?php
//lesson files
//todo
include_once('../protect.php');
protect(0);

//check for id
if (isset($_GET['id']) && $_GET['id']!="") {
    $id = $_GET['id'];
    } else {
        header('Location : lessons.php?id='.$_GET['cid']);
        }
//load course details added by this teacher
$getLesson	=	$db->getAllRecords('lesson_files','*,unix_timestamp(dt) as date',' AND lesson="'.$id.'" ');

//template default for techer
include 'template_default.php';

//output the fields
//main datas
$main = file_get_contents('../templates/user/main.html');
//date functions
include "../extras/date/date.php";
//getting the file type
include "../extras/files/files.php";
//card datas :cards 2 used nolinks
$card = file_get_contents('../templates/user/card2.html');
//card parameters
$cardpara = array('{{title}}','{{name}}','{{text}}');
$cardout = '';
//printing values
for($i=0; $i<count($getLesson);$i++){
	$carddata = array(
		"File ID: ".($i+1),
		"Added ". timeago($getLesson[$i]['date']),
		file_card($getLesson[$i]['type'], $getLesson[$i]['loc'], $getLesson[$i]['data'])
	);
	$cardout .= str_replace($cardpara, $carddata, $card);
}
//extras
$extras = '<br/><a href="lesson_page.php?cid='.$_GET['cid'].'&id='.$_GET['id'].'" class="btn btn-primary">Go back</a>';

//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Lesson Files View', $cardout, $extras);
echo str_replace($mainpara, $maindata, $main);


//footer
include '../templates/user/footer.html';
?>