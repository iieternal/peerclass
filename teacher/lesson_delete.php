<?php
//course delete confirm page
include_once('../protect.php');
protect(1);

//check for id
if (isset($_GET['id']) && $_GET['id']!="") {
    $id = $_GET['id'];
    } else {
        header('Location: lessons.php?id='.$_GET['cid']);
        }
//load course details added by this teacher
$getLesson	=	$db->getAllRecords('lessons','*',' AND (course="'.$_GET['cid'].'" AND id="'.$id.'") ');

//check for delete confirmation 
if (isset($_GET['delete']) && $_GET['delete']=="true") {
    if($getLesson[0]['id'] == $id){
                        //lesson delete
						$where1 = array('id' => $id);
						$db->delete('lessons', $where1);
                        //lesson file delete
                        $where2 = array('lesson' => $id);
                        $db->delete('lesson_files', $where2);
                        //redirect
                        header('Location: lessons.php?id='.$_GET['cid']);
                        //delete assignments as well-todo
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
$description = "Are you sure you want to delete this lesson and all its associated files?";

$carddata = array("Confirmation Box", $getLesson[0]['name'], $description,"lessons.php?id=".$_GET['cid'],'Go Back');
$cardout .= str_replace($cardpara, $carddata, $card);
$deleteBtn = '<br>
<a href="lesson_delete.php?delete=true&cid='.$_GET['cid'].'&id='.$getLesson[0]['id'].'" class="btn btn-primary">Delete Lesson</a>';
//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('', $cardout, $deleteBtn);
echo str_replace($mainpara, $maindata, $main);


//footer
include '../templates/user/footer.html';
?>
