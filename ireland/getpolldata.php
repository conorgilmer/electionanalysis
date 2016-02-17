<?php
   $q=$_GET["q"];
include('php/config.php');

  $sql_query = "SELECT ff, fg, lab, green, sf, others, pd, wp, SD, IA from polls_ireland where date = '$q'";
  $con = mysql_connect($dbhost,$dblogin,$dbpwd);
  if (!$con){ die('Could not connect: ' . mysql_error()); }
  mysql_select_db($dbname, $con);

  $result = mysql_query($sql_query);
  echo "{ \"cols\": [ {\"id\":\"\",\"label\":\"Party\",\"pattern\":\"\",\"type\":\"string\"}, {\"id\":\"\",\"label\":\"Percentage\",\"pattern\":\"\",\"type\":\"number\"}  , {\"id\":\"\",\"role\":\"style\",\"type\":\"string\"}  ], \"rows\": [ ";
  $total_rows = mysql_num_rows($result);
  $row_num = 0;
  while($row = mysql_fetch_array($result)){
    $row_num++;
    if ($row_num == $total_rows){
      echo "{\"c\":[{\"v\":\"" . 'Fianna Fail' . "\",\"f\":null},{\"v\":" . $row['ff'] . ",\"f\":null},{\"v\":\"#008000\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'Fine Gael' . "\",\"f\":null},{\"v\":" . $row['fg'] . ",\"f\":null},{\"v\":\"#0000FF\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'Labour' . "\",\"f\":null},{\"v\":" . $row['lab'] . ",\"f\":null},{\"v\":\"#FF0000\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'Sinn Fein' . "\",\"f\":null},{\"v\":" . $row['sf'] . ",\"f\":null},{\"v\":\"#32CD32\",\"f\":null}  ]},";
      echo "{\"c\":[{\"v\":\"" . 'Green' . "\",\"f\":null},{\"v\":" . $row['green'] . ",\"f\":null},{\"v\":\"#00FF00\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'Progressive Democrats' . "\",\"f\":null},{\"v\":" . $row['pd'] . ",\"f\":null},{\"v\":\"#800080\",\"f\":null}  ]},";
      echo "{\"c\":[{\"v\":\"" . 'Social Democrats' . "\",\"f\":null},{\"v\":" . $row['SD'] . ",\"f\":null},{\"v\":\"#444080\",\"f\":null}  ]},";
      echo "{\"c\":[{\"v\":\"" . 'Independent Alliance' . "\",\"f\":null},{\"v\":" . $row['IA'] . ",\"f\":null},{\"v\":\"#111080\",\"f\":null}  ]},";
      echo "{\"c\":[{\"v\":\"" . 'Workers Party' . "\",\"f\":null},{\"v\":" . $row['wp'] . ",\"f\":null},{\"v\":\"#222222\",\"f\":null}  ]},";
      echo "{\"c\":[{\"v\":\"" . 'Others' . "\",\"f\":null},{\"v\":" . $row['others'] . ",\"f\":null},{\"v\":\"#808000\",\"f\":null} ]} ";

    } else {
      echo "{\"c\":[{\"v\":\"" . 'others' . "\",\"f\":null},{\"v\":" . $row['others'] . ",\"f\":null}]}, ";
    }
  }
  echo " ] }";





  mysql_close($con);
?>
