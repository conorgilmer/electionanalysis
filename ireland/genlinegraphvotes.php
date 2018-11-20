<?php

   include('php/config.php');

    $choice = $_GET["q"]; 
//    $db =  mysql_connect($dbhost,$dblogin,$dbpwd);
  //  mysql_select_db($dbname);    
	
// The Chart table contain two fields: Date and PercentageChange
//$queryData = mysql_query("
$queryData = "
  SELECT	date,
                ff,
                fg,
                lb,
                gp,
                sf,
                sp,
                pb,
                ul,
                dl,
                wp,
                wp,
                pd,
                fm,
                cp,
                cnp,
                nl,
                un,
                nal,
                others
        FROM votes_ire ";


// Create connection
$conn = new mysqli($dbhost, $dblogin, $dbpwd, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = $conn->query($queryData);



if ($choice == 'all') {
$table = array();
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'string'),
    array('label' => 'FF', 'type' => 'number'),
    array('label' => 'FG', 'type' => 'number'),
    array('label' => 'Labour', 'type' => 'number'),
    array('label' => 'Green', 'type' => 'number'),
    array('label' => 'SF', 'type' => 'number'),
    array('label' => 'PD', 'type' => 'number'),
    array('label' => 'SP', 'type' => 'number'),
    array('label' => 'PB', 'type' => 'number'),
    array('label' => 'UL', 'type' => 'number'),
    array('label' => 'DL', 'type' => 'number'),
    array('label' => 'WP', 'type' => 'number'),
    array('label' => 'CNP', 'type' => 'number'),
    array('label' => 'Farmers', 'type' => 'number'),
    array('label' => 'NL', 'type' => 'number'),
    array('label' => 'CP', 'type' => 'number'),
    array('label' => 'Nat Labour', 'type' => 'number'),
    array('label' => 'Unionist', 'type' => 'number'),
    array('label' => 'Others', 'type' => 'number')
);
//First Series
$rows = array();
//while($r = mysql_fetch_assoc($queryData)) {

if ($result->num_rows > 0) {
    // output data of each row
    while($r = $result->fetch_assoc()) {


	$temp = array();
	// the following line will used to slice the Pie chart
	$temp[] = array('v' => (string) $r['date']); 

	//Values of the each slice
	$temp[] = array('v' => (float) $r['ff']); 
	$temp[] = array('v' => (float) $r['fg']); 
	$temp[] = array('v' => (float) $r['lb']); 
	$temp[] = array('v' => (float) $r['gp']); 
	$temp[] = array('v' => (float) $r['sf']); 
	$temp[] = array('v' => (float) $r['pd']); 
	$temp[] = array('v' => (float) $r['sp']); 
	$temp[] = array('v' => (float) $r['pb']); 
	$temp[] = array('v' => (float) $r['ul']); 
	$temp[] = array('v' => (float) $r['dl']); 
	$temp[] = array('v' => (float) $r['wp']); 
	$temp[] = array('v' => (float) $r['cnp']); 
	$temp[] = array('v' => (float) $r['fm']); 
	$temp[] = array('v' => (float) $r['nl']); 
	$temp[] = array('v' => (float) $r['cp']); 
	$temp[] = array('v' => (float) $r['nal']); 
	$temp[] = array('v' => (float) $r['un']); 
	$temp[] = array('v' => (float) $r['others']); 
	$rows[] = array('c' => $temp);
}
} else {
    echo "0 results";
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
//while($r = mysql_fetch_assoc($queryData)) {
if ($result->num_rows > 0) {
    // output data of each row
    while($r = $result->fetch_assoc()) {

	$temp = array();
	// the following line will used to slice the Pie chart
	$temp[] = array('v' => (string) $r['date']); 

	//Values of the each slice
	$temp[] = array('v' => (float) $r[$choice]); 
	$rows[] = array('c' => $temp);
}
} else {
    echo "0 results";
}


}

$table['rows'] = $rows;
$jsonTable = json_encode($table);

echo $jsonTable;

?>






