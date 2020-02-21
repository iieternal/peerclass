<?php
//comment add
include '../../protect.php';
protect();

//POST Data
$commentId = isset($_POST['comment_id']) ? $_POST['comment_id'] : ""; //parent
$comment = isset($_POST['comment']) ? $_POST['comment'] : ""; //comment
//$commentSenderName = isset($_POST['name']) ? $_POST['name'] : ""; //sender

$data		=	array(
						'comment'=>$comment,
						'lesson'=>$_POST['lesson'],
						'parent_comment_id'=>$commentId,
						'sender'=>$_SESSION['id']
						);
if(!empty($comment) AND trim($comment) != ''){
	$insert		=	$db->insert('tbl_comment',$data);
	echo TRUE;
}

	?>
