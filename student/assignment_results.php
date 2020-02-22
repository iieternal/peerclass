<?php
//assignment answers after due date

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
    $getTotalRecords	=	$db->getRecFrmQry('SELECT count(lessons.id) as total FROM `lessons` LEFT JOIN s_courses ON (lessons.course = s_courses.course AND student = "'.$_SESSION['id'].'") WHERE lessons.assignment = 1 AND lessons.assignment_due < now()');
    $total_records = $getTotalRecords[0]['total'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1;

//load list of all assignments added by this teacher
    //lists the nearest ones first
//Command: ORDER BY dt ASC LIMIT $offset, $total_records_per_page
    $command = "ORDER BY lessons.assignment_due ASC LIMIT $offset, $total_records_per_page";
$getAssignLesson	=	$db->getRecFrmQry('SELECT *,lessons.course as l_course, lessons.id as l_id FROM `lessons` LEFT JOIN s_courses ON (lessons.course = s_courses.course AND student = "'.$_SESSION['id'].'") WHERE (lessons.assignment = 1 AND lessons.assignment_due < now())'.$command);

//template default for student
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
for($i=0;$i<count($getAssignLesson); $i++){
    $date = date_create($getAssignLesson[$i]['assignment_due']);
    $complete = date_format($date,'Y/m/d');

	$carddata = array( "Due date: ".$complete,$getAssignLesson[$i]['name'], $getAssignLesson[$i]['description'],"assessment_report.php?cid=".$getAssignLesson[$i]['l_course']."&id=".$getAssignLesson[$i]['l_id'],'View');

	$cardout .= str_replace($cardpara, $carddata, $card);
}

//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Assesment Results', $cardout, "<br/>".$pagation);
echo str_replace($mainpara, $maindata, $main);


//footer
include '../templates/user/footer.html';
?>