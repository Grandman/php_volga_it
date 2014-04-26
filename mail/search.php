<?php 
require 'Mandrill.php';
try {
    $mandrill = new Mandrill('3xGDzd_VFDw4tlUbMzOf5Q');
    $result = $mandrill->messages->search();
	foreach($result as $element)
	{
		echo  "<tr><td>" . date('Y-m-d H:i:s', $element['ts']) . "</td><td>" .
		$element['sender'] . "</td><td>" . $element['email'] . "</td><td><a href='#' data-toggle=\"modal\" data-target=\"#myModal\" onclick=GetBody(\"" . $element['_id'] . "\");>" .
		$element['subject'] . "</a></td><td>" . $element['opens'] ."</td><td>" .
		$element['clicks']. "</td></tr>";
	}
} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_ServiceUnavailable - Service Temporarily Unavailable
    throw $e;
}
/*
Array ( 
[0] => 
Array ( [ts] => 1398501035 
[subject] => ssss 
[email] => sss@sss.ru 
[tags] => Array ( ) 
[opens] => 0 
[clicks] => 0 
[state] => sent 
[smtp_events] => Array ( ) 
[subaccount] => 
[resends] => Array ( ) 
[reject] => 
[_id] => e606582cedab4f188923f16075cb7be6 
[sender] => sss@sss.ru [template] => 
[opens_detail] => Array ( ) 
[clicks_detail] => Array ( ) 
)*/
 