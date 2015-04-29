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
                others
        FROM polls_uk ");



if ($choice == 'all') {
$table = array();
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'string'),
    array('label' => 'cons', 'type' => 'number'),
    array('label' => 'lab', 'type' => 'number'),
    array('label' => 'libdems', 'type' => 'number'),
    array('label' => 'ukip', 'type' => 'number'),
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
	$temp[] = array('v' => (float) $r['cons']); 
	$temp[] = array('v' => (float) $r['lab']); 
	$temp[] = array('v' => (float) $r['libdems']); 
	$temp[] = array('v' => (float) $r['ukip']); 
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






