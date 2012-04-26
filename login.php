<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SchedulePro - Welcome</title>
</head>

<body>
<h2>Incorrect login or password!</h2>
<?php 
	// Connects to your Database 
	mysql_connect("localhost", "hackmu", "hackpass") or die(mysql_error()); 
	mysql_select_db("hackmudb") or die(mysql_error()); 

	//Checks if there is a login cookie
	if(isset($_COOKIE['ID_my_site'])) //if there is, it logs you in and directes you to the members page
	
	{ 
		$login_name = $_COOKIE['email_cookie']; 
		$pass = $_COOKIE['password_cookie'];
		$check = mysql_query("SELECT * FROM users WHERE username = '$username'") or die(mysql_error());
		
		while($info = mysql_fetch_array( $check )) 
		{
			if ($pass != $info['password']) 
			{
				header("Location: index.html");
			}
			else
			{
				header("Location: welcome.php");

			}
		}
	}
?>
 
		<form action="login2.php" method="post"> 
			<table border="0"> 
				<tr><td colspan=2><h1>Login</h1></td></tr> 
				<tr><td>Username/Email:</td><td> 
					<input type="text" name="login_name" maxlength="40"> 
				</td></tr> 
				<tr><td>Password:</td><td> 
					<input type="password" name="login_name" maxlength="50"> 
				</td></tr> 
				<tr><td colspan="2" align="right"> 
					<input type="submit" name="submit" value="Login"> 
				</td></tr> 
			</table> 
		</form>
		<br>
		Not yet registered? <a href="register.php">Click here to register.</a>
</body>
</html>