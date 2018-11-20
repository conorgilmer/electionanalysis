<?php
   include('config.php');

    $choice = $_GET["q"]; 
    $con =  mysql_connect($dbhost,$dblogin,$dbpwd);
	
// The Chart table contain two fields: Date and PercentageChange
$queryData = mysql_query("
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
                vote_uk.sdlp as vsdlp,
                vote_uk.sf as vsf,
                vote_uk.others as vothers
        FROM seats_uk, vote_uk where seats_uk.id = $choice"); // AND seats_uk.date = vote_uk.date");



  if (!$con){ die('Could not connect: ' . mysql_error()); }
  mysql_select_db($dbname, $con);
  $result = mysql_query($queryData);
  echo "{ \"cols\": [ {\"id\":\"\",\"label\":\"Party\",\"pattern\":\"\",\"type\":\"string\"}, {\"id\":\"\",\"label\":\"Percentage\",\"pattern\":\"\",\"type\":\"number\"} ], \"rows\": [ ";
  $total_rows = mysql_num_rows($result);
  $row_num = 0;

  $vchoice = "v".$choice;
  $schoice = "s".$choice;
  while($row = mysql_fetch_array($result)){
    $row_num++;
    if ($row_num == $total_rows){
      echo "{\"c\":[{\"v\":\"" . 'Conservatives' . "\",\"f\":null},{\"v\":" . $row['vcons'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'Labour' . "\",\"f\":null},{\"v\":" . $row["v".'vlab'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'Lib Dems' . "\",\"f\":null},{\"v\":" . $row['vlibdems'] . ",\"f\":null}]},";
     /* echo "{\"c\":[{\"v\":\"" . 'Green' . "\",\"f\":null},{\"v\":" . $row['green'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'UKIP' . "\",\"f\":null},{\"v\":" . $row['ukip'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'SNP' . "\",\"f\":null},{\"v\":" . $row['snp'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'PC' . "\",\"f\":null},{\"v\":" . $row['pc'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'UUP' . "\",\"f\":null},{\"v\":" . $row['uup'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'DUP' . "\",\"f\":null},{\"v\":" . $row['dup'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'SDLP' . "\",\"f\":null},{\"v\":" . $row['sdlp'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'SF' . "\",\"f\":null},{\"v\":" . $row['sf'] . ",\"f\":null}]},";
      echo "{\"c\":[{\"v\":\"" . 'APNI' . "\",\"f\":null},{\"v\":" . $row['apni'] . ",\"f\":null}]},";*/
      echo "{\"c\":[{\"v\":\"" . 'Others' . "\",\"f\":null},{\"v\":" . $row['vothers'] . ",\"f\":null}]} ";
    } else {
//      echo "{\"c\":[{\"v\":\"" . 'others' . "\",\"f\":null},{\"v\":" . $row['others'] . ",\"f\":null}]}, ";
    }
  }
  echo " ] }";
  mysql_close($con);


?>


