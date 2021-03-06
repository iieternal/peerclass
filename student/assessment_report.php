<?php
//assessment report
include_once('../protect.php');
protect(0);
//pre-set variables
$total_records_per_page = 10;


//get course id
if (isset($_GET['id']) && $_GET['id']!="") {
    $id = $_GET['id'];
    } else {
        header('Location: find_course.php');
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
    $getTotalRecords	=	$db->getQueryCount('assignment_questions','id',' AND (lesson="'.$id.'") ');
    $total_records = $getTotalRecords[0]['total'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1;

//load list of all courses added by this teacher
//Command: ORDER BY date DESC LIMIT $offset, $total_records_per_page
    $command = "ORDER BY dt ASC LIMIT $offset, $total_records_per_page";
$getAssignment	=	$db->getAllRecords('assignment_questions','*',' AND (lesson="'.$id.'") ', $command);
//template default for techer
include 'template_default.php';
//pagation
ob_start();
$get_var = '&cid='.$_GET['cid'].'&id='.$id;
include '../extras/pagation/pagation_footer.php';
$pagation = ob_get_clean();

//redirect on assignment end
    if($total_no_of_pages < $page_no){
        header('location: lesson_page.php?'.$get_var);
    }

//output the fields
//main datas
$main = file_get_contents('../templates/user/main.html');
//card datas :card 2 no links
$card = file_get_contents('../templates/user/card2.html');
//card parameters
$cardpara = array('{{title}}','{{name}}','{{text}}');
$cardout = '';
//importing form v2
include '../templates/materials/form2/form.php';
$order = array('select', 'hidden', 'hidden', 'button');

//printing values
for($i=0;$i<count($getAssignment); $i++){
//simplifying shuffle w.r.t option value
    //shuffles the answer options each time
//answer readout
$answer = "<p class='alert alert-sucess'> Answer: ".$getAssignment[$i]['answer1']."</p>";
$getAssignmentAns	=	$db->getAllRecords('s_assign_ans','*',' AND (lesson="'.$id.'" AND assignment = "'.$getAssignment[$i]['id'].'") ');

if(isset($getAssignmentAns[0]) && $getAssignmentAns[0]['answer'] == 1){
	$answer .= '<br> You Choose The Correct Answer';
} else {
	$answer .= '<br> You Choose The Wrong Answer';
}


//form is created each time {only once in theory}
$carddata = array('Question: '. ($i+1), $getAssignment[$i]['question'], $answer);
$cardout .= str_replace($cardpara, $carddata, $card);
}

//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Tests added on this lesson', $cardout, '<br><br><a href="lesson_page.php?cid='.$_GET['cid'].'&id='.$id.'" class="btn btn-primary">Go Back</a><br/><br/>'.$pagation);
echo str_replace($mainpara, $maindata, $main);


//footer
include '../templates/user/footer.html';
