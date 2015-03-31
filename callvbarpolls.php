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
<h1>Graph Vertical Bar Chart Poll</h1>
</div>
</div>
<div clas="row">
<div class="span12">

    <img src="http://localhost/electionanalysis/graphpoll.php?type=bar&title=Parties&height=450&width=900&id=<?echo $id;?>"/> 
 

</div>


</div> <!-- /container -->
<?php 
include (TEMPLATE_PATH . "/public/footer.html");
?>
