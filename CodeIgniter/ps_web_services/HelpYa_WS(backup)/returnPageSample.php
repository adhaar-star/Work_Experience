<?php
/**
 * @author Payfort
 * @copyright Copyright PayFort 2012-2015 
 * @version 1.0 2015-10-11 2:39:41 PM
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once 'classes/PayfortIntegration.php';

$payfortIntegration = new PayfortIntegration();
header('Content-type: application/json');
echo json_encode($_REQUEST);
//echo ($_REQUEST);exit;
//echo 'signature: '.$_REQUEST['signature'];exit;

//check if there are return parameters inside payfort responce (option "Send Response Parameters" should be activated inside your account)
/*if (isset($_REQUEST['signature']) AND !empty($_REQUEST['signature'])) {
    //calculate Signature after back to merchant and comapre it with request Signature 
    $checkReturnSignature = $payfortIntegration->calculateReturnToMerchantSignature('cbqeyr5252', 'sha256');
    
  //echo $checkReturnSignature;exit;
    if ($checkReturnSignature) {
        //valide request
        echo "Response Message : " . $_REQUEST['response_message'];
        echo "<br>";
        echo "Response Code    : " . $_REQUEST['response_code'];
    } else {
        echo "Signature Mismatch";
        
        echo "Response Message : " . $_REQUEST['response_message'];
        echo "<br>";
        echo "Response Code    : " . $_REQUEST['response_code'];
    }

} else {
    //check your (Send Response Parameters) option inside your Technical Settings configration in your Payfort account
}*/

?>