<!-- header -->
<?php include('php/header.php'); ?>  

<!-- additional header stuff -->

  <script type="text/javascript">

                // Load the Visualization API and the chart package.
                google.load('visualization', '1', {'packages':['corechart']});
  function drawItems(num) {
    var jsonChartData = $.ajax({
      url: "genlinegraphavg.php",
      data: "q="+num,
      dataType:"json",
      async: false
    }).responseText;


                        // Create our data table out of JSON data loaded from server.
                        var data = new google.visualization.DataTable(jsonChartData);
                        var options = {
                                title: 'Ireland Elections Proportionality Bonus over time ' +num,
                                width: 900,
                                height: 500,
				vAxis: {title: "Seats(Bonus/Bounce)"},
                                hAxis: {title: "Date of Election"}
                        };
                        // Instantiate and draw our chart, passing in some options.
                        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                        chart.draw(data, options);

                }
    </script>

<!-- menu -->
<?php include('php/menu.php'); ?>  

<!-- Content Start -->

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-9">
 <h2>Ireland Dail Election Proportionality - Bonus/Bounce over time</h2>
<p>Select a Party to compare vote share and seats accruing</p>
  <form>
  <select name="users" onchange="drawItems(this.value)">
  <option value="all">Select a Party:</option>
    <option value="all">All</option>
    <option value="high">High Bounce</option>
    <option value="low">Low Bounce</option>
    <option value="avg">Average Bounce</option>
  </select>
  </form>
  <div id="chart_div"></div>
        </div>
      </div>

<!-- Content End -->

<!-- footer -->
<?php include('php/footer.php'); ?>  
