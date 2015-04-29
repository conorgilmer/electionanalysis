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
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, {width: 500, height: 340});
    }

    </script>


</head>
<body>

<h1>Opinion Polls UK 2015 - Pie Chart</h1>
  <form>
  <select name="users" onchange="drawChart(this.value)">
  <option value="">Select an opinion poll:</option>
  <?php
  include('config.php');


    // Make a MySQL Connection
    $con = mysql_connect($dbhost, $dblogin, $dbpwd) or die(mysql_error());
    mysql_select_db($dbname) or die(mysql_error());
    // Create a Query
    $sql_query = "SELECT id, date, source  FROM polls_uk ORDER BY date ASC";
    // Execute query
    $result = mysql_query($sql_query) or die(mysql_error());
    while ($row = mysql_fetch_array($result)){
    echo '<option value="'. $row['id'] . '">'. $row['date'] .' - ' . $row['source'] . '</option>';
    }
    mysql_close($con);
  ?>
  </select>
  </form>
  <div id="chart_div"></div>

  <div id="chart_div"></div>
</body>
</html>
