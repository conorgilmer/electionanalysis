<?php
  include('config.php');
   $q=$_GET["q"];

  $sql_query = "SELECT cons,lab,libdems,ukip,green,snp,sdlp,pc,dup,uup, others from vote_uk where id = $q";
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
      echo "{\"c\":[{\"v\":\"" . 'Conservatives' . "\",\"f\":null},{\"v\":" . $row['cons'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'Labour' . "\",\"f\":null},{\"v\":" . $row['lab'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'Liberal Democrats' . "\",\"f\":null},{\"v\":" . $row['libdems'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'Green' . "\",\"f\":null},{\"v\":" . $row['green'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'UKIP' . "\",\"f\":null},{\"v\":" . $row['ukip'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'SNP' . "\",\"f\":null},{\"v\":" . $row['snp'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'PC' . "\",\"f\":null},{\"v\":" . $row['pc'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'UUP' . "\",\"f\":null},{\"v\":" . $row['uup'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'DUP' . "\",\"f\":null},{\"v\":" . $row['dup'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'SDLP' . "\",\"f\":null},{\"v\":" . $row['sdlp'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'others' . "\",\"f\":null},{\"v\":" . $row['others'] . ",\"f\":null}]} ";
    } else {
      echo "{\"c\":[{\"v\":\"" . 'others' . "\",\"f\":null},{\"v\":" . $row['others'] . ",\"f\":null}]}, ";
    }
  }
  echo " ] }";
  mysql_close($con);
?>
