<?php
//add assignments : assessment
include_once('../protect.php');
protect(1);

//post parameters
if(isset($_REQUEST['assignment_question']) and $_REQUEST['assignment_question']!=""){
	extract($_REQUEST);
//assuming test app every field is perfect
//into database
	$data		=	array(
						'lesson'=>$_REQUEST['id'],
						'question'=>$assignment_question,
						'answer1'=>$assign_ans1,
						'answer2'=>$assign_ans2,
						'answer3'=>$assign_ans3,
						'answer4'=>$assign_ans4
						);
	$insert		=	$db->insert('assignment_questions',$data);
	// header('Location: lesson_page.php?cid='.$_REQUEST['cid'].'&id='.$_REQUEST['id'];
	
}

//get current number on assignment questions added
$getTotal = $db->getQueryCount('assignment_questions','id',' AND (lesson="'.$_REQUEST['id'].'") ');
$question_no = $getTotal[0]['total'] + 1;
//template default for techer
include 'template_default.php';

//main datas
$main = file_get_contents('../templates/user/main.html');

//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');

//include form
include "../templates/materials/form/form.php";

$order = array('textarea', 'input', 'input', 'input', 'input', 'button');

$data = array(['#'],
	 ['Question','assignment_question'],
 ['Correct Answer','input','assign_ans1','Correct answer'],
  ['Wrong Answer','input','assign_ans2','Answer 2'],
   ['Wrong Answer','input','assign_ans3','Answer 3'],
    ['Wrong Answer','input','assign_ans4','Answer 4'],
  ['submit','Save & Add Another']);

$form = form_template($order, $data);

$extra = '<a href="lesson_page.php?cid='.$_REQUEST['cid'].'&id='.$_REQUEST['id'].'" class="btn btn-primary">Go back</a>';
//main output
$maindata = array('Add Assessment Question No: '.$question_no, '', $form."<br/>".$extra);
echo str_replace($mainpara, $maindata, $main);

//footer
include '../templates/user/footer.html';

?>
