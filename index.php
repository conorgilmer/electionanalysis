<?php
/* Menu for Election pages */
/*
 * Set up constant to ensure include files cannot be called on their own
*/
define ( "MY_APP", 1 );
/*
 * Set up a constant to your main application path
*/
define ( "APPLICATION_PATH", "application" );
define ( "TEMPLATE_PATH", APPLICATION_PATH . "/view" );
include (TEMPLATE_PATH . "/public/header.html");
?>


<div class="container">

    <div class="row">
    <div class="span12">
    
    <h1>Elections Ireland and UK</h1>
<p>Show Election data from Ireland and UK, broken down into parties and display graphs of breakdown by seats and votes. </p>


    <h1>Polls</h1>
<p>List opinion polls, and list polls over time.</p>
<ol>
<li>List all Polls </li>
<li>Graph all Polls </li>
</ol>
    
    <h1>Done</h1>
    <p>
</p>
<ol>
<li>Add Dail Elections</li>
<li>Add Westminister Elections</li>
<li>Replace phpmygraph with Google Charts</li>
<li>Use phpmygraph</li>
</ol>
        
    
    <h1>To Do</h1>
    <p>
Some improvements.</p>
<ol>
<li>Add NI Assembly Elections</li>
<li>Add Euro Elections</li>
<li>Group Polls by Polling Company</li>
</ol>
        
    </div>
    
    </div>

</div>



<?php include (TEMPLATE_PATH . "/public/footer.html"); ?>
