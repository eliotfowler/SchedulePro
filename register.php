<?php
include_once "lib/swift_required.php";
// we check if everything is filled in

if (empty($_POST['fname'])) { //if no name has been supplied
		die(msg(0,"Please enter a first name"));
	} else {
		$fname = $_POST['fname']; //else assign it a variable
	}
	
	if (empty($_POST['lname'])) { //if no name has been supplied
		die(msg(0,"Please enter a last name"));
	} else {
		$lname = $_POST['lname']; //else assign it a variable
	}
	
	if (empty($_POST['email'])) {
		die(msg(0,"Please enter your email"));
	} else {
		if(!(preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $_POST['email'])))
			die(msg(0,"Please provide a valid email."));
		$email = $_POST['email'];
	}
	
	if (empty($_POST['pass']) || empty($_POST['pass2'])) {
		die(msg(0,"Please enter and confirm your password."));
	} else {
		$pw = $_POST['pass'];
	}
	
	// this makes sure both passwords entered match
	if ($_POST['pass'] != $_POST['pass2'])
	{
		die(msg(0,"Passwords do not match."));
	}

	if(!(int)$_POST['school']) {
		die(msg(0,"Please choose a school."));
	} else $school = "muohio";



// Here you must put your code for validating and escaping all the input data,
// inserting new records in your DB and echo-ing a message of the type:

mysql_connect("localhost", "hackmu", "hackpass") or die(mysql_error()); 
mysql_select_db("hackmudb") or die(mysql_error()); 

$check = mysql_query("SELECT email FROM users WHERE email = '$email'") or die(mysql_error());
$check2 = mysql_num_rows($check);

//if the name exists it gives an error
if ($check2 != 0)
{
	$toSend = "Sorry, the email " . $email . " is already in use.";
	die(msg(0, $toSend));
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
$add_member = mysql_query($insert);

//if(mysql_affected_rows == 1) {
	//send activation
	/*
 * Create the body of the message (a plain-text and an HTML version).
 * $text is your plain-text email
 * $html is your html version of the email
 * If the reciever is able to view html emails then only the html
 * email will be displayed
 */ 
$activation_link = "http://www.schedulepro.eliotfowler.com/dev/SchedulePro/activate.php?email=".$email."&act=".$activation;
$text = "Thank you for registering with SchedulePro!\n Please click the following link to activate your account:\n" . $activation_link . "\n\n\n Thanks,\n SchedulePro";
$html = <<<EOM
<html>
  <head></head>
  <body>
  	$fname $lname,<br>
    Thank you for registering with SchedulePro! <br />
	Please click the following link to activate your account:<br />
    $activation_link
    <br /><br /><br />Thanks,<br />
    SchedulePro
  </body>
</html>
EOM;
 
 
// This is your From email address
$from = array('eliot@SchedulePro.com' => 'SchedulePro');
// Email recipients
$to = array(
  $email=>$fname
);
// Email subject
$subject = 'Welcome to SchedulePro!';
 
// Login credentials
$username = 'SchedulePro';
$password = 'hackpass';
 
// Setup Swift mailer parameters
$transport = Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 587);
$transport->setUsername($username);
$transport->setPassword($password);
$swift = Swift_Mailer::newInstance($transport);
 
// Create a message (subject)
$message = new Swift_Message($subject);
 
// attach the body of the email
$message->setFrom($from);
$message->setBody($html, 'text/html');
$message->setTo($to);
$message->addPart($text, 'text/plain');
 
// send message 
if ($recipients = $swift->send($message, $failures))
{
  // This will let us know how many users received this message
  echo 'Message sent out to '.$recipients.' users';
}
// something went wrong =(
else
{
  echo "Something went wrong - ";
  print_r($failures);
}
//}

//echo msg(0, $recipients);
echo msg(1,"registered.html");


function msg($status,$txt)
{
	return '{"status":'.$status.',"txt":"'.$txt.'"}';
}
?>
