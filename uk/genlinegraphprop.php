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
//    $db =  mysql_connect($dbhost,$dblogin,$dbpwd);
//    mysql_select_db($dbname);    

$conn = new mysqli($dbhost, $dblogin, $dbpwd, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// The Chart table contain two fields: Date and PercentageChange
//$queryData = mysql_query("
$queryData = "
  SELECT	seats_uk.date as thedate,
                seats_uk.cons as scons,
                seats_uk.lab as slab,
                seats_uk.libdems as slibdems,
                seats_uk.ukip as sukip,
                seats_uk.green as sgreen,
                seats_uk.snp as ssnp,
                seats_uk.pc as spc,
                seats_uk.uup as suup,
                seats_uk.dup as sdup,
                seats_uk.apni as sapni,
                seats_uk.sdlp as ssdlp,
                seats_uk.sf as ssf,
                seats_uk.others as sothers,
                seats_uk.allseats as sallseats,
  		vote_uk.date as vdate,
                vote_uk.cons as vcons,
                vote_uk.lab as vlab,
                vote_uk.libdems as vlibdems,
                vote_uk.ukip as vukip,
                vote_uk.green as vgreen,
                vote_uk.snp as vsnp,
                vote_uk.pc as vpc,
                vote_uk.uup as vuup,
                vote_uk.dup as vdup,
                vote_uk.apni as vapni,
                vote_uk.sdlp as vsdlp,
                vote_uk.sf as vsf,
                vote_uk.others as vothers
        FROM seats_uk, vote_uk where seats_uk.date = vote_uk.date";

$result = $conn->query($queryData);

/*if ($choice == 'all') {
$table = array();
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'string'),
    array('label' => 'Conservatives', 'type' => 'number'),
    array('label' => 'Labour', 'type' => 'number'),
    array('label' => 'Liberal Democrats', 'type' => 'number'),
    array('label' => 'Greens', 'type' => 'number'),
    array('label' => 'UKIP', 'type' => 'number'),
    array('label' => 'SNP', 'type' => 'number'),
    array('label' => 'PC', 'type' => 'number'),
    array('label' => 'UUP', 'type' => 'number'),
    array('label' => 'DUP', 'type' => 'number'),
    array('label' => 'APNI', 'type' => 'number'),
    array('label' => 'SDLP', 'type' => 'number'),
    array('label' => 'SF', 'type' => 'number'),
    array('label' => 'Others', 'type' => 'number')
);
First Series
$rows = array();
while($r = mysql_fetch_assoc($queryData)) {
	$temp = array();
	 the following line will used to slice the Pie chart
	$temp[] = array('v' => (string) $r['date']); 
	$seats =$r['allseats'];
	xxValues of the each slice
	$temp[] = array('v' => (float) (100 * $r['cons']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['lab']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['libdems']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['green']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['ukip']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['ukip']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['snp']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['pc']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['uup']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['dup']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['apni']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['sdlp']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['sf']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['others']/$seats)); 
	$rows[] = array('c' => $temp);
}
}
else {*/
$table = array();
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'string'),
    array('label' => getName($choice). ' Seats', 'type' => 'number'),
    array('label' => 'Proportional Seat Share', 'type' => 'number')
);
//First Series
//$rows = array();
//while($r = mysql_fetch_assoc($queryData)) {


if ($result->num_rows > 0) {
$rows = array();
//while($r = mysql_fetch_assoc($queryData)) {
while($r = $result->fetch_assoc()) {

	$temp = array();
	//$sats =$r['allseats'];
	// the following line will used to slice the Pie chart
	$temp[] = array('v' => (string) $r['thedate']); 

	//Values of the each slice
$vchoice = "v".$choice;	
$schoice = "s".$choice;	
	$temp[] = array('v' => (float) ( $r[$schoice])); 
	$temp[] = array('v' => (float) (($r[$vchoice]/100) * 650)); 
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


