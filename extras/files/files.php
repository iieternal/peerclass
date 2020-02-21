<?php
//files function

//returns template for the output file
function file_card($type, $data, $text = ''){
	if($type == "text"){
		$output = '<p class"card-text">'.$text."</p>";
	} else if($type == "img"){

		$temp_array = explode("/", $data);
		$file_name = end($temp_array);
		$output = '<img src="/files/'.$data.'" class="img img-fluid"/> <br/><br/> <a href ="/files/'.$data.'" class="btn btn-primary">Download Image File</a>';

	} else if($type == "audio"){

		$temp_array = explode("/", $data);
		$file_name = end($temp_array);
		$output = 'File Name: '.$file_name.' <br/><br/><a href ="/files/'.$data.'" class="btn btn-primary">Download Audio File</a>';

	} else if($type == "vd"){

		$temp_array = explode("/", $data);
		$file_name = end($temp_array);
		$output = ' <a href ="/files/'.$data.'" class="btn btn-primary">Download Video</a>';

	} else if($type == "doc"){
		$temp_array = explode("/", $data);
		$file_name = end($temp_array);
		$output = 'File Name: '.$file_name.' <br/><br/><a href ="/files/'.$data.'" class="btn btn-primary">Download Doc File</a>';
	} else {
		$temp_array = explode("/", $data);
		$file_name = end($temp_array);
		$output = 'File Name: '.$file_name.' <br/><br/><a href ="/files/'.$data.' class="btn btn-primary">Download File</a>';
	}
	return $output;
}

//get file Name
function file_name($loc)
{
	$temp_array = explode("/", $data);
	return end($temp_array);
}

?>