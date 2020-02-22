<?php
//google scholar feed
include '../protect.php';
protect(0);

//include template
include 'template_default.php';

//rss feed
include '../extras/rss/rss2html.php';

$url = 'https://www.bing.com/search?q=site:scholar.google.com%20'.urlencode($_GET['q']).'&format=rss';
//$url = "https://edtechreview.in/?format=feed";
$out = output_rss_feed($url);


$main = file_get_contents('../templates/user/main.html');
//main parameters
$mainpara = array('{{title}}','{{card}}','{{extras}}');
$maindata = array('Journals', '', $out);
echo str_replace($mainpara, $maindata, $main);

//footer
include '../templates/user/footer.html';