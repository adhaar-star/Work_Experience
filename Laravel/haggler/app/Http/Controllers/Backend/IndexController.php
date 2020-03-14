<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\PasswordReset;


class IndexController extends BackendController {

	protected $disableSecurity = true; 

	public function __construct() {
		parent::__construct();
		$this->middleware('guest', ['except' => ['getLogout']]);
	}
	
	public function getIndex() {

		$this->layout->content = view('backend.index.login');
		return $this->layout;
	}

	public function postLogin(\Illuminate\Http\Request $request) {

		$valid = \Validator::make($request->all(), [
				'username' => 'required',
				'password' => 'required'
			]);

		if ($valid->fails()) {
			return redirect($this->adminBase())->with([
				'message' => ['text' => 'Invalid login details',
				'class' => 'alert-danger']
				])
			->withErrors($valid)
			->withInput($request->except('password'));
		}

		$field = filter_var($request->get('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

		$auth = \Auth::attempt([
        'email'  => $request->get('username'),
        'password' => $request->get('password'),
        //'role' => 'admin|vendor',
        'status' => 'active',

        ]);
        if($auth && \Auth::user()->role == 'customer'){
        	
        	       \Auth::logout();
	        	 	return redirect($this->adminBase())
				->with(['message' => $this->alert('You are not Authorized to login here.', 'alert-danger') ])
				->withInput($request->except('password'));
   
        }

		if (!$auth) {
			return redirect($this->adminBase())
			->with(['message' => $this->alert('Invalid email or password.', 'alert-danger') ])
			->withInput($request->except('password'));
		}

		return redirect($this->adminBase('dashboard'));


	}

	public function getForgotPassword() {
		$this->layout->content = view('backend.index.forgot-password');
		return $this->layout;
	}

	public function getResetPassword($token){

         if(!empty($token)){
            $resetUser =  PasswordReset::where('token',$token)->first();
            if(!empty($resetUser)){
            	$timestamp = strtotime($resetUser->created_at) +  3600;

            	if ($timestamp < strtotime('now')) {

            		die("token expired");
            	}

            	
            	$user = User::where('email',$resetUser->email)->first();

                 $this->layout->content = view('backend.index.reset_password',['user' =>$user ]);
		         return $this->layout;
                
            }else{

                 $this->layout->content = view('backend.index.login');
		         return $this->layout;

            }

         }
		


	}

	public function postResetPassword(\Illuminate\Http\Request $request){
     
           $user = User::find($request->user_id);
           $valid = \Validator::make($request->all(), [
				 'password' => 'required|confirmed'

			]);

           if($valid->fails()){

           	return redirect()->back()->with([
				'message' => ['text' => 'Unable to save info',
				'class' => 'alert-danger']
				])
			->withErrors($valid);
           }

           $user->username = $request->get('username','');
           $user->password = $request->get('password','');
           if($user->save()){
                return redirect()->back()->with(['message' => ['text' => 'Password reset successfully !','class'=>'alert-success']]);
           }

           return redirect()->back()->with(['message' => ['text' => 'Unable to save vendor information !','class'=>'alert-danger']]);


	}

	public function postForgotPassword() {
		

		$u = User::where('email', \Input::get('email'))->first();

		if (!$u) {
				return redirect($this->adminBase('/forgot-password'))->with([
				'message' => ['text' => 'Invalid email or email is not registered.',
				'class' => 'alert-danger']
				]);
		}

		    $resetToken = str_random(40);
            $passwordReset = new PasswordReset();
            $passwordReset->email = $u->email;
            $passwordReset->token = $resetToken;
            $passwordReset->created_at = date('Y-m-d H:i:s');
            $tokenUrl = \URL::to('admin/reset-password/'.$resetToken);
            if($passwordReset->save()){


            	$mStatus = \Mail::send('backend.email.reset_password',['user' => $u,'resetLink' => $tokenUrl ], function ($message) use($u){
			    $message->from('us@example.com', 'Haggler');
			    $message->subject("Haggler Reset Password");

			    $message->to($u->email);
			    });

            	

			    return redirect($this->adminBase('/'))->with([
				'message' => ['text' => 'Please check your email. A link  has been mailed to your registered email id.',
				'class' => 'alert-success']
				]);


            }


		

	}

	public function getLogout() {
		if (\Auth::guest()) {
			return response('Unauthorized.', 401);
		}

		\Auth::logout();

		return redirect($this->adminBase());
	}
	
}