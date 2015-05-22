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


$table = array();
if ($choice == 'all') {
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'string'),
    array('label' => 'High Bounce', 'type' => 'number'),
    array('label' => 'Low Bounce', 'type' => 'number'),
    array('label' => 'Average', 'type' => 'number')
);
} else if ($choice == 'low') {
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'string'),
    array('label' => 'Low', 'type' => 'number')
);
} else if ($choice == 'high') {
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'string'),
    array('label' => 'High', 'type' => 'number')
);
} else if ($choice == 'avg') {
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'string'),
    array('label' => 'Average', 'type' => 'number')
);
} else {
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'string'),
    array('label' => 'High Bounce', 'type' => 'number'),
    array('label' => 'Low Bounce', 'type' => 'number'),
    array('label' => 'Average', 'type' => 'number')
);

}
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
	$bounce      = 0;
	$bounce_t    = 0;
	$parlseats   = 650;
	while($votes = mysql_fetch_assoc($queryDataV)) {
		$bounce = (float)($r['cons']) - ($parlseats * $votes['cons']/100);
		$bounce_t = abs($bounce) + $bounce_t;
		$lowbounce = (((($bounce) > $lowbounce)) ? $lowbounce :($bounce));
		$highbounce = (((abs($bounce) < $highbounce)) ? $highbounce : abs($bounce));
		
		$bounce = (float)$r['lab'] - ($parlseats * $votes['lab']/100); 
		$lowbounce = (((abs($bounce) > $lowbounce)) ? $lowbounce : abs($bounce));
		$highbounce = (((abs($bounce) < $highbounce)) ? $highbounce : abs($bounce));
		$bounce_t = abs($bounce) + $bounce_t; 
		
		$bounce = (float)$r['libdems'] - ($parlseats * $votes['libdems']/100); 
		$lowbounce = (((($bounce) > $lowbounce)) ? $lowbounce : ($bounce));
		$highbounce = (((abs($bounce) < $highbounce)) ? $highbounce : abs($bounce));
		$bounce_t = abs($bounce) + $bounce_t; 
		
		$bounce = (float)$r['snp'] - ($parlseats * $votes['snp']/100); 
		$lowbounce = (((($bounce) > $lowbounce)) ? $lowbounce : ($bounce));
		$highbounce = (((abs($bounce) < $highbounce)) ? $highbounce : abs($bounce));
		$bounce_t = abs($bounce) + $bounce_t; 
		
		$bounce = (float)$r['ukip'] - ($parlseats * $votes['ukip']/100); 
		$lowbounce = (((($bounce) > $lowbounce)) ? $lowbounce : ($bounce));
		$highbounce = (((abs($bounce) < $highbounce)) ? $highbounce : abs($bounce));
		$bounce_t = abs($bounce) + $bounce_t; 
	}
	//Values of the each slice
	if ($choice == 'all') {
	$temp[] = array('v' => (float) ($highbounce )); 
	$temp[] = array('v' => (float) ($lowbounce )); 
	$temp[] = array('v' => (float) ($bounce_t)/5.0); 
	}
	else if ($choice == 'low') {
	$temp[] = array('v' => (float) ($lowbounce )); 
	}
	else if ($choice == 'high') {
	$temp[] = array('v' => (float) ($highbounce )); 
	}
	else if ($choice == 'avg') {
	$temp[] = array('v' => (float) ($bounce_t)/5.0); 
	}
	else  {
	$temp[] = array('v' => (float) ($highbounce )); 
	$temp[] = array('v' => (float) ($lowbounce )); 
	$temp[] = array('v' => (float) ($bounce_t)/5.0); 
	}
	$rows[] = array('c' => $temp);
}
//}

$table['rows'] = $rows;
$jsonTable = json_encode($table);

echo $jsonTable;

?>






