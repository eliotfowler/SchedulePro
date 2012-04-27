<?php

// we check if everything is filled in

if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['email']) || empty($_POST['pass']))
{
	die(msg(0,"All the fields are required"));
}


// is the sex selected?

if(!(int)$_POST['sex-select'])
{
	die(msg(0,"You have to select your sex"));
}


// is the birthday selected?

if(!(int)$_POST['day'] || !(int)$_POST['month'] || !(int)$_POST['year'])
{
	die(msg(0,"You have to fill in your birthday"));
}


// is the email valid?

if(!(preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $_POST['email'])))
	die(msg(0,"You haven't provided a valid email"));



// Here you must put your code for validating and escaping all the input data,
// inserting new records in your DB and echo-ing a message of the type:

// echo msg(1,"/member-area.php");

// where member-area.php is the address on your site where registered users are
// redirected after registration.




echo msg(1,"registered.html");


function msg($status,$txt)
{
	return '{"status":'.$status.',"txt":"'.$txt.'"}';
}
?>
