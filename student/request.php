<?php
//request for connection
include_once('../protect.php');
protect(0);

if(isset($_GET['id'])){
	//instead of check and update simple removal
	$id = $_GET['id'];
	$where1 = array(
		'person1' => $_SESSION['id'],
		'person2' => $id,
		'status' => 0
	);
	$where2 = array(
		'person2' => $_SESSION['id'],
		'person1' => $id,
		'status' => 0
	);
	$db->delete('connections', $where1);
	$db->delete('connections', $where2);

	//add to connections table
	//into database
	$data		=	array(
						'person1' => $_SESSION['id'],
						'person2' => $id,
						'status' => 0
						);
	$insert		=	$db->insert('connections',$data);

	header('Location: index.php?alert=success&msg=Request%20Sent');
}
?>