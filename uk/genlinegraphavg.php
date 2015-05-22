<?php

   include('config.php');

    $choice = $_GET["q"]; 
    $db =  mysql_connect($dbhost,$dblogin,$dbpwd);
    mysql_select_db($dbname);    
	
// The Chart table contain two fields: Date and PercentageChange
$queryData = mysql_query("
  SELECT	date,
                cons,
                lab,
                libdems,
                ukip,
                green,
                snp,
                pc,
                uup,
                dup,
                apni,
                sdlp,
                sf,
                others
        FROM seats_uk ");


if ($choice == 'all') {
$table = array();
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'string'),
    array('label' => 'High Bounce', 'type' => 'number'),
    array('label' => 'Low Bounce', 'type' => 'number'),
    array('label' => 'Average', 'type' => 'number')
);
//First Series
$rows = array();
while($r = mysql_fetch_assoc($queryData)) {
	$temp = array();
	// the following line will used to slice the Pie chart
	$temp[] = array('v' => (string) $r['date']); 
	$edate = $r['date'];
  $queryDataV = mysql_query("SELECT date, cons,lab,libdems,ukip,green,snp,sdlp,pc,dup,uup,sf,apni, others from vote_uk where date = '$edate'");
	$highbounce  = 0;
	$lowbounce   = 100.0;
	$avgbounce   = 0;
	$count       = 1;
	$bounce      = 0;
	$bounce_t    = 0;
	$parlseats   = 650;
	while($votes = mysql_fetch_assoc($queryDataV)) {
		$bounce = (float)($r['cons']) - ($parlseats * $votes['cons']/100);
		$bounce_t = abs($bounce) + $bounce_t;
		//if ($lowbounce > (abs($bounce))) { 
		//	$lowbounce = $bounce;
		//}
		$lowbounce = (((abs($bounce) > $lowbounce)) ? $lowbounce : abs($bounce));
		$highbounce = (((abs($bounce) < $highbounce)) ? $highbounce : abs($bounce));
	//	echo $lowbounce . "<br>";
		$bounce = $r['lab'] - ($parlseats * $votes['lab']/100); 
		$lowbounce = (((abs($bounce) > $lowbounce)) ? $lowbounce : abs($bounce));
		$highbounce = (((abs($bounce) < $highbounce)) ? $highbounce : abs($bounce));
		$bounce_t = abs($bounce) + $bounce_t; 
		$bounce = $r['libdems'] - ($parlseats * $votes['libdems']/100); 
		$lowbounce = (((abs($bounce) > $lowbounce)) ? $lowbounce : abs($bounce));
		$highbounce = (((abs($bounce) < $highbounce)) ? $highbounce : abs($bounce));
		$bounce_t = abs($bounce) + $bounce_t; 
		$count = $count +1;
	}
	//Values of the each slice
	$temp[] = array('v' => (float) ($highbounce )); 
	$temp[] = array('v' => (float) ($lowbounce )); 
	$temp[] = array('v' => (float) ($bounce_t)/3.0); 
	$rows[] = array('c' => $temp);
}
}
else {
$table = array();
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'string'),
    array('label' => $choice, 'type' => 'number')
);
//First Series
$rows = array();
while($r = mysql_fetch_assoc($queryData)) {
	$temp = array();
	// the following line will used to slice the Pie chart
	$temp[] = array('v' => (string) $r['date']); 

	//Values of the each slice
	$temp[] = array('v' => (float) $r[$choice]);


 
	$rows[] = array('c' => $temp);
}
}

$table['rows'] = $rows;
$jsonTable = json_encode($table);

echo $jsonTable;

?>






