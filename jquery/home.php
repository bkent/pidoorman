<?php
session_start();

if (!isset($_SESSION["valid_user"]))
{
// User not logged in, redirect to login page
header("Location: index.html");
exit();
}

$user_id = $_SESSION["user_id"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/search_results.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<title>PiDoorMan</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<?php
include "functions.php";

echo "<table border='0' align='center'>
<form name='form1' action='new_ticket.php' method='get'>
<tr><td><img src='./images/pidoorman.png' alt='PiDoorMan' title='PiDoorMan' height='20px' /></td><td>&nbsp; &nbsp; &nbsp; &nbsp; </td>
<td>";
echo "Logged in as: <b>" . $_SESSION["short_name"] . "</b>";
echo "</td><td>&nbsp; &nbsp; &nbsp; &nbsp; </td><td><b>New Ticket for:</b></td>
<td><select name='site'>
<option value='noselection' >&#60;Please Select...&#62;</option>";

iConnect(); 
$data = mysql_query("SELECT * FROM `ROM_site` ORDER BY `ROM_site`.`name` ASC") or die(mysql_error());

while($info = mysql_fetch_array( $data )) 
{ 
$name=$info['name'];
$site_id=$info['id'];
echo "<option value='$site_id' >$name</option>";
}
echo "</select></td>
<td align='left'><input type='submit' name='Submit' value='  Go  ' /></form></td>
<td>&nbsp; &nbsp; &nbsp; &nbsp; </td><td>
<form name='form2' action='new_site.php' method='get'>
<td align='right'><input type='submit' name='Submit' value='Add New Site' /></form></td>
</td>
<td>
<form name='form3' action='new_installer.php' method='get'>
<td align='right'><input type='submit' name='Submit' value='Add New Installer' /></form></td>
</td>
<td>
<form name='form4' action='new_engineer.php' method='get'>
<td align='right'><input type='submit' name='Submit' value='Add New Engineer' /></form></td>
</td>
<td>
<form name='form5' action='reports.php' method='get'>
<td align='right'><input type='submit' name='Submit' value='Find Ticket(s)' /></form></td>
</td></tr>";

$my_tickets = "<table border='0' align='center'>";

$data1 = mysql_query("SELECT * FROM `ROM_ticket` WHERE `ROM_ticket`.`user_id` = '$user_id' 
AND `ROM_ticket`.`status` = '1' OR `ROM_ticket`.`status` = '2' ORDER BY `ROM_ticket`.`open_date` ASC") or die(mysql_error());

$my_num_tickets = mysql_num_rows($data1);

while($info = mysql_fetch_array( $data1 )) 
	{
	$my_id = $info['id'];
	$my_site_id = $info['site_id'];
	$my_reference = $info['reference'];
	$my_status = $info['status'];
	$datetime = $info['open_date'];
	
	//Relate site ID to site name
$data2 = mysql_query("SELECT `ROM_site`.`name` FROM `ROM_site` WHERE `ROM_site`.`id` = '$my_site_id'") or die(mysql_error());
while($info = mysql_fetch_array( $data2 )) 
{ 
$my_site=$info['name'];
}
	
	$my_ukdate = date('d/m/Y',strtotime($datetime));
	$my_time = date('H:i',strtotime($datetime));

	if($my_status==2)
	{
	//Ticket is Defcon#1, colour the table red
	$my_status="Defcon#1";
	$colour="bgcolor='red'";
	}
	
	elseif($my_status==1)
	{
	//Ticket is pending, colour the table yellow
	$my_status="Pending";
	$colour="bgcolor='yellow'";
	}
	
	$my_tickets .= "<tr bgcolor='#D3D3D3'><td align='left' colspan='2'>&nbsp;<a href='edit_ticket.php?id=$my_id'>$my_reference</a></td>";
	$my_tickets .= "<tr><td align='right'><b>Opened: </b></td><td>$my_ukdate $my_time</td></tr>";
	$my_tickets .= "<tr><td align='right'><b>Site: </b></td><td>$my_site</td></tr>";
	$my_tickets .= "<tr $colour><td align='center' colspan='2'><b><font color='white'>$my_status</font></b></td></tr><tr><td colspan= '2'><br /><br /></td></tr>";

	}
$my_tickets .= "</table>";

$all_tickets = "<table border='0' align='center'>";

$data3 = mysql_query("SELECT * FROM `ROM_ticket` WHERE `ROM_ticket`.`status` = '1' 
OR `ROM_ticket`.`status` = '2' ORDER BY `ROM_ticket`.`open_date` ASC") or die(mysql_error());

$all_num_tickets = mysql_num_rows($data3);

while($info = mysql_fetch_array( $data3 )) 
	{
	$all_id = $info['id'];
	$all_site_id = $info['site_id'];
	$all_reference = $info['reference'];
	$all_status = $info['status'];
	$datetime = $info['open_date'];
	
	//Relate site ID to site name
$data4 = mysql_query("SELECT `ROM_site`.`name` FROM `ROM_site` WHERE `ROM_site`.`id` = '$all_site_id'") or die(mysql_error());
while($info = mysql_fetch_array( $data4 )) 
{ 
$all_site=$info['name'];
}
	
	$all_ukdate = date('d/m/Y',strtotime($datetime));
	$all_time = date('H:i',strtotime($datetime));

	if($all_status==2)
	{
	//Ticket is Defcon#1, colour the table red
	$all_status="Defcon#1";
	$colour="bgcolor='red'";
	}
	
	elseif($all_status==1)
	{
	//Ticket is pending, colour the table yellow
	$all_status="Pending";
	$colour="bgcolor='yellow'";
	}
	
	$all_tickets .= "<tr bgcolor='#D3D3D3'><td align='left' colspan='2'>&nbsp;<a href='edit_ticket.php?id=$all_id'>$all_reference</a></td>";
	$all_tickets .= "<tr><td align='right'><b>Opened: </b></td><td>$all_ukdate $all_time</td></tr>";
	$all_tickets .= "<tr><td align='right'><b>Site: </b></td><td>$all_site</td></tr>";
	$all_tickets .= "<tr $colour><td align='center' colspan='2'><b><font color='white'>$all_status</font></b></td></tr><tr><td colspan= '2'><br /><br /></td></tr>";

	}
$all_tickets .= "</table>";

$def_tickets = "<table border='0' align='center'>";

$data5 = mysql_query("SELECT * FROM `ROM_ticket` WHERE `ROM_ticket`.`status` = '2' ORDER BY `ROM_ticket`.`open_date` ASC") or die(mysql_error());

$def_num_tickets = mysql_num_rows($data5);

while($info = mysql_fetch_array( $data5 )) 
	{
	$def_id = $info['id'];
	$def_site_id = $info['site_id'];
	$def_reference = $info['reference'];
	$def_status = $info['status'];
	$datetime = $info['open_date'];
	
	//Relate site ID to site name
$data6 = mysql_query("SELECT `ROM_site`.`name` FROM `ROM_site` WHERE `ROM_site`.`id` = '$def_site_id'") or die(mysql_error());
while($info = mysql_fetch_array( $data6 )) 
{ 
$def_site=$info['name'];
}
	
	$def_ukdate = date('d/m/Y',strtotime($datetime));
	$def_time = date('H:i',strtotime($datetime));

	if($def_status==2)
	{
	//Ticket is Defcon#1, colour the table red
	$def_status="Defcon#1";
	$colour="bgcolor='red'";
	}
	
	$def_tickets .= "<tr bgcolor='#D3D3D3'><td align='left' colspan='2'>&nbsp;<a href='edit_ticket.php?id=$def_id'>$def_reference</a></td>";
	$def_tickets .= "<tr><td align='right'><b>Opened: </b></td><td>$def_ukdate $def_time</td></tr>";
	$def_tickets .= "<tr><td align='right'><b>Site: </b></td><td>$def_site</td></tr>";
	$def_tickets .= "<tr $colour><td align='center' colspan='2'><b><font color='white'>$def_status</font></b></td></tr><tr><td colspan= '2'><br /><br /></td></tr>";

	}
$def_tickets .= "</table>";

$closed_tickets = "<table border='0' align='center'>";

$data5 = mysql_query("SELECT * FROM `ROM_ticket` WHERE `ROM_ticket`.`status` = '0' ORDER BY `ROM_ticket`.`closed_date` DESC LIMIT 8") or die(mysql_error());

while($info = mysql_fetch_array( $data5 )) 
	{
	$closed_id = $info['id'];
	$closed_site_id = $info['site_id'];
	$closed_reference = $info['reference'];
	$closed_status = $info['status'];
	$datetime = $info['closed_date'];
	
	//Relate site ID to site name
$data6 = mysql_query("SELECT `ROM_site`.`name` FROM `ROM_site` WHERE `ROM_site`.`id` = '$closed_site_id'") or die(mysql_error());
while($info = mysql_fetch_array( $data6 )) 
{ 
$closed_site=$info['name'];
}
	
	$closed_ukdate = date('d/m/Y',strtotime($datetime));
	$closed_time = date('H:i',strtotime($datetime));

	if($closed_status==0)
	{
	//Ticket is Defcon#1, colour the table red
	$closed_status="Closed";
	$colour="bgcolor='#00FF33'";
	}
	
	$closed_tickets .= "<tr bgcolor='#D3D3D3'><td align='left' colspan='2'>&nbsp;<a href='edit_ticket.php?id=$closed_id'>$closed_reference</a></td>";
	$closed_tickets .= "<tr><td align='right'><b>Closed: </b></td><td>$closed_ukdate $closed_time</td></tr>";
	$closed_tickets .= "<tr><td align='right'><b>Site: </b></td><td>$closed_site</td></tr>";
	$closed_tickets .= "<tr $colour><td align='center' colspan='2'><b><font color='white'>$closed_status</font></b></td></tr><tr><td colspan= '2'><br /><br /></td></tr>";

	}
$closed_tickets .= "</table>";

echo "<tr><td colspan='16'>&nbsp;</td></tr>
<tr><td colspan='4' align='center'><b>" . $_SESSION["short_name"] . "'s Open Tickets ($my_num_tickets)</b></td>
<td colspan='4' align='center'><b>All Open Tickets ($all_num_tickets)</b></td>
<td colspan='4' align='center'><b>DEFCON#1 Tickets ($def_num_tickets)</b></td>
<td colspan='4' align='center'><b>Recently Closed</b></td></tr>
<tr><td colspan='4' align='center' valign='top'>$my_tickets</b></td>
<td colspan='4' align='center' valign='top'>$all_tickets</td>
<td colspan='4' align='center' valign='top'>$def_tickets</td>
<td colspan='4' align='center' valign='top'>$closed_tickets</td></tr></table>";
?>
</body>
</html>
