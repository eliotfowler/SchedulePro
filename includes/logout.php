<?php 

session_start();
setcookie("email_cookie", '', time() - 3600);
setcookie("password_cookie", '', time() - 3600);
unset($user_info);
unset($_SESSION['email']);
session_destroy();

header("Location: index.php");

?>