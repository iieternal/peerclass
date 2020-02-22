<?php
//error page
include '../protect.php';
protect(0);

//include template
include 'template_default.php';


if(isset($_GET['alert'])){
	switch($_GET['type']){
		case 'success':
			$out = '<p class="alert alert-success">'.$_GET['alert'].'</a>';
		break;

		case 'warning':
			$out = '<p class="alert alert-warning">'.$_GET['alert'].'</a>';
		break;

		case 'info':
			$out = '<p class="alert alert-info">'.$_GET['alert'].'</a>';
		break;
	}
}

$main = file_get_contents('../templates/user/main.html');
//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Alerts', '', $out);
echo str_replace($mainpara, $maindata, $main);

//footer
include '../templates/user/footer.html';