<?php
   include('php/config.php');

    $choice = $_GET["q"]; 
    $db =  mysql_connect($dbhost,$dblogin,$dbpwd);
    mysql_select_db($dbname);    
	
// The Chart table contain two fields: Date and PercentageChange
$queryData = mysql_query("
  SELECT	date,
                source,
                ff,
                fg,
                lab,
                sf,
                pd,
                rn,
                SD,
                wp,
                pbp,
                IA,
                green,
                others
        FROM polls_ireland ");



if ($choice == 'all') {
$table = array();
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'string'),
    array('label' => 'ff', 'type' => 'number'),
    array('label' => 'fg', 'type' => 'number'),
    array('label' => 'lab', 'type' => 'number'),
    array('label' => 'sf', 'type' => 'number'),
    array('label' => 'pd', 'type' => 'number'),
    array('label' => 'rn', 'type' => 'number'),
    array('label' => 'SD', 'type' => 'number'),
    array('label' => 'IA', 'type' => 'number'),
    array('label' => 'wp', 'type' => 'number'),
    array('label' => 'pbp', 'type' => 'number'),
    array('label' => 'green', 'type' => 'number'),
    array('label' => 'others', 'type' => 'number')
);
//First Series
$rows = array();
while($r = mysql_fetch_assoc($queryData)) {
	$temp = array();
	// the following line will used to slice the Pie chart
	$temp[] = array('v' => (string) $r['date']); 

	//Values of the each slice
	$temp[] = array('v' => (float) $r['ff']); 
	$temp[] = array('v' => (float) $r['fg']); 
	$temp[] = array('v' => (float) $r['lab']); 
	$temp[] = array('v' => (float) $r['sf']); 
	$temp[] = array('v' => (float) $r['pd']); 
	$temp[] = array('v' => (float) $r['rn']); 
	$temp[] = array('v' => (float) $r['SD']); 
	$temp[] = array('v' => (float) $r['IA']); 
	$temp[] = array('v' => (float) $r['wp']); 
	$temp[] = array('v' => (float) $r['pbp']); 
	$temp[] = array('v' => (float) $r['green']); 
	$temp[] = array('v' => (float) $r['others']); 
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
	$temp[] = array('v' => (string) $r['date']); 
	//$temp[] = array('v' => (string) $r['source'] . $r['date']); 

	//Values of the each slice
	$temp[] = array('v' => (float) $r[$choice]); 
	$rows[] = array('c' => $temp);
}
}

$table['rows'] = $rows;
$jsonTable = json_encode($table);

echo $jsonTable;

?>



