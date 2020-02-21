<?php
include_once('../protect.php');
protect(0);

//template default for techer
include 'template_default.php';

//include suggestions
include 'suggest.php';

//footer
include '../templates/user/footer.html';
?>