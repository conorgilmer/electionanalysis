<html>
<head>
  <!--Load the AJAX API-->
  <script type="text/javascript" src="http://www.google.com/jsapi"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <script type="text/javascript">

  // Load the Visualization API and the chart package.
  google.load('visualization', '1', {'packages':['corechart']});
  function drawChart(num) {
    var jsonChartData = $.ajax({
      url: "getpolldata.php",
      data: "q="+num,
      dataType:"json",
      async: false
    }).responseText;


      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonChartData);

      // Instantiate and draw our chart, passing in some options.
      var pie_chart = new google.visualization.PieChart(document.getElementById('chart_div_pie'));
      pie_chart.draw(data, {title: 'Opinion Poll - Pie Chart', width: 500, height: 340});

// Instantiate and draw our chart, passing in some options.
      var bar_chart = new google.visualization.BarChart(document.getElementById('chart_div_bar'));
      bar_chart.draw(data, {title: 'Opinion Poll - Bar Chart', width: 500, height: 340, legend: { position: 'none' },});
    }

    </script>


</head>
<body>

<h1>Opinion Polls Ireland - Pie and Bar Chart</h1>
  <form>
  <select name="users" onchange="drawChart(this.value)">
  <option value="">Select an opinion poll:</option>
  <?php

 $dbuser="root";
  $dbname="elections";
  $dbpass="";
  $dbserver="localhost";


    // Make a MySQL Connection
    $con = mysql_connect($dbserver, $dbuser, $dbpass) or die(mysql_error());
    mysql_select_db($dbname) or die(mysql_error());
    // Create a Query
    $sql_query = "SELECT id, date, source  FROM polls_ireland ORDER BY date ASC";
    // Execute query
    $result = mysql_query($sql_query) or die(mysql_error());
    while ($row = mysql_fetch_array($result)){
    echo '<option value="'. $row['id'] . '">'. $row['date'] .' - ' . $row['source'] . '</option>';
    }
    mysql_close($con);
  ?>
  </select>
  </form>
  <div id="chart_div_pie"></div>

  <div id="chart_div_bar"></div>
</body>
</html>
