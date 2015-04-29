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

      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>UK Elections</h1>
        <p class="lead">Looking at Opinion Polls, Votes, Seat returns and Proportionality of UK Elections.</p>
        <!--p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p-->
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-4">
          <h2>Opinion Pools</h2>
          <p>In the run up to the May 2015, General Election.</p>
          <p>The Line Chart shows how most of the parties have not changed much.</p>
          <p><a class="btn btn-primary" href="polls.php" role="button">View details &raquo;</a></p>
        </div>

        <div class="col-lg-4">
          <h2>Proportionality</h2>
          <p>The crux of this is to look at how proportional is the representaion in a parliament from the votes cast for a particular party</p>
          <p>The graph shows what percentage over or below of seats a party gets relative to its vote share..</p>
          <p><a class="btn btn-primary" href="prop.php" role="button">View details &raquo;</a></p>
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
