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

$sql = "SELECT * FROM seats_uk where election = $election";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	$allseats = $row["allseats"];
        //echo "id: " . $row["id"]. " - Name: " . $row["source"]. " " . $row["date"]. "<br>";
	array_push($seats, $row["cons"], $row["lab"], $row["libdems"], $row["ukip"], $row["green"], $row["snp"]);
	array_push($seats, $row["pc"], $row["bnp"], $row["dup"], $row["uup"], $row["apni"], $row["sdlp"], $row["sf"], $row["others"]);
    }
} else {
    echo "0 results";
}


$sql = "SELECT * FROM vote_uk where election = $election";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["id"]. " - Name: " . $row["source"]. " " . $row["date"]. "<br>";
	array_push($votes, $row["cons"], $row["lab"], $row["libdems"], $row["ukip"], $row["green"], $row["snp"]);
	array_push($votes, $row["pc"], $row["bnp"], $row["dup"], $row["uup"], $row["apni"], $row["sdlp"], $row["sf"], $row["others"]);
	array_push($prseats, 
			($allseats*$row["cons"]/100), 
			($allseats*$row["lab"]/100), 
			($allseats*$row["libdems"]/100), 
			($allseats*$row["ukip"]/100), 
			($allseats*$row["green"]/100), 
			($allseats*$row["snp"]/100), 
			($allseats*$row["pc"]/100), 
			($allseats*$row["bnp"]/100), 
			($allseats*$row["dup"]/100), 
			($allseats*$row["uup"]/100), 
			($allseats*$row["apni"]/100), 
			($allseats*$row["sdlp"]/100), 
			($allseats*$row["sf"]/100), 
			($allseats*$row["others"]/100) );
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
<title>UK Elections Bounce</title>
</head>
<body>
<h1>UK Elections Bounce</h1>
<h3>Select Year</h3>
<p>
<select onChange="window.location='ukelectionsbounce.php?year='+this.value">
        <option value='' disabled selected>year</option>
        <option value='2017'>Westminister 2017</option>
        <option value='2015'>Westminister 2015</option>
        <option value='2010'>Westminister 2010</option>
        <option value='2005'>Westminister 2005</option>
        <option value='2001'>Westminister 2001</option>
        <option value='1997'>Westminister 1997</option>
        <option value='1992'>Westminister 1992</option>
        <option value='1987'>Westminister 1987</option>
     </select>

</p>
<img src="bounceukgen.php?year=<?php echo $election;?>&graphtype=votes"/>
<br/>
<?php

$_SESSION['seats'] = $seats;?>
<img src="bounceukgen.php?year=<?php echo $election;?>&graphtype=seats"/>
<br/>

<?php
$_SESSION['prseats'] = $prseats;?>
<img src="bounceukgen.php?year=<?php echo $election;?>&graphtype=prseats"/>
<br/>
<?php
for ($b=0; $b < sizeof($seats); $b++){
	array_push($bounce, $seats[$b] - $prseats[$b]);
}


$_SESSION['bounce'] = $bounce;?>
<img src="bounceukgen.php?year=<?php echo $election;?>&graphtype=bounce"/>
