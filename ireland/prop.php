<!-- header -->
<?php include('php/header.php'); ?>  

<!-- additional header stuff -->

  <script type="text/javascript">

                // Load the Visualization API and the chart package.
                google.load('visualization', '1', {'packages':['corechart']});
  function drawItems(num) {
    var jsonChartData = $.ajax({
      url: "genlinegraphprop.php",
      data: "q="+num,
      dataType:"json",
      async: false
    }).responseText;


                        // Create our data table out of JSON data loaded from server.
                        var data = new google.visualization.DataTable(jsonChartData);
                        var options = {
                                title: 'Irish Elections Proportionality Seats v Vote ' +num,
                                width: 900,
                                height: 500,
				vAxis: {title: "Seats(Percentage)"},
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
 <h2>Dail Election Proportionality - Line Graphs</h2>
<p>Select a Party to compare vote share and seats accruing</p>
  <form>
  <select name="users" onchange="drawItems(this.value)">
<option value="all">Select a Party:</option>
    <option value="all">All</option>
    <option value="ff">Fianna Fail</option>
    <option value="fg">Fine Gael</option>
    <option value="lb">Labour</option>
    <option value="sf">Sinn Fein</option>
    <option value="pd">Progressive Democrats</option>
    <option value="gp">Green</option>
    <option value="rn">ReNua</option>
    <option value="sp">Socialist Party</option>
    <option value="pb">People Before Profit</option>
    <option value="wp">Workers Party</option>
    <option value="dl">Democratic Left</option>
    <option value="cnp">Clann Na pobalachta</option>
    <option value="nal">National Labour</option>
    <option value="nl">National League</option>
    <option value="fm">Farmers/CnaT</option>
    <option value="cp">Centre Party</option>
    <option value="un">Unionist</option>
    <option value="others">others</option> 
 </select>
  </form>
  <div id="chart_div"></div>
        </div>
      </div>

<!-- Content End -->

<!-- footer -->
<?php include('php/footer.php'); ?>  
