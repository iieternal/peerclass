<?php
include 'form/form.php';
$order = array('input','select', 'button');
$data = array(['#'], ['LABEL', 'input', 'first_name', 'Enter your name' ],['label','multiple','many_options',[[0,'hello'],[1,'hi']]], ['submit', 'Submit']);
echo form_template($order, $data);
?>