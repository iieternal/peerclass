<?php
//error_reporting( E_ALL );
function form_template($order, $data, $extra = '') {

//form start
$header = file_get_contents(__DIR__."/header.html");
$input = file_get_contents(__DIR__."/input.html");
$datepicker = file_get_contents(__DIR__."/datepicker.html");
$select = file_get_contents(__DIR__."/select.html");
$option = file_get_contents(__DIR__."/option.html");
$check = file_get_contents(__DIR__."/check.html");
$textarea = file_get_contents(__DIR__."/textarea.html");
$button = file_get_contents(__DIR__."/button.html");
$footer = file_get_contents(__DIR__."/footer.html");

//parameters
$p_input = array("{{label}}" , "{{type}}" , "{{id}}", "{{placeholder}}");
$p_datepicker = array("{{label}}" , "{{type}}" , "{{id}}", "{{placeholder}}");
$p_select = array("{{label}}" , "{{multiple}}" , "{{id}}", "{{options}}");
$p_option = array("{{value}}" ,"{{option}}");
$p_textarea = array("{{label}}" , "{{id}}");
$p_check = array("{{label}}" , "{{id}}");
$p_button = array("{{type}}" ,"{{label}}");

//output
$output = "";
$output .= str_replace('{{link}}', $data[0][0], $header);

//note:data is always i+1
for($i=0;$i<count($order);$i++){
//switch
switch ($order[$i]){
case 'input':
$output .= str_replace($p_input, $data[$i+1], $input);
break;

//include '../teplates/materials/datepicker/datepicker.html';
case 'datepicker':
$output .= str_replace($p_datepicker, $data[$i+1], $datepicker);
break;


case 'select':
$temp_options = "";
for($j=0; $j<count($data[$i+1][3]);$j++){
$temp_options .= str_replace($p_option, $data[$i+1][3][$j], $option);
}
$temp_select = array($data[$i+1][0], $data[$i+1][1], $data[$i+1][2], $temp_options);
$output .= str_replace($p_select, $temp_select, $select);
$temp_options = $temp_select = "";
break;

case 'textarea':
$output .= str_replace($p_textarea, $data[$i+1], $textarea);
break;

case 'checkbox':
$output .= str_replace($p_checkbox, $data[$i+1], $checkbox);
break;

case 'button':
$output .= $extra; //add something before button
$output .= str_replace($p_button, $data[$i+1], $button);
break;
default:
$output .= "";
}
}

$output .= $footer;

return $output;
}
/*
Example: 
$order = array('input','select', 'button');
$data = array(['#'], ['LABEL', 'text', 'first_name', 'Enter your name' ],['label','multiple','many_options',[[0,'hello'],[1,'hi']]], ['submit', 'Submit']);
echo form_template($order, $data);
*/

?>
