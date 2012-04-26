<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SchedulePro - Register</title>
</head>

<body>
<h1>Welcome to SchedulePro!</h1>
<h2>Please register below</h2>
<?php 
	// Connects to your Database 
	mysql_connect("localhost", "hackmu", "hackpass") or die(mysql_error()); 
	mysql_select_db("hackmudb") or die(mysql_error()); 

	//This code runs if the form has been submitted
	if (isset($_POST['submit']))
	{ 
		//This makes sure they did not leave any fields blank
		if (!$_POST['username'] | !$_POST['pass'] | !$_POST['pass2'] | !$_POST['school'] | !$_POST['email'])
		{
			die('You did not complete all of the required fields');
		}

		// checks if the username is in use
		if (!get_magic_quotes_gpc())
		{
			$_POST['username'] = addslashes($_POST['username']);
		}
		$usercheck = $_POST['username'];
		$check = mysql_query("SELECT username FROM users WHERE username = '$usercheck'") or die(mysql_error());
		$check2 = mysql_num_rows($check);

		//if the name exists it gives an error
		if ($check2 != 0)
		{
			die('Sorry, the username '.$_POST['username'].' is already in use.');
		}
		
		$emailcheck = $_POST['email'];
		$check = mysql_query("SELECT email FROM users WHERE email = '$emailcheck'") or die(mysql_error());
		$check2 = mysql_num_rows($check);

		//if the name exists it gives an error
		if ($check2 != 0)
		{
			die('Sorry, the email '.$_POST['email'].' is already in use.');
		}

		// this makes sure both passwords entered match
		if ($_POST['pass'] != $_POST['pass2'])
		{
			die('Your passwords did not match. ');
		}

		// here we encrypt the password and add slashes if needed
		$_POST['pass'] = md5($_POST['pass']);
		if (!get_magic_quotes_gpc())
		{
			$_POST['pass'] = addslashes($_POST['pass']);
			$_POST['username'] = addslashes($_POST['username']);
		}

		// now we insert it into the database
		$insert = "INSERT INTO users (email, username, password, school) VALUES ('".$_POST['email']."', '".$_POST['username']."', '".$_POST['pass']."', '".$_POST['school']."')";
		$add_member = mysql_query($insert) or die('Sorry, unable to add users at this time');
?>
		<h1>Registered</h1>

<?php

		echo "<p>Thank you, you are now registered as \"<b>";
		echo $_POST['username'];
		echo "</b>\"- you may now login</a>.</p>";
	} 
	else 
	{ 
?>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table border="0">
            <tr><td>Username:</td><td>
                <input type="text" name="username" maxlength="60">
            </td></tr>
			<tr><td>Email:</td><td>
                <input type="text" name="email" maxlength="128">
            </td></tr>
            <tr><td>Password:</td><td>
                <input type="password" name="pass" maxlength="10">
            </td></tr>
            <tr><td>Confirm Password:</td><td>
                <input type="password" name="pass2" maxlength="10">
            </td></tr>
            <tr><td>University</td><td>
                <select name="school">
					<option value="muohio">Miami University (Oxford)</option>
				</select>
            </td></tr>
            <tr><th colspan=2><input type="submit" name="submit" value="Register"></th></tr>
		</table>
	</form>

<?php
	}
?>
</body>
</html>