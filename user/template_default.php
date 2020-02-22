<?php
//teacher template defaults
$header = file_get_contents('../templates/user/header.html');
//header parameters
echo str_replace('{{title}}', "User Profile", $header);

$nav = file_get_contents('../templates/user/nav.html');
$menu = file_get_contents('../templates/user/menu.html');
//menu parameters
$menupara = array('{{href}}', '{{title}}');
$menudata = array(['/home.php' , "Home"],
				);
$menu_output = '';
foreach($menudata as $temp_mdata){
$menu_output .= str_replace($menupara, $temp_mdata, $menu);
}
//nav parameters
$navpara = array('{{title}}', '{{menu}}');
$navdata = array('Dashboard' , $menu_output);
echo str_replace($navpara, $navdata, $nav);
?>