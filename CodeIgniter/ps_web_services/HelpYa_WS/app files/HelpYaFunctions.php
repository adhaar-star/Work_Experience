<?php
/**
 * Created by PhpStorm.
 * User: c73
 * Date: 15/12/15
 * Time: 5:49 PM
 */

require_once('HelperFunctions.php');
require_once('class.phpmailer.php');
require_once('class.smtp.php');

class HelpYaFunctions
{
    function __construct()
    {

    }

    function connection()
    {

        $server = "localhost";
        $user = "helpyaap_helpya";
        $password = "He@mysecret1000.cO";

        $dbName = 'helpyaap_HelpYaApp';
        $con = mysql_pconnect($server, $user, $password);

        mysql_set_charset('utf8', $con);

        if (!$con) {
            die('Database does not connect: ' . mysql_error());
        } else {
            mysql_select_db($dbName, $con);

        }
    }

    function getDefaultDate()
    {
        return date('Y-m-d H:i:s');
    }


    public function call_service($service, $postData)
    {
        //$this->markAllPassedJobsAsRejected();exit;
        switch ($service)
        {
            case "RegisterUser":
            {
                //return $this->loginStudent($postData);
                return $this->RegisterUser($postData);
            }
                break;

            case "LoginUser":
            {
                return $this->LoginUser($postData);
            }
                break;

            case "LoginViaFb":
            {
                //return $this->loginStudent($postData);
                return $this->LoginViaFb($postData);
            }
                break;

            case "LoginViaTwitter":
            {
                //return $this->loginStudent($postData);
                return $this->LoginViaTwitter($postData);
            }
                break;

            case "GetUserDetails":
            {
                return $this->GetUserDetails($postData);
            }
                break;

            case "UpdateUserProfile":
            {
                return $this->UpdateUserProfile($postData);
            }
                break;

            case "ChangePassword":
            {
                return $this->ChangePassword($postData);
            }
                break;
            case "GetAllSkills":
            {
                return $this->GetAllSkills();
            }
                break;
            case "AddReview":
            {
                return $this->AddReview($postData);
            }
                break;
            case "AddUserSkills":
            {
                return $this->AddUserSkills($postData);
            }
                break;
            case "AddJobDetails":
            {
                return $this->AddJobDetails($postData);
            }
                break;
            case "GetAllJobsForFreelancer":
            {
                return $this->GetAllJobsForFreelancer($postData);
            }
                break;
            case "AcceptJob":
            {
                return $this->AcceptJob($postData);
            }
                break;
            case "RejectJob":
            {
                return $this->RejectJob($postData);
            }
                break;
            case "UpdateCompletedJob":
            {
                return $this->UpdateCompletedJob($postData);
            }
                break;
            case "UpdatePaidJob":
            {
                return $this->UpdatePaidJob($postData);
            }
                break;
            case "ForgotPassword":
            {
                return $this->ForgotPassword($postData);
            }
                break;
            case "GetAllReviews":
            {
                return $this->GetAllReviews($postData);
            }
                break;
            case "GetEligibleFreelancers":
            {
                return $this->GetEligibleFreelancers($postData);
            }
                break;
            case "Logout":
            {
                return $this->Logout($postData);
            }
                break;
            case "GetEmployerRequests":
            {
                return $this->GetEmployerRequests($postData);
            }
                break;
            case "GetAllJobsForFreelancerDashboard":
            {
                return $this->GetAllJobsForFreelancerDashboard($postData);
            }
                break;
            case "GetAllJobsForEmployerDashboard":
            {
                return $this->GetAllJobsForEmployerDashboard($postData);
            }
                break;
            case "UpdateDeviceToken":
            {
                return $this->UpdateDeviceToken($postData);
            }
                break;                
            case "MakePayment":
            {
            	return $this->MakePayment($postData);
            }
            	break;
             case "UpdateRequestForJob":
            {
            	return $this->UpdateRequestForJob($postData);
            }
            	break;            	
            case "UpdatePaymentRequestForJob":
            {
            	return $this->UpdatePaymentRequestForJob($postData);
            }
            	break;            	
            case "UpdateReleaseRequestForJob":
            {
            	return $this->UpdateReleaseRequestForJob($postData);
            }
            	break;
            case "AddBankInfo":
            {
            	return $this->addBankInfo($postData);
            }
            	break;
            case "GetAllBanks":
            {
            	return $this->GetAllBanks($postData);
            }
            case "GetFinanceList":
            {
            	return $this->GetFinanceList($postData);
            }
            case "AddComplaints":
            {
            	return $this->AddComplaints($postData);
            }
            case "CancelJob":
            {
            	return $this->CancelJob($postData);
            }
            case "GetNotification":
            {
            	return $this->GetNotification($postData);
            }
            case "DeleteSeenNotification":
            {
            	return $this->DeleteSeenNotification($postData);
            }
            case "GetCustomAds":
            {
            	return $this->GetCustomAds();
            }
				case "GetUserImage":
            {
            	return $this->GetUserImage($postData);
            }
				
				case "DeleteUserImage":
            {
            	return $this->DeleteUserImage($postData);
            }	
					case "AddUserImage":
            {
            	return $this->AddUserImage($postData);
            }	
					
        }
    }

    public function RegisterUser($UserData)
    {
        $status = 2;
        $null="";

        $name = validateObject ($UserData , 'user_name', "");
        $name = addslashes($name);


        $email = validateObject ($UserData , 'email', "");
        $email = addslashes($email);

        $password = validateObject ($UserData , 'password', $null);
        $password = addslashes($password);

        $user_type = addslashes(validateObject ($UserData , 'user_type', ""));

        $device_type = validateObject($UserData,'device_type',"");
        $device_token =  addslashes(validateObject ($UserData , 'device_token', ""));

        $enc_password = $null;
        //print_r($enc_password);

        if($password!=$null)
        {
            $enc_password = encryptPassword($password);
            // print_r($enc_password);
        }


        $errorMsg = "";

        //Check if Email already exists
        $querySelNor = "Select * from tbluserdetails where email = '".$email."'";
        $resSelNor = mysql_query($querySelNor) or  $errorMsg =  mysql_error();

        if (mysql_num_rows($resSelNor)>0)
        {
            $status = 2;
            $errorMsg = "Email Id already exists";

        }
        else
        {

            $insertFields = "type, user_name, email, password";
            $valuesFields = $user_type.",'".$name."','".$email."', '".$enc_password."'";

            $query = "Insert into tbluserdetails (".$insertFields.") values(".$valuesFields.")";


            $res = mysql_query($query) or $errorMsg =  mysql_error();

            if($res)
            {
                $userInsertedId = mysql_insert_id();
                $query = "select * from tbluserdetails where user_id = '".$userInsertedId."'";

                $res=mysql_query($query);

                $user=array();
                while($r = mysql_fetch_assoc($res)) {
                    $status = 1;
                    $user = $r;
                    $errorMsg = "Successfully logged in";
                }
                if($user!=null)
                {
                    $temp=array();
                    $temp['User']=$user;
                    $temp['Reviews'] = array();
                    $temp['Skills'] = array();
                    $temp['BankInfo'] = array();
                   // $temp["Complaints"] = array();
                    $returnData = array();
                    $returnData[] =$temp;
                    $data['User']=$returnData;
                    $this->AddDeviceToken($user['user_id'],$device_type,$device_token);
                }
                $status = 1; //success
                }
            else
            {
                $status = 2;
                $data['User'] = null;
            }

        }

        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;


        return $data;
    }

    public function LoginUser($UserData)
    {
        $status = 2;

        $errorMsg = "";
        $name = addslashes(validateObject ($UserData , 'user_name', ""));
        $email = addslashes(validateObject ($UserData , 'email', ""));
        $password = validateObject ($UserData , 'password', "");
        $password = encryptPassword($password);
        $password = addslashes($password);
        $device_type = validateObject($UserData,'device_type',"");
        $device_token =  addslashes(validateObject ($UserData , 'device_token', ""));


        if($email != "" || $name != "")
        {
            $query = "SELECT * FROM tbluserdetails WHERE (user_name ='".$name."' OR email ='".$name."') AND password ='".$password."'";


            $res=mysql_query($query);
            $user=array();

            while($r = mysql_fetch_assoc($res))
            {
                $status = 1;
                $user = $r;
                $errorMsg = "Successfully logged in";
            }
            if($user!=null)
            {
                $temp=array();

                $temp['User']=$user;
                $this->AddDeviceToken($user['user_id'],$device_type,$device_token);

                $temp['SuperHero'] = 0;
                $querySkills = "SELECT *  FROM tblskills WHERE FIND_IN_SET(skill_id,  (SELECT skill_id  FROM tbluserskills  WHERE user_id = ".$user['user_id']."))";
                $resSkills = mysql_query($querySkills);
                $skillDetails = array();
                while($skill = mysql_fetch_assoc($resSkills))
                {
                    if($skill['skill_id'] == '0')
                    {
                        $temp['SuperHero'] = 1;
                    }
                    else
                        $skillDetails[] = $skill;
                }
                $temp['Skills'] = $skillDetails;

                $queryReviews = "SELECT u.first_name,u.last_name,u.profile_pic,u.user_name, r.*,j.skill_id, j.employer_id, j.freelancer_id,s.skill_description, s.skill_description_en, s.skill_description_ar from tblreviews r, tbluserdetails u,tbljobs j,tblskills s WHERE r.reviewee_id = ".$user['user_id']." AND u.user_id = r.reviewer_id AND j.job_id = r.job_id AND s.skill_id = j.skill_id ORDER BY review_id DESC limit 10";

                $resReviews = mysql_query($queryReviews);
                $reviewDetails = array();
                while($review = mysql_fetch_assoc($resReviews))
                {
                    $reviewDetails[] = $review;
                }
                $temp['Reviews'] = $reviewDetails;             
                
                
                $queryBankInfo = "SELECT b.type AS type, b.name AS 'Bank*', b.branch AS 'Branch*', b.country AS 'Country*', b.city AS 'City', b.code AS 'Bank/IFSC Code', b.swift_code AS 'Swift Code', b.beneficiary_account AS 'IBAN No.*', b.beneficiary_name AS 'Name*', b.beneficiary_nickname AS NickName, b.beneficiary_address AS Address, b.beneficiary_phone AS 'Phone Number', b.beneficiary_description AS Description, b.beneficiary_currency AS 'Currency*'
				FROM tblbankinfo AS b, tbluserdetails AS u
				WHERE u.user_id = b.user_id	AND u.user_id = ".$user['user_id']."";
				
                $resBankInfo = mysql_query($queryBankInfo);
                $bankInfoDetails = array();
                while($bankInfo = mysql_fetch_assoc($resBankInfo))
                {
                    $bankInfoDetails[] = $bankInfo;
                }
                $temp['BankInfo'] = $bankInfoDetails;                
                
                /*$queryComplaints = "SELECT c.* FROM tblcomplaints AS c, tbluserdetails AS u
				WHERE u.user_id = c.user_id	AND u.user_id = ".$user['user_id']."";
				
                $resComplaints = mysql_query($queryComplaints);
                $ComplaintsDetails = array();
                while($complaints = mysql_fetch_assoc($resComplaints))
                {
                    $ComplaintsDetails[] = $complaints;
                }
                $temp['Complaints'] = $ComplaintsDetails;
                */
                $returnData = array();
                $returnData[] =$temp;
                $data['User']=$returnData;
            }
            else
            {
                $status = 2;
                $errorMsg = 'The details you entered are invalid.';
                $data['User'] = null;
            }
        }
        else
        {
            $status = 2;
            $errorMsg = 'Email cannot be NULL';
            $data['User'] = null;
        }

        $data['status'] = ($status > 1) ? '0' : '1';;
        $data['message'] = $errorMsg;

        return $data;
    }

    public  function  UpdateDeviceToken($postData)
    {
        $device_type = validateObject($postData,'device_type',"");
        $device_token =  addslashes(validateObject ($postData , 'device_token', ""));
        $user_id = addslashes(validateObject ($postData , 'user_id', ""));
        $this->AddDeviceToken($user_id,$device_type,$device_token);
        $data['status'] =  '1';
        $data['message'] = "";
        return $data;

    }

    public function LoginViaFb($UserData)
    {
        $status = 2;
        $fbLoginStatus = 0;

        $name = validateObject ($UserData , 'user_name', "");
        $name = addslashes($name);


        $email = validateObject ($UserData , 'email', "");
        $email = addslashes($email);

        $user_type = "1";

        $device_type = validateObject($UserData,'device_type',"");
        $device_token =  addslashes(validateObject ($UserData , 'device_token', ""));

        $facebook_id = addslashes(validateObject ($UserData , 'facebook_id', ""));

        $errorMsg = "";

        //Check if Email already exists
        $querySelFB = "Select * from tbluserdetails where facebook_id = '".$facebook_id."'";
        $resSelFB = mysql_query($querySelFB) or  $errorMsg =  mysql_error();

        $user=array();

        if (mysql_num_rows($resSelFB)>0)
        {
            $r = mysql_fetch_assoc($resSelFB);
            $status = 1;
            $user = $r;
            $errorMsg = "Successfully logged in";
            $this->AddDeviceToken($user['user_id'],$device_type,$device_token);
            $fbLoginStatus = 1;
        }
        else
        {
            $querySelEmail = "Select * from tbluserdetails where email = '".$email."'";
            $resSelEmail = mysql_query($querySelEmail) or  $errorMsg =  mysql_error();
            if (mysql_num_rows($resSelEmail)>0 && strlen($email) > 0)
            {
                $user = mysql_fetch_assoc($resSelEmail);
                $queryUpdate = "Update tbluserdetails set facebook_id = '".$facebook_id."' where email = '".$email."'";
                $resUpdate = mysql_query($queryUpdate) or $error =  mysql_error();

                if ($resUpdate)
                {
                    $status = 1;
                    $temp=array();
                    $temp['User']=$user;
                    $temp['Reviews'] = array();
                    $temp['Skills'] = array();
                    $temp['BankInfo'] = array();
                   // $temp['Complaints'] = array();
                    $returnData = array();
                    $returnData[] =$temp;
                    $data['User']=$returnData;

                    $this->AddDeviceToken($user['user_id'],$device_type,$device_token);
                }
                $fbLoginStatus = 1;
            }
            else
            {
                $insertFields = "type, user_name, email, password, facebook_id";
                $valuesFields = $user_type.",'".$name."','".$email."', '','".$facebook_id."'";

                $query = "Insert into tbluserdetails (".$insertFields.") values(".$valuesFields.")";

                $res = mysql_query($query) or $errorMsg =  mysql_error();

                if($res)
                {
                    $userInsertedId = mysql_insert_id();
                    $query = "select * from tbluserdetails where user_id = '".$userInsertedId."'";

                    $res=mysql_query($query);

                    $user=array();
                    while($r = mysql_fetch_assoc($res))
                    {
                        $user = $r;
                        $errorMsg = "Successfully logged in";
                    }
                    if($user!=null)
                    {
                        $temp=array();
                        $temp['User']=$user;
                        $temp['Reviews'] = array();
                        $temp['Skills'] = array();
                        $temp['BankInfo'] = array();
                        //$temp['Complaints'] = array();
                        $returnData = array();
                        $returnData[] =$temp;
                        $data['User']=$returnData;
                        $this->AddDeviceToken($user['user_id'],$device_type,$device_token);
                    }
                    $status = 1; //success
                    $fbLoginStatus = 2;
                }
                else
                {
                    $status = 2;
                    $data['User'] = null;
                }

            }

        }
        if($user!=null)
        {
            $temp=array();

            $temp['User']=$user;
            $this->AddDeviceToken($user['user_id'],$device_type,$device_token);


            $temp['SuperHero'] = 0;
            $querySkills = "SELECT *  FROM tblskills WHERE FIND_IN_SET(skill_id,  (SELECT skill_id  FROM tbluserskills  WHERE user_id = ".$user['user_id']."))";
            $resSkills = mysql_query($querySkills);
            $skillDetails = array();
            while($skill = mysql_fetch_assoc($resSkills))
            {
                if($skill['skill_id'] == '0')
                {
                    $temp['SuperHero'] = 1;
                }
                else
                    $skillDetails[] = $skill;
            }
            $temp['Skills'] = $skillDetails;

            $queryReviews = $queryReviews = "SELECT u.first_name,u.last_name,u.profile_pic,u.user_name, r.*,j.skill_id, j.employer_id, j.freelancer_id,s.skill_description, s.skill_description_en, s.skill_description_ar from tblreviews r, tbluserdetails u,tbljobs j,tblskills s WHERE r.reviewee_id = ".$user['user_id']." AND u.user_id = r.reviewer_id AND j.job_id = r.job_id AND s.skill_id = j.skill_id ORDER BY review_id DESC limit 10";

            $resReviews = mysql_query($queryReviews);
            $reviewDetails = array();
            while($review = mysql_fetch_assoc($resReviews))
            {
                $reviewDetails[] = $review;
            }
            $temp['Reviews'] = $reviewDetails;
            
            $queryBankInfo = "SELECT b.type AS type, b.name AS 'Bank*', b.branch AS 'Branch*', b.country AS 'Country*', b.city AS 'City', b.code AS 'Bank/IFSC Code', b.swift_code AS 'Swift Code', b.beneficiary_account AS 'IBAN No.*', b.beneficiary_name AS 'Name*', b.beneficiary_nickname AS NickName, b.beneficiary_address AS Address, b.beneficiary_phone AS 'Phone Number', b.beneficiary_description AS Description, b.beneficiary_currency AS 'Currency*'
			FROM tblbankinfo AS b, tbluserdetails AS u
			WHERE u.user_id = b.user_id	AND u.user_id = ".$user['user_id']."";
				
            $resBankInfo = mysql_query($queryBankInfo);
            $bankInfoDetails = array();
            while($bankInfo = mysql_fetch_assoc($resBankInfo))
            {
            	$bankInfoDetails[] = $bankInfo;
            }
            $temp['BankInfo'] = $bankInfoDetails;
            
           /* $queryComplaints = "SELECT c.* FROM tblcomplaints AS c, tbluserdetails AS u
				WHERE u.user_id = c.user_id	AND u.user_id = ".$user['user_id']."";
				
            $resComplaints = mysql_query($queryComplaints);
            $ComplaintsDetails = array();
            while($complaints = mysql_fetch_assoc($resComplaints))
            {
                $ComplaintsDetails[] = $complaints;
            }
            $temp['Complaints'] = $ComplaintsDetails;*/
            
            $returnData = array();
            $returnData[] =$temp;
            $data['fbLoginStatus'] = $fbLoginStatus;
            $data['User']=$returnData;
        }
        else
        {
            $status = 2;
            $errorMsg = 'The details you entered are invalid.';
            $data['User'] = null;
        }

        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;


        return $data;
    }

    public function LoginViaTwitter($UserData)
    {
        $status = 2;
        $twitterLoginStatus = 0;

        $name = validateObject ($UserData , 'user_name', "");
        $name = addslashes($name);


        $email = validateObject ($UserData , 'email', "");
        $email = addslashes($email);

        $user_type = "1";

        $device_type = validateObject($UserData,'device_type',"");
        $device_token =  addslashes(validateObject ($UserData , 'device_token', ""));

        $twitter_id = addslashes(validateObject ($UserData , 'twitter_id', ""));

        $errorMsg = "";

        //Check if Email already exists
        $querySelTwitter = "Select * from tbluserdetails where twitter_id = '".$twitter_id."'";
        $resSelTwitter = mysql_query($querySelTwitter) or  $errorMsg =  mysql_error();

        $user=array();

        if (mysql_num_rows($resSelTwitter)>0)
        {
            $r = mysql_fetch_assoc($resSelTwitter);
            $status = 1;
            $user = $r;
            $errorMsg = "Successfully logged in";
            $this->AddDeviceToken($user['user_id'],$device_type,$device_token);
            $twitterLoginStatus = 1;
        }
        else
        {
            $querySelEmail = "Select * from tbluserdetails where email = '".$email."'";
            $resSelEmail = mysql_query($querySelEmail) or  $errorMsg =  mysql_error();
            if (mysql_num_rows($resSelEmail)>0 && strlen($email) > 0)
            {
                $user = mysql_fetch_assoc($resSelEmail);
                $queryUpdate = "Update tbluserdetails set twitter_id = '".$twitter_id."' where email = '".$email."'";
                $resUpdate = mysql_query($queryUpdate) or $error =  mysql_error();

                if ($resUpdate)
                {
                    $status = 1;
                    $temp=array();
                    $temp['User']=$user;
                    $temp['Reviews'] = array();
                    $temp['Skills'] = array();
                    $temp['BankInfo'] = array();
                    $returnData = array();
                    $returnData[] =$temp;
                    $data['User']=$returnData;

                    $this->AddDeviceToken($user['user_id'],$device_type,$device_token);
                }
                $twitterLoginStatus = 1;
            }
            else
            {
                $insertFields = "type, user_name, email, password, twitter_id";
                $valuesFields = $user_type.",'".$name."','".$email."', '','".$twitter_id."'";

                $query = "Insert into tbluserdetails (".$insertFields.") values(".$valuesFields.")";

                $res = mysql_query($query) or $errorMsg =  mysql_error();

                if($res)
                {
                    $userInsertedId = mysql_insert_id();
                    $query = "select * from tbluserdetails where user_id = '".$userInsertedId."'";

                    $res=mysql_query($query);

                    $user=array();
                    while($r = mysql_fetch_assoc($res))
                    {
                        $user = $r;
                        $errorMsg = "Successfully logged in";
                    }
                    if($user!=null)
                    {
                        $temp=array();
                        $temp['User']=$user;
                        $temp['Reviews'] = array();
                        $temp['Skills'] = array();
                        $temp['BankInfo'] = array();
                       // $temp['Complaints'] = array();
                        $returnData = array();
                        $returnData[] =$temp;
                        $data['User']=$returnData;
                        $this->AddDeviceToken($user['user_id'],$device_type,$device_token);
                    }
                    $status = 1; //success
                    $twitterLoginStatus = 2;
                }
                else
                {
                    $status = 2;
                    $data['User'] = null;
                }

            }

        }
        if($user!=null)
        {
            $temp=array();

            $temp['User']=$user;
            $this->AddDeviceToken($user['user_id'],$device_type,$device_token);

            $temp['SuperHero'] = 0;
            $querySkills = "SELECT *  FROM tblskills WHERE FIND_IN_SET(skill_id,  (SELECT skill_id  FROM tbluserskills  WHERE user_id = ".$user['user_id']."))";
            $resSkills = mysql_query($querySkills);
            $skillDetails = array();
            while($skill = mysql_fetch_assoc($resSkills))
            {
                if($skill['skill_id'] == '0')
                {
                    $temp['SuperHero'] = 1;
                }
                else
                    $skillDetails[] = $skill;
            }
            $temp['Skills'] = $skillDetails;

            $queryReviews = $queryReviews = "SELECT u.first_name,u.last_name,u.profile_pic,u.user_name, r.*,j.skill_id, j.employer_id, j.freelancer_id,s.skill_description, s.skill_description_en, s.skill_description_ar from tblreviews r, tbluserdetails u,tbljobs j,tblskills s WHERE r.reviewee_id = ".$user['user_id']." AND u.user_id = r.reviewer_id AND j.job_id = r.job_id AND s.skill_id = j.skill_id ORDER BY review_id DESC limit 10";
            $resReviews = mysql_query($queryReviews);
            $reviewDetails = array();
            while($review = mysql_fetch_assoc($resReviews))
            {
                $reviewDetails[] = $review;
            }
            $temp['Reviews'] = $reviewDetails;
            
            $queryBankInfo = "SELECT b.type AS type, b.name AS 'Bank*', b.branch AS 'Branch*', b.country AS 'Country*', b.city AS 'City', b.code AS 'Bank/IFSC Code', b.swift_code AS 'Swift Code', b.beneficiary_account AS 'IBAN No.*', b.beneficiary_name AS 'Name*', b.beneficiary_nickname AS NickName, b.beneficiary_address AS Address, b.beneficiary_phone AS 'Phone Number', b.beneficiary_description AS Description, b.beneficiary_currency AS 'Currency*'
			FROM tblbankinfo AS b, tbluserdetails AS u
			WHERE u.user_id = b.user_id	AND u.user_id = ".$user['user_id']."";
				
            $resBankInfo = mysql_query($queryBankInfo);
            $bankInfoDetails = array();
            while($bankInfo = mysql_fetch_assoc($resBankInfo))
            {
                $bankInfoDetails[] = $bankInfo;
            }
            $temp['BankInfo'] = $bankInfoDetails;
            
            
        	/*$queryComplaints = "SELECT c.* FROM tblcomplaints AS c, tbluserdetails AS u
				WHERE u.user_id = c.user_id	AND u.user_id = ".$user['user_id']."";
				
            $resComplaints = mysql_query($queryComplaints);
            $ComplaintsDetails = array();
        	while($complaints = mysql_fetch_assoc($resComplaints))
            {
                $ComplaintsDetails[] = $complaints;
            }
            $temp['Complaints'] = $ComplaintsDetails;*/
            
            $returnData = array();
            $returnData[] =$temp;
            $data['twitterLoginStatus'] = $twitterLoginStatus;
            $data['User']=$returnData;
        }
        else
        {
            $status = 2;
            $errorMsg = 'The details you entered are invalid.';
            $data['User'] = null;
        }

        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;


        return $data;
    }

    public function  AddDeviceToken($userId,$type,$deviceToken)
    {
        $deviceTokenQuery = "SELECT * FROM tbldevicetoken where device_token = '".$deviceToken."'";
        $deviceTokenResult = mysql_query($deviceTokenQuery) or $errorMsg =  mysql_error();
        if(mysql_fetch_assoc($deviceTokenResult)>0)
        {
            $deleteDeviceTokenQuery = "DELETE FROM tbldevicetoken where device_token = '".$deviceToken."'";
            $deleteDeviceTokenResult = mysql_query($deleteDeviceTokenQuery) or $errorMsg =  mysql_error();
        }

        $insertDeviceQuery = "INSERT INTO tbldevicetoken (user_id,device_type,device_token) values (".$userId.",'".$type."','".$deviceToken."')";
        $insertDeviceResult = mysql_query($insertDeviceQuery) or $errorMsg =  mysql_error();
    }

    public function GetUserDetails($UserData)
    {
        $status = 2;
        $errorMsg = "";
        $user_id = addslashes(validateObject ($UserData , 'user_id', ""));
        $isFromHireFlow = addslashes(validateObject($UserData, 'isFromHireFlow', "0"));

        $queryUser = "select * from tbluserdetails where user_id = ".$user_id;
        $resUserDetails = mysql_query($queryUser);
        $userDetails = array();
        while($r = mysql_fetch_assoc($resUserDetails))
        {
            $userDetails = $r;

            $temp=array();
            $temp['User']=$userDetails;


            $temp['SuperHero'] = 0;
            $querySkills = "SELECT *  FROM tblskills WHERE FIND_IN_SET(skill_id,  (SELECT skill_id  FROM tbluserskills  WHERE user_id = ".$user_id."))";
            $resSkills = mysql_query($querySkills);
            $skillDetails = array();
            while($skill = mysql_fetch_assoc($resSkills))
            {
                if($skill['skill_id'] == '0')
                {
                    $temp['SuperHero'] = 1;
                }
                else
                    $skillDetails[] = $skill;
            }
            $temp['Skills'] = $skillDetails;

            $queryReviews = $queryReviews = "SELECT u.first_name,u.last_name,u.profile_pic,u.user_name, r.*,j.skill_id, j.employer_id, j.freelancer_id, s.skill_description, s.skill_description_en, s.skill_description_ar from tblreviews r, tbluserdetails u,tbljobs j,tblskills s WHERE r.reviewee_id = ".$user_id." AND u.user_id = r.reviewer_id AND j.job_id = r.job_id AND s.skill_id = j.skill_id ORDER BY review_id DESC limit 10";

            $resReviews = mysql_query($queryReviews);
            $reviewDetails = array();
            while($review = mysql_fetch_assoc($resReviews))
            {
                $reviewDetails[] = $review;
            }
            $temp['Reviews'] = $reviewDetails;
            
            $queryBankInfo = "SELECT b.type AS type, b.name AS 'Bank*', b.branch AS 'Branch*', b.country AS 'Country*', b.city AS 'City', b.code AS 'Bank/IFSC Code', b.swift_code AS 'Swift Code', b.beneficiary_account AS 'IBAN No.*', b.beneficiary_name AS 'Name*', b.beneficiary_nickname AS NickName, b.beneficiary_address AS Address, b.beneficiary_phone AS 'Phone Number', b.beneficiary_description AS Description, b.beneficiary_currency AS 'Currency*'
			FROM tblbankinfo AS b, tbluserdetails AS u
			WHERE u.user_id = b.user_id	AND u.user_id = ".$user_id."";
            $resBankInfo = mysql_query($queryBankInfo);
            $bankInfoDetails = array();
            while($bankInfo = mysql_fetch_assoc($resBankInfo))
            {
                $bankInfoDetails[] = $bankInfo;
            }
            $temp['BankInfo'] = $bankInfoDetails;
            
			/*$queryComplaints = "SELECT c.* FROM tblcomplaints AS c, tbluserdetails AS u
				WHERE u.user_id = c.user_id	AND u.user_id = ".$user_id."";
            $resComplaints = mysql_query($queryComplaints);
            $ComplaintsDetails = array();
  
        	while($complaints = mysql_fetch_assoc($resComplaints))
            {
               	 $ComplaintsDetails[] = $complaints;
            }           
            $temp['Complaints'] = $ComplaintsDetails;*/

            if($isFromHireFlow === "1")
            {
                $queryFreelancerJobs = "SELECT * FROM tbljobs WHERE freelancer_id = ".$user_id. " AND (accepted AND !completed)";

                $resultFreelancerJobs = mysql_query($queryFreelancerJobs);

                $result1 = array();
                while($r1 = mysql_fetch_assoc($resultFreelancerJobs))
                {
                    $result1[] = $r1;
                }

                $data['freelancerJobs'] = $result1;
            }

            $returnData = array();
            $returnData[] =$temp;
            $data['User']=$returnData;
            $status = 1;

        }
        if($userDetails == null)
        {
            $status = 2;
            $errorMsg = 'User not found';
            $data['User'] = null;
        }

        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;

        return $data;
    }

    public  function  UpdateUserProfile($UserData)
    {
        $status = 2;
        $errorMsg = "";
        $user_id = addslashes(validateObject ($UserData , 'user_id', ""));
        $user_name = addslashes(validateObject ($UserData , 'user_name', ""));
        $first_name = addslashes(validateObject ($UserData , 'first_name', ""));
        $last_name = addslashes(validateObject ($UserData , 'last_name', ""));
        $dob = addslashes(validateObject ($UserData , 'dob', ""));
        $phone = addslashes(validateObject ($UserData , 'phone', ""));
        $location = addslashes(validateObject ($UserData , 'location', ""));
        $latitude = addslashes(validateObject ($UserData , 'latitude', ""));
        $longitude = addslashes(validateObject ($UserData , 'longitude', ""));
        $gender = addslashes(validateObject ($UserData , 'gender', ""));
        $profile_pic = addslashes(validateObject ($UserData , 'profile_pic', ""));
        $cover_pic = addslashes(validateObject ($UserData , 'cover_pic', ""));
        $college_name = addslashes(validateObject ($UserData , 'college_name', ""));
        $degree = addslashes(validateObject ($UserData , 'degree', ""));
        $major = addslashes(validateObject ($UserData , 'major', ""));
        $experience = addslashes(validateObject ($UserData , 'experience', ""));
        $education_level = addslashes(validateObject ($UserData , 'education_level', ""));
        $school_name = addslashes(validateObject ($UserData , 'school_name', ""));
        $hourly_rate = addslashes(validateObject ($UserData , 'hourly_rate', ""));
        $user_type = addslashes(validateObject ($UserData , 'user_type', ""));
        $password = addslashes(validateObject ($UserData , 'password', ""));
        $year_attained = addslashes(validateObject($UserData, 'year_attained',""));
        $class = addslashes(validateObject($UserData, 'class',""));

        $queryUser = "select * from tbluserdetails where user_id = ".$user_id."";
        $resUserDetails = mysql_query($queryUser);
        $userDetails = array();

        $queryUpdate = "";

        while($r = mysql_fetch_assoc($resUserDetails))
        {
            if(strlen($user_name) > 0)
            {
                $queryUpdate = $queryUpdate." user_name = '".$user_name."',";
            }
            if(strlen($password) > 0)
            {
                $enc_password = encryptPassword($password);
                $queryUpdate = $queryUpdate." password = '".$enc_password."',";
            }
            if(strlen($first_name) > 0)
            {
                $queryUpdate = $queryUpdate." first_name = '".$first_name."',";
            }
            if(strlen($last_name) > 0)
            {
                $queryUpdate = $queryUpdate." last_name = '".$last_name."',";
            }
            if(strlen($dob) > 0)
            {
                $queryUpdate = $queryUpdate." dob = '".$dob."',";
            }
            if(strlen($phone) > 0)
            {
                $queryUpdate = $queryUpdate." phone = '".$phone."',";
            }
            if(strlen($location) > 0)
            {
                $queryUpdate = $queryUpdate." location = '".$location."',";
            }
            if(strlen($latitude) > 0)
            {
                $queryUpdate = $queryUpdate." latitude = '".$latitude."',";
            }
            if(strlen($longitude) > 0)
            {
                $queryUpdate = $queryUpdate." longitude = '".$longitude."',";
            }
            if(strlen($gender) > 0)
            {
                $queryUpdate = $queryUpdate." gender = '".$gender."',";
            }
            if(strlen($year_attained) > 0)
            {
                $queryUpdate = $queryUpdate." year_attained = '".$year_attained."',";
            }
            if(strlen($class) > 0)
            {
                $queryUpdate = $queryUpdate." class = '".$class."',";
            }

            if(strlen($profile_pic) > 0)
            {
                $imagedata = base64_decode($profile_pic);
                $imagename = $user_id."_".date("YmdHis").".png";

                $destdir = '../HelpYa_WS/userimages/'.$imagename;

                if(!file_put_contents($destdir, $imagedata))
                {

                    echo "error";
                }

                $queryUpdate = $queryUpdate." profile_pic = '".$imagename."',";
            }
            if(strlen($cover_pic) > 0)
            {
                $imagedata = base64_decode($cover_pic);
                $imagename = "cover_".$user_id."_".date("YmdHis").".png";

                $destdir = '../HelpYa_WS/usercoverimages/'.$imagename;

                if(!file_put_contents($destdir, $imagedata))
                {

                    echo "error";
                }

                $queryUpdate = $queryUpdate." cover_pic = '".$imagename."',";
            }
            if(strlen($college_name) > 0)
            {
                $queryUpdate = $queryUpdate." college_name = '".$college_name."',";
            }
            if(strlen($degree) > 0)
            {
                $queryUpdate = $queryUpdate." degree = '".$degree."',";
            }
            if(strlen($major) > 0)
            {
                $queryUpdate = $queryUpdate." major = '".$major."',";
            }
            if(strlen($experience) > 0)
            {
                $queryUpdate = $queryUpdate." experience = '".$experience."',";
            }
            if(strlen($education_level) > 0)
            {
                $queryUpdate = $queryUpdate." education_level = '".$education_level."',";
            }
            if(strlen($school_name) > 0)
            {
                $queryUpdate = $queryUpdate." school_name = '".$school_name."',";
            }
            if(strlen($hourly_rate) > 0)
            {
                $queryUpdate = $queryUpdate." hourly_rate = '".$hourly_rate."',";
            }
            if(strlen($user_type) > 0)
            {
                $queryUpdate = $queryUpdate." user_type = '".$user_type."',";
            }

            if($queryUpdate != "")
            {
                $queryUpdate = "Update tbluserdetails set".$queryUpdate." user_id = '".$user_id."'";

                $queryUpdate = $queryUpdate." where user_id = '".$user_id."'";

                $resUpdate = mysql_query($queryUpdate) or $error =  mysql_error();

                if ($resUpdate)
                {
                    $status = 1;
                    $queryUser = "select * from tbluserdetails where user_id = ".$user_id;
                    $resUserDetails = mysql_query($queryUser);
                    $userDetails = array();
                    while($r = mysql_fetch_assoc($resUserDetails))
                    {
                        $userDetails = $r;

                        $temp=array();
                        $temp['User']=$userDetails;


                        $temp['SuperHero'] = 0;
                        $querySkills = "SELECT *  FROM tblskills WHERE FIND_IN_SET(skill_id,  (SELECT skill_id  FROM tbluserskills  WHERE user_id = ".$user_id."))";
                        $resSkills = mysql_query($querySkills);
                        $skillDetails = array();
                        while($skill = mysql_fetch_assoc($resSkills))
                        {
                            if($skill['skill_id'] == '0')
                            {
                                $temp['SuperHero'] = 1;
                            }
                            else
                                $skillDetails[] = $skill;
                        }
                        $temp['Skills'] = $skillDetails;


                        $queryReviews = $queryReviews = "SELECT u.first_name,u.last_name,u.profile_pic,u.user_name, r.*,j.skill_id,j.employer_id, j.freelancer_id,s.skill_description, s.skill_description_en, s.skill_description_ar from tblreviews r, tbluserdetails u,tbljobs j,tblskills s WHERE r.reviewee_id = ".$user_id." AND u.user_id = r.reviewer_id AND j.job_id = r.job_id AND s.skill_id = j.skill_id ORDER BY review_id DESC limit 10";

                        $resReviews = mysql_query($queryReviews);
                        $reviewDetails = array();
                        while($review = mysql_fetch_assoc($resReviews))
                        {
                            $reviewDetails[] = $review;
                        }
                        $temp['Reviews'] = $reviewDetails;
                        
                        $queryBankInfo = "SELECT b.type AS type, b.name AS 'Bank*', b.branch AS 'Branch*', b.country AS 'Country*', b.city AS 'City', b.code AS 'Bank/IFSC Code', b.swift_code AS 'Swift Code', b.beneficiary_account AS 'IBAN No.*', b.beneficiary_name AS 'Name*', b.beneficiary_nickname AS NickName, b.beneficiary_address AS Address, b.beneficiary_phone AS 'Phone Number', b.beneficiary_description AS Description, b.beneficiary_currency AS 'Currency*'
						FROM tblbankinfo AS b, tbluserdetails AS u
						WHERE u.user_id = b.user_id	AND u.user_id = ".$user_id."";
				
               			$resBankInfo = mysql_query($queryBankInfo);
                		$bankInfoDetails = array();
                		while($bankInfo = mysql_fetch_assoc($resBankInfo))
                		{
                   		 	$bankInfoDetails[] = $bankInfo;
               			}
                		$temp['BankInfo'] = $bankInfoDetails;
                		
                		/*$queryComplaints = "SELECT c.* FROM tblcomplaints AS c, tbluserdetails AS u
						WHERE u.user_id = c.user_id	AND u.user_id = ".$user_id."";
				
                		$resComplaints = mysql_query($queryComplaints);
                		$ComplaintsDetails = array();
               			while($complaints = mysql_fetch_assoc($resComplaints))
                		{
                    		$ComplaintsDetails[] = $complaints;
               			}
               			$temp['Complaints'] = $ComplaintsDetails;*/

                        $returnData = array();
                        $returnData[] =$temp;
                        $data['User']=$returnData;

                    }
                }
                else
                {
                    $errorMsg = "Error while adding or updating user details.";
                    $data['User'] = null;
                }
            }

        }
        if($userDetails == null)
        {
            $status = 2;
            $errorMsg = 'User not found';
            $data['User'] = null;
        }

        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;

        return $data;
    }

    public  function  ChangePassword($UserData)
    {
        $password = validateObject ($UserData , 'password', "");
        $password = addslashes($password);
        $user_id = addslashes(validateObject ($UserData , 'user_id', ""));

        $enc_password = encryptPassword($password);


        $data = array();

        $errorMsg = "";

        //Check if Email already exists
        $querySelNor = "Select * from tbluserdetails where user_id = ".$user_id."";
        $resSelNor = mysql_query($querySelNor) or  $errorMsg =  mysql_error();

        if (mysql_num_rows($resSelNor)>0)
        {
            $status = 2;
            $queryUpdate = "Update tbluserdetails set password = '".$enc_password."' where user_id = ".$user_id."";

            $resUpdate = mysql_query($queryUpdate) or $error =  mysql_error();

            if (!($resUpdate))
            {
                $errorMsg = "Error in updating user password";
            }
            else
                $status = 1;
        }
        else
        {
            $status = 2;
        }

        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;

        return $data;
    }

    public function  GetAllSkills()
    {
        $status = 2;
        $errorMsg = "";


        $querylevel0Skills = "SELECT * FROM tblskills WHERE parent = 0 AND skill_id != 0 ORDER BY priority ASC";
        $resultlevel0Skills = mysql_query($querylevel0Skills);
        $resultSkills = array();

        while($r0 = mysql_fetch_assoc($resultlevel0Skills))
        {
            $skill0 = $r0;
            $skill0['SubModules'] = array();

            $querylevel1Skills = "SELECT * FROM tblskills WHERE parent = ".$skill0['skill_id'];
            $resultlevel1Skills = mysql_query($querylevel1Skills);
            while($r1 = mysql_fetch_assoc($resultlevel1Skills))
            {
                $skill1 = $r1;

                $skill1['SubModules'] = array();
                $querylevel2Skills = "SELECT * FROM tblskills WHERE parent = ".$skill1['skill_id'];
                $resultlevel2Skills = mysql_query($querylevel2Skills);

                while($r2 = mysql_fetch_assoc($resultlevel2Skills))
                {
                    $skill2 = $r2;
                    $skill2['SubModules'] = array();
                    $querylevel3Skills = "SELECT * FROM tblskills WHERE parent = ".$skill2['skill_id'];
                    $resultlevel3Skills = mysql_query($querylevel3Skills);

                    while($r3 = mysql_fetch_assoc($resultlevel3Skills))
                    {
                        $skill3 = $r3;
                        $skill3['SubModules'] = array();
                        $skill2['SubModules'][] = $skill3;
                    }
                    $skill1['SubModules'][] = $skill2;
                }

                $skill0['SubModules'][] = $skill1;
            }

            $resultSkills[]=$skill0;
        }


        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;
        $data['Skills'] = $resultSkills;
        return $data;
    }

    /**
     * @param $ReviewData
     * @return mixed
     */
    public  function  AddReview($ReviewData)
    {
        $status = 2;
        $errorMsg = "";

        $job_id = addslashes(validateObject ($ReviewData , 'job_id', ""));
        $reviewee_id = addslashes(validateObject ($ReviewData , 'reviewee_id', ""));
        $reviewer_id = addslashes(validateObject ($ReviewData , 'reviewer_id', ""));
        $ratings = addslashes(validateObject ($ReviewData , 'ratings', ""));
        $description = addslashes(validateObject ($ReviewData , 'description', ""));
        $date_added = addslashes(validateObject ($ReviewData , 'date_added', ""));
        $r1 = addslashes(validateObject ($ReviewData , 'r1', 0.0));
        $r2 = addslashes(validateObject ($ReviewData , 'r2', 0.0));
        $r3 = addslashes(validateObject ($ReviewData , 'r3', 0.0));
        $r4 = addslashes(validateObject ($ReviewData , 'r4', 0.0));
        $r5 = addslashes(validateObject ($ReviewData , 'r5', 0.0));

        $queryDeleteDuplicate = "DELETE FROM tblreviews WHERE reviewee_id = ".$reviewee_id." AND reviewer_id = ".$reviewer_id. " AND job_id = ".$job_id;

        $resultDeleteDuplicate = mysql_query($queryDeleteDuplicate) or $errorMsg =  mysql_error();

        $insertFields = "reviewee_id, reviewer_id, ratings, review_description, date_added, r1, r2, r3, r4, r5, job_id";
        $valuesFields = $reviewee_id.",".$reviewer_id.",".$ratings.", '".$description."', '".$date_added."', ".$r1.", ".$r2.", ".$r3.", ".$r4.", ".$r5.",".$job_id;
        $query = "Insert into tblreviews (".$insertFields.") values (".$valuesFields.")";
       // echo $query;exit;
        $res = mysql_query($query) or $errorMsg =  mysql_error();

        if($res)
        {
            $status = 1;
            //$updateRatingsQuery = "UPDATE tbluserdetails SET average_ratings = ((average_ratings+".$ratings.")/2) where user_id = ".$reviewee_id;
            $updateRatingsQuery = "UPDATE tbluserdetails SET average_ratings = (SELECT  SUM(ratings)/count(*)  FROM tblreviews WHERE reviewee_id = ".$reviewee_id.") where user_id = ".$reviewee_id;
            $updateRatingsResponse = mysql_query($updateRatingsQuery) or $errorMsg =  mysql_error();
        	$data['message'] = $errorMsg;
      
        }

        $data['status'] = ($status > 1) ? '0' : '1';
        return $data;
    }

    public  function  AddUserSkills($SkillData)
    {
        $status = 2;
        $errorMsg = "";

        $skill_ids = validateObject ($SkillData , 'skill_ids', "");
        $user_id = validateObject ($SkillData , 'user_id', "");

        $queryGetUserSkills = "SELECT * FROM tbluserskills where user_id = ".$user_id;
        $resultGetUserSkills = mysql_query($queryGetUserSkills);

        if(mysql_num_rows($resultGetUserSkills) > 0)
        {
            $query = "UPDATE tbluserskills set skill_id = '".implode(",", $skill_ids)."'  where user_id = ".$user_id;

        }
        else
        {
            $strIds = implode(',', $skill_ids);
            $query = "INSERT INTO tbluserskills (user_id,skill_id) values (".$user_id.",'".$strIds."')";
        }

        $res = mysql_query($query) or $error =  mysql_error();
        if (!($res))
        {
            $errorMsg = "Error in inserting skills";
        }
        else
        {
            $status = 1;
        }

        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;
		   $data['Skills'] = $resultSkills;
        return $data;
    }
	
	
 public  function  GetUserImage($PostData)
    {
  

	 $array = get_object_vars($PostData);
	
        //$skill_ids = validateObject ($SkillData , 'skill_ids', "");
	        // $user_id = validateObject($PostData, 'user_id', 0);
	 foreach($array as $key=>$value){
		 
		  $user_id = validateValue($value,0);
	
	 }

       

        $queryGetUserSkills = "SELECT * FROM tbluser where user_id = ".$user_id;
        $resultGetUserSkills = mysql_query($queryGetUserSkills);

	 $resultSkills = array();
	   while($r0 = mysql_fetch_assoc($resultGetUserSkills))
        {
            $skill0 = $r0;
           
           

	  $resultSkills[]=$skill0;
	 
	 
	 
	   }
	 
	 
	 
	 
        if(mysql_num_rows($resultGetUserSkills) > 0)
        {
           
 $status = 2;
        $errorMsg = "UserDetails Successfully Retrieved";
        }
        else
        {
          $status = 0;
        $errorMsg = "Could Not Find User";
        }

        

        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;
	      
		   $data['UserDetails'] = $resultSkills;
        return $data;
    }
 
	
	
	 public  function  DeleteUserImage($PostData)
    {
      $errorMsg="";
        //$skill_ids = validateObject ($SkillData , 'skill_ids', "");
        //$user_id = validateObject ($ImageData, 'user_id', "");
          //$user_image = validateObject ($ImageData, 'user_image', "");
	
		  $user_image =$PostData->user_image;
		   $user_id =$PostData->user_id;
		 
	
        $queryGetUserSkills = "SELECT * FROM tbluser where `user_id` ='$user_id'";
        $resultGetUserSkills = mysql_query($queryGetUserSkills) or $error=mysql_error();

	 $resultSkills = array();
	 
        if(mysql_fetch_assoc($resultGetUserSkills)>0)
        {
			
            $deleteDeviceTokenQuery = "DELETE FROM `tbluser` WHERE `user_id` = '$user_id'  AND `user_image` = '$user_image'";
            $deleteDeviceTokenResult = mysql_query($deleteDeviceTokenQuery) or $error=mysql_error();
			if(!($deleteDeviceTokenResult )){
			
			
				 $errorMsg="Error deleting image";
			}
			
        }
		 else{
		 $errorMsg="Error deleting image";
		 
		 }
        
		
		
 if(  $errorMsg==""){
	
	  $dir="../HelpYa_WS/userimages";
	 
	 unlink($dir.'/'.$user_image);
	 
			  
		 $data['message']="Image deleted successfully";
			 $status=0;
			 

		 }
		 else{
       
			 
			
			 
			 
	  $data['message'] = $errorMsg;
			  $status=2;
			
			 
	
		 }
        $data['status'] = ($status > 1) ? '0' : '1';
		
		  
        return $data;
    }
	
	
	 public  function  AddUserImage($PostData)
    {
       $errorMsg=""; 

        //$skill_ids = validateObject ($SkillData , 'skill_ids', "");
        $user_id = $PostData->user_id;
		 $user_image = $PostData->user_image;
		  $image_name = $PostData->image_name;
     
		 
        $bg = base64_decode($user_image);
		 
		 
		               

 $file = fopen("../HelpYa_WS/userimages/".$image_name, 'w');
		 
		  fwrite($file, $bg);
		 if(fclose($file)){
 $imagestatus ="Image uploaded";
}else{
$imagestatus= "Error uploading image";
}
			$InsertImageQuery = "INSERT INTO tbluser ".
       "(user_id,user_image) ".
       "VALUES ".
       "('$user_id','$image_name')";
          
           $InsertImageResult = mysql_query($InsertImageQuery) or $errorMsg =mysql_error();
        
        
 if($errorMsg==""){
		 $data['message']="Image inserted successfully";
			 $status=0;
		 }
		 else{
        $data['message'] = $errorMsg;
			  $status=2;
		 }
        $data['status'] = ($status > 1) ? '0' : '1';
		
		  $data['image_status']=$imagestatus;
        return $data;
    }
	
	
    public function AddJobDetails($JobData)
    {
        $status = 2;
        $errorMsg = "";

        $freelancer_id = addslashes(validateObject ($JobData , 'freelancer_id', ""));
        $employer_id = addslashes(validateObject ($JobData , 'employer_id', ""));
        $start_date = addslashes(validateObject ($JobData , 'start_date', ""));
        $end_date = addslashes(validateObject ($JobData , 'end_date', ""));
        $start_time = addslashes(validateObject ($JobData , 'start_time', ""));
        $end_time = addslashes(validateObject ($JobData , 'end_time', ""));
        $skill_id = addslashes(validateObject ($JobData , 'skill_id', ""));
        $paid = 0;
        $days_option = addslashes(validateObject ($JobData , 'days_option', ""));
        $num_of_days = addslashes(validateObject ($JobData , 'num_of_days', ""));

        $query = "INSERT INTO tbljobs (freelancer_id, employer_id, start_date, end_date,num_of_days, start_time, end_time, skill_id,days_option, paid) values (".$freelancer_id.",".$employer_id.",'".$start_date."','".$end_date."', '".$num_of_days."', '".$start_time."','".$end_time."',".$skill_id.", '".$days_option."',".$paid.")";
	//echo $query;die();

        $res = mysql_query($query) or $error =  mysql_error();
        if (!($res))
        {
            $errorMsg = "Error in inserting job details";
        }
        else
        {
            $status = 1;
        }

        //Push to Freelancer
        $job_id = mysql_insert_id();
		$this->SendNotification($employer_id,$freelancer_id,$job_id,0,1);
        $query_getDeviceToken = "SELECT t.*,u.user_name FROM tbldevicetoken t,tbluserdetails u WHERE u.user_id = ".$employer_id." AND t.user_id = ".$freelancer_id;
        $result_getDeviceToken = mysql_query($query_getDeviceToken);

        if(mysql_num_rows($result_getDeviceToken) > 0)
        {
            while($r = mysql_fetch_assoc($result_getDeviceToken))
            {
                $deviceToken = $r['device_token'];
                $deviceType = $r['device_type'];
                $message = $r['user_name']." sent you job request";
                //$this->sendNotification($employer_id,$freelancer_id,'0');
                $this->sendPush($deviceToken, $message, $deviceType);
            }
        }


        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;

        return $data;

    }

    public function GetAllJobsForFreelancer($PostData)
    {
        $this->markAllPassedJobsAsRejected();

        $errorMsg = "";
        $freelancer_id = addslashes(validateObject ($PostData , 'freelancer_id', ""));

       /* $queryJobs = "SELECT j.*,s.skill_description,s.skill_description_en, s.skill_description_ar, u.profile_pic AS employer_profile_pic,u.user_name AS employer_user_name,u.class AS employer_class,u.education_level AS employer_education_level FROM tbljobs j, tbluserdetails u, tblskills s  WHERE j.freelancer_id = ".$freelancer_id. " AND u.user_id = j.employer_id AND s.skill_id = j.skill_id ORDER BY job_id DESC";*/
        //u.location AS employer_location,u.latitude AS employer_latitude,u.longitude AS employer_longitude
        //echo $queryJobs;exit;
        
        $queryJobs = "SELECT j.*,s.skill_description, s.skill_description_en, s.skill_description_ar, u.profile_pic AS employer_profile_pic,u.user_name AS employer_user_name,u.class AS employer_class,u.education_level AS employer_education_level, IFNULL(paid_to_admin, 0) AS paid_to_admin, IFNULL(payment_requested, 0) AS freelancer_requested_payment , IFNULL(release_requested, 0) AS employer_requested_released , IFNULL(payment_release, 0) AS payment_release FROM tbljobs j
LEFT JOIN tblpayment p ON  j.job_id = p.job_id
INNER JOIN tbluserdetails u ON u.user_id = j.employer_id
INNER JOIN tblskills s ON s.skill_id = j.skill_id 
WHERE j.freelancer_id = ".$freelancer_id. " ORDER BY job_id DESC";
        $resultJobs = mysql_query($queryJobs);

        $result = array();

        while($r = mysql_fetch_assoc($resultJobs))
        {
            if($r['completed'])
            {
                $queryReview = "SELECT * FROM tblreviews WHERE job_id = ".$r['job_id']." AND reviewee_id = ".$r['employer_id'];
                $resultReview = mysql_query($queryReview);
                if(mysql_num_rows($resultReview)>0)
                    $r['review_added'] = 1;
                else
                    $r['review_added'] = 0;
            }
            else
                $r['review_added'] = 0;

            $result[] = $r;
        }

        $data['status'] =  '1';
        $data['message'] = $errorMsg;
        $data['Jobs'] = $result;
        return $data;
    }
      
    public function AcceptJob($JobData)
    {
        $status = 2;
        $errorMsg = "";

        $job_id = validateObject ($JobData , 'job_id', "");

        $query = "UPDATE tbljobs set accepted = 1  where job_id = ".$job_id;

        $res = mysql_query($query) or $error =  mysql_error();
        if (!($res))
        {
            $errorMsg = "Error in accepting job.";
        }
        else
        {

            $query_GetJobDetails = "SELECT j.*, u.user_name AS freelancer_name, d.device_token AS device_token, d.device_type AS device_type FROM tbljobs j, tbluserdetails u,tbldevicetoken d WHERE j.job_id = ".$job_id." AND u.user_id = j.freelancer_id AND d.user_id = j.employer_id";
            $result_GetJobDetails = mysql_query($query_GetJobDetails);           
            $r = mysql_fetch_assoc($result_GetJobDetails);
            $this->SendNotification($r['freelancer_id'],$r['employer_id'],$job_id,0,0);
            $message = $r['freelancer_name']." accepted your job request.";                
            $this->sendPush($r['device_token'], $message, $r['device_type']);

            $status = 1;
        }

        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;
        return $data;
    }

    public function RejectJob($JobData)
    {
        $status = 2;
        $errorMsg = "";

        $job_id = validateObject ($JobData , 'job_id', "");

        $query = "UPDATE tbljobs set rejected = 1  where job_id = ".$job_id;

        $res = mysql_query($query) or $error =  mysql_error();
        if (!($res))
        {
            $errorMsg = "Error in rejecting job.";
        }
        else
        {
            $query_GetJobDetails = "SELECT j.*, u.user_name AS freelancer_name, d.device_token AS device_token, d.device_type AS device_type FROM tbljobs j, tbluserdetails u,tbldevicetoken d WHERE j.job_id = ".$job_id." AND u.user_id = j.freelancer_id AND d.user_id = j.employer_id";
            $result_GetJobDetails = mysql_query($query_GetJobDetails);
            $r = mysql_fetch_assoc($result_GetJobDetails);
            $this->SendNotification($r['freelancer_id'],$r['employer_id'],$job_id,0,0);
            $message = $r['freelancer_name']." rejected your job request.";            
            $this->sendPush($r['device_token'], $message, $r['device_type']);

            $status = 1;
        }

        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;
        return $data;
    }

    public function UpdateCompletedJob($JobData)
    {
        $status = 2;
        $errorMsg = "";

        $job_id = validateObject ($JobData , 'job_id', "");

        $query = "UPDATE tbljobs set completed = 1  where job_id = ".$job_id;

        $res = mysql_query($query) or $error =  mysql_error();
        if (!($res))
        {
            $errorMsg = "Error in updating completed job.";
        }
        else
        {
            $status = 1;
        }

        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;
        return $data;
    }

    public function UpdatePaidJob($JobData)
    {
        $status = 2;
        $errorMsg = "";

        $job_id = validateObject ($JobData , 'job_id', "");

        $query = "UPDATE tbljobs set paid = 1  where job_id = ".$job_id;

        $res = mysql_query($query) or $error =  mysql_error();
        if (!($res))
        {
            $errorMsg = "Error in updating completed job.";
        }
        else
        {
            $status = 1;
        }

        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;
        return $data;
    }

    public function ForgotPassword($UserData)
    {
        $status = 2;
        $email = addslashes(validateObject ($UserData , 'email', ""));

        $queryUser = "Select email from tbluserdetails where email = '".$email."'";

        $resUserDetails = mysql_query($queryUser) or  $errorMsg =  mysql_error();

        if (mysql_num_rows($resUserDetails)>0)
        {
            $password = generateRandomString(10);
            $NewPassword = encryptPassword($password);

            $queryUpdate = "UPDATE tbluserdetails SET password = '".$NewPassword."' where email = '".$email."'";
            $resUpdate = mysql_query($queryUpdate) or $error =  mysql_error();

            if ($resUpdate)
            {
                $message = "Hi, \nThe new password for your account is: \n\n$password\n\nRegards, \n\nHelpYa Team";
                $sent = $this->sendEmail($message, $email, 'This Is The Password Recovery Of Your Account');


                if($sent)
                {
                    $status = 1;
                    $errorMsg = "Password sent successfully.";
                }
                else
                {
                    $errorMsg = "Error sending password.";
                }
            }
            else
            {
                $errorMsg = "Email Id not Available.";
            }
        }
        else
        {
            $errorMsg = "Email Id not Available.";
        }


        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;

        return $data;
    }

    function sendEmail($data, $sendto, $subject)
    {
        $mail = new PHPMailer();
        $mail->SMTPDebug = 1;  // Enable verbose debug output
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers// Enable SMTP authentication

        $mail->Username = 'demo.narolainfotech@gmail.com'; // SMTP username
        $mail->Password = 'Narola102'; // SMTP password

        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;  // TCP port to connect to

        $mail->setFrom('demo.narolainfotech@gmail.com', 'HelpYa');
        $mail->addAddress($sendto); // Add a recipient

        $mail->isHTML(false); // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body    = $data;
        if(!$mail->send())
        {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            return 0;
        } else {
            return 1;
        }
    }

    public function GetAllReviews($UserData)
    {
        $errorMsg = "";
        $user_id = addslashes(validateObject ($UserData , 'user_id', ""));
        //Alisha
        //$user_id = '105';

        $max_review_id = addslashes(validateObject($UserData,'max_review_id',""));
        $min_review_id = addslashes(validateObject($UserData,'min_review_id',""));

        if(strlen($max_review_id) > 0)
            $queryReviews = "SELECT u.user_name,u.profile_pic, r.*,j.skill_id,j.employer_id,j.freelancer_id,s.skill_description, s.skill_description_en, s.skill_description_ar FROM tbluserdetails u, tblreviews r,tbljobs j,tblskills s WHERE u.user_id = r.reviewer_id AND r.reviewee_id = ".$user_id." AND review_id > ".$max_review_id." AND j.job_id = r.job_id AND s.skill_id = j.skill_id order by review_id desc LIMIT 10";
        else if(strlen($min_review_id) > 0)
            $queryReviews = "SELECT u.user_name,u.profile_pic, r.*,j.skill_id,j.employer_id, j.freelancer_id,s.skill_description,s.skill_description_en, s.skill_description_ar FROM tbluserdetails u, tblreviews r,tbljobs j,tblskills s WHERE u.user_id = r.reviewer_id AND r.reviewee_id = ".$user_id." AND review_id < ".$min_review_id." AND j.job_id = r.job_id AND s.skill_id = j.skill_id order by review_id desc LIMIT 10";

        $resultReviews = mysql_query($queryReviews);
        $result = array();

        while($r = mysql_fetch_assoc($resultReviews))
        {
            $result[] = $r;
        }

        $data['status'] =  '1';
        $data['message'] = $errorMsg;
        $data['Reviews'] = $result;
        return $data;
    }

    public function  GetEligibleFreelancers($PostData)
    {
        $this->markAllPassedJobsAsRejected();
        $errorMsg = "";

        $user_id = validateObject($PostData, 'user_id', 0);
        $skill_ids = validateObject ($PostData , 'skill_ids', "");
        $skill_ids[] = '0';
		
  
		
        $queryGetAllTeachers = "SELECT s.*,u.* FROM tbluserdetails u, tbluserskills s WHERE u.user_id = s.user_id AND s.skill_id != '' AND u.user_id != ".$user_id;
        $resultGetAllTeachers = mysql_query($queryGetAllTeachers) or $error =  mysql_error();

        $result = array();

        while($r = mysql_fetch_assoc($resultGetAllTeachers))
        {
            $arrUserSkills = explode(',',$r['skill_id']);
            $intersectArray = array_intersect($skill_ids, $arrUserSkills);

            if(count($intersectArray) > 0)
            {
                $result[] = $r;
            }
        }

        $data['status'] =  '1';
        $data['message'] = $errorMsg;
        $data['MatchesFound'] = $result;
        return $data;
    }

    function sendPush($deviceToken, $message, $deviceType)
    {
        if ($deviceType == 'iOS')
        {
            $passphrase = 'password';

            $ctx = stream_context_create();
            stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
            stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

            // Open a connection to the APNS server
            $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

            if (!$fp)
                exit("Failed to connect: $err $errstr" . PHP_EOL);
            /*else
                echo "\n\n Successfully Connected to server";*/

            {
                // Create the payload body
                $body['aps'] = array(
                    'alert' => $message,
                    'sound' => 'default',
                    'deviceToken' => $deviceToken
                );

                // Encode the payload as JSON
                $payload = json_encode($body);

                // Build the binary notification
                $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

                // Send it to the server
                //$result = fwrite($fp, $msg, strlen($msg));
                $result = fwrite($fp, $msg, strlen($msg));

                /*if ($result)
                    echo "\n\n Message sent successfully...";*/
            }

            // Close the connection to the server
            fclose($fp);

        }
        else
        {
            $registration_ids = array();
            array_push($registration_ids, $deviceToken);


            // Set POST variables
            $url = 'https://android.googleapis.com/gcm/send';

//        $message = array("content" => $_POST['message']);
            $pushmessage = array("content" => $message);
            $fields = array(
                'registration_ids' => $registration_ids,
                'data' => $pushmessage,
            );


            /*$headers = array(
                'Authorization: key=AIzaSyCvZIjpLmOt1e5VRjJ4_AetFLCrV6TUenU',
                'Content-Type: application/json'
            );*/
            //AIzaSyBOpM-4-lCbBitQzpe__nZMaXryQip4U_g
            $headers = array(
                'Authorization: key=AIzaSyAUSWf6aeD5mgLDxuHiD0fasR06DWbWuEI',
                'Content-Type: application/json'
            );

            // Open connection
            $ch = curl_init();

            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            // Execute post
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }

            // Close connection
            curl_close($ch);
            //  echo $result;
        }
    }

    public function Logout($PostData)
    {
        $device_token =  addslashes(validateObject ($PostData , 'device_token', ""));

        $deviceTokenQuery = "SELECT * FROM tbldevicetoken where device_token = '".$device_token."'";
        $deviceTokenResult = mysql_query($deviceTokenQuery) or $errorMsg =  mysql_error();
        if(mysql_fetch_assoc($deviceTokenResult)>0)
        {
            $deleteDeviceTokenQuery = "DELETE FROM tbldevicetoken where device_token = '".$device_token."'";
            $deleteDeviceTokenResult = mysql_query($deleteDeviceTokenQuery) or $errorMsg =  mysql_error();
        }
        $data['status'] = '1';
        $data['message'] = '';

        return $data;
    }

    public  function  GetEmployerRequests($postData)
    {
        $this->markAllPassedJobsAsRejected();
        $status = '1';
        $errorMsg = "";
        $employer_id = addslashes(validateObject ($postData , 'employer_id', ""));

       // $queryRequests = "SELECT j.*,s.skill_description, s.skill_description_en, s.skill_description_ar, u.profile_pic AS freelancer_profile_pic,u.user_name AS freelancer_user_name,u.email AS freelancer_email,u.hourly_rate AS freelancer_hourly_rate,u.first_name AS freelancer_first_name,u.college_name AS freelancer_college,u.major AS freelancer_major FROM tbljobs j, tbluserdetails u, tblskills s  WHERE j.employer_id = ".$employer_id." AND u.user_id = j.freelancer_id AND s.skill_id = j.skill_id ORDER BY job_id DESC";
       //u.location AS freelancer_location,u.latitude AS freelancer_latitude,u.longitude AS freelancer_longitude
       
       //Ruchi Changes       
        $queryRequests = "SELECT j.*,s.skill_description, s.skill_description_en, s.skill_description_ar, u.profile_pic AS freelancer_profile_pic,u.user_name AS freelancer_user_name,u.email AS freelancer_email,u.hourly_rate AS freelancer_hourly_rate,u.first_name AS freelancer_first_name,u.college_name AS freelancer_college,u.major AS freelancer_major, IFNULL(paid_to_admin, 0) AS paid_to_admin, IFNULL(payment_requested, 0) AS freelancer_requested_payment , IFNULL(release_requested, 0) AS employer_requested_released , IFNULL(payment_release, 0) AS payment_release FROM tbljobs j
		LEFT JOIN tblpayment p ON  j.job_id = p.job_id
		INNER JOIN tbluserdetails u ON u.user_id = j.freelancer_id
		INNER JOIN tblskills s ON s.skill_id = j.skill_id 
		WHERE j.employer_id = ".$employer_id." ORDER BY job_id DESC";
		
        $resultRequests = mysql_query($queryRequests);

        if(!$resultRequests)
            $status = '0';
        $result = array();

        while($r = mysql_fetch_assoc($resultRequests))
        {
            if($r['completed'])
            {
                $queryReview = "SELECT * FROM tblreviews WHERE job_id = ".$r['job_id']." AND reviewee_id = ".$r['freelancer_id'];
                $resultReview = mysql_query($queryReview);
                if(mysql_num_rows($resultReview)>0)
                    $r['review_added'] = 1;
                else
                    $r['review_added'] = 0;
            }
            else
                $r['review_added'] = 0;

            $result[] = $r;
        }

        $data['status'] =  $status;
        $data['message'] = $errorMsg;
        $data['Requests'] = $result;
        return $data;
    }

    public function  GetAllJobsForFreelancerDashboard($PostData)
    {
        $errorMsg = "";
        $freelancer_id = addslashes(validateObject ($PostData , 'freelancer_id', ""));

        $queryJobs = "SELECT j.*,s.skill_description, s.skill_description_en, s.skill_description_ar, u.profile_pic AS employer_profile_pic,u.user_name AS employer_user_name,u.class AS employer_class,u.education_level AS employer_education_level FROM tbljobs j, tbluserdetails u, tblskills s  WHERE j.freelancer_id = ".$freelancer_id. " AND u.user_id = j.employer_id AND j.accepted AND s.skill_id = j.skill_id ORDER BY job_id ASC";
        $resultJobs = mysql_query($queryJobs);

        $result = array();

        while($r = mysql_fetch_assoc($resultJobs))
        {
            $result[] = $r;
        }

        $data['status'] =  '1';
        $data['message'] = $errorMsg;
        $data['Jobs'] = $result;
        return $data;
    }

    public function  GetAllJobsForEmployerDashboard($PostData)
    {
        $errorMsg = "";
        $employer_id = addslashes(validateObject ($PostData , 'employer_id', ""));

        $queryJobs = "SELECT j.*,s.skill_description, s.skill_description_en, s.skill_description_ar, u.profile_pic AS freelancer_profile_pic,u.user_name AS freelancer_user_name,u.college_name AS freelancer_college,u.major AS freelancer_major FROM tbljobs j, tbluserdetails u, tblskills s  WHERE j.employer_id = ".$employer_id." AND u.user_id = j.freelancer_id AND j.accepted AND s.skill_id = j.skill_id ORDER BY job_id ASC";
        $resultJobs = mysql_query($queryJobs);

        $result = array();

        while($r = mysql_fetch_assoc($resultJobs))
        {
            $result[] = $r;
        }

        $data['status'] =  '1';
        $data['message'] = $errorMsg;
        $data['Jobs'] = $result;
        return $data;
    }

    function markAllPassedJobsAsRejected()
    {
        $queryJobs = "UPDATE tbljobs SET rejected = 1 WHERE CONCAT(start_date,' ',start_time) < UTC_TIMESTAMP() AND !completed AND !accepted AND !rejected";
        mysql_query($queryJobs) or  mysql_error();
        $queryJobs = "UPDATE tbljobs SET completed = 1 WHERE CONCAT(end_date,' ',end_time) < UTC_TIMESTAMP() AND !rejected AND accepted AND !completed";
        mysql_query($queryJobs) or  mysql_error();
        $queryJobs = "SELECT job_id, DATE_SUB(CONCAT(start_date,' ',start_time), INTERVAL 1 HOUR) as startEarlier, UTC_TIMESTAMP() as currentTime from tbljobs where !rejected AND accepted AND !completed";
        $response = mysql_query($queryJobs) or  mysql_error();
        if(mysql_num_rows($response) > 0)
        {
        	while($r = mysql_fetch_assoc($response))
        	{
        		$job_id = $r['job_id'];
        		//$exact_time = $r['exactStartTime'];
        		$earlier_time = $r['startEarlier'];
        		$current_time = $r['currentTime']; 
        		if($current_time > $earlier_time)
        		{
        			$queryPayment = "SELECT * from tblpayment WHERE job_id = ".$job_id;
        			$responsePayment = mysql_query($queryPayment) or  mysql_error();
        			if(mysql_num_rows($responsePayment) == 0)
        			{
        				$updateJobs = "UPDATE tbljobs SET accepted = 0 , rejected = 1 WHERE job_id = ".$job_id;
        				mysql_query($updateJobs) or  mysql_error();
					}
        		}
        		
        	}
        }

    }
    
    /*Function Created by Ruchi*/
    function MakePayment($PostData)
    {
    	$errorMsg = "";
    	$status = 2;
    	$job_id = addslashes(validateObject ($PostData , 'job_id', ""));
    	$employer_id = addslashes(validateObject ($PostData , 'employer_id', ""));
    	$freelancer_id = addslashes(validateObject ($PostData , 'freelancer_id', ""));
    	$payfort_id = addslashes(validateObject ($PostData , 'payfort_id', ""));
    	$amount = addslashes(validateObject ($PostData , 'amount', ""));
    	$currency = addslashes(validateObject ($PostData , 'currency', ""));
    	
    	
        $query = "INSERT INTO tblpayment (job_id, employer_id, freelancer_id, payfort_id, amount, currency) values (".$job_id.",".$employer_id.",".$freelancer_id.",".$payfort_id.",'".$amount."','".$currency."')";
        $res = mysql_query($query) or $error =  mysql_error();
        if (!($res))
        {
            $errorMsg = "Error in inserting payment details";
        }
        else
        {
            $status = 1;
            //$updatejobs = "UPDATE tbljobs SET paid = 1 where job_id = ".$job_id."";
            //mysql_query($updatejobs) or  mysql_error();
        }
		$data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;

        return $data;
    	
    }
    
    function UpdateRequestForJob($JobData)
    {
    	$errorMsg = "";
    	$status = 2;
    	$user_id = addslashes(validateObject ($JobData , 'user_id', ""));
    	$job_id = addslashes(validateObject ($JobData , 'job_id', ""));
    	$call_for = addslashes(validateObject ($JobData , 'call_for', ""));
    	
    	$sql = "Select * from tblpayment where job_id = ".$job_id;
    	$response = mysql_query($sql) or $error =  mysql_error();
    	if(mysql_num_rows($response) > 0)
    	{
    		$r = mysql_fetch_assoc($response);
    		if($call_for == "requestForPayment")
    		{
    			$query = "UPDATE tblpayment set payment_requested = 1  where job_id = ".$job_id;
    			$this->SendNotification($user_id,$r['employer_id'],$job_id,1,0);
       		 	$res = mysql_query($query) or $error =  mysql_error();
       			if (!($res))
       			{
           			$errorMsg = "Error in updating request for payment job.";
       			}
       		 	else
       		 	{
           		 	$status = 1;
        		}
    		}
    		else if($call_for == "requestForRelease")
    		{
    			$query = "UPDATE tblpayment set release_requested = 1  where job_id = ".$job_id;
       			$res = mysql_query($query) or $error =  mysql_error();
        		if (!($res))
        		{
            		$errorMsg = "Error in updating request for payment job.";
        		}
        		else
        		{
            		$status = 1;
        		}
    		}
    		
    	}
    	else
    	{
    		$errorMsg = "Payment is not done.";
    	}   	
    	

        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;
        return $data;  
    }
    
    function UpdatePaymentRequestForJob($JobData)
    {
    	$errorMsg = "";
    	$status = 2;
    	$job_id = addslashes(validateObject ($JobData , 'job_id', ""));
    	
    	$sql = "Select * from tblpayment where job_id = ".$job_id;
    	$response = mysql_query($sql) or $error =  mysql_error();
    	if(mysql_num_rows($response) > 0)
    	{
    		$query = "UPDATE tblpayment set payment_requested = 1  where job_id = ".$job_id;

       		 $res = mysql_query($query) or $error =  mysql_error();
       		 if (!($res))
       		 {
           		 $errorMsg = "Error in updating request for payment job.";
       		 }
       		 else
       		 {
           		 $status = 1;
        	}
    	}
    	else
    	{
    		$errorMsg = "Payment is not done.";
    	}   	
    	

        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;
        return $data;    	
    }
    
    function UpdateReleaseRequestForJob($JobData)
    {
    	$errorMsg = "";
    	$status = 2;
    	$job_id = addslashes(validateObject ($JobData , 'job_id', ""));
    	
    	$sql = "Select * from tblpayment where job_id = ".$job_id;
    	$response = mysql_query($sql) or $error =  mysql_error();
    	if(mysql_num_rows($response) > 0)
    	{
    	
    		$query = "UPDATE tblpayment set release_requested = 1  where job_id = ".$job_id;

       		$res = mysql_query($query) or $error =  mysql_error();
        	if (!($res))
        	{
            	$errorMsg = "Error in updating request for payment job.";
        	}
        	else
        	{
            	$status = 1;
        	}
		}
		else
		{
			$errorMsg = "Payment is not done.";
		}
        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;
        return $data;
    	
    }
    
    function AddBankInfo($bankData)
    {
   		$errorMsg = "";
    	$status = 2;
    	
    	$user_id = addslashes(validateObject ($bankData , 'user_id', ""));
    	$type = addslashes(validateObject ($bankData , 'type', ""));  
    	$name = addslashes(validateObject ($bankData , 'Bank*', ""));
    	$branch = addslashes(validateObject ($bankData , 'Branch*', "")); 
    	$city = addslashes(validateObject ($bankData , 'City', ""));
    	$country = addslashes(validateObject ($bankData , 'Country*', ""));
    	$code = addslashes(validateObject ($bankData , 'Bank/IFSC Code', ""));
    	$swift_code = addslashes(validateObject ($bankData , 'Swift Code', ""));
    	$beneficiary_account = addslashes(validateObject ($bankData , 'IBAN No.*', ""));
    	$beneficiary_name = addslashes(validateObject ($bankData , 'Name*', ""));
    	$beneficiary_nickname = addslashes(validateObject ($bankData , 'NickName', ""));
    	$beneficiary_address = addslashes(validateObject ($bankData , 'Address', ""));
    	$beneficiary_phone = addslashes(validateObject ($bankData , 'Phone Number', ""));
    	$beneficiary_description = addslashes(validateObject ($bankData , 'Description', ""));
    	$beneficiary_currency = addslashes(validateObject ($bankData , 'Currency*', ""));     
    	
    	$sql = "Select * from tblbankinfo where user_id = ".$user_id."";    	
    	$response = mysql_query($sql) or $error =  mysql_error();
    	if(mysql_num_rows($response) == 0)
    	{
    		$query = "INSERT INTO tblbankinfo (user_id, type, name, branch, city, country, code, swift_code, beneficiary_account, beneficiary_name, beneficiary_nickname, beneficiary_address, beneficiary_phone, beneficiary_description, beneficiary_currency) values (".$user_id.",".$type.",'".$name."','".$branch."','".$city."','".$country."','".$code."','".$swift_code."','".$beneficiary_account."','".$beneficiary_name."','".$beneficiary_nickname."','".$beneficiary_address."','".$beneficiary_phone."','".$beneficiary_description."','".$beneficiary_currency."')";
    		//echo $query;
        	$res = mysql_query($query) or $error =  mysql_error();
        	if (!($res))
        	{
           	 	$errorMsg = "Error in inserting bank details";
       		}
        	else
        	{
          	  	$status = 1;
          	  	$errorMsg = "Bank info added successfully";
        	}
    	}    	
    	else
    	{
    		$updateQuery = "UPDATE tblbankinfo SET type=".$type.", name='".$name."', branch='".$branch."', city='".$city."', country='".$country."', code='".$code."', swift_code='".$swift_code."',beneficiary_account='".$beneficiary_account."', beneficiary_name='".$beneficiary_name."', beneficiary_nickname='".$beneficiary_nickname."', beneficiary_address='".$beneficiary_address."', beneficiary_phone='".$beneficiary_phone."', beneficiary_description='".$beneficiary_description."', beneficiary_currency='".$beneficiary_currency."' WHERE user_id=".$user_id;  		
    		$resUpdate = mysql_query($updateQuery) or $error =  mysql_error();
        	if (!($resUpdate))
        	{
           	 	$errorMsg = "Error in updating bank details";
       		}
        	else
        	{
          	  	$status = 1;
          	  	$errorMsg = "Bank info updated successfully";
        	}
    	}    	
    	
    	$data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;
        return $data;
    }
    
    function GetAllBanks()
    {
    	$status = 2;
        $errorMsg = "";

		//International Bank
        $querylevel0Country = "SELECT * FROM tblcountry where name <> 'Saudi Arabia' and is_active = 0 ORDER BY name ASC";
        $resultlevel0Country = mysql_query($querylevel0Country);
        $resultBanks = array();

        while($r0 = mysql_fetch_assoc($resultlevel0Country))
        {
            $country0 = $r0;
            //$country0['Banks'] = array();
            $querylevel1Bank = "SELECT bank_id, name FROM tblbanks WHERE country_id = ".$country0['country_id']." and is_active = 0 ORDER BY name ASC";
            $resultlevel1Bank = mysql_query($querylevel1Bank);
           if(mysql_num_rows($resultlevel1Bank)){
           		while($r1 = mysql_fetch_assoc($resultlevel1Bank))
            	{
                	$bank1 = $r1;
                	$bank1['Branches'] = array();
                	$querylevel2Branch = "SELECT branch_id, name FROM tblbranches WHERE bank_id = ".$bank1['bank_id']." ORDER BY name ASC";
                	$resultlevel2Branch = mysql_query($querylevel2Branch);
					if(mysql_num_rows($resultlevel2Branch)){
						while($r2 = mysql_fetch_assoc($resultlevel2Branch))
                		{
                    		$branch2 = $r2;
                   	 		$bank1['Branches'][] = $branch2;
               			}
               			$country0['Banks'][] = $bank1;
					}               		 
            }
            $resultBanks['International Bank'][]=$country0;
           }
        }        
        
        //Local Bank
        $querylevel0Country = "SELECT * FROM tblcountry where name = 'Saudi Arabia' and is_active = 0 ORDER BY name ASC";
        $resultlevel0Country = mysql_query($querylevel0Country);

        while($r0 = mysql_fetch_assoc($resultlevel0Country))
        {
            $country0 = $r0;
            $country0['Banks'] = array();
            $querylevel1Bank = "SELECT bank_id, name FROM tblbanks WHERE country_id = ".$country0['country_id']." ORDER BY name ASC";
            $resultlevel1Bank = mysql_query($querylevel1Bank);
           if(mysql_num_rows($resultlevel1Bank)){
           		while($r1 = mysql_fetch_assoc($resultlevel1Bank))
            	{
                	$bank1 = $r1;
                	$country0['Banks'][] = $bank1;   
                }                
                           		 
            }
            $resultBanks['Local Bank']=$country0;
           
        }
        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;
        $data['Type'] = $resultBanks;
        return $data;
    }
    
    function GetFinanceList($financeData)
	{	
		$status = 1;
        $errorMsg = "";        
        $user_id = addslashes(validateObject ($financeData , 'user_id', ""));
        
		$query = "SELECT j.job_id,  j.freelancer_id,  j.employer_id , j.skill_id, j.paid, uf.user_name as freelancer_name , uf.profile_pic as freelancer_pic, uf.major as freelancer_major, ue.user_name as employer_name , ue.profile_pic as employer_pic, ue.major as employer_major, s.skill_description, s.skill_description_en, s.skill_description_ar, p.amount, p.payment_release_date 
		FROM  tbljobs j
		LEFT JOIN tblpayment p ON j.job_id = p.job_id
		INNER JOIN tbluserdetails uf ON uf.user_id = j.freelancer_id
		INNER JOIN tbluserdetails ue ON ue.user_id = j.employer_id 
		INNER JOIN tblskills s ON s.skill_id = j.skill_id
		WHERE ((j.employer_id = ".$user_id." AND j.freelancer_id != ".$user_id.") OR (j.employer_id != ".$user_id." AND j.freelancer_id =".$user_id.")) AND j.paid = 1";
		
		$resFinance = mysql_query($query) or $error =  mysql_error();	
		$resultFinance = array();
		$payment_sent = 0;
		$payment_received = 0;
		if(mysql_num_rows($resFinance)){
       	 while($r = mysql_fetch_assoc($resFinance))
        	{
            	$resultFinance[] = $r;
            	if($r['employer_id'] == $user_id)
            	{
            		$payment_sent = $payment_sent + $r['amount'];
            	}
            	else if($r['freelancer_id'] == $user_id)
            	{
            		$payment_received = $payment_received + $r['amount'];
            	}
       		}
       		$status = 1;
       		$data['payment_sent'] = $payment_sent;
       		$data['payment_received'] = $payment_received;
       	}
		
		$data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;
        $data['Finance'] = $resultFinance;
        return $data;
	}
	
	function AddComplaints($complaintsData)
	{
		$status = 2;
        $errorMsg = "";  
        $user_id = addslashes(validateObject ($complaintsData , 'user_id', ""));
        $description = addslashes(validateObject ($complaintsData , 'description', ""));
        $action = addslashes(validateObject ($complaintsData , 'action', ""));
        
		/*$sql = "Select * from tblcomplaints where user_id = ".$user_id."";    	
    	$response = mysql_query($sql) or $error =  mysql_error();
    	if(mysql_num_rows($response) == 0)
    	{*/
    		$query = "INSERT INTO tblcomplaints (user_id, description, action) values (".$user_id.",'".$description."','".$action."')";
    		//echo $query;
        	$res = mysql_query($query) or $error =  mysql_error();
        	if (!($res))
        	{
           	 	$errorMsg = "Error in inserting complaints";
       		}
        	else
        	{
          	  	$status = 1;
          	  	$errorMsg = "Complaint added successfully";
        	}
    	//}    	
    	/*else
    	{
    		$updateQuery = "UPDATE tblcomplaints SET description='".$description."', action='".$action."' WHERE user_id=".$user_id;  		
    		$resUpdate = mysql_query($updateQuery) or $error =  mysql_error();
        	if (!($resUpdate))
        	{
           	 	$errorMsg = "Error in updating complaints";
       		}
        	else
        	{
          	  	$status = 1;
          	  	$errorMsg = "Complaint updated successfully";
        	}
    	}  */
		$data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;
        $data['Complaints'] = $resultFinance;
        return $data;
	}
	
	public function CancelJob($JobData)
    {
        $status = 2;
        $errorMsg = "";

        $job_id = validateObject ($JobData , 'job_id', "");

        $query = "DELETE from tbljobs where job_id = ".$job_id;

        $res = mysql_query($query) or $error =  mysql_error();
        if (!($res))
        {
            $errorMsg = "Error in cancelling job.";
        }
        else
        {

            $query_GetJobDetails = "SELECT j.*, u.user_name AS freelancer_name, d.device_token AS device_token, d.device_type AS device_type FROM tbljobs j, tbluserdetails u,tbldevicetoken d WHERE j.job_id = ".$job_id." AND u.user_id = j.freelancer_id AND d.user_id = j.employer_id";
            $result_GetJobDetails = mysql_query($query_GetJobDetails);
           /* while($r = mysql_fetch_assoc($result_GetJobDetails))
            {
                $message = $r['freelancer_name']." cancelled job request.";
                $this->sendPush($r['device_token'], $message, $r['device_type']);
            }*/

            $status = 1;
        }

        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;
        return $data;
    }
    
    public function SendNotification($sender_id, $reciever_id, $job_id, $notification_type, $reciever_type)
    {
    	$notification_query = mysql_query("INSERT INTO tblnotifications(sender_id,reciever_id,job_id,notification_type,reciever_type) VALUES
	        ('" . $sender_id . "','" . $reciever_id . "','" . $job_id . "',".$notification_type.",".$reciever_type.")") or die(mysql_error());        
    }
    
    public function DeleteSeenNotification($NotificationData)
    {
   		$reciever_id = validateObject ($NotificationData , 'reciever_id', "");
   		$reciever_type = validateObject ($NotificationData , 'reciever_type', "");
    	$notification_query = mysql_query("DELETE FROM tblnotifications WHERE reciever_id = '".$reciever_id."' and reciever_type = ".$reciever_type."") or die(mysql_error());        
    	//echo "DELETE FROM tblnotifications WHERE reciever_id = '".$reciever_id."' and reciever_type = ".$reciever_type."";
    	$data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;
        return $data;
    }
    public function GetNotification($NotificationData)
    {
    	$status = 2;
        $errorMsg = "";
        $totalpendingcount = 0;
        $totalcompletecount = 0;
        $emp_pendingcount = 0;
        $emp_completecount = 0;
        $fre_pendingcount = 0;
        $fre_completecount = 0;

        $reciever_id = validateObject ($NotificationData , 'reciever_id', "");
        
        $notification_query = "SELECT * from tblnotifications where reciever_id = ".$reciever_id;        
        $result_notification = mysql_query($notification_query) or die(mysql_error());
        $count = mysql_num_rows($result_notification);
        if ($count > 0)
        {
        	while ($n = mysql_fetch_assoc($result_notification))
            {
            
            	if($n['reciever_type'] == 0)//it means reciever is an employer
            	{
            		if($n['notification_type'] == 0)
            		{
            			$emp_pendingcount = $emp_pendingcount + 1;             			
            		}
            		else
            		{
            			$emp_completecount = $emp_completecount + 1;            			
            		}
            	}
            	else //it means reciever is an freelancner
            	{
            		if($n['notification_type'] == 0)
            		{
            			$fre_pendingcount = $fre_pendingcount + 1;            			
            		}
            		else
            		{
            			$fre_completecount = $fre_completecount + 1;            			
            		}
            	}
            }
            //$emp_pendingcount = 0;$emp_completecount = 0;$fre_pendingcount = 0;$fre_completecount = 0;
            $notification = array();
            if($emp_pendingcount>0)
            {
            	$notification['Hire']['pending'] = $emp_pendingcount;
            }
            if($emp_completecount>0)
            {
            	$notification['Hire']['complete'] = $emp_completecount;
            }
            
            if($fre_pendingcount>0)
            {
            	$notification['Job']['pending'] = $fre_pendingcount;
            }
            if($fre_completecount>0)
            {
            	$notification['Job']['complete'] = $fre_completecount;
            }
            
            if($emp_pendingcount + $emp_completecount > 0)
            {
            	$data['employerCount'] = $emp_pendingcount + $emp_completecount;
            }
            if($fre_pendingcount + $fre_completecount > 0)
            {
            	$data['freelancerCount'] = $fre_pendingcount + $fre_completecount;
            }
            $status = 1;
          
        }
        if (!empty($notification))
        	 $data['notification'] = $notification;
       // print_r($notification);
       
        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;
        return $data;
        
    } 
    
    public function GetCustomAds()
    {
    	//$con = $GLOBALS['con'];
    	$status = 2;
        $errorMsg = "";
        $ad_array=array();
        $ad_query = "SELECT url, CONCAT('http://ns372321.ip-46-105-111.eu/~helpyaapp/HelpYa_WS/adsimage/', image) as adImages from tblcustomads where is_active = 0";        
       /* if($ad_query_stmt = $con->prepare($ad_query))
        {
        	$ad_query_stmt->execute();
            $ad_query_stmt->store_result();
            if ($ad_query_stmt->num_rows > 0) {
              while ($ads = fetch_assoc_all_values($ad_query_stmt)) {
              	$ad_array[] = $ads;
              }
              $status = 1;
        	}
        }
        $ad_query_stmt->close();*/
        $result_ads = mysql_query($ad_query) or die(mysql_error());
        $count = mysql_num_rows($result_ads);
        if($count >  0)
        {
        	while ($ads = mysql_fetch_assoc($result_ads)){
        		//$ads['adImages'] = $this->getAdImages($ads['ad_id']);
        		$ad_array[] = $ads;
        	}
        	$status = 1;
        }
        $data['status'] = ($status > 1) ? '0' : '1';
        $data['message'] = $errorMsg;
        $data['customAds'] = $ad_array;
        return $data;
    }
    
}

?>