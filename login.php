<?php
session_start();
// dBase file
include "functions.php";

	$is_ajax = $_REQUEST['is_ajax'];
	if(isset($is_ajax) && $is_ajax)
	{

 if (!$_POST['user_name'] || !$_POST['password'])
 	{
 	die("You need to provide a username and password.<p>Click <a href='index.html'>here</a> to return to the main login screen.</p>");
 	}
 
 $user_name=$_POST['user_name'];
 $password=$_POST['password'];
 
iConnect();
 
 // To protect MySQL injection (more detail about MySQL injection)
$user_name = stripslashes($user_name);
$password = stripslashes($password);
$user_name = mysql_real_escape_string($user_name);
$password = mysql_real_escape_string($password);
 
 // Create query
 $q = "select * from pdm_users where user_name='$user_name' and password='$password' limit 1";
 // Run query

 $r = mysql_query($q);

while($info = mysql_fetch_array( $r )) 
	{ 
	$dbuser_name=$info['user_name'];
	$dbpassword=$info['password'];
	$short_name=$info['short_name'];
	$user_id=$info['id'];
	
	}
 
 if ( $user_name == $dbuser_name && $password == $dbpassword )
 	{
 	// Login good, create session variables
 	//$_SESSION["valid_id"] = $obj->id;
 	$_SESSION["valid_user"] = $_POST["user_name"];
 	$_SESSION["short_name"] = $short_name;
	$_SESSION["user_id"] = $user_id;

 	// Redirect to home page
	echo "success";
 	//Header("Location: home.php");
	//echo "<meta http-equiv='REFRESH' content='0;url=home.php'";
	//echo "Login Sucess" . $_SESSION["valid_user"];
 	}

}
 

?>