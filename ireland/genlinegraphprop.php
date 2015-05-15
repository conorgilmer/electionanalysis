<?php

   include('php/config.php');

    $choice = $_GET["q"]; 
    $db =  mysql_connect($dbhost,$dblogin,$dbpwd);
    mysql_select_db($dbname);    
	
// The Chart table contain two fields: Date and PercentageChange
$queryData = mysql_query("
  SELECT	seats_ire.date as thedate,
                seats_ire.ff as sff,
                seats_ire.fg as sfg,
                seats_ire.lb as slb,
                seats_ire.gp as sgp,
                seats_ire.sf as ssf,
                seats_ire.sp as ssp,
                seats_ire.pb as spb,
                seats_ire.ul as ul,
                seats_ire.dl as sdl,
                seats_ire.wp as swp,
                seats_ire.pd as spd,
                seats_ire.ri as sri,
                seats_ire.fm as sfm,
                seats_ire.cnp as scnp,
                seats_ire.others as sothers,
                seats_ire.total as sallseats,
  		votes_ire.date as vdate,
                votes_ire.ff as vff,
                votes_ire.fg as vfg,
                votes_ire.lb as vlb,
                votes_ire.gp as vgp,
                votes_ire.sf as vsf,
                votes_ire.sp as vsp,
                votes_ire.pb as vpb,
                votes_ire.ul as vul,
                votes_ire.dl as vdl,
                votes_ire.wp as vwp,
                votes_ire.ri as vri,
                votes_ire.pd as vpd,
                votes_ire.fm as vfm,
                votes_ire.cnp as vcnp,
                votes_ire.others as vothers
        FROM seats_ire, votes_ire where seats_ire.date = votes_ire.date");


/*if ($choice == 'all') {
$table = array();
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'string'),
    array('label' => 'FF', 'type' => 'number'),
    array('label' => 'FG', 'type' => 'number'),
    array('label' => 'Labour', 'type' => 'number'),
    array('label' => 'Greens', 'type' => 'number'),
    array('label' => 'SF', 'type' => 'number'),
    array('label' => 'SP', 'type' => 'number'),
    array('label' => 'PB', 'type' => 'number'),
    array('label' => 'UL', 'type' => 'number'),
    array('label' => 'DL', 'type' => 'number'),
    array('label' => 'WP', 'type' => 'number'),
    array('label' => 'RI', 'type' => 'number'),
    array('label' => 'PD', 'type' => 'number'),
    array('label' => 'FM', 'type' => 'number'),
    array('label' => 'CNaP', 'type' => 'number'),
    array('label' => 'Others', 'type' => 'number')
);
First Series
$rows = array();
while($r = mysql_fetch_assoc($queryData)) {
	$temp = array();
	 the following line will used to slice the Pie chart
	$temp[] = array('v' => (string) $r['date']); 
	$seats = 166; //$r['sallseats'];
	xxValues of the each slice
	$temp[] = array('v' => (float) (100 * $r['ff']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['fg']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['lb']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['gp']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['sf']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['sp']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['pb']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['ul']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['dl']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['wp']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['ri']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['pd']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['fm']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['cnp']/$seats)); 
	$temp[] = array('v' => (float) (100 * $r['others']/$seats)); 
	$rows[] = array('c' => $temp);
}
}
else {*/
$table = array();
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'string'),
    array('label' => $choice. ' Seats', 'type' => 'number'),
    array('label' => 'Proportional Seat Share', 'type' => 'number')
);
//First Series
$rows = array();
while($r = mysql_fetch_assoc($queryData)) {
	$temp = array();
	//$sats =$r['allseats'];
	// the following line will used to slice the Pie chart
	$temp[] = array('v' => (string) $r['thedate']); 

	//Values of the each slice
$vchoice = "v".$choice;	
$schoice = "s".$choice;	
	$temp[] = array('v' => (float) ( $r[$schoice])); 
	$temp[] = array('v' => (float) (($r[$vchoice]/100) * 166)); 
	$rows[] = array('c' => $temp);
}
//}

$table['rows'] = $rows;
$jsonTable = json_encode($table);

echo $jsonTable;

?>


