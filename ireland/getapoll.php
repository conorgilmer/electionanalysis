<?php
   $q=$_GET["q"];
include('php/config.php');

  $sql_query = "SELECT ff, fg, lab, green, sf,wp,dl,sp,pbp,rn,SD,IA, others, pd from polls_ireland where id = $q";
//  $con = mysql_connect($dbhost,$dblogin,$dbpwd);
//  if (!$con){ die('Could not connect: ' . mysql_error()); }
//  mysql_select_db($dbname, $con);

//  $result = mysql_query($sql_query);

// Create connection
$conn = new mysqli($dbhost, $dblogin, $dbpwd, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = $conn->query($sql_query);


  echo "{ \"cols\": [ {\"id\":\"\",\"label\":\"Party\",\"pattern\":\"\",\"type\":\"string\"}, {\"id\":\"\",\"label\":\"Percentage\",\"pattern\":\"\",\"type\":\"number\"}  , {\"id\":\"\",\"role\":\"style\",\"type\":\"string\"}  ], \"rows\": [ ";
  //$total_rows = mysql_num_rows($result);
  $total_rows =$result->num_rows;
  $row_num = 0;
//  while($row = mysql_fetch_array($result)){

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

    $row_num++;
    $othersadd = "";
    if ($row_num == $total_rows){
echo "{\"c\":[{\"v\":\"" . 'Fianna Fail' . "\",\"f\":null},{\"v\":" . $row['ff'] . ",\"f\":null},{\"v\":\"#008000\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'Fine Gael' . "\",\"f\":null},{\"v\":" . $row['fg'] . ",\"f\":null},{\"v\":\"#0000FF\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'Labour' . "\",\"f\":null},{\"v\":" . $row['lab'] . ",\"f\":null},{\"v\":\"#FF0000\",\"f\":null} ]},";
	if ($row['sf']!= '0') {
      echo "{\"c\":[{\"v\":\"" . 'Sinn Fein' . "\",\"f\":null},{\"v\":" . $row['sf'] . ",\"f\":null},{\"v\":\"#32CD32\",\"f\":null}  ]},"; }
	if ($row['IA']!= '0') {
      echo "{\"c\":[{\"v\":\"" . 'IA' . "\",\"f\":null},{\"v\":" . $row['IA'] . ",\"f\":null},{\"v\":\"#FFFF00\",\"f\":null}  ]},";
} else { $othersadd = $othersadd . "/" ."IA";}
	if ($row['SD']!= '0') {
      echo "{\"c\":[{\"v\":\"" . 'SocDem' . "\",\"f\":null},{\"v\":" . $row['SD'] . ",\"f\":null},{\"v\":\"#990099\",\"f\":null}  ]},";
} else { $othersadd = $othersadd . "/" ."SD";}
	if ($row['rn']!= '0') {
      echo "{\"c\":[{\"v\":\"" . 'Renua' . "\",\"f\":null},{\"v\":" . $row['rn'] . ",\"f\":null},{\"v\":\"#32CFFF\",\"f\":null}  ]},";
} else { $othersadd = $othersadd . "/" ."RN";}
	if ($row['green'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'Green' . "\",\"f\":null},{\"v\":" . $row['green'] . ",\"f\":null},{\"v\":\"#00FF00\",\"f\":null} ]},";
} else { $othersadd = $othersadd . "/" ."GP";}
	if ($row['pd'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'Progressive Democrats' . "\",\"f\":null},{\"v\":" . $row['pd'] . ",\"f\":null},{\"v\":\"#000080\",\"f\":null}  ]},";}
/*	if ($row['un'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'Unionist' . "\",\"f\":null},{\"v\":" . $row['un'] . ",\"f\":null},{\"v\":\"#800080\",\"f\":null}  ]},"; } if ($row['nal'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'Nat Lab' . "\",\"f\":null},{\"v\":" . $row['nal'] . ",\"f\":null},{\"v\":\"#FF0000\",\"f\":null} ]},"; } if ($row['cnp'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'CnaP' . "\",\"f\":null},{\"v\":" . $row['cnp'] . ",\"f\":null},{\"v\":\"#008000\",\"f\":null} ]},"; }*/
	if ($row['wp'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'WP' . "\",\"f\":null},{\"v\":" . $row['wp'] . ",\"f\":null},{\"v\":\"#FF0011\",\"f\":null} ]},";
} else { $othersadd = $othersadd . "/" ."WP";}
	if ($row['dl'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'DL' . "\",\"f\":null},{\"v\":" . $row['dl'] . ",\"f\":null},{\"v\":\"#FF00FF\",\"f\":null} ]},"; }
	if ($row['pd'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'PD' . "\",\"f\":null},{\"v\":" . $row['pd'] . ",\"f\":null},{\"v\":\"#FF00FF\",\"f\":null} ]},";}
	if ($row['sp'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'SP' . "\",\"f\":null},{\"v\":" . $row['sp'] . ",\"f\":null},{\"v\":\"#FF0000\",\"f\":null} ]},"; }
	if ($row['pbp'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'PBP-AAA' . "\",\"f\":null},{\"v\":" . $row['pbp'] . ",\"f\":null},{\"v\":\"#990000\",\"f\":null} ]},"; }
/*	if ($row['ul'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'UL' . "\",\"f\":null},{\"v\":" . $row['ul'] . ",\"f\":null},{\"v\":\"#FF0000\",\"f\":null} ]},"; } if ($row['fm'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'FM/CnT' . "\",\"f\":null},{\"v\":" . $row['fm'] . ",\"f\":null},{\"v\":\"#FC0C0C\",\"f\":null} ]},"; } if ($row['cp'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'Centre' . "\",\"f\":null},{\"v\":" . $row['cp'] . ",\"f\":null},{\"v\":\"#FFCC00\",\"f\":null} ]},"; } if ($row['nl'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'Nat League' . "\",\"f\":null},{\"v\":" . $row['nl'] . ",\"f\":null},{\"v\":\"#FF0000\",\"f\":null} ]},"; }*/
      echo "{\"c\":[{\"v\":\"" . 'Others'. $othersadd . "\",\"f\":null},{\"v\":" . $row['others'] . ",\"f\":null},{\"v\":\"#808000\",\"f\":null} ]} ";

    } else {
      echo "{\"c\":[{\"v\":\"" . 'Others' . "\",\"f\":null},{\"v\":" . $row['others'] . ",\"f\":null}]}, ";
    }
  } // while end
} else {
    echo "0 results";
}

  echo " ] }";

  //mysql_close($con);
  $conn->close;
?>
