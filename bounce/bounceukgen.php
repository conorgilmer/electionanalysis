<?php
session_start();
        //Include phpMyGraph class 
        include('phpMyGraph.php');
$election=$_GET['year'];        
$graphtype=$_GET['graphtype'];        

if ($graphtype == "votes")
{
$votes=$_SESSION['votes'];
}
elseif ($graphtype == "seats")
{
$votes=$_SESSION['seats'];
}
elseif ($graphtype == "prseats")
{
$votes=$_SESSION['prseats'];
}
else {
$votes=$_SESSION['bounce'];
}
	//Create config array for graph
        $cfguk = array
        (
            'title'=> $graphtype . ' by First Past The Post - UK General Election '.  $election,
            'background-color'=>'FFFFFF',
            'graph-background-color'=>'FFFFFF',
            'font-color'=>'000000',
            'border-color'=>'009900',
            'column-color'=>'00FF00',
            'column-shadow-color'=>'009900',
            'column-font-color-q1'=>'000000',
            'column-font-color-q2'=>'000000',
	    'random-column-color'=>1
        );
        //Create data array for graph
        $datauk = array
        (
            'CONS'=>$votes[0],
            'LAB'=>$votes[1],
            'LIB'=>$votes[2],
            'UKIP'=>$votes[3],
            'GP'=>$votes[4],
            'SNP'=>$votes[5],
            'PC'=>$votes[6],
            'DUP'=>$votes[8],
            'UUP'=>$votes[9],
            'SF'=>$votes[12],
	    'SDLP'=>$votes[11],
            'OTH'=>$votes[13],	    
        );
        
        //Create new graph 
        $graphuk = new phpMyGraph();
        
        //Parse vertical line graph
	$graphuk->parseVerticalColumnGraph($datauk,$cfguk);



?> 

