<?php
session_start();

/*
 * Set up constant to ensure include files cannot be called on their own
*/
define ( "MY_APP", 1 );
/*
 * Set up a constant to your main application path
 */
define ( "APPLICATION_PATH", "application" );
define ( "TEMPLATE_PATH", APPLICATION_PATH . "/view" );

//include_once(APPLICATION_PATH . "/inc/session.inc.php");


/*
 * Include the config.inc.php file
 */
include (APPLICATION_PATH . "/inc/config.inc.php");
include (APPLICATION_PATH . "/inc/db.inc.php");

//Set up variable so 'active' class set on navbar link
$activeHome = "active";

include (TEMPLATE_PATH . "/public/header.html");

?>
<div class="container">
<div class="row">
<div class="span12">
<h1>Graph Poll of Polls</h1>
</div>
</div>
<div clas="row">
<div class="span12">

    <img src="http://localhost/electionanalysis/lineall.php?title=Poll+of+Polls&height=900&width=1800&table=polls_ireland"/> 



<p>
 <a href="allpolls.php?party=ff" class=btn btn-primary role=button>FF</a>
 <a href="allpolls.php?party=fg" class=btn btn-primary role=button>FG</a>
 <a href="allpolls.php?party=lb" class=btn btn-primary role=button>LAB</a>
 <a href="allpolls.php?party=sf" class=btn btn-primary role=button>SF</a>
 <a href="allpolls.php?party=gp" class=btn btn-primary role=button>GP</a>
 <a href="allpolls.php?party=ind" class=btn btn-primary role=button>Ind</a>

 </p>
 
</div>


</div> <!-- /container -->
<?php 
include (TEMPLATE_PATH . "/public/footer.html");
?>
