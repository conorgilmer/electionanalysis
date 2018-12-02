<?php 
session_start();
include ('inc/config.php');

$xAxis = array();
$yAxis = array();
$zAxis = array();
$wAxis = array();

$conn = new mysqli($dbhost, $dblogin, $dbpwd, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	
// The Chart table contain two fields: Date and PercentageChange
//$queryData = mysql_query("
$queryData = "
  SELECT	date,
                cons, lab, libdems,
                ukip, green, snp, pc, uup, dup, apni, sdlp, sf,
                others
        FROM vote_uk ";
$result = $conn->query($queryData);
$number=0;
while($r = $result->fetch_assoc()) {
	$number++;
	array_push($xAxis, $r['date']);
	array_push($yAxis, $r['cons']);
	array_push($zAxis, $r['lab']);
	array_push($wAxis, $r['libdems']);
}

$_SESSION['xaxis'] = $xAxis;
$_SESSION['yaxis'] = $yAxis;
$_SESSION['zaxis'] = $zAxis;
$_SESSION['waxis'] = $wAxis;
$gTitle = "UK Elections Vote Percentage";
$gLine1 = "Conservatives";
$gLine2 = "Labour";
$gLine3 = "Lib Dems";
?>
<html>
<body>
<h2>UK Elections Vote % using LibCharts</h2>
<img src="http://localhost/electionanalysis/bounce/libchart/threeLineChart.php?title=<?echo $gTitle;?>&line1=<?echo $gLine1;?>&line2=<?echo $gLine2;?>&line3=<?echo $gLine3;?>&num=<?echo $number;?>"/>

</body>
</html>
