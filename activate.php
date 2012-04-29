<?php
$email = $_GET['email'];
$act = $_GET['act'];

mysql_connect("localhost", "hackmu", "hackpass") or die(mysql_error()); 
mysql_select_db("hackmudb") or die(mysql_error()); 

$check = mysql_query("SELECT * FROM users WHERE email = '". $email ."'");
$row = mysql_fetch_array( $check );

if($row['activation'] != null){
	if($row['activation'] == $act) {
		mysql_query("UPDATE users SET activation=null WHERE email='". $email . "'");
		header("Location: index.php");
	}
	else { ?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
      		<head>
        		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        		<title>Incorrect Activation</title>
        	</head>
        
       		<body>
        		<h2>Either you have not activated your account or you attempted to activate it with the wrong key.</h2>
        		<h3><a href="incorrect_activation?email=<? echo $email; ?>" Click here to resend the activation email. </a>
        	</body>
        </html>


<?
	}
}	
else header("Location: index.php");

?>