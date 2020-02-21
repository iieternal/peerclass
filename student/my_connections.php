<?php
//my_connections
include_once('../protect.php');
protect(0);
//pre-set variables
$total_records_per_page = 7;


//avoiding added users
$query_extras = '  FROM `user_profile` LEFT JOIN connections ON user_profile.tb_user=connections.person1 OR user_profile.tb_user=connections.person2 WHERE ((person1 OR person2) = '.$_SESSION['id'].' AND (person1 OR person2) = '.$_SESSION['id'].') ';

//paused
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
    $getTotalRecords	=	$db->getRecFrmQry('SELECT count(user_profile.id) as total '.$query_extras);
    $total_records = $getTotalRecords[0]['total'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1;

//load list of all courses added by this teacher
//Command: ORDER BY date DESC LIMIT $offset, $total_records_per_page
    $command = " ORDER BY connections.dt ASC LIMIT $offset, $total_records_per_page";
$getUsers	=	$db->getRecFrmQry('SELECT *'.$query_extras.$command);
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
for($i=0;$i<count($getUsers); $i++){
	$con_stat = $getUsers[$i]['status'] ? 'Pending' : 'Connected';
$carddata = array('@'.$getUsers[$i]['username'], $getUsers[$i]['fname'].' '.$getUsers[$i]['last_name'], 'Status: '.$con_stat,"/profile.php?id=".$getUsers[$i]['tb_user'],'Connect');
$cardout .= str_replace($cardpara, $carddata, $card);
}


//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('My Connections', $cardout, "<br/>".$pagation);
echo str_replace($mainpara, $maindata, $main);


//footer
include '../templates/user/footer.html';
?>
