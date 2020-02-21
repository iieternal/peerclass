<?php
//assignmnets
//lists all assignments taken by this teacher on this lesson
include_once('../protect.php');
protect(0);
//pre-set variables
$total_records_per_page = 1;

//reading the post request
if(isset($_POST['answer_selected']) && $_POST['answer_selected'] != ''){
    $clean_token = unserialize(urldecode($_POST['assignment_token']));
    //$ans_post = array_search( $_POST['answer_selected'], $clean_token) + 1;
    $ans_post = $clean_token[$_POST['answer_selected']-1];
    //into database
    $data       =   array(
                        'assignment'=>$_POST['assignment_id'],
                        'answer'=>$ans_post,
                        'lesson'=>$_GET['id']
                        );
    $insert     =   $db->insert('s_assign_ans',$data);

}

//get course id
if (isset($_GET['id']) && $_GET['id']!="") {
    $id = $_GET['id'];
    } else {
        header('Location : find_course.php');
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
$ans_shuffle = array('1','2','3','4'); //numbers to shuffle

//printing values
for($i=0;$i<count($getAssignment); $i++){
//simplifying shuffle w.r.t option value
    //shuffles the answer options each time
shuffle($ans_shuffle);
//answer readout
$answer = "<b>A)</b> ".$getAssignment[$i]['answer'.$ans_shuffle[0]];
$answer .= "<br><b>B)</b> ".$getAssignment[$i]['answer'.$ans_shuffle[1]];
$answer .= "<br><b>C)</b> ".$getAssignment[$i]['answer'.$ans_shuffle[2]];
$answer .= "<br><b>D)</b> ".$getAssignment[$i]['answer'.$ans_shuffle[3]];

$data = array(
    ['POST','assignment_page.php?page_no='.($page_no+1).$get_var],
    ['Select Answer','','answer_selected',[
        [1,'A',''],[2,'B',''], [3,'C',''],[4,'D','']]],
        ['assignment_token', urlencode(serialize($ans_shuffle))],

        ['assignment_id', $getAssignment[$i]['id']],
    ['submit', 'Save & Answer Next Question']);
$select_ans = form_template($order, $data);
//form is created each time {only once in theory}

$answer .= "<br>".$select_ans;
$carddata = array('Question: '. ($i+1), $getAssignment[$i]['question'], $answer);
$cardout .= str_replace($cardpara, $carddata, $card);
}

//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Assignments added on this lesson', $cardout, '<br><br><a href="lesson_page.php?cid='.$_GET['cid'].'&id='.$id.'" class="btn btn-primary">Go Back</a><br/><br/>'.$pagation);
echo str_replace($mainpara, $maindata, $main);


//footer
include '../templates/user/footer.html';
?>
