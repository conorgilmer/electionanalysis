<?php
  include('config.php');
   $q=$_GET["q"];

  $sql_query_votes = "SELECT cons,lab,libdems,ukip,green,snp,sdlp,pc,dup,uup,sf,apni, others from vote_uk where id = $q";
  $sql_query_seats = "SELECT cons,lab,libdems,ukip,green,snp,sdlp,pc,dup,uup,sf,apni, others from seats_uk where id = $q";

  $con = mysql_connect($dbhost,$dblogin,$dbpwd);

  if (!$con){ die('Could not connect: ' . mysql_error()); }
  mysql_select_db($dbname, $con);

  $result_votes = mysql_query($sql_query_votes);

  $total_rows_votes = mysql_num_rows($result_votes);
  $row_num_votes = 0;
  while($row_votes = mysql_fetch_array($result_votes)){
    $row_num_votes++;
    if ($row_num_votes == $total_rows_votes){
	$pcons = (float) (650 * $row_votes['cons'])/100; 
	$plab = (float) (650 * $row_votes['lab'])/100; 
	$plibdems = (float) (650 * $row_votes['libdems'])/100; 
	$pgreen = (float) (650 * $row_votes['green'])/100; 
	$pukip = (float) (650 * $row_votes['ukip'])/100; 
	$psnp = (float) (650 * $row_votes['snp'])/100; 
	$ppc = (float) (650 * $row_votes['pc'])/100; 
	$puup = (float) (650 * $row_votes['uup'])/100; 
	$pdup = (float) (650 * $row_votes['dup'])/100; 
	$psdlp = (float) (650 * $row_votes['sdlp'])/100; 
	$psf = (float) (650 * $row_votes['sf'])/100; 
	$papni = (float) (650 * $row_votes['apni'])/100; 
	$pothers = (float) (650 * $row_votes['others'])/100; 
	}
  }

  $result = mysql_query($sql_query_seats);
  echo "{ \"cols\": [ {\"id\":\"\",\"label\":\"Party\",\"pattern\":\"\",\"type\":\"string\"}, {\"id\":\"\",\"label\":\"Seat Return Difference\",\"pattern\":\"\",\"type\":\"number\"} , {\"id\":\"\",\"role\":\"style\",\"type\":\"string\"} ], \"rows\": [ ";
  $total_rows = mysql_num_rows($result);
  $row_num = 0;
  while($row = mysql_fetch_array($result)){
    $row_num++;
    if ($row_num == $total_rows){
      $bcons = round($row['cons'] - $pcons);
      $blab = round($row['lab'] - $plab);
      $blibdems = round($row['libdems'] - $plibdems);
      $bgreen = round($row['green'] - $pgreen);
      $bukip = round($row['ukip'] - $pukip);
      $bsnp = round($row['snp'] - $psnp);
      $bpc = round($row['pc'] - $ppc);
      $buup = round($row['uup'] - $puup);
      $bdup = round($row['dup'] - $pdup);
      $bsdlp = round($row['sdlp'] - $psdlp);
      $bsf = round($row['sf'] - $psf);
      $bapni = round($row['apni'] - $papni);
      $bothers = round($row['others'] - $pothers);
      echo "{\"c\":[{\"v\":\"" . 'Conservatives' . "\",\"f\":null},{\"v\":" . $bcons . ",\"f\":null},{\"v\":\"#0000FF\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'Labour' . "\",\"f\":null},{\"v\":" . $blab . ",\"f\":null},{\"v\":\"#FF0000\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'Lib Dems' . "\",\"f\":null},{\"v\":" . $blibdems . ",\"f\":null},{\"v\":\"#FFA500\",\"f\":null}  ]},";
      echo "{\"c\":[{\"v\":\"" . 'Green' . "\",\"f\":null},{\"v\":" . $bgreen . ",\"f\":null},{\"v\":\"#00FF00\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'UKIP' . "\",\"f\":null},{\"v\":" . $bukip . ",\"f\":null},{\"v\":\"#800080\",\"f\":null}  ]},";
      echo "{\"c\":[{\"v\":\"" . 'SNP' . "\",\"f\":null},{\"v\":" . $bsnp . ",\"f\":null},{\"v\":\"#FFFF00\",\"f\":null}  ]},";
      echo "{\"c\":[{\"v\":\"" . 'PC' . "\",\"f\":null},{\"v\":" . $bpc . ",\"f\":null},{\"v\":\"#006400\",\"f\":null}     ]},";
      echo "{\"c\":[{\"v\":\"" . 'UUP' . "\",\"f\":null},{\"v\":" . $buup . ",\"f\":null},{\"v\":\"#0000CD\",\"f\":null}  ]},";
      echo "{\"c\":[{\"v\":\"" . 'DUP' . "\",\"f\":null},{\"v\":" . $bdup . ",\"f\":null},{\"v\":\"#000080\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'SDLP' . "\",\"f\":null},{\"v\":" . $bsdlp . ",\"f\":null},{\"v\":\"#FF0000\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'SF' . "\",\"f\":null},{\"v\":" . $bsf . ",\"f\":null},{\"v\":\"#00FF00\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'APNI' . "\",\"f\":null},{\"v\":" . $bapni . ",\"f\":null},{\"v\":\"#FFFF00\",\"f\":null} ]},";
      echo "{\"c\":[{\"v\":\"" . 'Others' . "\",\"f\":null},{\"v\":" . $bothers . ",\"f\":null},{\"v\":\"#808000\",\"f\":null} ]} ";
    } else {
//      echo "{\"c\":[{\"v\":\"" . 'others' . "\",\"f\":null},{\"v\":" . $row['others'] . ",\"f\":null}]}, ";
    }
  }
  echo " ] }";
  mysql_close($con);
?>
