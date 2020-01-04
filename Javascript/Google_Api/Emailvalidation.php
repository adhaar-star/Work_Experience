<?php
if(($_GET['username'])!=""){

    $username = $_GET['username'];
include('dbconnection.php');	
    $query="select * from login where email='$username'";

 $retval = mysql_query( $query, $c );
    $count=mysql_num_rows($retval);

    // If the count is equal to one, we will send message other wise display an error message.

    if($count==1)

    {

        $rows=mysql_fetch_array($retval);

        $pass  =  $rows['pass'];//FETCHING PASS


   include('swiftmailer-5.x/lib/swift_required.php');

// Create the SMTP configuration
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl");
$transport->setUsername("astrocooler@gmail.com");
$transport->setPassword("astrocooler2112");

// Create the message


$mailer = Swift_Mailer::newInstance($transport);
$message = Swift_Message::newInstance('Astro-Assure credentials')
  ->setFrom(array('info@astrocooler.com' => 'Astro-Cooler'))
  ->setTo(array($username => 'Astro app user'))
  ->setBody('<p><a href="http://astrocooler.com/AstroAssure_pre/">http://astrocooler.com/AstroAssure_pre</a> </p>
<p> Use your email as your username</p>
<p> Your Password is : '.' '.$pass.'</p><img src="http://astrocooler.com/AstroAssure/ac.png" alt="Astro-Cooler" style="text-align:center;">');
//$attachment = Swift_Attachment::newInstance(file_get_contents('path/logo.png'), 'logo.png');  
//$message->attach($attachment);
$message->setContentType("text/html");

if (!$mailer->send($message))
{
  echo "Email could not be sent";
 
}
else{
echo "Email sent successfully";
}
   


	}
	else
	{
		 
    echo    'Email Not Found in the Database'; 
      
    
	}

}
else
{
echo 'Please Enter your Email address';
}
?>
