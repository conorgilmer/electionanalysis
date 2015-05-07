<!-- header -->
<?php include('php/header.php'); ?>  

<!-- additional header stuff -->

  <script type="text/javascript">

                // Load the Visualization API and the chart package.
                google.load('visualization', '1', {'packages':['corechart']});
  function drawItems(num) {
    var jsonChartData = $.ajax({
      url: "genlinegraphseats.php",
      data: "q="+num,
      dataType:"json",
      async: false
    }).responseText;

                        // Create our data table out of JSON data loaded from server.
                        var data = new google.visualization.DataTable(jsonChartData);
                        var options = {
                                title: 'UK Elections Seat allocated for ' +num,
                                width: 900,
                                height: 500,
				vAxis: {title: "Seats"},
                                hAxis: {title: "Date of Election"}
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
          location.href = 'seatspie.php?row=' + row + '&col=' + col + '&year=' + year;
        });
                }
    </script>


<!-- menu -->
<?php include('php/menu.php'); ?>  


<!-- Content Start -->

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-9">
 <h2>UK Westminister Election Seats - Line Graphs</h2>
<p>Select a Graph for a part from the opinion polls or view all</p>
  <form>
  <select name="users" onchange="drawItems(this.value)">
  <option value="all">Select a Party:</option>
    <option value="all">All</option>
    <option value="lab">Labour</option>
    <option value="cons">Conservatives</option>
    <option value="libdems">Liberal Democrats</option>
    <option value="green">Green</option>
    <option value="ukip">UKIP</option>
    <option value="snp">SNP</option>
    <option value="pc">Plaid Cymru</option>
    <option value="dup">DUP</option>
    <option value="uup">UUP</option>
    <option value="sdlp">SDLP</option>
    <option value="sf">Sinn Fein</option>
    <option value="apni">Alliance</option-->
    <option value="others">Others</option>
  </select>
  </form>
  <div id="chart_div"></div>
        </div>
      </div>


<!-- Content End -->

<!-- footer -->
<?php include('php/footer.php'); ?>  

