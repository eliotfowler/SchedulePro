<?php

mysql_connect("localhost", "hackmu", "hackpass") or die(mysql_error()); 
mysql_select_db("hackmudb") or die(mysql_error()); 
	
$login_name = $_POST['login_name'];
$pw = $_POST['password'];

if(!$login_name | !$pass)
{
	echo $login_name . " " . $pw;
	//header("Location: login.php"); 
}

// checks it against the database
	
$check = mysql_query("SELECT * FROM users WHERE email = '". $login_name ."'") or die(mysql_error());
$check2 = mysql_num_rows($check);
if($check2 == 0) {
	//header("Location: login.php"); 
}
	
//}
while($user_info = mysql_fetch_array( $check )) 
{
	$pw = stripslashes($pw);
	$user_info['password'] = stripslashes($info['password']);
	$md5pw = md5($pw);

	//gives error if the password is wrong
	if ($md5pw != $info['password'])
	{	
		echo "pw no match";
		//header("Location: login.php");
	}
	else 
	{ 
		$email = $user_info['email'];
		// if login is ok then we add a cookie 
		$email = stripslashes($email); 
		$hour = time() + 3600; 
		setcookie(email_cookie, $email, $hour); 
		setcookie(password_cookie, $pw, $hour); 

		//then redirect them to the members area 
		header("Location: welcome.php"); 
	} 
} 
?>