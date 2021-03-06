<?php
//course_page
include_once('../protect.php');
protect(1);

//check for id
if (isset($_GET['id']) && $_GET['id']!="") {
    $id = $_GET['id'];
    } else {
        header('Location : courses.php');
        }
//load course details added by this teacher
$getCourses	=	$db->getAllRecords('courses','*',' AND (teacher="'.$_SESSION['id'].'" AND id="'.$id.'") ');
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
$description = $getCourses[0]['description'] ."<br><br>Total lessons added: ".$total_lessons." <br><br> Tags: " . $getCourses[0]['tags'];

$carddata = array($getCourses[0]['category'], $getCourses[0]['name'], $description,"lessons.php?id=".$getCourses[0]['id'],'View Lessons');
$cardout .= str_replace($cardpara, $carddata, $card);
$deleteBtn = '<br><a href="add_lesson.php?cid='.$getCourses[0]['id'].'" class="btn btn-primary">Add Lesson</a>  <a href="course_edit.php?id='.$getCourses[0]['id'].'" class="btn btn-primary">Edit Course</a>  
<a href="course_delete.php?id='.$getCourses[0]['id'].'" class="btn btn-primary">Delete Course</a>';
//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Course View', $cardout, $deleteBtn);
echo str_replace($mainpara, $maindata, $main);


//footer
include '../templates/user/footer.html';
?>