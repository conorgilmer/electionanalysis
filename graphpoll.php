<?php
        /* Libchart - PHP chart library
         * Copyright (C) 2005-2011 Jean-Marc Trémeaux (jm.tremeaux at gmail.com)
         *
         * This program is free software: you can redistribute it and/or modify
         * it under the terms of the GNU General Public License as published by
         * the Free Software Foundation, either version 3 of the License, or
         * (at your option) any later version.
         *
         * This program is distributed in the hope that it will be useful,
         * but WITHOUT ANY WARRANTY; without even the implied warranty of
         * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
         * GNU General Public License for more details.
         *
         * You should have received a copy of the GNU General Public License
         * along with this program.  If not, see <http://www.gnu.org/licenses/>.
         *
         */

        /**
         * Direct PNG output demonstration (image not saved to disk)
         *
         */
define ( "MY_APP", 1 );
/*
 * Set up a constant to your main application path
 */
define ( "APPLICATION_PATH", "application" );
define ( "TEMPLATE_PATH", APPLICATION_PATH . "/view" );


/*
 * Include the config.inc.php file
 */
include (APPLICATION_PATH . "/inc/config.inc.php");
include (APPLICATION_PATH . "/inc/db.inc.php");
//include (APPLICATION_PATH . "/inc/functions.inc.php");


	$title  = $_GET['title'];
	$height = $_GET['height'];
	$width  = $_GET['width'];
	$id     = $_GET['id'];
	$type   = $_GET['type'];
        include "library/libchart/classes/libchart.php";

        header("Content-type: image/png");
	if ($type == "bar") {
            $chart = new VerticalBarChart($width, $height);}
	elseif ($type == "hbar") {
            $chart = new HorizontalBarChart($width, $height);}
	elseif ($type == "pie") {
            $chart = new PieChart($width, $height);}
	else
            $chart = new PieChart($width, $height);

        $dataSet = new XYDataSet();
	$sqlQuery = "SELECT * FROM polls_ireland where id = $id" ;
	//$result = mysql_query($sqlQuery);
	$result = $link_id->query($sqlQuery);

	if ($result) {
		//while ($db_field = mysql_fetch_assoc($result))
		while ($db_field = $result->fetch_assoc())
		{
		        $dataSet->addPoint(new Point("FF", $db_field['ff'] ));
		        $dataSet->addPoint(new Point("FG", $db_field['fg'] ));
		        $dataSet->addPoint(new Point("LAB", $db_field['lab'] ));
		        $dataSet->addPoint(new Point("GREEN", $db_field['green'] ));
		        $dataSet->addPoint(new Point("SF", $db_field['sf'] ));
		        $dataSet->addPoint(new Point("Others", $db_field['others'] ));
		        $dataSet->addPoint(new Point("PD", $db_field['pd'] ));
       		}
	} else {
        	die("Failure: ");
	}
 


        $chart->setDataSet($dataSet);

        $chart->setTitle($title);
        $chart->render();
?>

