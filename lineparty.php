<?

/*
 * Set up a constant to your main application path
 */
define ( "APPLICATION_PATH", "application" );

/*
 * Include the config.inc.php file
 */
include (APPLICATION_PATH . "/inc/config.inc.php");
include (APPLICATION_PATH . "/inc/db.inc.php");
include (APPLICATION_PATH . "/inc/functions.inc.php");

include "library/libchart/classes/libchart.php";

	header("Content-type: image/png");

	$width  = $_GET['width'];
	$height = $_GET['height'];
	$title  = $_GET['title'];
	$table  = $_GET['table'];
	$party  = $_GET['party'];
//	$type   = $_GET['type'];
	//$table  = "polls_ireland";
	$partyName = getName($party);	
	$chart = new LineChart($width,$height);

	$party1 = new XYDataSet();

	$sqlQuery = "SELECT * FROM $table ";
	$result = mysql_query($sqlQuery);
	if ($result) {
		while ($db_field = mysql_fetch_assoc($result))
		{	
        	//$dataSet->addPoint(new Point($db_field[$xaxis], $db_field[$yaxis]));
		$party1->addPoint(new Point($db_field['date'], $db_field[$party]));
      		}
	} else {
        	die("Failure: ");
	}
 

	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie($partyName, $party1);
	$chart->setDataSet($dataSet);

	$chart->setTitle($title);
	$chart->getPlot()->setGraphCaptionRatio(0.72);
	
	$chart->render();
?>
