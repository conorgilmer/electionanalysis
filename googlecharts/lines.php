<html>
<head>
  <!--Load the AJAX API-->
  <script type="text/javascript" src="http://www.google.com/jsapi"></script>
  <!--script type="text/javascript" src="jquery-1.9.1.min.js"></script-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
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
                                title: 'Opinion Polls of ' +num,
                                width: 900,
                                height: 500
                        };
                        // Instantiate and draw our chart, passing in some options.
                        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                        chart.draw(data, options);
                }
    </script>


</head>
<body>
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
  <div id="table_div"></div>
</body>
</html>
