<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>UK Elections and Polls</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="justified-nav.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<!--Load the AJAX API-->
  <script type="text/javascript" src="http://www.google.com/jsapi"></script>
  <!--script type="text/javascript" src="js/jquery-1.9.1.min.js"></script-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
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
                                title: 'UK Elections Proportionality Seats v Vote ' +num,
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




  </head>

  <body>

    <div class="container">

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <div class="masthead">
        <h3 class="text-muted">UK Elections and Polls</h3>
        <nav>
          <ul class="nav nav-justified">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="polls.php">Polls</a></li>
            <li><a href="votes.php">Votes</a></li>
            <li><a href="seats.php">Seats</a></li>
            <li><a href="prop.php">Proportionality</a></li>
            <li><a href="about.php">About</a></li>
          </ul>
        </nav>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-9">
 <h2>UK Westminister Election Proportionality - Line Graphs</h2>
<p>Select a Party to compare vote share and seats acruing</p>
  <form>
  <select name="users" onchange="drawItems(this.value)">
  <option value="all">Select a Party:</option>
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

      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; Conor Gilmer 2015</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
