<?php
//comment-list
include '../../protect.php';
protect();
//checking for lesson id
if(isset($_GET['lesson'])){
$id = $_GET['lesson'];
$getComment	=	$db->getRecFrmQry('SELECT *,tb_user.id as uid,unix_timestamp(date) as dt FROM `tbl_comment` LEFT JOIN tb_user ON tb_user.id = sender WHERE lesson = '.$id);
//append to array
include '../date/date.php';
$comments = array();
for($i=0; $i<count($getComment); $i++){
	$new_row = array(
			'comment' => $getComment[$i]['comment'],
			'comment_id' => $getComment[$i]['comment_id'],
			'parent_comment_id' => $getComment[$i]['parent_comment_id'],
			'sender_name' => $getComment[$i]['username'],
			'sender_id' => $getComment[$i]['uid'],
			'date' => timeago($getComment[$i]['dt'])
		);
	array_push($comments, $new_row);
	unset($new_row);
}
//output as json
echo json_encode($comments);
}

?>