<?php
//suggestion based on similar user preferences
$getCourse = $db->getAllRecords('courses','*',' AND (student = '.$_SESSION['id'].') ORDER BY dt DESC  LIMIT 3');
//finding users with similar insterst
$getUsers = $db->getRecFrmQry('');
//finding related courses
$getRelated;