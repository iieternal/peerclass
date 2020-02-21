<?php
//courses_attending
include_once('../protect.php');
protect(0);
//pre-set variables
$total_records_per_page = 7;

//query
//SELECT * FROM `s_courses` LEFT JOIN courses ON courses.id=s_courses.course

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
    $getTotalRecords	=	$db->getRecFrmQry('SELECT count(s_courses.id) as total FROM `s_courses` LEFT JOIN courses ON courses.id=s_courses.course WHERE (student="'.$_SESSION['id'].'") ');
    $total_records = $getTotalRecords[0]['total'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1;

//load list of all courses added by this teacher
//Command: ORDER BY dt DESC LIMIT $offset, $total_records_per_page
    $command = "ORDER BY s_courses.dt DESC LIMIT $offset, $total_records_per_page";
$getCourses	=	$db->getRecFrmQry('SELECT * FROM `s_courses` LEFT JOIN courses ON courses.id=s_courses.course WHERE (student="'.$_SESSION['id'].'") '.$command);

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
for($i=0;$i<count($getCourses); $i++){
    $completed = $getCourses[$i]['completed'] ? " (Completed)" : " (Incomplete)";
$carddata = array($getCourses[$i]['category'], $getCourses[$i]['name'].$completed, $getCourses[$i]['description'],"course_page.php?id=".$getCourses[$i]['course'],'View');
$cardout .= str_replace($cardpara, $carddata, $card);
}

//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Courses Attending', $cardout, "<br/>".$pagation);
echo str_replace($mainpara, $maindata, $main);


//footer
include '../templates/user/footer.html';
?>
