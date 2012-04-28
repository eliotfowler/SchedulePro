<?php

// we check if everything is filled in

if (empty($_POST['fname'])) { //if no name has been supplied
		die(msg(0,"Please enter a first name"));
	} else {
		$fname = $_POST['fname']; //else assign it a variable
	}
	
	if (empty($_POST['lname'])) { //if no name has been supplied
		die(msg(0,"Please enter a last name"));
	} else {
		$fname = $_POST['lname']; //else assign it a variable
	}
	
	if (empty($_POST['e-mail'])) {
		die(msg(0,"Please enter your email"));
	} else {
		if(!(preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $_POST['email'])))
			die(msg(0,"Please provide a valid email."));
	}
	
	if (empty($_POST['pass']) || empty($_POST['pass2'])) {
		die(msg(0,"Please enter and confirm your password."));
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
		die(msg(0,"Passwords do not match."));
	}

	if(!(int)$_POST['school']) {
		die(msg(0,"Please choose a school."));
	}



// Here you must put your code for validating and escaping all the input data,
// inserting new records in your DB and echo-ing a message of the type:

mysql_connect("localhost", "hackmu", "hackpass") or die(mysql_error()); 
mysql_select_db("hackmudb") or die(mysql_error()); 

$check = mysql_query("SELECT email FROM users WHERE email = '$email'") or die(mysql_error());
$check2 = mysql_num_rows($check);

//if the name exists it gives an error
if ($check2 != 0)
{
	$toSend = 'Sorry, the email '.$email.' is already in use.';
	die(msg(0, $toSend);
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

// echo msg(1,"/member-area.php");

// where member-area.php is the address on your site where registered users are
// redirected after registration.




echo msg(1,"registered.html");


function msg($status,$txt)
{
	return '{"status":'.$status.',"txt":"'.$txt.'"}';
}
?>
