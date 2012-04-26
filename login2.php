<?php

mysql_connect("localhost", "hackmu", "hackpass") or die(mysql_error()); 
mysql_select_db("hackmudb") or die(mysql_error()); 
	
$isuname = false;
$login_name = $_POST['login_name'];
$pw = $_POST['password'];
echo "login_name is " . $uname . "<br>";
echo "password is " . $pw . "<br>";
if(!$uname | !$pass)
{
	header("Location: login.php"); 
}

// checks it against the database
$check = mysql_query("SELECT * FROM users WHERE username = '". $login_name ."'") or die(mysql_error());

//Gives error if user dosen't exist
$check2 = mysql_num_rows($check);
if ($check2 == 0)
{
	$check = mysql_query("SELECT * FROM users WHERE email = '". $login_name ."'") or die(mysql_error());
	$check3 = mysql_num_rows($check);
	if($check3 == 0) {
		header("Location: login.php"); 
	}
	
}
else $isuname = true;
while($info = mysql_fetch_array( $check )) 
{
	$pw = stripslashes($pw);
	$info['password'] = stripslashes($info['password']);
	$md5pw = md5($pw);

	//gives error if the password is wrong
	if ($md5pw != $info['password'])
	{
		header("Location: login.php");
	}
	else 
	{ 
		if($isuname) {
			$getemail = mysql_query("SELECT * FROM users WHERE username = '". $login_name ."'") or die(mysql_error());
			$user_arr = mysql_fetch_array($getemail);
			$email = $user_arr['email'];
		}
		// if login is ok then we add a cookie 
		$email = stripslashes($email); 
		$hour = time() + 3600; 
		setcookie(email_cookie, $email, $hour); 
		setcookie(password_cookie, $info['password'], $hour); 

		//then redirect them to the members area 
		header("Location: welcome.php"); 
	} 
} 
?>