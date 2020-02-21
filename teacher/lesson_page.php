<?php
//lesson_page
include_once('../protect.php');
protect(1);

//check for id
if (isset($_GET['id']) && $_GET['id']!="") {
    $id = $_GET['id'];
    } else {
        header('Location : lessons.php?id='.$_GET['cid']);
        }
//load course details added by this teacher
$getLesson	=	$db->getAllRecords('lessons','*',' AND (course = "'.$_GET['cid'].'" AND id="'.$id.'") ');
//find course lessons
$getTotalRecords	=	$db->getQueryCount('lesson_files','id',' AND (lesson="'.$getLesson[0]['id'].'") ');
    $total_lessons_files = $getTotalRecords[0]['total'];
//template default for techer
include 'template_default.php';

//output the fields
//main datas
$main = file_get_contents('../templates/user/main.html');
//card datas
$card = file_get_contents('../templates/user/card.html');
//card parameters
$cardpara = array('{{title}}','{{name}}','{{text}}','{{url}}','{{urlText}}');
$cardout = '';
//printing values
$description = "<br>Tags:".$getLesson[0]['tags']."<br><br>Total lesson files: ".$total_lessons_files."<br><br> Students: ###<br><br>Assignment: ".($getLesson[0]['assignment']? "Active" : "Inactive");
$description = $description.'<br><br><a href="lesson_files.php?cid='.$_GET['cid'].'&id='.$getLesson[0]['id'].'" class="btn btn-primary">View Lesson Files</a><br><br>
	<a href="assignment_page.php?cid='.$_GET['cid'].'&id='.$getLesson[0]['id'].'" class="btn btn-primary">Assignments</a><br><br><a href="add_assignment.php?cid='.$_GET['cid'].'&id='.$getLesson[0]['id'].'" class="btn btn-primary">Add Assignment</a><br><br>
	<a href="comments.php?cid='.$_GET['cid'].'&id='.$getLesson[0]['id'].'" class="btn btn-primary">Comments</a>';

$carddata = array($getLesson[0]['name'], $getLesson[0]['description'], $description,"lessons.php?id=".$getLesson[0]['course'],'Go back');
$cardout .= str_replace($cardpara, $carddata, $card);
$deleteBtn = '<br><a href="add_lesson_files.php?cid='.$_GET['cid'].'&id='.$getLesson[0]['id'].'" class="btn btn-primary">Add Lesson Files</a>  
<a href="lesson_delete.php?cid='.$_GET['cid'].'&id='.$getLesson[0]['id'].'" class="btn btn-primary">Delete Lesson</a>';
//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Lesson View', $cardout, $deleteBtn);
echo str_replace($mainpara, $maindata, $main);


//footer
include '../templates/user/footer.html';
?>
