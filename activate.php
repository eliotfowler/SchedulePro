<?php
$email = $_GET['email'];
$act = $_GET['act'];

mysql_connect("localhost", "hackmu", "hackpass") or die(mysql_error()); 
mysql_select_db("hackmudb") or die(mysql_error()); 

$check = mysql_query("SELECT * FROM users WHERE email = '". $email ."'");
$row = mysql_fetch_array( $check );

if($row['activation'] != null){
	if($row['activation'] == $act) {
		mysql_query("UPDATE users SET activation=null WHERE email=". $email . "");
		echo "udating table<br>";
		//header("Location: index.php");
	}
	echo "dont match<br>";
	//else header("Location: incorrect_activation.php");
}
echo "not null";
//else header("Location: index.php");

?>