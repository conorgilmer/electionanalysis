<?php

   include('config.php');

function getName($name) {
if ($name =='cons') {
	$nameText = "Conservatives";
}
else if ($name =='lab') {
	$nameText = "Labour";
}
else if ($name =='libdems') {
	$nameText = "Liberal Democrats";
}
else if ($name =='green') {
	$nameText = "Green Party";
}
else if ($name =='ukip') {
	$nameText = "UKIP";
}
else if ($name =='others') {
	$nameText = "Others/Independents";
} else {
	$nameText = $name;
}
return $nameText;
}
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
                sdlp,
                sf,
                others
        FROM seats_uk ");


if ($choice == 'all') {
$table = array();
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'string'),
    array('label' => 'Conservatives', 'type' => 'number'),
    array('label' => 'Labour', 'type' => 'number'),
    array('label' => 'Liberal Democrats', 'type' => 'number'),
    array('label' => 'Green', 'type' => 'number'),
    array('label' => 'UKIP', 'type' => 'number'),
    array('label' => 'SNP', 'type' => 'number'),
    array('label' => 'PC', 'type' => 'number'),
    array('label' => 'UUP', 'type' => 'number'),
    array('label' => 'DUP', 'type' => 'number'),
    array('label' => 'SDLP', 'type' => 'number'),
    array('label' => 'SF', 'type' => 'number'),
    array('label' => 'Others', 'type' => 'number')
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
	$temp[] = array('v' => (float) $r['green']); 
	$temp[] = array('v' => (float) $r['ukip']); 
	$temp[] = array('v' => (float) $r['ukip']); 
	$temp[] = array('v' => (float) $r['snp']); 
	$temp[] = array('v' => (float) $r['pc']); 
	$temp[] = array('v' => (float) $r['uup']); 
	$temp[] = array('v' => (float) $r['dup']); 
	$temp[] = array('v' => (float) $r['sdlp']); 
	$temp[] = array('v' => (float) $r['sf']); 
	$temp[] = array('v' => (float) $r['others']); 
	$rows[] = array('c' => $temp);
}
}
else {
$table = array();
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'string'),
    array('label' => getName($choice), 'type' => 'number')
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






