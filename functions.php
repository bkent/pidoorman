<?php
function iConnect() 
{
mysql_connect("localhost", "root", "root") or die(mysql_error()); 
mysql_select_db("pidoorman") or die(mysql_error()); 
}

function iConnect2() 
{
	$mysqli = new mysqli("localhost", "root", "root","pidoorman");
	if($mysqli->connect_errno > 0)
	{
		die('Unable to connect to database [' . $mysqli->connect_error . ']');
	}
	else
	    return $mysqli;
}

function ukstrtotime($str) {
return strtotime(preg_replace("/^([0-9]{1,2})[\/\. -]+([0-9]{1,2})[\/\. -]+([0-9]{1,4})/", "\\2/\\1/\\3", $str));
}

?>