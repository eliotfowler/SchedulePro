<?php
session_start();
session_regenerate_id();
if(empty($_SESSION['email'])) {
	if(empty($_COOKIE['email'])) {
		header("Location: index.php");
	}
	else {
		$_SESSION['email'] = $_COOKIE['email'];	
	}
}

mysql_connect("localhost", "hackmu", "hackpass") or die(mysql_error()); 
mysql_select_db("hackmudb") or die(mysql_error()); 

$check = mysql_query("SELECT * FROM users WHERE email = '". $_SESSION['email'] ."'");

if(mysql_num_rows($check) == 0) {
	logout();	
}

function logout() {
	setcookie("email_cookie", '', time() - 3600);
	setcookie("password_cookie", '', time() - 3600);
	unset($user_info);
	unset($_SESSION['email']);
	
	header("Location: index.php");
}

?>