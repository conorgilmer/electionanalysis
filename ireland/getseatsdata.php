<?php
   $q=$_GET["q"];

include('php/config.php');

$sql_query = "SELECT election, source, ff, fg, lb, gp, sf,wp,dl,sp,pb,ul,cp,un,fm,nl ,cnp,nal, others, pd 
		from seats_ire where id = $q";
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
//  $total_rows = mysql_num_rows($result);
  $row_num = 0;
//  while($row = mysql_fetch_array($result)){

$total_rows = $result->num_rows;
    // output data of each row


    while($row = $result->fetch_assoc()) {

    $row_num++;
    if ($row_num == $total_rows){
      echo "{\"c\":[{\"v\":\"" . 'Fianna Fail' . "\",\"f\":null},{\"v\":" . $row['ff'] . ",\"f\":null},{\"v\":\"#008000\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'Fine Gael' . "\",\"f\":null},{\"v\":" . $row['fg'] . ",\"f\":null},{\"v\":\"#0000FF\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'Labour' . "\",\"f\":null},{\"v\":" . $row['lb'] . ",\"f\":null},{\"v\":\"#FF0000\",\"f\":null} ]},";

	if ($row['sf']!= '0') {
      echo "{\"c\":[{\"v\":\"" . 'Sinn Fein' . "\",\"f\":null},{\"v\":" . $row['sf'] . ",\"f\":null},{\"v\":\"#32CD32\",\"f\":null}  ]},";
}
	if ($row['gp'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'Green' . "\",\"f\":null},{\"v\":" . $row['gp'] . ",\"f\":null},{\"v\":\"#00FF00\",\"f\":null} ]},";
}
	if ($row['pd'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'Progressive Democrats' . "\",\"f\":null},{\"v\":" . $row['pd'] . ",\"f\":null},{\"v\":\"#000080\",\"f\":null}  ]},";}
	if ($row['un'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'Unionist' . "\",\"f\":null},{\"v\":" . $row['un'] . ",\"f\":null},{\"v\":\"#800080\",\"f\":null}  ]},"; }
	if ($row['nal'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'Nat Lab' . "\",\"f\":null},{\"v\":" . $row['nal'] . ",\"f\":null},{\"v\":\"#FF0000\",\"f\":null} ]},";
}
	if ($row['cnp'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'CnaP' . "\",\"f\":null},{\"v\":" . $row['cnp'] . ",\"f\":null},{\"v\":\"#008000\",\"f\":null} ]},";
}
	if ($row['wp'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'WP' . "\",\"f\":null},{\"v\":" . $row['wp'] . ",\"f\":null},{\"v\":\"#FF0011\",\"f\":null} ]},";
}
	if ($row['dl'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'DL' . "\",\"f\":null},{\"v\":" . $row['dl'] . ",\"f\":null},{\"v\":\"#FF00FF\",\"f\":null} ]},";
}
	if ($row['pd'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'PD' . "\",\"f\":null},{\"v\":" . $row['pd'] . ",\"f\":null},{\"v\":\"#FF00FF\",\"f\":null} ]},";
}
	if ($row['sp'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'SP' . "\",\"f\":null},{\"v\":" . $row['sp'] . ",\"f\":null},{\"v\":\"#FF0000\",\"f\":null} ]},";
}
	if ($row['pb'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'PBP' . "\",\"f\":null},{\"v\":" . $row['pb'] . ",\"f\":null},{\"v\":\"#FF0000\",\"f\":null} ]},";
}
	if ($row['ul'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'UL' . "\",\"f\":null},{\"v\":" . $row['ul'] . ",\"f\":null},{\"v\":\"#FF0000\",\"f\":null} ]},";
}
	if ($row['fm'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'FM/CnT' . "\",\"f\":null},{\"v\":" . $row['fm'] . ",\"f\":null},{\"v\":\"#FC0C0C\",\"f\":null} ]},";
}
	if ($row['cp'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'Centre' . "\",\"f\":null},{\"v\":" . $row['cp'] . ",\"f\":null},{\"v\":\"#FFCC00\",\"f\":null} ]},";
}
	if ($row['nl'] != '0') {
      echo "{\"c\":[{\"v\":\"" . 'Nat League' . "\",\"f\":null},{\"v\":" . $row['nl'] . ",\"f\":null},{\"v\":\"#FF0000\",\"f\":null} ]},";
}
      echo "{\"c\":[{\"v\":\"" . 'Others' . "\",\"f\":null},{\"v\":" . $row['others'] . ",\"f\":null},{\"v\":\"#808000\",\"f\":null} ]} ";

    } else {
      echo "{\"c\":[{\"v\":\"" . 'others' . "\",\"f\":null},{\"v\":" . $row['others'] . ",\"f\":null}]}, ";
    }
  }
  echo " ] }";

  //mysql_close($con);
?>
