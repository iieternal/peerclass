<?php  

$hr=array('A','B','C','D','E','F','G','H','I');
$lr=array('J','K','L','M','N','O','P','Q');
$ar=array('R','S','T','U','V','W','X','Y','Z');

$hrl=count($hr);
$lrl=count($lr);
$arl=count($ar);

$ts= $hrl+$lrl+$arl;

echo 'Total no. of students = ' . $ts;

$ng=round($ts/7);

echo 'Total no. of groups = ' . $ng;

$gm=array();
$rptr=0;
$r=0;
$c=0;
$ngc=$ng;

while($hrl>0){
	if($r < $ngc){
		$gm[$r][$c]=$hr[$rptr];
		$rptr++;
		$r++;
		$hrl--;
	}

	else {
		$r=0;
		$c++;
	}
	

}
$rptr=0;
while($arl>0){
	if($r < $ngc){
		$gm[$r][$c]=$ar[$rptr];
		$rptr++;
		$r++;
		$arl--;
	}

	else {
		$r=0;
		$c++;
	}
	

}

$rptr=0;
while($lrl>0){
	if($r < $ngc){
		$gm[$r][$c]=$lr[$rptr];
		$rptr++;
		$r++;
		$lrl--;
	}

	else {
		$r=0;
		$c++;
	}
	

}
print_r($gm);


?>