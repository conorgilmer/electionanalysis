<!-- header -->
<?php include('php/header.php'); ?>  

<!-- additional header stuff -->

  <script type="text/javascript">

  // Load the Visualization API and the chart package.
  google.load('visualization', '1', {'packages':['corechart']});
  function drawChart(num) {
    var jsonChartData = $.ajax({
      url: "getseatdata.php",
      data: "q="+num,
      dataType:"json",
      async: false
    }).responseText;

    var jsonPropData = $.ajax({
      url: "getpropdata.php",
      data: "q="+num,
      dataType:"json",
      async: false
    }).responseText;
   
    var jsonBounceData = $.ajax({
      url: "getbounces.php",
      data: "q="+num,
      dataType:"json",
      async: false
    }).responseText;

    var jsonBounceTableData = $.ajax({
      url: "getbouncestable.php",
      data: "q="+num,
      dataType:"json",
      async: false
    }).responseText;

      // actual seats 
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonChartData);

      // Instantiate and draw our chart, passing in some options.
      var pie_chart = new google.visualization.PieChart(document.getElementById('seats_pie_div'));
      pie_chart.draw(data, {title: 'Seats - Pie Chart', width: 500, height: 340});

      // Instantiate and draw our chart, passing in some options.
      var bar_chart = new google.visualization.BarChart(document.getElementById('seats_bar_div'));
      bar_chart.draw(data, {title: 'Seats - Bar Chart', bars: 'horizontal',  width: 500, height: 340, legend: { position: 'none' },});

      // proportional seats 
      // Create our data table out of JSON data loaded from server.
      var prop_data = new google.visualization.DataTable(jsonPropData);

      // Instantiate and draw our chart, passing in some options.
      var prop_pie_chart = new google.visualization.PieChart(document.getElementById('pseats_pie_div'));
      prop_pie_chart.draw(prop_data, {title: 'Proportional - Pie Chart', width: 500, height: 340});

      // Instantiate and draw our chart, passing in some options.
      var prop_bar_chart = new google.visualization.BarChart(document.getElementById('pseats_bar_div'));
      prop_bar_chart.draw(prop_data, {title: 'Proportional - Bar Chart', bars: 'horizontal',  width: 500, height: 340, legend: { position: 'none' },});

      // Bounce
      var bounce_data = new google.visualization.DataTable(jsonBounceData);
      // Instantiate and draw our chart, passing in some options.
      var bounce_bar_chart = new google.visualization.BarChart(document.getElementById('bounce_bar_div'));
      bounce_bar_chart.draw(bounce_data, {title: 'Seat Bounce ', bars: 'horizontal',  width: 500, height: 340, legend: { position: 'none' },});


      var bounce_tabledata = new google.visualization.DataTable(jsonBounceTableData);
    // Instantiate and draw our table, passing in some options.
    var table = new google.visualization.Table(document.getElementById('bounce_table_div'));
    table.draw(bounce_tabledata, {showRowNumber: true, alternatingRowStyle: true});
    }

    </script>



<!-- menu -->
<?php include('php/menu.php'); ?>  

<!-- Content Start -->

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-9">
 <h2>UK Westminister Election Proportionality</h2>

  <form>
  <select name="users" onchange="drawChart(this.value)">
  <option value="">Select an election :</option>
  <?php
  include('config.php');

$conn = new mysqli($dbhost, $dblogin, $dbpwd, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

    // Make a MySQL Connection
    //$con = mysql_connect($dbhost, $dblogin, $dbpwd) or die(mysql_error());
    //mysql_select_db($dbname) or die(mysql_error());
    // Create a Query
    $sql_query = "SELECT id, date, source  FROM seats_uk ORDER BY date DESC";
    // Execute query
    //$result = mysql_query($sql_query) or die(mysql_error());

$result = $conn->query($sql_query);

    //while ($row = mysql_fetch_array($result)){

if ($result->num_rows > 0) {
//$rows = array();
//while($r = mysql_fetch_assoc($queryData)) {
while($row = $result->fetch_assoc()) {

    echo '<option value="'. $row['id'] . '">'. $row['date'] .' - ' . $row['source'] . '</option>';
    }

} else {
    echo "0 results";
}


//    mysql_close($con);
  ?>
  </select>
  </form>
</div>
</div>
      <div class="row">
        <div class="col-lg-6">
  <div id="seats_pie_div"></div>
  <div id="seats_bar_div"></div>
  <div id="bounce_bar_div"></div>
        </div>
        <div class="col-lg-6">
  <div id="pseats_pie_div"></div>
  <div id="pseats_bar_div"></div>
  <div id="bounce_table_div"></div>
        </div>
      </div>

<!-- Content End -->

<!-- footer -->
<?php include('php/footer.php'); ?>  
