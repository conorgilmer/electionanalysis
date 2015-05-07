<!-- header -->
<?php include('php/header.php'); ?>

<!-- additional header stuff -->

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
   
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
    
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);
    
    function drawChart() {
      var num = <?echo  $_GET['row']?>;
	num = num + 1;
      var jsonData = $.ajax({
      url: "getpolldata.php",
      data: "q="+num,
      dataType:"json",
      async: false
    }).responseText;

      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, {width: 500, height: 340});
    }

    </script>


<!-- menu -->
<?php include('php/menu.php'); ?>


<!-- Content Start -->

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-9">

        <p class="lead"> <?echo  $_GET['year']?> Poll - Pie Chart</p>

    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>

   </div>
      </div>


<!-- Content End -->

<!-- footer -->
<?php include('php/footer.php'); ?>