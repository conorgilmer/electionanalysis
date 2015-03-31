<?php

/*
 * This constant is declared in index.php
* It prevents this file being called directly
*/
defined('MY_APP') or die('Restricted access');

/* form the link for pie */
function output_def_link($id){
    return "<a href ='callpiepolls.php?id=$id'>$id</a>";
}


/* form the link for pie */
function output_pie_link($id){
    return "<a href ='callpiepolls.php?id=$id'>Pie</a>";
}


/* form the link for vertical bar */
function output_vbar_link($id){
    return "<a href ='callvbarpolls.php?id=$id'>V Bar</a>";
}


/* form the link for horizontal bar */
function output_hbar_link($id){
    return "<a href ='callhbarpolls.php?id=$id'>H Bar</a>";
}

// authenticate login funciton
function authenticate($username, $password) {   
    $boolAuthenticated = false;
    
    $sqlQuery = "SELECT * from adminusers WHERE ";
    $sqlQuery .= "username = '" . $username . "'";
    $sqlQuery .= " AND ";
    $sqlQuery .= "password = '" .$password . "'";
    
    $result = mysql_query($sqlQuery);
    
    if (!$result)  die("Error: " . $sqlQuery . mysql_error());
    
    if (mysql_num_rows($result)==1) {
        $boolAuthenticated = true;
    }
    
    return $boolAuthenticated;
    
} /* login user authenticate */


function writeCSV ($table){
    $result=mysql_query("select * from $table ");

    $out = '';

    // Get all fields names in table.
    $fields = mysql_list_fields('elections',$table);

    // Count the table fields and put the value into $columns.
    $columns = mysql_num_fields($fields);

    // Put the name of all fields to $out.
    for ($i = 0; $i < $columns; $i++) {
        $l=mysql_field_name($fields, $i);
        $out .= '"'.$l.'",';
    }
    $out .="\r\n";

    // Add all values in the table to $out.
    while ($l = mysql_fetch_array($result)) {
        for ($i = 0; $i < $columns; $i++) {
            $out .='"'.$l["$i"].'",';
        }
        $out .="\r\n";

    }

    try {
    // Open file export.csv.
    $f = fopen ('export.csv','w');

    // Put all values from $out to export.csv.
    fputs($f, $out);
    fclose($f);
    } catch (Exception $e) {
        return FALSE;
    }
    return TRUE;
}
