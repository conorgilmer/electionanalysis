<!-- header -->
<?php include('php/header.php'); ?>  

<!-- additional header stuff -->

  <script type="text/javascript">

                // Load the Visualization API and the chart package.
                google.load('visualization', '1', {'packages':['corechart']});
  function drawItems(num) {
    var jsonChartData = $.ajax({
      url: "genlinegraph.php",
      data: "q="+num,
      dataType:"json",
      async: false
    }).responseText;

                        // Create our data table out of JSON data loaded from server.
                        var data = new google.visualization.DataTable(jsonChartData);
                        var options = {
                                title: 'Irish Opinion Polls of ' +num,
                                width: 900,
                                height: 500,
				vAxis: {title: "Percentage"},
                                hAxis: {title: "Date of Polls"}
                        };
                        // Instantiate and draw our chart, passing in some options.
                        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                        chart.draw(data, options);

// a click handler which grabs some values then redirects the page
        google.visualization.events.addListener(chart, 'select', function() {
          // grab a few details before redirecting
          var selection = chart.getSelection();
          var row = selection[0].row;
          var col = selection[0].column;
          var year = data.getValue(row, 0);
          location.href = 'pollspie.php?row=' + row + '&col=' + col + '&year=%27' + year+"%27";
        });

                }
    </script>


<!-- menu -->
<?php include('php/menu.php'); ?>  


<!-- Content Start -->

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-9">
  
<h1>Opinion Polls Ireland - Line Chart</h1>
  <form>
  <select name="users" onchange="drawItems(this.value)">
  <option value="all">Select a Party:</option>
    <option value="all">All</option>
    <option value="ff">Fianna Fail</option>
    <option value="fg">Fine Gael</option>
    <option value="lab">Labour</option>
    <option value="sf">Sinn Fein</option>
    <option value="pd">Progressive Democrats</option>
    <option value="green">Green</option>
    <option value="rn">ReNua</option>
    <option value="sp">Socialist Party</option>
    <option value="pb">People Before Profit</option>
    <option value="wp">Workers Party</option>
    <option value="others">others</option>
  </select>
  </form>

<div id="chart_div"></div>
        </div>
      </div>

<!-- Content End -->

<!-- footer -->
<?php include('php/footer.php'); ?>  
