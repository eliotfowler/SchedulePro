<?php 
include_once "lib/swift_required.php";
$email = $_GET['email'];

mysql_connect("localhost", "hackmu", "hackpass") or die(mysql_error()); 
mysql_select_db("hackmudb") or die(mysql_error()); 

$check = mysql_query("SELECT * FROM users WHERE email = '". $email ."'");
$row = mysql_fetch_array( $check );

$activation = $row['activation'];

$activation_link = "http://www.schedulepro.eliotfowler.com/dev/SchedulePro/activate.php?email=".$email."&act=".$activation;
$text = "Here is your requested activation link:\n Please click the following link to activate your account:\n" . $activation_link . "\n\n\n Thanks,\n SchedulePro";
$html = <<<EOM
<html>
  <head></head>
  <body>
  	$fname $lname,<br>
    Here is your requested activation link. <br />
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
$to = array($email=>$row['fname']);
// Email subject
$subject = 'Your requested activation code';
 
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
  echo 'Message sent out to '.$recipients.' users <BR>Please check your email and follow the link to activate your account.';
}
// something went wrong =(
else
{
  echo "Something went wrong - ";
  print_r($failures);
}

?>