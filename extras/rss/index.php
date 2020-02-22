<?php
// get a copy of rss2html.php from https://gist.github.com/zma/270b179926971b431e8c and put it at the same directory as this php script

include_once("rss2html.php");
// output RSS feed to HTML
output_rss_feed('https://www.bing.com/search?q='.$q.'&PC=U316&FORM=CHROMN&format=rss', 20, true, true, 300);
?>
