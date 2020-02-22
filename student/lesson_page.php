<?php
//lesson_page
include_once('../protect.php');
protect(0);

//check for id
if (isset($_GET['id']) && $_GET['id']!="") {
    $id = $_GET['id'];
    } else {
        header('Location : lessons.php?id='.$_GET['cid']);
        }
//assignment check
$getNxtLessons	=	$db->getAllRecords('lessons','*',' AND (course="'.$id.'") AND id > '.$id, 'LIMIT 1');
if(isset($getNxtLessons[0]['id'])){    
	$getTotalRecords1	=	$db->getQueryCount('assignment_questions','id',' AND (lesson="'.$getNxtLessons[0]['id'].'") ');
	$assignmentQuestions = $db->getRecFrmQry('SELECT count(*) as total FROM s_assign_ans WHERE answer = 1 AND lesson = '.$id);
	if(($assignmentQuestions[0]['total']/$getTotalRecords1[0]['total']) < 0.4 ){
		header('location: alert.php?alert=To%20skip%20a%20lesson%20you%20need%20to%20pasthe%20tests&type=warning');
	}
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
$description = "<br>Tags:".$getLesson[0]['tags']."<br><br>Total lesson files: ".$total_lessons_files."<br><br>Assignment: ".($getLesson[0]['assignment']? "Active" : "Inactive");
$description = $description.'<br><br><a href="lesson_files.php?cid='.$_GET['cid'].'&id='.$getLesson[0]['id'].'" class="btn btn-primary">View Lesson Files</a><br><br>
	<a href="assignment_page.php?cid='.$_GET['cid'].'&id='.$getLesson[0]['id'].'" class="btn btn-primary">Assess Yourself</a><br><br>
	<a href="comments.php?cid='.$_GET['cid'].'&id='.$getLesson[0]['id'].'" class="btn btn-primary">Ask a question</a>';

$carddata = array($getLesson[0]['name'], $getLesson[0]['description'], $description,"lessons.php?id=".$getLesson[0]['course'],'Go back');
$cardout .= str_replace($cardpara, $carddata, $card);
//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Lesson View', $cardout, '');
echo str_replace($mainpara, $maindata, $main);


//footer
include '../templates/user/footer.html';
?>
