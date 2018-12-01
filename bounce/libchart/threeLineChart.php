<?php
/* passed title, line1 and line1 in the URL
   3 arrays xaxis, yaxis and zaxis passed as session variables
*/
session_start();
$graphTitle  = $_GET['title'];
$line1Title  = $_GET['line1'];
$line2Title  = $_GET['line2'];
$line3Title  = $_GET['line3'];
//$number  = $_GET['num'];
$number  = isset($_GET['num']) ? $_GET['num'] : 4;  /* default 4 */
$graphWidth  = isset($_GET['width']) ? $_GET['width'] : 750;  /* default 750 */
$graphHeight = isset($_GET['height']) ? $_GET['height'] : 375; /* default 375 */

include "library/libchart/classes/libchart.php";


     header("Content-type: image/png");

	$chart = new LineChart($graphWidth, $graphHeight);

	$serie1 = new XYDataSet();

	$serie2 = new XYDataSet();
	$serie3 = new XYDataSet();

	for ($i=0; $i<$number; $i++){
	$serie1->addPoint(new Point($_SESSION['xaxis'][$i], $_SESSION['yaxis'][$i]));
	$serie2->addPoint(new Point($_SESSION['xaxis'][$i], $_SESSION['zaxis'][$i]));
	$serie3->addPoint(new Point($_SESSION['xaxis'][$i], $_SESSION['waxis'][$i]));
	}

/* Legend */
	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie($line1Title, $serie1);
	$dataSet->addSerie($line2Title, $serie2);
	$dataSet->addSerie($line3Title, $serie3);
	$chart->setDataSet($dataSet);

/*graph render*/

	$chart->setTitle($graphTitle);
	$chart->render();


?>
