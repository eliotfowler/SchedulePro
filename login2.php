<?php

mysql_connect("localhost", "hackmu", "hackpass") or die(mysql_error()); 
mysql_select_db("hackmudb") or die(mysql_error()); 
	
	
$uname = $_POST['username'];
$pw = $_POST['password'];
echo "username is " . $uname . "<br>";
echo "password is " . $pw . "<br>";
if(!$uname | !$pass)
		{
			echo "WTF?";
			//header("Location: login.php"); 
		}
		// checks it against the database

		// This section is errors on incorrect pass
		//if (!get_magic_quotes_gpc())
		//{
		//	$_POST['email'] = addslashes($_POST['email']);
		//}

		$check = mysql_query("SELECT * FROM users WHERE username = '". $uname ."'") or die(mysql_error());

		//Gives error if user dosen't exist
		$check2 = mysql_num_rows($check);
		if ($check2 == 0)
		{
			die('That user does not exist in our database. <a href=register.php>Click Here to Register</a>');
		}
		while($info = mysql_fetch_array( $check )) 
		{
			$pw = stripslashes($_POST['pass']);
			$info['password'] = stripslashes($info['password']);
			$md5pw = md5($pw);

			//gives error if the password is wrong
			if ($md5pw != $info['password'])
			{
				die('Incorrect password, please try again.');
			}
			else 
			{ 
				// if login is ok then we add a cookie 
				$uname = stripslashes($_POST['username']); 
				$hour = time() + 3600; 
				setcookie(ID_my_site, $_POST['username'], $hour); 
				setcookie(Key_my_site, $_POST['pass'], $hour); 

				//then redirect them to the members area 
				header("Location: welcome.php"); 
			} 
		} 
?>