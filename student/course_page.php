<?php
//course_page
include_once('../protect.php');
protect(0);

//include words limit
include '../extras/limit/limit.php';

//check for id
if (isset($_GET['id']) && $_GET['id']!="") {
    $id = $_GET['id'];
    } else {
        header('Location: courses_attending.php');
        }
//load course details added by this teacher
$getCourses	=	$db->getAllRecords('courses','*',' AND (id="'.$id.'") ');
//load course attending status
$getStatus	=	$db->getAllRecords('s_courses','*',' AND (course="'.$id.'" AND student = '.$_SESSION['id'].') ');
//find course lessons
$getTotalRecords	=	$db->getQueryCount('lessons','id',' AND (course="'.$getCourses[0]['id'].'") ');
    $total_lessons = $getTotalRecords[0]['total'];
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
$description = $getCourses[0]['description'] ."<br><br>Total lessons: ".$total_lessons." <br><br> Tags: " . $getCourses[0]['tags'];

$carddata = array($getCourses[0]['category'], $getCourses[0]['name'], $description,"lessons.php?id=".$getCourses[0]['id'],'View Lessons');
$cardout .= str_replace($cardpara, $carddata, $card);
//status checking
if(empty($getStatus[0])){
	$Btns = '<a href="course_attend.php?action=attend&cid='.$getCourses[0]['id'].'" class="btn btn-primary">Attend this course</a>';
} else {
$Btns = '<a href="google_scholar.php?q='.$getCourses[0]['tags'].'" class="btn btn-primary">Related Journals</a><br>  <br>  
<a href="request_assignment.php?id='.$getCourses[0]['id'].'" class="btn btn-primary">Main Assignment</a><br>  <br>  
<a href="course_attend.php?action=unattend&cid='.$getCourses[0]['id'].'" class="btn btn-primary">Remove this course</a>
<br>
';
}
//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Course View', $cardout, $Btns);
echo str_replace($mainpara, $maindata, $main);


//footer
include '../templates/user/footer.html';
?>