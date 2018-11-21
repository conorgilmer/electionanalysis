<?php
  include('php/config.php');
   $q=$_GET["q"];

  $sql_query_votes = "SELECT id,ff,fg,lb,gp,sf,wp,dl,pd,sp,pb,ul,fm,cnp,cp,nl,nal,un, others from votes_ire where id = $q";
  $sql_query_seats = "SELECT id,total,ff,fg,lb,gp,sf,wp,dl,pd,sp,pb,ul,fm,cnp,cp,nl,nal,un, others from seats_ire where id = $q";

  //$con = mysql_connect($dbhost,$dblogin,$dbpwd);

  //if (!$con){ die('Could not connect: ' . mysql_error()); }
  //mysql_select_db($dbname, $con);

  //$result_votes = mysql_query($sql_query_votes);



// Create connection
$conn = new mysqli($dbhost, $dblogin, $dbpwd, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$result_votes = $conn->query($sql_query_votes);

  //$total_rows_votes = mysql_num_rows($result_votes);
  $row_num_votes = 0;
  //while($row_votes = mysql_fetch_array($result_votes)){
  $total_rows_votes = $result_votes->num_rows;
    // output data of each row
    while($row_votes = $result_votes->fetch_assoc()) {


    $row_num_votes++;
    if ($row_num_votes == $total_rows_votes){
	$seats = 166;
	$pff = (float) ($seats * $row_votes['fg'])/100; 
	$pfg = (float) ($seats * $row_votes['fg'])/100; 
	$plab = (float) ($seats * $row_votes['lb'])/100; 
	$pgreen = (float) ($seats * $row_votes['gp'])/100; 
	$psf = (float) ($seats * $row_votes['sf'])/100; 
	$pdl = (float) ($seats * $row_votes['dl'])/100; 
	$pwp = (float) ($seats * $row_votes['wp'])/100; 
	$psp = (float) ($seats * $row_votes['sp'])/100; 
	$ppb = (float) ($seats * $row_votes['pb'])/100; 
	$pul = (float) ($seats * $row_votes['ul'])/100; 
	$ppd = (float) ($seats * $row_votes['pd'])/100; 
	$pcnp = (float) ($seats * $row_votes['cnp'])/100; 
	$pcp = (float) ($seats * $row_votes['cp'])/100; 
	$pnl = (float) ($seats * $row_votes['nl'])/100; 
	$pfm = (float) ($seats * $row_votes['fm'])/100; 
	$pnal = (float) ($seats * $row_votes['nal'])/100; 
	$pun = (float) ($seats * $row_votes['un'])/100; 
	$pothers = (float) ($seats * $row_votes['others'])/100; 
	}
  }

  //$result = mysql_query($sql_query_seats);
  $result = $conn->query($sql_query_seats);
  echo "{ \"cols\": [ {\"id\":\"\",\"label\":\"Party\",\"pattern\":\"\",\"type\":\"string\"}, {\"id\":\"\",\"label\":\"Seat Return Difference\",\"pattern\":\"\",\"type\":\"number\"} , {\"id\":\"\",\"role\":\"style\",\"type\":\"string\"} ], \"rows\": [ ";
//  $total_rows = mysql_num_rows($result);
  $row_num = 0;
//  while($row = mysql_fetch_array($result)){


$total_rows = $result->num_rows;
    // output data of each row
    while($row = $result->fetch_assoc()) {

    $row_num++;
    if ($row_num == $total_rows){
      $bff = round($row['ff'] - $pff);
      $bfg = round($row['fg'] - $pfg);
      $blab = round($row['lb'] - $plab);
      $bgreen = round($row['gp'] - $pgreen);
      $bsf = round($row['sf'] - $psf);
      $bwp = round($row['wp'] - $pwp);
      $bdl = round($row['dl'] - $pdl);
      $bsp = round($row['sp'] - $psp);
      $bpb = round($row['pb'] - $ppb);
      $bul = round($row['ul'] - $pul);
      $bpd = round($row['pd'] - $ppd);
      $bfm = round($row['fm'] - $pfm);
      $bcnp = round($row['cnp'] - $pcnp);
      $bcp = round($row['cp'] - $pcp);
      $bnl = round($row['nl'] - $pnl);
      $bnal = round($row['nal'] - $pnal);
      $bun = round($row['un'] - $pun);
      $bothers = round($row['others'] - $pothers);
      echo "{\"c\":[{\"v\":\"" . 'FF' . "\",\"f\":null},{\"v\":" . $bff . ",\"f\":null},{\"v\":\"#008000\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'FG' . "\",\"f\":null},{\"v\":" . $bfg . ",\"f\":null},{\"v\":\"#0000FF\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'Labour' . "\",\"f\":null},{\"v\":" . $blab . ",\"f\":null},{\"v\":\"#FF0000\",\"f\":null} ]},";
      if ($bgreen != 0) {
      echo "{\"c\":[{\"v\":\"" . 'Green' . "\",\"f\":null},{\"v\":" . $bgreen . ",\"f\":null},{\"v\":\"#00FF00\",\"f\":null} ]},";
      }
      if ($bsf != 0) {
      echo "{\"c\":[{\"v\":\"" . 'SF' . "\",\"f\":null},{\"v\":" . $bsf . ",\"f\":null},{\"v\":\"#00FF00\",\"f\":null} ]},";
      }
      if ($bpd != 0) {
      echo "{\"c\":[{\"v\":\"" . 'PD' . "\",\"f\":null},{\"v\":" . $bpd . ",\"f\":null},{\"v\":\"#000080\",\"f\":null} ]},";
      }
      if ($bwp != 0) {
      echo "{\"c\":[{\"v\":\"" . 'WP' . "\",\"f\":null},{\"v\":" . $bwp . ",\"f\":null},{\"v\":\"#800000\",\"f\":null} ]},";
      }
      if ($bdl != 0) {
      echo "{\"c\":[{\"v\":\"" . 'DL' . "\",\"f\":null},{\"v\":" . $bdl . ",\"f\":null},{\"v\":\"#800080\",\"f\":null} ]},";
      }
      if ($bsp != 0) {
      echo "{\"c\":[{\"v\":\"" . 'SP' . "\",\"f\":null},{\"v\":" . $bsp . ",\"f\":null},{\"v\":\"#FF2220\",\"f\":null} ]},";
      }
      if ($bpb != 0) {
      echo "{\"c\":[{\"v\":\"" . 'PBP' . "\",\"f\":null},{\"v\":" . $bpb . ",\"f\":null},{\"v\":\"#FF3330\",\"f\":null} ]},";
      }
      if ($bul != 0) {
      echo "{\"c\":[{\"v\":\"" . 'UL' . "\",\"f\":null},{\"v\":" . $bul . ",\"f\":null},{\"v\":\"#FFFF00\",\"f\":null} ]},";
      }
      if ($bcnp != 0) {
      echo "{\"c\":[{\"v\":\"" . 'CNP' . "\",\"f\":null},{\"v\":" . $bcnp . ",\"f\":null},{\"v\":\"#008080\",\"f\":null} ]},";
      }
      if ($bun != 0) {
      echo "{\"c\":[{\"v\":\"" . 'UN' . "\",\"f\":null},{\"v\":" . $bun . ",\"f\":null},{\"v\":\"#800080\",\"f\":null} ]},";
      }
      if ($bcp != 0) {
      echo "{\"c\":[{\"v\":\"" . 'CP' . "\",\"f\":null},{\"v\":" . $bcp . ",\"f\":null},{\"v\":\"#008810\",\"f\":null} ]},";
      }
      if ($bnl != 0) {
      echo "{\"c\":[{\"v\":\"" . 'NL' . "\",\"f\":null},{\"v\":" . $bnl. ",\"f\":null},{\"v\":\"#FFFF00\",\"f\":null} ]},";
      }
      if ($bnal != 0) {
      echo "{\"c\":[{\"v\":\"" . 'Nat Lab' . "\",\"f\":null},{\"v\":" . $bnal. ",\"f\":null},{\"v\":\"#800000\",\"f\":null} ]},";
      }
      if ($bfm != 0) {
      echo "{\"c\":[{\"v\":\"" . 'FM/CnaT' . "\",\"f\":null},{\"v\":" . $bfm . ",\"f\":null},{\"v\":\"#008080\",\"f\":null} ]},";
      }
      echo "{\"c\":[{\"v\":\"" . 'Others' . "\",\"f\":null},{\"v\":" . $bothers . ",\"f\":null},{\"v\":\"#808000\",\"f\":null} ]} ";
    } else {
//      echo "{\"c\":[{\"v\":\"" . 'others' . "\",\"f\":null},{\"v\":" . $row['others'] . ",\"f\":null}]}, ";
    }
  }
  echo " ] }";
  //mysql_close($con);
  $conn->close;
?>
