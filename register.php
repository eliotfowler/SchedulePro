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

	//This code runs if the form has been submitted
	if (isset($_POST['submit']))
	{ 
		$error = array(); //Declare An Array to store any error message
		
		if (empty($_POST['fname'])) { //if no name has been supplied
			$error[] = 'Please enter a first name '; //add to array "error"
		} else {
			$fname = $_POST['fname']; //else assign it a variable
		}
		
		if (empty($_POST['lname'])) { //if no name has been supplied
			$error[] = 'Please enter a last name '; //add to array "error"
		} else {
			$fname = $_POST['lname']; //else assign it a variable
		}
		
		if (empty($_POST['e-mail'])) {
			$error[] = 'Please Enter your Email ';
		} else {
			if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['e-mail'])) {
				//regular expression for email validation
				$email = $_POST['email'];
			} else {       
				$error[] = 'Please enter a valid email address.';
			}
		}
		
		if (empty($_POST['pass']) || empty($_POST['pass2'])) {
			$error[] = 'Please enter Your password ';
		} else {
			$pw = $_POST['pass'];
		}
		
		if (empty($_POST['school'])) {
			$error[] = 'Please pick a school.';
		} else {
			$school = $_POST['school'];
		}
		
		// this makes sure both passwords entered match
		if ($_POST['pass'] != $_POST['pass2'])
		{
			$error[] = 'Passwords do not match.';
		}

		if (empty($error)) { //send to database if there's no error
			mysql_connect("localhost", "hackmu", "hackpass") or die(mysql_error()); 
			mysql_select_db("hackmudb") or die(mysql_error()); 

		
			$emailcheck = $email;
			$check = mysql_query("SELECT email FROM users WHERE email = '$emailcheck'") or die(mysql_error());
			$check2 = mysql_num_rows($check);

			//if the name exists it gives an error
			if ($check2 != 0)
			{
				die('Sorry, the email '.$email.' is already in use.');
			}
			
			$activation = md5(uniqid(rand(), true));
			
			// here we encrypt the password and add slashes if needed
			$pw = md5($_POST['pass']);
			if (!get_magic_quotes_gpc())
			{
				$pw = addslashes($pw);
			}

			// now we insert it into the database
			$insert = "INSERT INTO users (fname, lname, email, password, school, activation) VALUES ('".$fname."', '".$lname."', '".$email."', '".$pw."', '".$school."', '".$activation."')";
			$add_member = mysql_query($insert) or die('Sorry, unable to add users at this time');
			
			if(mysql_affected_rows == 1) {
				//send activation
			}
			
		} else {
			echo '<ol>';
			foreach ($error as $key => $values) {
				echo '  <li>' . $values . '</li>';
			}
			echo '</ol>';
		}
		
?>
		<h1>Registered</h1>

<?php

		echo "<p>Thank you, you are now registered as \"<b>";
		echo $email;
		echo "</b>\"- you may now login</a>.</p>";
	} 
	else 
	{ 
?>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table border="0">
            <tr><td>First Name:</td><td>
                <input type="text" name="fname" maxlength="45">
            </td></tr>
            <tr><td>Last Name:</td><td>
                <input type="text" name="lname" maxlength="45">
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