<?php

namespace App\Controllers\Api\Mobile;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json; charset=UTF-8");

use App\Controllers\Api\ApiBaseController as ApiBaseController;
use Quill\Factories\CoreFactory;
use Quill\Factories\ServiceFactory;
use Quill\Factories\ModelFactory;
use Quill\Exceptions\BaseException;
use Quill\Exceptions\ValidationException;
use Minishlink\WebPush\WebPush;

class UserController extends ApiBaseController {

    /**
     * Constructor
     * @param object contains app core.
     */
    function __construct($app = NULL) {

        // Call to parent class constructer.
        parent::__construct($app);

        // Instantiate models.
        $this->models = ModelFactory::boot(array('User', 'Admin','Candidate','MasterExpertise','MasterExperience','MasterDegree','MasterStudyField','MasterCollege','MasterLocations',"MasterSkillLevel",'Employer','EmployerCards','MasterLocations','VideoStats',"CandidateEducation","CandidateJobs","CandidateLocation","CandidateSkill"));

        // Instantiate core classes.
        $this->core = CoreFactory::boot(array('Response', 'Http', 'View'));

        // Instantiate services.
        $this->services = ServiceFactory::boot(array('Jwt'));
    }

    /**
     * @api {post} /api/user/login/ login user.
     * @apiName login
     * @apiGroup api/user
     * @apiDescription Use this api to login.
     * @apiParamExample {json} Request-Example:
     * {
     * "subject": "Some text",
     * "message": "Some text"
     * }
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {
     * @author Loveleen
     * @date 9 jan, 2018
     * "meta": {
     * "success": true,
     * "code": 200
     * },
     * "data": {
     * "message": "You have logged in successfully.",
     * }
     * }
     */
   /* public function login() {

        $request = $this->jsonRequest;

        $rules = [
            'required' => [['username'], ['password']]];

        $v = new \Quill\Validator($request, array('username', 'password', 'rsvp_id', 'remember_user'));

        $v->rules($rules);

        if ($v->validate()) {

            $user = $v->sanatized();

            if (isset($user['remember_user'])) { // user selected keep me logged in
                $days = 30;
            } else { // user not selected keep me logged in
                $days = 1;
            }
            $user_detail = $this->models->user->getUserDetailsByUsername($user['username']);

            if ($user_detail['username'] !== $user['username']) { // make the user name case sensetive
                throw new BaseException('Username or password incorrect.');
            }

            if (!empty($user_detail)) { // if user detail exist
                $check = password_verify($user['password'], $user_detail['password']);

                if ($check) { // password match

                } else { // password dont match
                    throw new BaseException('Username or password incorrect.');
                }
            } else {
                throw new BaseException('Username or password incorrect.');
            }
        } else {

            throw new ValidationException($v->errors());
        }
    }
*/
 public function login() {

        $request = $this->jsonRequest;

        $rules = [
            'required' => [['email'], ['password']]];

        $v = new \Quill\Validator($request, array('email', 'password'));

        $v->rules($rules);


         if ($v->validate()) {

            $user = $v->sanatized();

            if (isset($user['remember_user'])) { // user selected keep me logged in
                $days = 30;
            } else { // user not selected keep me logged in
                $days = 1;
            }
            $user_detail = $this->models->user->getUserDetailsByUsername($user['email']);

            if ($user_detail['Email'] !== $user['email']) { // make the user name case sensetive
                throw new BaseException('Email or password incorrect.');
            }

            if (!empty($user_detail)) { // if user detail exist
                $check = password_verify($user['password'], $user_detail['Password']);

                if ($check) { // password match
                    if ($user_detail['is_verified'] == '1') {

                        if ($user_detail['Status'] == 'Active') { // active user
                            // Active user
                          
                            $user_detail['token'] = $this->services->jwt->genrateUserToken($user_detail['user_id'], $this->app->config('base_url') . 'api/user/login/', $this->app->config('domain'));

                            setcookie('token', $user_detail['token'], time() + (3600 * 24 * $days), $this->app->config('path'), $this->app->config('domain'), false, true);

            
                         $data = array();

                $data['user'] = 1;
                $data['role'] = $user_detail['Role'];
                $data['status'] = $user_detail['Status'];
                $data['message'] = 'You logged in successfully';

                            $this->core->response->json($data);
                        } else if ($user_detail['status'] == '0' && $user_detail['is_deleted'] == '0') { // Inactive user
                            throw new BaseException('Your account has been deactivated by admin. Please contact administrator.');
                        } else { // deleted user
                            $message = $user_detail['deleted_by'] == 'admin' ? "You account has been deleted by admin, please contact administrator." : "You have deleted your account.";
                            throw new BaseException($message);
                        }
                    } else {
                        throw new BaseException('Your account is not verified yet. Please check your email to verify your acccount.');
                    }
                } else { // password dont match
                    throw new BaseException('Username or password incorrect.');
                }
            } else {
                throw new BaseException('Username or password incorrect.');
            }
        } else {

            throw new ValidationException($v->errors());
        }


    }







    /**
     *
     *  Function is giving link to user where password is reg
     enerated
     * @author Loveleen 
     * @date 9 Jan, 2018
     * "meta": {
     * "success": true,
     * "code": 200
     * },
     * "data": {
     * "message": "Please check your email for reset password link.",
     * }
     * }
     */
    public function regeneratePassword() {

        $request = $this->jsonRequest;

        $rules = [
            'required' => [['email']]];

        $v = new \Quill\Validator($request, array('email'));

        $v->rules($rules);

        if ($v->validate()) {

            $user = $v->sanatized();

            $user_detail = $this->models->user->checkEmail($user['email']);

            if (!empty($user_detail)) {

                if ($user_detail['status'] == '1') { // if user is active
                    $app = array(
                        'base_assets_url' => $this->app->config('base_assets_url'),
                        'base_url' => $this->app->config('base_url')
                    );
                    $user_info = array('sender' => $user_detail['username'],
                        'username' => $user_detail['username'],
                        'link' => $this->app->config('base_url') . 'generatePassword/' . $user_detail['verify_token'] . '/');

                    // send email to user for account activation
                    $this->services->emailNotification = new \App\Services\EmailNotification();
                    $this->services->emailNotification->sendMail(array('email' => $user_detail['email'], 'name' => $user_detail['username']), 'BrainPatient Password Regeneration', $this->core->view->make('email/passwordReset.php', array('user' => $user_info, 'app' => $app), false));

                    $user_data = array();
                    $user_data['user_id'] = $user_detail['user_id'];
                    $user_data['token_date_time'] = date('Y-m-d H:i:s');
                    $user_detail = $this->models->user->save($user_data);

                    if (!empty($user_detail)) {
                        $data = array();
                        $data['message'] = "Please check your email for reset password link.";
                        $this->core->response->json($data);
                    }
                } else {
                    throw new BaseException('You can only reset password once your account has been verified. Please check your email for instructions on how to verify.');
                }
            } else {
                throw new BaseException("Email address doesn't exist.");
            }
        } else {

            throw new ValidationException($v->errors());
        }
    }

      public function check(){
      $email  = $_POST['email'];
      $emailcheck = $this->models->user->check($email); 
    }

   

    /**
     *
     *  Function is giving link to user where password is regenerated
     * @author Loveleen 
     * @date 9 Jan, 2018
     * "meta": {
     * "success": true,
     * "code": 200
     * },
     * "data": {
     * "message": "Please check your email for reset password link.",
     * }
     * }
     */
    public function resetPassword() {

        $request = $this->jsonRequest;

        $rules = [
            'required' => [['password'], ['confirm_password']]
        ];

        $v = new \Quill\Validator($request, array('password', 'confirm_password', 'email'));

        $v->rules($rules);

        if ($v->validate()) {

            $user = $v->sanatized();

            $user_detail = $this->models->user->getUserDetailsByEmail($user['email']);

            if (!empty($user_detail)) {

                if ($user['password'] == $user['confirm_password']) { // both password matches
                    $user_data = array();
                    $user_data['user_id'] = $user_detail['user_id'];
                    $user_data['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
                    $user_detail = $this->models->user->save($user_data);

                    $data = array();
                    $data['message'] = "Password changed successfully.";

                    $_SESSION["account_exist"] = "Password changed successfully.";

                    $this->core->response->json($data);
                } else {
                    throw new BaseException('Confirmation password is wrong.');
                }
            } else {
                throw new BaseException("Email address doesn't exist.");
            }
        } else {

            throw new ValidationException($v->errors());
        }
    }

    /**
     *
     *  Function for user logout
     * @author Loveleen 
     * @date 9 Jan, 2018
     * "meta": {
     * "success": true,
     * "code": 200
     * },
     * "data": {
     * "message": "User logout successfully.",
     * }
     * }
     */
    public function logout() {
        if (!empty($_COOKIE['token'])) {

            $request = $this->jsonRequest;

            setcookie('token', '', time() - (3600 * 24), $this->app->config('path'), $this->app->config('domain'), false, true);
//            $logged_out_data = array();
//            $logged_out_data['id'] = $request['id'];
//            $logged_out_data['is_loggedin'] = '0';
//            $logged_out_data['last_loggedout_date'] = date("Y-m-d h:i:s");
//            $this->models->user->save($logged_out_data);

            $data = array();
            $data['message'] = 'User logout successfully.';
            $this->core->response->json($data);
        }
    }

    /**
     *
     * Function for changing password
     * @author Loveleen 
     * @date 25 Jan, 2018
     * @return {"meta":{"success":true,"code":200},"data":{"message":"Password changed successfully."}}
     */
    public function changePassword() {

        $request = $this->jsonRequest;

        $user_data = array();

        $user_data = $this->app->user;

        $rules = [
            'required' => [['current_password'], ['new_password'], ['confirm_password']]
        ];

        $v = new \Quill\Validator($request, array('current_password', 'new_password', 'confirm_password'));

        $v->rules($rules);

        if ($v->validate()) {

            $data = array();
            $post_data = $v->sanatized();

            if (!empty($user_data)) { // check user is login
                $check = password_verify($post_data['current_password'], $user_data['password']);

                // password validation
                if (strlen($post_data['current_password']) < 6) { // password matches not matches the length
                    throw new BaseException('Minimum six characters required in current password.');
                }

                if (!empty($check)) { // if current password not matching the entered password
                    if ($post_data['current_password'] == $post_data['new_password']) {
                        throw new BaseException("Current password and old password should not be same.");
                    }
                    if ($post_data['new_password'] == $post_data['confirm_password']) { // both password same
                        // password validation
                        if (strlen($post_data['new_password']) < 6) {
                            throw new BaseException('Minimum six characters required in new password.');
                        }
                        $detail = array();
                        $detail['user_id'] = $user_data['user_id'];
                        $detail['password'] = password_hash($post_data['new_password'], PASSWORD_DEFAULT);
                        $user_detail = $this->models->user->save($detail); // save user detail

                        if (!empty($user_detail)) {
                            $data['message'] = 'Password changed successfully.';
                            $this->core->response->json($data);
                        }
                    } else {
                        throw new BaseException("Confirmation password is incorrect.");
                    }
                } else {
                    throw new BaseException("Current password is incorrect.");
                }
            } else {
                throw new BaseException("User is not login.");
            }
        } else {

            throw new ValidationException($v->errors());
        }
    }
    
    /**
     *
     *  Function for admin login
     * @author Loveleen 
     * @date 11 Jan, 2018
     * "meta": {
     * "success": true,
     * "code": 200
     * },
     * "data": {
     * "message": "You logged in successfully.",
     * }
     * }
     */
    public function adminLogin() {

        $request = $this->jsonRequest;

        $rules = [
            'required' => [['username'], ['password']]];

        $v = new \Quill\Validator($request, array('username', 'password'));

        $v->rules($rules);

        if ($v->validate()) {

            $user = $v->sanatized();

            $user_detail = $this->models->admin->getUserDetailsByUsername($user['username']);

            $check = password_verify($user['password'], $user_detail['password']);

            if (!empty($user_detail) && $check) { // check password is same
                $_SESSION['user_data']['user_id'] = $user_detail['admin_id'];
                $_SESSION['user_data']['user_name'] = $user_detail['username'];
                $_SESSION['user_data']['email'] = $user_detail['email'];

                $data = array();
                $data['user'] = 1;
                $data['message'] = 'You logged in successfully';

                $this->core->response->json($data);
            } else {
                throw new BaseException('Username or password incorrect');
            }
        } else {

            throw new ValidationException($v->errors());
        }
    }
}
