<?php

   include('php/config.php');

    $choice = $_GET["q"]; 
//    $db =  mysql_connect($dbhost,$dblogin,$dbpwd);
//    mysql_select_db($dbname);    
	
// The Chart table contain two fields: Date and PercentageChange
//$queryData = mysql_query("
$queryData ="
  SELECT	date,
                ff,
                fg,
                lb,
                pd,
                gp,
                wp,
                dl,
                sf,
                others
        FROM seats_ire ";

// Create connection
$conn = new mysqli($dbhost, $dblogin, $dbpwd, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = $conn->query($queryData);

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
//while($r = mysql_fetch_assoc($queryData)) {


if ($result->num_rows > 0) {
    // output data of each row
    while($r = $result->fetch_assoc()) {
	$temp = array();
	// the following line will used to slice the Pie chart
	$temp[] = array('v' => (string) $r['date']); 
	$edate = $r['date'];

  //$queryDataV = mysql_query("SELECT date, ff, fg,lb,sf,pd, wp, dl,gp, others from votes_ire where date = '$edate'");
  $queryDataV = "SELECT date, ff, fg,lb,sf,pd, wp, dl,gp, others from votes_ire where date = '$edate'";
	$highbounce  = 0;
	$lowbounce   = 0.0;
	$avgbounce   = 0;
	$bounce      = 0;
	$bounce_t    = 0;
	$parlseats   = 166;
	//while($votes = mysql_fetch_assoc($queryDataV)) {
	$result1 = $conn->query($queryDataV);
        while($r = $result1->fetch_assoc()) {
		$bounce = (float)($r['ff']) - ($parlseats * $votes['ff']/100);
		$bounce_t = abs($bounce) + $bounce_t;
		$lowbounce = (((($bounce) > $lowbounce)) ? $lowbounce :($bounce));
		$highbounce = (((abs($bounce) < $highbounce)) ? $highbounce : abs($bounce));
	
		$bounce = (float)$r['lb'] - ($parlseats * $votes['lb']/100); 
		$lowbounce = (((($bounce) > $lowbounce)) ? $lowbounce : ($bounce));
		$highbounce = (((abs($bounce) < $highbounce)) ? $highbounce : abs($bounce));
		$bounce_t = abs($bounce) + $bounce_t; 
		
		$bounce = (float)$r['fg'] - ($parlseats * $votes['fg']/100); 
		$lowbounce = (((($bounce) > $lowbounce)) ? $lowbounce : ($bounce));
		$highbounce = (((abs($bounce) < $highbounce)) ? $highbounce : abs($bounce));
		$bounce_t = abs($bounce) + $bounce_t; 
		
		$bounce = (float)$r['pd'] - ($parlseats * $votes['pd']/100); 
		$lowbounce = (((($bounce) > $lowbounce)) ? $lowbounce : ($bounce));
		$highbounce = (((abs($bounce) < $highbounce)) ? $highbounce : abs($bounce));
		$bounce_t = abs($bounce) + $bounce_t; 
		
		$bounce = (float)$r['sf'] - ($parlseats * $votes['sf']/100); 
		$lowbounce = (((($bounce) > $lowbounce)) ? $lowbounce : ($bounce));
		$highbounce = (((abs($bounce) < $highbounce)) ? $highbounce : abs($bounce));
		$bounce_t = abs($bounce) + $bounce_t; 
		
		$bounce = (float)$r['others'] - ($parlseats * $votes['others']/100); 
		$lowbounce = (((($bounce) > $lowbounce)) ? $lowbounce : ($bounce));
		$highbounce = (((abs($bounce) < $highbounce)) ? $highbounce : abs($bounce));
		$bounce_t = abs($bounce) + $bounce_t; 
	}
	//Values of the each slice
	if ($choice == 'all') {
	$temp[] = array('v' => (float) ($highbounce )); 
	$temp[] = array('v' => (float) ($lowbounce )); 
	$temp[] = array('v' => (float) ($bounce_t)/6.0); 
	}
	else if ($choice == 'low') {
	$temp[] = array('v' => (float) ($lowbounce )); 
	}
	else if ($choice == 'high') {
	$temp[] = array('v' => (float) ($highbounce )); 
	}
	else if ($choice == 'avg') {
	$temp[] = array('v' => (float) ($bounce_t)/6.0); 
	}
	else  {
	$temp[] = array('v' => (float) ($highbounce )); 
	$temp[] = array('v' => (float) ($lowbounce )); 
	$temp[] = array('v' => (float) ($bounce_t)/6.0); 
	}
	$rows[] = array('c' => $temp);
}
} else {
    echo "0 results";
}


//}

$table['rows'] = $rows;
$jsonTable = json_encode($table);

echo $jsonTable;

?>






