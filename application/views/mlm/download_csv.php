<?php

$name = date('m/d/y') .'_CSV'; //This will be the name of the csv file.
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename='.$name.'.csv');

$output = fopen('php://output', 'w');

fputcsv($output, array('heading1', 'heading2', 'heading... n')); //The column heading row of the csv file

//establish mysql connections: hope you know the arguments :)

$temp = array();
while ($row = mysql_fetch_assoc($results))
{
	array_push($temp, $row);
}
 $c = count($temp); 
   for($i=0; $i<=$c; $i++) {

	fputcsv($output, $temp[$i]);
}

?>