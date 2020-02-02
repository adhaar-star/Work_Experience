<?php
/**
 * Created by PhpStorm.
 * User: c73
 * Date: 15/12/15
 * Time: 5:48 PM
 */

include 'config.php';

//include_once 'paths.php';
//error_reporting(0);
$post_body = file_get_contents('php://input');
$post_body = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($post_body));
$reqData[] = json_decode($post_body);

 print_r($reqData);

$postData = $reqData[0];

$debug = 0;
// $logger -> Log($debug, 'POST DATA :', $postData);
$status = "";

// $logger -> Log($debug, 'Service :', $_REQUEST['Service']);

switch ($_REQUEST['Service'])
{
    case "RegisterUser":
    case "LoginUser":
    case "LoginViaFb":
    case "LoginViaTwitter":
    case "GetUserDetails":
    case "UpdateUserProfile":
    case "ChangePassword":
    case "GetAllSkills":
    case "AddReview":
    case "AddUserSkills":
    case "AddJobDetails":
    case "GetAllJobsForFreelancer":
    case "UpdateCompletedJob":
    case "UpdatePaidJob":
    case "AcceptJob":
    case "RejectJob":
    case "ForgotPassword":
    case "GetAllReviews":
    case "GetEligibleFreelancers":
    case "Logout":
    case "GetEmployerRequests":
    case "GetAllJobsForFreelancerDashboard":
    case "GetAllJobsForEmployerDashboard":
    case "UpdateDeviceToken":
    case "MakePayment":
    case "UpdateRequestForJob":
    case "UpdatePaymentRequestForJob":
    case "UpdateReleaseRequestForJob":
    case "AddBankInfo":
    case "GetAllBanks":
    case "GetFinanceList":
    case "AddComplaints":
    case "CancelJob":
    case "GetNotification":
    case "DeleteSeenNotification":
    case "GetCustomAds";
    {
        include_once 'HelpYaFunctions.php';
        $user = new HelpYaFunctions();

        $data = $user->call_service($_REQUEST['Service'], $postData);
    }
        break;

    default:
    {
        $data['data'] = 'No Service Found';
        $data['message'] = 'No Service Found';
    }
        break;
}

echo json_encode($data);

?>