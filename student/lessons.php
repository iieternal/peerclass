<?php
//lessons
//lists all lessons taken by this teacher on this course
include_once('../protect.php');
protect(0);
//pre-set variables
$total_records_per_page = 7;

//get course id
if (isset($_GET['id']) && $_GET['id']!="") {
    $id = $_GET['id'];
    } else {
        header('Location: courses_attendings.php');
        }

//pagation config
if (isset($_GET['page_no']) && $_GET['page_no']!="") {
    $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
        }
	$offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";

//sql call for total records
    $getTotalRecords	=	$db->getQueryCount('lessons','id',' AND (course="'.$id.'") ');
    $total_records = $getTotalRecords[0]['total'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1;

//load list of all courses added by this teacher
//Command: ORDER BY date DESC LIMIT $offset, $total_records_per_page
    $command = "ORDER BY dt ASC LIMIT $offset, $total_records_per_page";
$getLessons	=	$db->getAllRecords('lessons','*',' AND (course="'.$id.'") ', $command);
//template default for techer
include 'template_default.php';
//pagation
ob_start();
include '../extras/pagation/pagation_footer.php';
$pagation = ob_get_clean();

//output the fields
//main datas
$main = file_get_contents('../templates/user/main.html');
//card datas
$card = file_get_contents('../templates/user/card.html');
//card parameters
$cardpara = array('{{title}}','{{name}}','{{text}}','{{url}}','{{urlText}}');
$cardout = '';
//printing values
for($i=0;$i<count($getLessons); $i++){
$carddata = array('', $getLessons[$i]['name'], $getLessons[$i]['description'],"lesson_page.php?cid=".$id."&id=".$getLessons[$i]['id'],'View');
$cardout .= str_replace($cardpara, $carddata, $card);
}

//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Course >> Lessons', $cardout, '<br><br><a href="course_page.php?id='.$id.'" class="btn btn-primary">Go back</a><br/><br/>'.$pagation);
echo str_replace($mainpara, $maindata, $main);


//footer
include '../templates/user/footer.html';
?>
