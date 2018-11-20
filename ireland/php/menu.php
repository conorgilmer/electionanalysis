  </head>

  <body>
<?php include_once("php/tracking.php") ?>
    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Ireland Elections and Polls</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            	<ul class="nav navbar-nav">
            		<li><a href="index.php">Home</a></li>
			<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Polls <span class="caret"></span></a>
                	<ul class="dropdown-menu" role="menu">
            		<li><a href="polls.php">Polls(Line)</a></li>
            		<li><a href="piebar.php">Select Polls(Bar/Pie)</a></li>
            		<li><a href="pollbarpie.php">Polls(Bar/Pie)</a></li>
                	</ul>
			</li>
            		<li><a href="votes.php">Votes</a></li>
            		<li><a href="seats.php">Seats</a></li>
			<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Proportionality <span class="caret"></span></a>
                	<ul class="dropdown-menu" role="menu">
            		<li><a href="prop.php">Proportionality over time (Line Graphs)</a></li>
            		<li><a href="propfive.php">Proportionality Elections (Bar/Pie Charts)</a></li>
            		<li><a href="propavg.php">Proportionality Elections (Average High Low Seat Bonus/Bounce)</a></li>
                	</ul>
			</li>

			<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Election 2016 <span class="caret"></span></a>
                	<ul class="dropdown-menu" role="menu">
            		<li><a href="polls2016.php">Opinion Polls During Campaign</a></li>
            		<li><a href="pop2016.php">Poll of Polls  During Campaign</a></li>
                	</ul>

			</li>

            		<li><a href="parties.php">Parties</a></li>
              		</li>

	    	</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="about.php">About</a></li>
		</ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>


