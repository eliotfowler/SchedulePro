<?php include_once "lib/swift_required.php";
mysql_connect("localhost", "hackmu", "hackpass") or die(mysql_error()); 
mysql_select_db("hackmudb") or die(mysql_error()); 

$query = mysql_query("SELECT email, users.uid, crn, fname, lname
					  FROM users, watch_list
					  WHERE users.uid = watch_list.uid");

$qresult = mysql_fetch_assoc($query);

$pinged = array();

$file=fopen("/var/www/dev/SchedulePro/cse_list","r");
while(!feof($file))
{
	$line = split(",",fgets($file));
	$pinged[] = $line;
}

fclose($file);
foreach ($qresult as $qkey => $qvalue) {
	foreach ($pinged as $pkey => $pvalue) {
			if($pvalue[0] == $qvalue['crn']) {
				if($pvalue[2] - $pvalue[1] > 0 && $qresult['sent'] == 0) {
					//send email
					/*
 * Create the body of the message (a plain-text and an HTML version).
 * $text is your plain-text email
 * $html is your html version of the email
 * If the reciever is able to view html emails then only the html
 * email will be displayed
 */ 
$text = "The class with crn " . $qvalue['crn'] . " has at least a spot open in it! Quick, go to bannerweb and sign up!!!";
$html = <<<EOM
<html>
  <head></head>
  <body>
	$fname $lname,<br>
	A class you added to your watch list has opened up! <br />
	Class with crn $pvalue[0] has at least a spot open! Quick go to <a href="https://www.bannerweb.muohio.edu">BannerWeb</a> and sign up! <BR />
	<br /><br /><br />Thanks,<br />
	SchedulePro
  </body>
</html>
EOM;
 
 
// This is your From email address
$from = array('eliot@SchedulePro.com' => 'SchedulePro');
// Email recipients
$to = array(
  $qresult['email']=>$qresult['fname']
);
// Email subject
$subject = 'Class has opened up!';
 
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
					//notify the database that the email was sent	
					$uquery = mysql_query("UPDATE watch_list
					  					   SET sent = 1
					  					   WHERE crn = '".$pvalue[0]."' AND uid = '".$qresult['uid']."'");
					
				}
			}
	}
}

?>