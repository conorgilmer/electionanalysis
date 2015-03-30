<?php

$connect = mysql_connect('127.0.0.1','root','');

if (!$connect) {
	die('Could not connect to MySQL: ' . mysql_error());
}

$cid =mysql_select_db('elections',$connect);
// supply your database name

define('CSV_PATH','C:/wamp/www/csvfile/');
// path where your CSV file is located

//$csv_file = CSV_PATH . "dadwalking.csv"; // Name of your CSV file
$csv_file = "polls1.csv"; // Name of your CSV file
$csvfile = fopen($csv_file, 'r');
$theData = fgets($csvfile);
$i = 0;
while (!feof($csvfile)) {
$csv_data[] = fgets($csvfile, 1024);
$csv_array = explode(",", $csv_data[$i]);
$insert_csv = array();
$insert_csv['id'] = '';
$insert_csv['date'] = $csv_array[1];
$insert_csv['source'] = $csv_array[2];
$insert_csv['ff'] = $csv_array[3];
$insert_csv['fg'] = $csv_array[4];
$insert_csv['lab'] = $csv_array[5];
$insert_csv['green'] = $csv_array[6];
$insert_csv['sf'] =  $csv_array[7];
$insert_csv['others'] = $csv_array[8];
$insert_csv['pd'] = $csv_array[9];
$dateadded = date("Y-m-d", strtotime($insert_csv['date']));
echo $dateadded . "<br>";
$query = "INSERT INTO polls_ireland(id,date,source,ff,fg,lab,green,sf,others,pd)
VALUES('','".$dateadded."' ,'".$insert_csv['source']."','".$insert_csv['ff']."','".$insert_csv['fg']."' ,'".$insert_csv['lab']."' ,'".$insert_csv['green']."' ,'".$insert_csv['sf']."' ,'".$insert_csv['others']."'    ,'".$insert_csv['pd']."')";
$n=mysql_query($query, $connect );
$i++;
print_r($insert_csv);
echo "<br>";
}
fclose($csvfile);

echo "File data successfully imported to database!!";
mysql_close($connect);
?>
