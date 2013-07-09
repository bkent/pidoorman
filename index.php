<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="./images/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="./css/pidoorman.css">
<script type="text/javascript" src="./jquery/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	
	$("#login").click(function() {
	
		var action = $("#form").attr('action');
		var form_data = {
			user_name: $('#user_name').val(),
			password: $("#password").val(),
			is_ajax: 1
		};
		
		$.ajax({
			type: "POST",
			url: action,
			data: form_data,
			success: function(response)
			{
				if(response == 'success')
					$("#form").slideUp('slow', function() {
						$("#message").html("<p><font color='green'>Thank you</font></p>");
						top.location.href='home.php';
					});
				else
					$("#message").html("<p><font color='red'>Invalid Password.</p>");	
			}
		});
		
		return false;
	});
	
});
</script>
</head>
<title>PiDoorMan Access Control</title>
<body OnLoad="document.form.user_name.focus();"><font face="arial">
<br /><br /><br /><br /><br /><table width="300" border="2" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form" id="form" method="post" action="login.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3" align="center" ><img src="./images/pidoorman.png" alt="PiDoorMan" title="PiDoorMan"  /></td>
</tr>
<tr>
<td width="78"><b>Username</b></td>
<td width="6">:</td>
<td width="294"><input id="user_name" name="user_name" size="40%" /></td>
</tr>
<tr>
<td><b>Password</b></td>
<td>:</td>
<td><input type="password" name="password" id="password" size="40%" /></td>
</tr>
<tr>
<td colspan="2"><i><font color="#C0C0C0">v 1.0</font></i></td>
<td align="center"><input type="submit" value="Login" name="login" id="login" class="button" /></td>
</tr>
<tr><td colspan="3"><div id="message" align="center"></div></td></tr>
</table>
</td>
</form>
</tr>
</table>
</font></body>
</html>