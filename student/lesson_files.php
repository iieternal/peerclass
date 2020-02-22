<?php
//lesson files
//todo
include_once('../protect.php');
protect(0);

//check for id
if (isset($_GET['id']) && $_GET['id']!="") {
    $id = $_GET['id'];
    } else {
        header('Location : lessons.php?id='.$_GET['cid']);
        }
//load course details added by this teacher
$getLessons	=	$db->getAllRecords('lesson_files','*,unix_timestamp(dt) as date',' AND lesson="'.$id.'" ');
$getLessonDetails	=	$db->getAllRecords('lessons','*',' AND id="'.$id.'" ');

//template default for techer
include 'template_default.php';


//youtube playlist
$yt = array();
$links = array();
$data = $getLessonDetails[0]['description'];

//display content
for($i=0;$i<count($getLessons);$i++){
	switch($getLessons[$i]['type']){
	case 'yt':
	$yt[] = $getLessons[$i]['data'];
	break;

	case 'link':
	$links[] = $getLessons[$i]['data'];
	break;

	default:
	break;
	}
}
$cardout = '';
//load main template
//load selected courses by the user
$card = file_get_contents('../templates/user/card4.html');
$cardpara = array('{{title}}','{{text}}');
//youtube
$youtube = file_get_contents('../templates/materials/youtube/youtube.html');
$playlist = file_get_contents('../templates/materials/youtube/playlist.html');

$youtubepara = array('{{url}}','{{playlist}}');
$playlistpara = array('{{url}}','{{id}}','{{desciption}}');
$play_out = '';
for($i=0;$i<count($yt);$i++){
		$explode = explode('v=',$yt[$i]);
		$end = end($explode);
		$playdata = array('https://www.youtube.com/embed/'.$end, $end, '');
		$play_out .= str_replace($playlistpara, $playdata, $playlist);
}
if(isset($yt[0])){
	$explode = explode('v=',$yt[0]);
	$end = end($explode);
	$youtube_data = array('https://www.youtube.com/embed/'.$end, $play_out);
	$youtube_out = str_replace($youtubepara, $youtube_data, $youtube);

//output card
	$cardD1 = array('Videos',$youtube_out);
	$cardout .= str_replace($cardpara, $cardD1, $card);
}
// $youtube = file_get_contents('../templates/youtube2/yt.html');
// $play_out = '';
// for($i=0; $i<count($yt); $i++){
// 		$playdata = $yt[$i];
// 		$play_out .= str_replace('{{url}}', $playdata, $youtube);
// }
//output card for links
$reflinks = '';
for($i=0;$i<count($links);$i++){
		$reflinks .= '<a class="btn" href="'.$links[$i].'">'.$links[$i].'</a><br/>';
}

$cardD2 = array('Reference Links',$reflinks);
$cardout .= str_replace($cardpara, $cardD2, $card);

//buttons at the end
$Btn = '<br><br><a href="comments.php?cid='.$_GET['cid'].'&id='.$_GET['id'].'" class="btn btn-primary">Ask a question</a>
		<br><br><a href="lesson_page.php?cid='.$_GET['cid'].'&id='.$_GET['id'].'" class="btn btn-primary">Go Back</a>';


$main = file_get_contents('../templates/user/main.html');
//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array($getLessonDetails[0]['name'], '', $cardout.$Btn);
echo str_replace($mainpara, $maindata, $main);

//load footer
include '../templates/user/footer.html';