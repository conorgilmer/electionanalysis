<?php
  include('config.php');
   $q=$_GET["q"];

  $sql_query = "SELECT cons,lab,libdems,ukip,green,snp,sdlp,pc,dup,uup,sf,apni, others from vote_uk where id = $q";
  $con = mysql_connect($dbhost,$dblogin,$dbpwd);
  if (!$con){ die('Could not connect: ' . mysql_error()); }
  mysql_select_db($dbname, $con);
  $result = mysql_query($sql_query);
  echo "{ \"cols\": [ {\"id\":\"\",\"label\":\"Party\",\"pattern\":\"\",\"type\":\"string\"}, {\"id\":\"\",\"label\":\"Percentage\",\"pattern\":\"\",\"type\":\"number\"} , {\"id\":\"\",\"role\":\"style\",\"type\":\"string\"}  ], \"rows\": [ ";
  $total_rows = mysql_num_rows($result);
  $row_num = 0;
  while($row = mysql_fetch_array($result)){
    $row_num++;
    if ($row_num == $total_rows){
echo "{\"c\":[{\"v\":\"" . 'Conservatives' . "\",\"f\":null},{\"v\":" . $row['cons'] . ",\"f\":null},{\"v\":\"#0000FF\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'Labour' . "\",\"f\":null},{\"v\":" . $row['lab'] . ",\"f\":null},{\"v\":\"#FF0000\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'Lib Dems' . "\",\"f\":null},{\"v\":" . $row['libdems'] . ",\"f\":null},{\"v\":\"#FFA500\",\"f\":null}  ]},";
      echo "{\"c\":[{\"v\":\"" . 'Green' . "\",\"f\":null},{\"v\":" . $row['green'] . ",\"f\":null},{\"v\":\"#00FF00\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'UKIP' . "\",\"f\":null},{\"v\":" . $row['ukip'] . ",\"f\":null},{\"v\":\"#800080\",\"f\":null}  ]},";
      echo "{\"c\":[{\"v\":\"" . 'SNP' . "\",\"f\":null},{\"v\":" . $row['snp'] . ",\"f\":null},{\"v\":\"#FFFF00\",\"f\":null}  ]},";
      echo "{\"c\":[{\"v\":\"" . 'PC' . "\",\"f\":null},{\"v\":" . $row['pc'] . ",\"f\":null},{\"v\":\"#006400\",\"f\":null}     ]},";
      echo "{\"c\":[{\"v\":\"" . 'UUP' . "\",\"f\":null},{\"v\":" . $row['uup'] . ",\"f\":null},{\"v\":\"#0000CD\",\"f\":null}  ]},";
      echo "{\"c\":[{\"v\":\"" . 'DUP' . "\",\"f\":null},{\"v\":" . $row['dup'] . ",\"f\":null},{\"v\":\"#000080\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'SDLP' . "\",\"f\":null},{\"v\":" . $row['sdlp'] . ",\"f\":null},{\"v\":\"#FF0000\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'SF' . "\",\"f\":null},{\"v\":" . $row['sf'] . ",\"f\":null},{\"v\":\"#00FF00\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'APNI' . "\",\"f\":null},{\"v\":" . $row['apni'] . ",\"f\":null},{\"v\":\"#FFFF00\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'Others' . "\",\"f\":null},{\"v\":" . $row['others'] . ",\"f\":null},{\"v\":\"#808000\",\"f\":null} ]} ";
    
    } else {
//      echo "{\"c\":[{\"v\":\"" . 'others' . "\",\"f\":null},{\"v\":" . $row['others'] . ",\"f\":null}]}, ";
    }
  }
  echo " ] }";
  mysql_close($con);
?>
