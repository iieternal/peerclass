<?php
include_once('../protect.php');
protect(1);

//template default for techer
include 'template_default.php';

//main datas
$main = file_get_contents('../templates/user/main.html');
//card datas
$card = file_get_contents('../templates/user/card.html');
//card parameters
$cardpara = array('{{title}}','{{name}}','{{text}}','{{url}}','{{urlText}}');
$carddata = array('Title','Name','Text','#','Link');
$cardout = str_replace($cardpara, $carddata, $card);
$cardout .= str_replace($cardpara, $carddata, $card);
//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Statistics', $cardout, "");
echo str_replace($mainpara, $maindata, $main);

//footer
include '../templates/user/footer.html';
?>