<?php
session_start();

function logout() {
	setcookie("email_cookie", '', time() - 3600);
	setcookie("password_cookie", '', time() - 3600);
	unset($user_info);
	unset($_SESSION['email']);
	
	header("Location: index.php");
}

?>