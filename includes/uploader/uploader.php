<?php
include '../../protect.php';
protect();

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST")
{
	
	$cid = $_REQUEST['cid'];
	if(isset($_REQUEST['id']))
		$id = $_REQUEST['id'];
	else
		$id = 'assignment';

	$file_name		= strip_tags($_FILES['upload_file']['name']);
	$file_id 		= strip_tags($_POST['upload_file_ids']);
	$file_size 		= $_FILES['upload_file']['size'];

	$dir = $base_dir."/files/".$cid;
	//check directory
	if(!is_dir($dir)){
		mkdir($dir);
		$dir = $dir."/".$id;
		if(!is_dir($dir)){
			mkdir($dir);
		}
	} else {
		$dir = $dir."/".$id;
	}
	$file_location 	= $dir ."/". $file_name;
	
	//file type identifier
	$img_type = array("jpg","jpeg","png","gif");
	$vd_type = array("mp4","mkv","avi","flv","mpeg");
	$audio_type = array("mp3","3gp");
	$doc_type = array("docx","ppt","pptx","pdf");

	$temp_array = explode('.', $file_name);
	$file_type = strtolower(end($temp_array));

	if(in_array($file_type,$img_type)){
		$filetype = "img";
	} else if(in_array($file_type,$vd_type)){
		$filetype = "vd";
	} else if(in_array($file_type,$audio_type)){
		$filetype = "aud";
	} else if(in_array($file_type,$doc_type)){
		$filetype = "doc";
	} else {
		$filetype = "other";
	}

	//file upload
	if(move_uploaded_file(strip_tags($_FILES['upload_file']['tmp_name']), $file_location)){
		//insert into database
		if(isset($_REQUEST['id'])){
	$data		=	array(
						'loc'=>$cid."/".$id."/".$file_name,
						'lesson'=>$_REQUEST['id'],
						'type'=>$filetype
						);
//for lesson file uploads
		$insert		=	$db->insert('lesson_files',$data);
	}
//for assignments updates
		if(isset($_REQUEST['assign'])){
			$data		=	array(
						'loc'=>$cid."/".$id."/".$file_name
						);
	$where		=	array(
						'id'=>$cid //assignment id
						);
	$update		=	$db->update('assignment_course', $data,$where);
		}
		//upload confirmation
		echo $file_id;
	}else{
		echo "System Error!";
	}
	
	
}
?>