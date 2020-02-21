<?php
//to display
//main datas
$main = file_get_contents('../templates/user/main.html');
//card datas
$card = file_get_contents('../templates/user/card2.html');
//card parameters
$cardpara = array('{{title}}','{{name}}','{{text}}');

//how many attend her course
$getAttendance	=	$db->getQueryCount('s_courses','id',' AND (course IN (SELECT id FROM courses WHERE teacher='.$_SESSION['id'].')) ');
$carddata = array('Attendance','How many are attending your courses?', $getAttendance[0]['total']);
$cardout = str_replace($cardpara, $carddata, $card);
//how many has done assesments
// $getAssesment	=	$db->getQueryCount('s_assign_ans','id',' AND (lesson IN (SELECT id FROM lessons WHERE course IN (SELECT id FROM courses WHERE teacher='.$_SESSION['id'].'))) ');
// $carddata .= array('Assessment','How many took self assessment test?', $getAssesment[0]['total']);
// $cardout .= str_replace($cardpara, $carddata, $card);
//how many passed assessment
$getAssesmentPassed	=	$db->getRecFrmQry('SELECT count(*) as total FROM s_assign_ans WHERE (lesson IN (SELECT id FROM lessons WHERE course IN (SELECT id FROM courses WHERE teacher='.$_SESSION['id'].'))) AND  answer = 1');
$carddata = array('Pass Rate','How many passed the assessment test?', $getAssesmentPassed[0]['total']);
$cardout = str_replace($cardpara, $carddata, $card);
//display stats

//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Statistics', $cardout, "");
echo str_replace($mainpara, $maindata, $main);
?>