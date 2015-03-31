<?php
session_start();

/*
 * Set up constant to ensure include files cannot be called on their own
*/
define ( "MY_APP", 1 );
/*
 * Set up a constant to your main application path
 */
define ( "APPLICATION_PATH", "application" );
define ( "TEMPLATE_PATH", APPLICATION_PATH . "/view" );

//include_once(APPLICATION_PATH . "/inc/session.inc.php");


/*
 * Include the config.inc.php file
 */
include (APPLICATION_PATH . "/inc/config.inc.php");
include (APPLICATION_PATH . "/inc/db.inc.php");
include (APPLICATION_PATH . "/inc/functions.inc.php");

//Set up variable so 'active' class set on navbar link
$activeHome = "active";

include (TEMPLATE_PATH . "/public/header.html");

?>

<div class="container">
<div class="row">
<div class="span12">
<h1>List Polls</h1>
</div>
</div>
<div clas="row">
<div class="span9">

<?php 

$sqlQuery = "SELECT * FROM polls_ireland";
$result = mysql_query($sqlQuery);


if ($result) {
	$htmlString = "";
	$htmlString .=  "<table class='table table-bordered table-condensed table-striped' border='1'>\n";
	
	$htmlString .= "<tr>";
	$htmlString .= "<th>ID</th>";
	$htmlString .= "<th>Date</th>";
	$htmlString .= "<th>Source</th>";
	$htmlString .= "<th>FF</th>";
        $htmlString .= "<th>FG</th>";
        $htmlString .= "<th>LAB</th>";
        $htmlString .= "<th>Green</th>";
        $htmlString .= "<th>Sinn Fein</th>";
        $htmlString .= "<th>Others</th>";
	$htmlString .= "<th>PDs</th>";
//	$htmlString .= "<th colspan='2'>Actions</th>";

	$htmlString .= "</tr>";
	
	while ($product = mysql_fetch_assoc($result))
	{
		$htmlString .=  "<tr>" ;
		$htmlString .=  "<td>";
		$htmlString .=  output_pie_link($product["id"]); //$product["id"];
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $product["date"];
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $product["source"];
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $product["ff"];
		$htmlString .=  "</td>";
                $htmlString .=  "<td>";
		$htmlString .=  $product["fg"];
		$htmlString .=  "</td>";
                $htmlString .=  "<td>";
		$htmlString .=  $product["lab"];
		$htmlString .=  "</td>";
                
       		$htmlString .=  "<td>";
		$htmlString .=  $product["green"];
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
                $htmlString .=  $product["sf"];
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $product["others"];
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $product["pd"];
		$htmlString .=  "</td>";
		
//		$htmlString .=  "<td>";
//		$htmlString .=  output_edit_link($product["id"]);
//		$htmlString .=  "</td>";
//		
//		$htmlString .=  "<td>";
//		$htmlString .=  output_delete_link($product["id"]);
//		$htmlString .=  "</td>";
		
		
		
		$htmlString .=  "</tr>\n";
		
	}
	$htmlString .=  "</table>\n";
	
	echo $htmlString ;
	
	
	
} else {
	
	die("Failure: " . mysql_error($link_id));
}
?>
</div>
<div class="span3"></div>

</div>


</div> <!-- /container -->
<?php 
include (TEMPLATE_PATH . "/public/footer.html");
?>
