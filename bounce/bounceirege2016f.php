<?php
        //Include phpMyGraph class 
        include('phpMyGraph4.php');
        
        //Create config array for graph
        $cfg = array
        (
            'title'=>'Bounce by STV-PR System - Irish General Election 2016',
	    'width'=>450,
	    'height'=>300,
            'background-color'=>'FFFFFF',
            'graph-background-color'=>'FFFFFF',
            'font-color'=>'000000',
            'border-color'=>'009900',
            'column-color'=>'00FF00',
            'column-shadow-color'=>'009900',
            'column-font-color-q1'=>'000000',
            'column-font-color-q2'=>'000000',
	    'random-column-color'=>1,
	    'disable-leganda'=>0
        );
        //Create data array for graph
        $data = array
        (
            'Fianna Fáil'=>6,
            'Fine Gael'=>10,
            'Labour'=>-3,
            'Greens'=>-2,
            'Sinn Féin'=>1,
            'AAA/PBP'=>0,
            'Ind All'=>-1,
            'Renua'=>-3,
            'Soc Dem'=>-2,
            'I4C'=>2,
            'Others'=>-6,
        );
        
        //Create new graph 
        $graph = new phpMyGraph();
        
        //Parse vertical line graph
	$graph->parseVerticalColumnGraph($data,$cfg);


?> 

