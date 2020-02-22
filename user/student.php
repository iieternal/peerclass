<?php
//student
include 'template_default.php';

//main datas
$main = file_get_contents('../templates/user/main.html');
//profile datas
$profile_header = file_get_contents('../templates/profile/header_files.html');
$profile_header = file_get_contents('../templates/profile/footer_files.html');
$profile = file_get_contents('../templates/profile/profile1.html');
//get user
$id = $_GET['id'];
$getUser = $db->
//profile parameters
$profilepara = array('{{name}}','{{designation}}','{{button1}}','{{button2}}');
$profiledata = array('Title','Name','Text','#');
$profileout = str_replace($profilepara, $profiledata, $profile);
$profileout .= str_replace($profilepara, $profiledata, $profile);
//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Statistics', $profileout, "");
echo str_replace($mainpara, $maindata, $main);

//footer
include '../templates/user/footer.php';