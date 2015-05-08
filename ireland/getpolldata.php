<?php
   $q=$_GET["q"];
include('php/config.php');

  $sql_query = "SELECT ff, fg, lab, green, sf, others, pd from polls_ireland where id = $q";
  $con = mysql_connect($dbhost,$dblogin,$dbpwd);
  if (!$con){ die('Could not connect: ' . mysql_error()); }
  mysql_select_db($dbname, $con);
  $result = mysql_query($sql_query);
  echo "{ \"cols\": [ {\"id\":\"\",\"label\":\"Party\",\"pattern\":\"\",\"type\":\"string\"}, {\"id\":\"\",\"label\":\"Percentage\",\"pattern\":\"\",\"type\":\"number\"} ], \"rows\": [ ";
  $total_rows = mysql_num_rows($result);
  $row_num = 0;
  while($row = mysql_fetch_array($result)){
    $row_num++;
    if ($row_num == $total_rows){
      echo "{\"c\":[{\"v\":\"" . 'Fianna Fail' . "\",\"f\":null},{\"v\":" . $row['ff'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'Fine Gael' . "\",\"f\":null},{\"v\":" . $row['fg'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'Labour' . "\",\"f\":null},{\"v\":" . $row['lab'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'Sinn Fein' . "\",\"f\":null},{\"v\":" . $row['sf'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'Green' . "\",\"f\":null},{\"v\":" . $row['green'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'Progressive Democrats' . "\",\"f\":null},{\"v\":" . $row['pd'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'Others' . "\",\"f\":null},{\"v\":" . $row['others'] . ",\"f\":null}]} ";
    } else {
      echo "{\"c\":[{\"v\":\"" . 'others' . "\",\"f\":null},{\"v\":" . $row['others'] . ",\"f\":null}]}, ";
    }
  }
  echo " ] }";
  mysql_close($con);
?>
