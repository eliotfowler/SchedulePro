<?php
 
include_once "lib/swift_required.php";
include_once "ipcheck.php";
 
function send() {
/*
 * Create the body of the message (a plain-text and an HTML version).
 * $text is your plain-text email
 * $html is your html version of the email
 * If the reciever is able to view html emails then only the html
 * email will be displayed
 */ 

$clientinfo = geoCheckIP();

$text = "Your class is almost full!\n";
$html = <<<EOM
<html>
  <head></head>
  <body>
    <p>AH CLASS FULL!<br>
       YOUR CLASS HAS ONLY 1 SPOT LEFT! DO SOMETHING! REGISTER!<br>
	<?php echo "hi" . $clientinfo['domain']; ?> <BR>
    </p>
  </body>
</html>
EOM;
 
 
    // This is your From email address
    $from = array('eliot@SchedulerPro.com' => 'SchedulerPro');
    // Email recipients
    $to = array(
    'fowlerje@muohio.edu'=>'Eliot Fowler',
    'eliot.fowler@gmail.com'=>'Eliot Fowler'
    );
    // Email subject
    $subject = 'Your class is almost full!';

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
}
