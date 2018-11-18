<?php
session_start();
$election = $_GET['year'];
$votes = array();
$seats = array();
$prseats = array();
$bounce = array();

 $servername="mysql4113int.cp.blacknight.com";
    $username="u1454354_webwayz";
    $password="Phibsb0r0ugh";
    $dbname="db1454354_congilei";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM seats_ire where election = '$election'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	$allseats = $row["total"];
        //echo "id: " . $row["id"]. " - Name: " . $row["source"]. " " . $row["date"]. "<br>";
	array_push($seats, $row["ff"], $row["fg"], $row["lb"], $row["gp"], $row["sf"]);
	array_push($seats, $row["others"]);
    }
} else {
    echo "results from ". $election;
    echo "0 results";
}


$sql = "SELECT * FROM votes_ire where source = '$election'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["id"]. " - Name: " . $row["source"]. " " . $row["date"]. "<br>";
	array_push($votes, $row["ff"], $row["fg"], $row["lb"], $row["gp"], $row["sf"]);
	array_push($votes, $row["others"]);
	array_push($prseats, 
			($allseats*$row["ff"]/100), 
			($allseats*$row["fg"]/100), 
			($allseats*$row["lb"]/100), 
			($allseats*$row["gp"]/100), 
			($allseats*$row["sf"]/100), 
			($allseats*$row["others"]/100) 
		);
    }
} else {
    echo "0 results";
}
$conn->close();

//print_r($votes);
$_SESSION['votes'] = $votes;
?>


<html>
<head>
<title>Ireland Elections Bounce</title>
</head>
<body>
<h1>Ireland Elections Bounce</h1>
<h3>Select Year</h3>
<p>
<select onChange="window.location='irelectionsbounce.php?year='+this.value">
        <option value='' disabled selected>year</option>
        <option value='2016'>Dail 2016</option>
        <option value='2011'>Dail 2011</option>
        <option value='2007'>Dail 2007</option>
        <option value='2002'>Dail 2002</option>
        <option value='1997'>Dail 1997</option>
        <option value='1992'>Dail 1992</option>
        <option value='1989'>Dail 1989</option>
        <option value='1987'>Dail 1987</option>
        <option value='1982b'>Dail 1982 Nov</option>
        <option value='1982a'>Dail 1982 Feb</option>
        <option value='1977'>Dail 1977</option>
        <option value='1973'>Dail 1973</option>
        <option value='1977'>Dail 1977</option>
        <option value='1969'>Dail 1969</option>
        <option value='1965'>Dail 1965</option>
        <option value='1961'>Dail 1961</option>
        <option value='1957'>Dail 1957</option>
        <option value='1954'>Dail 1954</option>
        <option value='1951'>Dail 1951</option>
        <option value='1948'>Dail 1948</option>
        <option value='1944'>Dail 1944</option>
        <option value='1943'>Dail 1943</option>
        <option value='1938'>Dail 1938</option>
        <option value='1937'>Dail 1937</option>
        <option value='1933'>Dail 1933</option>
        <option value='1932'>Dail 1932</option>
        <!--option value='1927b'>Dail 1927 Sept</option>
        <option value='1927a'>Dail 1927 June</option>
        <option value='1923'>Dail 1923</option>
        <option value='1922'>Dail 1922</option>
        <option value='1921'>Dail 1921</option>
        <option value='1918'>Dail 1918</option-->
     </select>

</p>
<img src="bounceiregen.php?year=<?php echo $election;?>&graphtype=votes"/>
<br/>
<?php

$_SESSION['seats'] = $seats;?>
<img src="bounceiregen.php?year=<?php echo $election;?>&graphtype=seats"/>
<br/>

<?php
$_SESSION['prseats'] = $prseats;?>
<img src="bounceiregen.php?year=<?php echo $election;?>&graphtype=prseats"/>
<br/>
<?php
for ($b=0; $b < sizeof($seats); $b++){
	array_push($bounce, $seats[$b] - $prseats[$b]);
}


$_SESSION['bounce'] = $bounce;?>
<img src="bounceiregen.php?year=<?php echo $election;?>&graphtype=bounce"/>
