<?php
//suggestion algorithm

//include words limit
include '../extras/limit/limit.php';
//select the first field of interest only

$getSurvey = $db->getAllRecords('survey_results','*',' AND (student = '.$_SESSION['id'].')');

//setup query for data analysis
$query = '';
for($i=0; $i<count($getSurvey); $i++){
//phase x...
	switch ($getSurvey[$i]['phase']) {
		// case '1':
		// 	$query .= '(branch LIKE "'.$getSurvey[$i]['ans'].'") OR ';
		// 	break;

		case '2':
			$query .= '(type LIKE "'.$getSurvey[$i]['ans'].'") OR ';
			break;

		case '3':
			$query .= '(language LIKE "'.$getSurvey[$i]['ans'].'") OR ';
			break;

		
		default:
			break;
	}
}
if(!empty($query)){
	$query = "WHERE ".substr_replace($query ,"", -3);
}

//get list of courses
$getCourses	=	$db->getRecFrmQry('SELECT * FROM `courses` '.$query.'  ORDER BY `rank` DESC');

//load selected courses by the user
$card = file_get_contents('../templates/user/card.html');
$cardpara = array('{{title}}','{{name}}','{{text}}','{{url}}','{{urlText}}');
$cardout = '';
//loop the data
for($i=0; $i<count($getCourses); $i++){
//put data onto cards
	$carddata = array($getCourses[$i]['name'],$getCourses[$i]['branch'],limit_word($getCourses[$i]['description'], 150),'course_page.php?id='.$getCourses[$i]['id'],'View');
	$cardout .= str_replace($cardpara, $carddata, $card);
}
//load main
//load main template
$main = file_get_contents('../templates/user/main.html');
//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Suggested Courses', '', $cardout);
echo str_replace($mainpara, $maindata, $main);

