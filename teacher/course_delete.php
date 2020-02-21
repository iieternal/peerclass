<?php
//course delete confirm page
include_once('../protect.php');
protect(1);

//check for id
if (isset($_GET['id']) && $_GET['id']!="") {
    $id = $_GET['id'];
    } else {
        header('Location: courses.php');
        }
//load course details added by this teacher
$getCourses	=	$db->getAllRecords('courses','*',' AND (teacher="'.$_SESSION['id'].'" AND id="'.$id.'") ');

//check for delete confirmation 
if (isset($_GET['delete']) && $_GET['delete']=="true") {
    if($getCourses[0]['id'] == $id){
        //course delete
						$where1 = array('id' => $id);
						$db->delete('courses', $where1);
                        //get all lessons
                        $getLessons = $db->getAllRecords('lessons','*',' AND course="'.$id.'" ');
                        for($i=0; $i<count($getLessons); $i++){
                        //lesson delete
                        $where2 = array('id' => $getLessons[$i]['id']);
                        $db->delete('lessons', $where2);
                        //lesson files delete
                        $where3 = array('lesson' => $getLessons[$i]['id']);
                        $db->delete('lesson_files', $where3);
                        unset($where2);
                        unset($where3);
                        //delete assignmets-todo
                    }
                        //redirect
                        header('Location: courses.php');
                    }
        }

//empty id or invalid id redirect
        //???

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
$description = "Are you sure you want to delete this course and all its associated lessons?";

$carddata = array("Confirmation Box", $getCourses[0]['name'], $description,"course_page.php?id=".$getCourses[0]['id'],'Go Back');
$cardout .= str_replace($cardpara, $carddata, $card);
$deleteBtn = '<br>
<a href="course_delete.php?delete=true&id='.$getCourses[0]['id'].'" class="btn btn-primary">Delete Course</a>';
//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('', $cardout, $deleteBtn);
echo str_replace($mainpara, $maindata, $main);


//footer
include '../templates/user/footer.html';
?>
