<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\register;
use App\Role;
use App\phoneverify;
use App\Company;
use App\roles_master;
use App\permission_master;
use App\common_route_master;
use App\Models\Payment\Plan;
use Braintree_Customer;
use Braintree_Subscription;
use App\Models\Payment\user_subscription;

class UserController extends Controller {

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index() {
      if (Auth::check()) {
         return redirect()->intended('admin/dashboard');
      }
      //return view('welcome');
      $role = Role::where('is_admin', 'N')->get();
      return view('front.register.index', compact('role'));
   }

   public function create(Request $request) {
      if (Auth::check()) {
         return redirect()->intended('admin/dashboard');
      }

      $findPlan = Plan::where('slug', $request->plan)->first();
      $plan = '';
      if($findPlan)
         $plan = $findPlan->braintree_plan;
      $plans = Plan::get();
      $role = Role::where('is_admin', 'N')->get();
      return view('front.register.create', compact('role', 'plan', 'plans'));
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request            
    * @return \Illuminate\Http\Response
    */
   public function otpview($id) {
      return view('front.register.verify_otp');
   }

   public function loginotpview($id) {
      return view('front.register.login_otp');
   }

   public function userverification($id, $token) {
      if ($id != null && $token != null) {
         $newuser = register::where(['id' => $id, 'remember_token' => $token])->first();
         $companyData = Company::where(['id' => $newuser['company_id']])->first();
         if (isset($newuser->id))
            return view('admin.user_management.verify', compact('newuser', 'companyData'));
         else
            return redirect('/');
      }else {
         return redirect('/');
      }
   }

   public function store(Request $request) {

      $this->validate($request, [
          'name' => 'required',
          'lname' => 'required',
          'email' => 'required|unique:users,email,?????',
          'password' => 'required|min:5',
          'confirm_password' => 'required|min:5|same:password',
          'company_name' => 'required',
          'phone' => 'required|min:9',
          'agree' => 'required',
      ]);

      if (empty($request->payment_method_nonce) || $request->payment_method_nonce == NULL) {
         return [
             'error' => true,
             'message' => 'Something went wrong.'
         ];
      }

      $company = Company::create([
                  'company_name' => $request['company_name'],
                  'address' => '',
                  'country' => 14, //set to Australia by default
      ]);

      $user_role = roles_master::create(['role_name' => 'Company Admin',
                  'company_id' => $company->id]);

      try {
         $routes = common_route_master::select('id')->get();
         $routes = isset($routes) ? $routes->toArray() : [];
         $route_list = [];
         foreach ($routes as $key => $path) {
            array_push($route_list, $path['id']);
         }

         //add athe complete list in permission table agains the new role created for the company
         $user_role->routes()->sync($route_list);
      } catch (Exception $ex) {
         print_r($ex->getMessage());
      }

      $request['password'] = bcrypt($request['password']);
      $request['role_id'] = $user_role->id;
      $request['company_id'] = $company->id;

      //create customer
      $customer = Braintree_Customer::create(['firstName' => $request['name'],
                  'lastName' => $request['lname'],
                  'email' => $request['email'],
                  'phone' => $request['phone'],
                  'company' => $request['company_id'],
                  'paymentMethodNonce' => $request->payment_method_nonce
      ]);

      //get pyament token
      $paymentToken = '';
      if ($customer->success) {
         $paymentToken = $customer->customer->paymentMethods[0]->token;
      } else {
         return $this->handleError($customer);
      }
      //add subsription
      $payment = Braintree_Subscription::create([
                  'paymentMethodToken' => $paymentToken,
                  'planId' => $request->plan
      ]);
      if (!$payment->success) {
         return $this->handleError($payment);
      }

      $subscription = user_subscription::create(['company_id' => $company->id,
                  'braintree_subscription_id' => $payment->subscription->id,
                  'braintree_subscription_plan' => $payment->subscription->planId,
                  'braintree_subscription_price' => $payment->subscription->price,
                  'next_billing_date' => $payment->subscription->nextBillingDate,
      ]);
      
      $AccountSid = env('TWILIO_ACCOUNT_SID', 'AC1c0f122e286d45d2f7117935360f68d7');
      $AuthToken = env('TWILIO_AUTH_TOKEN', '2bed13b3d4b8227b5c1762529356cea2');
      $url = env('TWILIO_URL', 'https://api.twilio.com/2010-04-01/Accounts/AC1c0f122e286d45d2f7117935360f68d7/Messages');

      $six_digit_random_number = mt_rand(100000, 999999);
      $from = '61476856876';
      $to = $request['phone'];
      $body = 'Your verification code is "' . $six_digit_random_number . '"';

      $toSend = "From=" . $from . "&To=" . $to . "&Body=" . $body;

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($ch, CURLOPT_USERPWD, "$AccountSid:$AuthToken");
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $toSend);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $result = curl_exec($ch);

      $request['verify_code'] = $six_digit_random_number;
      $user = register::create(['name' => $request['name'],
                  'lname' => $request['lname'],
                  'email' => $request['email'],
                  'password' => $request['password'],
                  'phone' => $request['phone'],
                  'verify_code' => $request['verify_code'],
                  'company_id' => $request['company_id'],
                  'role_id' => $request['role_id'] = $user_role->id,
      ]);


      $insertedId = $user->id;
      return [
          'error' => false,
          'otpid' => $insertedId,
          'otp' => $six_digit_random_number,
          'otpurl' => url('/api/v1/checkotp/' . $insertedId)
      ];
   }

   public function modify(Request $request, $id) {
      $user = \App\User::where('id', $id)->first();


      $this->validate($request, [
          'name' => 'required',
          'lname' => 'required',
          'email' => 'required',
          'password' => 'required|min:5',
          'confirm_password' => 'required|min:5|same:password',
          'phone' => 'required|min:9',
          'agree' => 'required',
      ]);

      $company = Company::where('id', $user->company_id)->first();

      $request['password'] = bcrypt($request['password']);
      $request['role_id'] = $user->role_id;
      $request['company_id'] = $company->id;
      $request['remember_token'] = '';

      $AccountSid = env('TWILIO_ACCOUNT_SID', 'AC1c0f122e286d45d2f7117935360f68d7');
      $AuthToken = env('TWILIO_AUTH_TOKEN', '2bed13b3d4b8227b5c1762529356cea2');
      $url = env('TWILIO_URL', 'https://api.twilio.com/2010-04-01/Accounts/AC1c0f122e286d45d2f7117935360f68d7/Messages');

      $six_digit_random_number = mt_rand(100000, 999999);
      $from = '61476856876';
      $to = $request['phone'];
      $body = 'Your verification code is "' . $six_digit_random_number . '"';

      $toSend = "From=" . $from . "&To=" . $to . "&Body=" . $body;

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($ch, CURLOPT_USERPWD, "$AccountSid:$AuthToken");
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $toSend);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $result = curl_exec($ch);

      $request['verify_code'] = $six_digit_random_number;
      $user = register::where('id', $id)->update(['name' => $request['name'],
          'lname' => $request['lname'],
          'email' => $request['email'],
          'password' => $request['password'],
          'phone' => $request['phone'],
          'verify_code' => $request['verify_code'],
          'remember_token' => $request['remember_token'],
          'company_id' => $request['company_id'],
          'role_id' => $request['role_id'] = $user->role_id,
      ]);


      return [
          'error' => false,
          'otpid' => $id,
          'otp' => $six_digit_random_number,
          'otpurl' => url('/api/v1/checkotp/' . $id)
      ];
   }

   /**
    * Display the specified resource.
    *
    * @param int $id            
    * @return \Illuminate\Http\Response
    */
   public function show($id) {
      if (Auth::check()) {
         return redirect()->intended('admin/dashboard');
      }
      $role = Role::where('is_admin', 'N')->get();
      return view('front.register.login_otp', compact('role'));
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param int $id            
    * @return \Illuminate\Http\Response
    */
   public function edit($id) {
      return view('admin.portfolio.create', compact());
   }

   /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request            
    * @param int $id            
    * @return \Illuminate\Http\Response
    */
   public function checkotp(Request $request, $id) {
      $register = register::find($id);

      $request_code = $request->verify_code;
      $register_code = $register->verify_code;

      $this->validate($request, [
          'verify_code' => 'required',
      ]);

      if ($request_code == $register_code) {
         $register->update([
             'status' => 'active',
         ]);
         Auth::loginUsingId($id);

         return [
             'error' => false,
             'redirect' => url('/admin/dashboard')
         ];
      }

      return [
          'error' => true,
          'message' => 'You have entered wrong OTP.'
      ];
   }

   public function logincheckotp(Request $request, $id) {
      $register = register::find($id);
      $request_code = $request->verify_code;
      $register_code = $register->verify_code;
      $email = $register->email;

      $this->validate($request, [
          'verify_code' => 'required',
      ]);

      if ($request_code === $register_code) {
         Auth::loginUsingId($id);
         return [
             'error' => false,
             'redirect' => url('/admin/dashboard')
         ];
      } else {
         return [
             'error' => true,
             'message' => 'You have entered wrong OTP.'
         ];
      }
   }

   public function checklogin(Request $request) {

      $this->validate($request, [
          'email' => 'required|email',
          'password' => 'required'
      ]);

      $email = $request->input('email');
      $password = $request->input('password');

      if (!Auth::once(['email' => $email, 'password' => $password])) {
         return [
             'error' => true,
             'message' => 'Login Failed.'
         ];
      }

      $request['password'] = bcrypt($request->input('password'));

      $userDetail = register::where('email', $email)->get();

      $phone = $userDetail[0]['phone'];
      $id = $userDetail[0]['id'];

      $AccountSid = env('TWILIO_ACCOUNT_SID', 'AC1c0f122e286d45d2f7117935360f68d7');
      $AuthToken = env('TWILIO_AUTH_TOKEN', '2bed13b3d4b8227b5c1762529356cea2');
      $url = env('TWILIO_URL', 'https://api.twilio.com/2010-04-01/Accounts/AC1c0f122e286d45d2f7117935360f68d7/Messages');

      $six_digit_random_number = mt_rand(100000, 999999);
      $from = '61476856876';
      $to = $phone;
      $body = 'Your verification code is "' . $six_digit_random_number . '"';

      $toSend = "From=" . $from . "&To=" . $to . "&Body=" . $body;

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($ch, CURLOPT_USERPWD, "$AccountSid:$AuthToken");
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $toSend);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $result = curl_exec($ch);

      $request['verify_code'] = $six_digit_random_number;
      $udetails = register::find($id);

      $uuSER = $udetails->update($request->all());

      if ($uuSER == 1) {
         return [
             'error' => false,
             'otpid' => $id,
             'otpurl' => url('/api/v1/logincheckotp/' . $id)
         ];
      }
   }

   public function logout() {
      Auth::logout();
      return redirect()->intended('login');
   }

   public function update(Request $request, $id) {
      $portfolio = register::find($id);

      $this->validate($request, [
          'projects' => 'required',
      ]);

      $portfolio->update($request->all());


      session()->flash('flash_message', 'Portfolio updated successfully...');
      return redirect('admin/portfolio');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param int $id            
    * @return \Illuminate\Http\Response
    */
   public function destroy($id) {
      $portfolio = Portfolio::find($id);
      $portfolio->delete();
      session()->flash('flash_message', 'Portfolio deleted successfully...');
      return redirect('admin/portfolio');
   }

   public function handleError($object) {
      foreach ($object->errors->deepAll() AS $error) {
         $error = $error->code . ": " . $error->message;
      }
      return ['error' => true, 'message' => $error];
   }

}
