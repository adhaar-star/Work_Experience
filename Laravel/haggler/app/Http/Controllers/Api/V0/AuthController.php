<?php



namespace App\Http\Controllers\Api\V0;



use \App\Models\User; 
use \App\Models\Device; 
use \App\Exceptions\Handler; 
use Socialite;

use \App\Models\ForgotPassword; 



class AuthController extends ApiController {

	

	public function postLogin(\Illuminate\Http\Request $request) {



		$valid = \Validator::make($request->all(), [

				'username' => 'required',

				'password' => 'required',
				'token'	=> '',
		        'device_type' => 'in:android,ios'

			]);



		if ($valid->fails()) {

			$this->addError('Invalid login details');

			return $this->response([], 401);

		}



		$field = filter_var($request->get('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';



		$auth = \Auth::attempt([

        $field  => $request->get('username'),

        'password' => $request->get('password'),

        'status' => 'active',

        //'role' => 'customer'

        ]);



		if (!$auth) {

			$this->addError('Username or password is incorrect');

			return $this->response([], 401);

		}



		$user = \Auth::user();
		
	\Mail::send('api.email.get_welcome_email',['user' => $user],function ($message) use($user)
		{
			    $message->from("testingbytes15@gmail.com","Haggler");
			    $message->subject("Haggler - WELCOME");
			    $message->to($user->email);
			    $message->replyTo("info@haggler.in","Haggler");

		});
\Mail::getSwiftMailer()->getTransport()->stop();
		
		if (!empty($request->get('token'))) {
			$user->device_id = $request->get('token');
		}
		$user->device_type = $request->get('device_type');

		//$user->api_token = str_random(rand(40,60));

$data = json_decode($user->reward, false);
 empty($data) ? (object)[]: $data;
		
		$device = Device::where("device_id",$request->get('token'))->first();

		if(empty($device)){

			$device = new Device();
			$device->user_id = $user->id;
			$device->device_id = $request->get('token');
			$device->device_type = $request->get('device_type');
			$device->save();
		}
		

		return $this->response($user);



	}



	public function registerFacebook() {

	}

	public function loginFacebook(\Illuminate\Http\Request $request){
//echo $request->get('firstName');die;
		$email = $request->get('email');
		$access_token = $request->get('access_token');
		$user = User::with('reward')->where('email',$email)->first();
		//$providerUser = Socialite::driver('facebook')->userFromToken($request->get('token'));

		if(!$user){
			$user2 = new User();

		$user2->api_token = str_random(rand(40,60));

		$user2->firstname = $request->get('firstName');
$user2->lastname = $request->get('lastname');
		//$user2->username = $request->get('firstName').$request->get('lastname');
		$user2->is_facebook_login = "yes";
			
		$user2->password = $request->get('regId');

		$user2->email = $email;

		$user2->device_id = $request->get('token');
		$user2->device_type = $request->get('device_type');

		$user2->status = 'active';

		$user2->role = 'customer';
			
		$user2->save();
		

			
$this->addMessage('user successfully logged in ');
	$query2=\Mail::send('api.email.get_welcome_email',['user' => $user2],function ($message) use($user,$email)
		{
			
			    $message->from("testingbytes15@gmail.com","Haggler");
			    $message->subject("Haggler - WELCOME");
			    $message->to($email);
			    $message->replyTo("info@haggler.in","Haggler");
		});
\Mail::getSwiftMailer()->getTransport()->stop();
			
		if($query2){
$mailresponse2="Mail successfully sent";
			}
			else{
		$mailresponse2="Error Sending Mail";	
			}
			
		$d = ['user'=>$user2,'Mail Response'=>$mailresponse2];
return $this->response($d);			//return $this->response();
			//return $this->response();
		}
		$query=\Mail::send('api.email.get_welcome_email',['user' => $user],function ($message) use($user)
		{
			    $message->from("testingbytes15@gmail.com","Haggler");
			    $message->subject("Haggler - WELCOME");
			    $message->to($user->email);
			    $message->replyTo("info@haggler.in","Haggler");
		});
\Mail::getSwiftMailer()->getTransport()->stop();
			
		if($query){
$mailresponse="Mail successfully sent";
			}
			else{
		$mailresponse="Error Sending Mail";	
			}
		
		$d = ['user'=>$user,'Mail Response'=>$mailresponse];
	
					$this->addMessage('user successfully logged in ');
		return $this->response($d);


	}
	

	public function getLogout() {



		

		if (!\Auth::check()) {

			$this->addError('You are already logout');

			return $this->response();

		}

		$user = \Auth::user();

		$user->api_token = null;

		//$user->save();



		return $this->response();



	}



	public function postRegister(\Illuminate\Http\Request $request) {



		$valid = \Validator::make($request->all(), [

				'username'        => 'required|unique:users,username',

		        'email' => 'required|email|unique:users,email',

		        'password' => 'required|min:5',

		        'device_id'	=> '',
		        'device_type' => 'in:android,ios'

			]);



		if ($valid->fails()) {

			$this->addMessage($valid->errors());

			$this->addError('Validation errors');

			return $this->response();

		}



		$user = new User();

		$user->api_token = str_random(rand(40,60));

		$user->username = $request->get('username');

		$user->password = $request->get('password');
		$user->is_facebook_login = "no";

		$user->email = $request->get('email');

		$user->device_id = $request->get('device_id');
		$user->device_type = $request->get('device_type');

		$user->status = 'active';

		$user->role = 'customer';

		if ($user->save()) return $this->response($user);





		$this->addError('Unable to process request');

		return $this->response();



	}


	public function getForgotPassword(\Illuminate\Http\Request $request){

		$valid = \Validator::make($request->all(), [

		        'email' => 'required|email',

			]);

		if ($valid->fails()) {

			

			$this->addMessage($valid->errors());

			$this->addError('Validation errors');

			return $this->response();

		}

		$user = User::where('email',$request->get("email"))->where('role','customer')->first();

		if(empty($user)){


			$this->addError('User with this email is not exists.');

			return $this->response();

		}

		//$forgotCode = str_random(rand(6,8)) . time();
$forgotCode = rand(100000, 999999);
\Mail::send('api.email.get_forgot_password',['user' => $user,'code' => $forgotCode ],function ($message) use($user)
		{
			    $message->from("testingbytes15@gmail.com","Haggler");
			    $message->subject("Haggler - Forgot Password");
			    $message->to($user->email);
			    $message->replyTo("info@haggler.in","Haggler");
		});

	
		$forgot = new ForgotPassword();
		$forgot->user_id = $user->id;
		$forgot->email = $user->email;
		$forgot->token = $forgotCode;

        if($forgot->save())
		  return $this->response();


		$this->addError('Error in forgot password.');

		return $this->response();

	


	}


	public function postForgotPassword(\Illuminate\Http\Request $request){

		$valid = \Validator::make($request->all(), [

		        'email' => 'required|email',
		        'code' => 'required',
		        'password' => 'required|min:5'

			]);


		$forgot = ForgotPassword::where('email',$request->get('email'))->where('token',$request->get('code'))->orderBy('id','desc')->first();

		if(empty($forgot)){


			$this->addError('You are not authorized to reset password.');

			return $this->response();


		}
		$forgotCode = rand(100000, 999999);
				$user = User::where('email',$request->get("email"))->where('role','customer')->first();

\Mail::send('api.email.get_change_password',['user' => $user,'code' => $forgotCode ],function ($message) use($user)
		{
			    $message->from("testingbytes15@gmail.com","Haggler");
			    $message->subject("Haggler - CHANGE PASSWORD");
			    $message->to($user->email);
			    $message->replyTo("info@haggler.in","Haggler");
		});
\Mail::getSwiftMailer()->getTransport()->stop();

		$user = User::find($forgot->user_id);

		$user->password = $request->get('password');

		if($user->save()){

			ForgotPassword::where('email',$request->get('email'))->delete();

			return $this->response();

		}


		$this->addError('Error in forgot password.');

		return $this->response();





	}



}