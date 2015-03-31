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
$id = $_GET['id'];
?>
<div class="container">
<div class="row">
<div class="span12">
<h1>Graph Pie Poll</h1>
</div>
</div>
<div clas="row">
<div class="span12">

    <img src="http://localhost/electionanalysis/graphpoll.php?type=pie&title=Parties&height=450&width=900&id=<?echo $id;?>"/> 
 
 <p>
 <a href="callpiepolls.php?id=<?echo $id;?>" class=btn btn-primary role=button>Pie Chart</a> 
 <a href="callvbarpolls.php?id=<?echo $id;?>" class=btn btn-primary role=button>Vertical Bar Chart</a> 
 <a href="callhbarpolls.php?id=<?echo $id;?>" class=btn btn-primary role=button>Horizontal Bar Chart</a> 

 </p>
</div>


</div> <!-- /container -->
<?php 
include (TEMPLATE_PATH . "/public/footer.html");
?>
