<?php
include('swiftmailer-5.x/lib/swift_required.php');
if(isset($_POST['feedback'])){
$feedback = $_POST['feedback'];
$email = $_POST['email'];
           

// Create the SMTP configuration
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl");
$transport->setUsername("astrocooler@gmail.com");
$transport->setPassword("astrocooler2112");

// Create the message


$mailer = Swift_Mailer::newInstance($transport);
$message = Swift_Message::newInstance('Astro app feedback')
  ->setFrom(array('spencer@astrocooler.com' => $email))
  ->setTo(array('spencer@astrocooler.com' => 'Astro app user'))
    
->setBody('Astro App user with email:-'.'<br>'.$email.'<br>'.'Sent Submitted  feedback :'.'<br>'.$feedback);
//$attachment = Swift_Attachment::newInstance(file_get_contents('path/logo.png'), 'logo.png');  
//$message->attach($attachment);
$message->setContentType("text/html");

if (!$mailer->send($message))
{
  echo "Feedback could not be sent";
 
}
else{
echo "Feedback sent successfully";
}

   
   



   }
 

  
 
	



?>
