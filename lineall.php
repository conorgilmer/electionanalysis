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

include "library/libchart/classes/libchart.php";

	header("Content-type: image/png");

	$width  = $_GET['width'];
	$height = $_GET['height'];
	$title  = $_GET['title'];
	$table  = $_GET['table'];
	$type   = $_GET['type'];
	//$table  = "polls_ireland";
	
	$chart = new LineChart($width,$height);

	$party1 = new XYDataSet();
	$party2 = new XYDataSet();
	$party3 = new XYDataSet();
	$party4 = new XYDataSet();
	$party5 = new XYDataSet();
	$party6 = new XYDataSet();
	$party7 = new XYDataSet();

	$sqlQuery = "SELECT * FROM $table";
	$result = mysql_query($sqlQuery);
	if ($result) {
		while ($db_field = mysql_fetch_assoc($result))
		{	
        	//$dataSet->addPoint(new Point($db_field[$xaxis], $db_field[$yaxis]));
		$party1->addPoint(new Point($db_field['date'], $db_field['ff']));
		$party2->addPoint(new Point($db_field["date"], $db_field["fg"]));
		$party3->addPoint(new Point($db_field["date"], $db_field["lab"]));
		$party4->addPoint(new Point($db_field["date"], $db_field["green"]));
		$party5->addPoint(new Point($db_field["date"], $db_field["sf"]));
		$party6->addPoint(new Point($db_field["date"], $db_field["others"]));
 		$party7->addPoint(new Point($db_field["date"], $db_field["pd"]));
      		}
	} else {
        	die("Failure: ");
	}
 

	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("Fianna Fail", $party1);
	$dataSet->addSerie("Fine Gael", $party2);
	$dataSet->addSerie("Labour", $party3);
	$dataSet->addSerie("Green", $party4);
	$dataSet->addSerie("Sinn Fein", $party5);
	$dataSet->addSerie("Others", $party6);
	$dataSet->addSerie("PD", $party7);
	$chart->setDataSet($dataSet);

	$chart->setTitle($title);
	$chart->getPlot()->setGraphCaptionRatio(0.72);
	
	$chart->render();
?>
