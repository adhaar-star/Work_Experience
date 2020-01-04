<?php


if(isset($_POST['email'])){
$email = $_POST['email'];

           
			
	$valueNull="";		


	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {		
			echo "Invalid Email";
	}
else{
$conn=mysql_connect('192.168.2.23','AstroAdmin','Astro-Cooler');
$sql = "SELECT * FROM `login`";
	
	

mysql_select_db('intermodal');
$retval = mysql_query( $sql, $conn );

$num_row = mysql_num_rows($retval);

$email1=array();
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
$email1[]=$row['email'];
}
foreach($email1 as $key=>$value)
{
 if($value==$email)
 {
	$valueNull=$value;
 
}
}
if($valueNull=="")
{
 
function randomPassword()

 {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
$codes=randomPassword();


include('swiftmailer-5.x/lib/swift_required.php');


//$mail->SMTPDebug = 3;                               // Enable verbose debug output




// Create the SMTP configuration
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl");
$transport->setUsername("astrocooler@gmail.com");
$transport->setPassword("astrocooler2112");

$mailer = Swift_Mailer::newInstance($transport);
$message = Swift_Message::newInstance('Astro-Assure credentials')
  ->setFrom(array('info@astrocooler.com' => 'Astro-Cooler'))
  ->setTo(array($email => 'Astro app user'))
  ->setBody('<p><a href="http://astrocooler.com/AstroAssure_pre/">http://astrocooler.com/AstroAssure_pre</a> </p>
<p> Use your email as your username</p>
<p> Your Password is : '.' '.$codes.'</p><img src="http://astrocooler.com/AstroAssure/ac.png" alt="Astro-Cooler" style="text-align:center;">');
   
$message->setContentType("text/html");

if (!$mailer->send($message))
{
  echo "Email could not be sent";
 
}
else{
echo "Email sent successfully";
$query = "INSERT INTO `login` (`name`,`role`,`email`,`pass`,`date`,`time`)
				VALUES ('','','$email','$codes','0000-00-00','00:00:00')";
	$result = mysql_query( $query,$conn)
		or die("Error". mysql_error());

}


   
 
}
  else{
		 
              echo 'This Email id alreday exists.Do you want to send the invite again to this id?'; 
		
   
	 }
 
	}

} 

?>
