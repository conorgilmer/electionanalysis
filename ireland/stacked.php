<?php
//session_start();
/* * Set up constant to ensure include files cannot be called on their own
*/
$election="2016"; //$_GET['q'];
include('php/header.php');
include('php/config.php');
//include('php/menu.php');
?>

<?php 
$partynames = array("Fianna Fail", "Fine Gael", "Labour", "Sinn Fein", "Greens", "Others");
        $partyseats= array(44, 51, 7, 23, 2, 30);
        $partybounce= array(-2, +4, -5, -1, -1, +5);
        $partyvotes= array(24.3, 25.5, 6.6, 13.8, 2.7, 27.1);
//echo "dal seats = ". array_sum($partyseats);
//echo "dal votes = ". array_sum($partyvotes);
?>
<!--script type="text/javascript" src="https://www.google.com/jsapi"></script>
-->
<script type="text/javascript">

google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {
        var inSeats = ['Seats', 44, 50, 7, 23, 2, 23, ''];
        var data = google.visualization.arrayToDataTable([
		['API',<?php for($i=0;$i<6;$i++){ echo "'".$partynames[$i] ."',"; } 
?>
{ role: 'annotation' } ], inSeats ]);
        var options = {
        width: 1000,
        height: 150,
        legend: { position: 'top', maxLines: 3, textStyle: {color: 'black', fontSize: 16 } }, isStacked: 'percent',
series: { 0:{color:'<?php echo $ffcol;?>'}, 1:{color:'<?php echo $fgcol;?>'},
    2:{color:'<?php echo $labcol;?>'}, 3:{color:'<?php echo $sfcol;?>'},
    4:{color:'<?php echo $gpcol;?>'}, 5:{color:'<?php echo $othcol;?>'} }
      };
        var inVotes = ['Votes', 24.3, 25.5, 6.6, 13.8, 2.7, 27.1, ''];
        var dataVotes = google.visualization.arrayToDataTable([
		['API',<?php for($i=0;$i<6;$i++){ echo "'".$partynames[$i] ."',"; } ?>
		{ role: 'annotation' } ], inVotes ]);
        var optionsVotes = {
        width: 1000,
        height: 150,
        legend: { position: 'top', maxLines: 3, textStyle: {color: 'black', fontSize: 16 } },
		isStacked: 'percent',
	series: { 
		0:{color:'<?php echo $ffcol;?>'}, 
		1:{color:'<?php echo $fgcol;?>'},
    		2:{color:'<?php echo $labcol;?>'},
		3:{color:'<?php echo $sfcol;?>'},
    		4:{color:'<?php echo $gpcol;?>'}, 
		5:{color:'<?php echo $othcol;?>'} } };
        
	var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);

        var chartVotes = new google.visualization.BarChart(document.getElementById('chartVotes_div'));
        chartVotes.draw(dataVotes, optionsVotes);

    	var dataB = new google.visualization.DataTable();
	dataB.addColumn('string', 'Question'); 
	dataB.addColumn('number', 'Seat Bonus');
dataB.addColumn({type: 'string', role: 'style'});
/*
dataB.addRow(['Deliverd', 30, 'color: green']);
dataB.addRow(['Failed', 5, 'color: #FF0000']);
dataB.addRow(['NCPR Rejected', 3, 'color: #00FF00']);
dataB.addRow(['Not Sent To operator', 10, 'color: #0000FF']);*/
	dataB.addRows([["FF", +6, '<?php echo $ffcol;?>'], ["FG", +10, '<?php echo $fgcol;?>'],["LAB", -3, '<?php echo $labcol;?>'],["SF", +1, '<?php echo $sfcol;?>'],["GP", -2, '<?php echo $gpcol;?>'],["Oth", -3, '<?php echo $othcol;?>']]); 
    <?php //for($i=0;$i<$countArrayLength;$i++){
      //  echo "['" . $values[$i]['question'] . "'," . $values[$i]['globalavg'] ."],"; //} ?> //]);
    var optionsb = {
        title: 'Seat Bounce',
        legend: { position: 'none' },
                vAxis: {minValue: -25 ,
                title: 'Seat Bonus',
                maxValue: 25},
                hAxis:{ slantedText: false},
 	//colors: ['red','green', 'blue', 'yellow', 'cyan', 'magenta','green'],
	series: { 
		0:{color:'<?php echo $ffcol;?>'}, 
		1:{color:'<?php echo $fgcol;?>'},
    		2:{color:'<?php echo $labcol;?>'},
		3:{color:'<?php echo $sfcol;?>'},
    		4:{color:'<?php echo $gpcol;?>'}, 
		5:{color:'<?php echo $othcol;?>'} } 

 };
   
/*
        var optionsb = {
          title : 'Monthly Coffee Production by Country',
          vAxis: {title: 'Cups'},
          hAxis: {title: 'Month'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };*/
	 var chartb = new google.visualization.ColumnChart(document.getElementById('column_chart'));
    chartb.draw(dataB, optionsb);
 	  }
</script>





<?php include('php/menu.php');?>
  <!-- Example row of columns -->
      <div class="row">
       <h1>Votes Vs Seats <?php echo $election; ?></h1>
        <div class="col-lg-9">
  
       <h4>Seats </h4> 
    		<div id="chart_div" style="width: 100%; height: auto"></div>
        </div>
      </div>    	
  <!-- Example row of columns -->
       <div class="row">
      `  <div class="col-lg-9">
  

       <h4>Votes </h4> 
	<div id="chartVotes_div" style="width: 100%; height: auto"></div>
	</div>
</div>    	
      <div class="row">
       <h1>Votes Vs Seats <?php echo $election; ?></h1>
        <div class="col-lg-9">
	
	<div id="column_chart"></div>
	</div>
</div>    	

<?php include ("php/footer.php"); ?>
	
