<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ChangePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){            
            return view('changePassword');
        } else {
            return view('admin.login');
        }        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = Input::all();                
        $currUserId = Auth::User()->id;                
        
        $validationmessages = [
            'password.required' => 'Please enter password',
            'password.min' => 'Please enter minimum 6 characters',  
            'confirm_password.required' => 'Please enter confirm password',
            'confirm_password.min' => 'Please enter minimum 6 characters',
            'confirm_password.same' => 'Password does not match the confirm password',
        ];

        $validator = Validator::make($post, [
                    'password' => 'required|min:6',                    
                    'confirm_password' => 'required|min:6|same:password',                    
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/changepassword')->withErrors($validator)->withInput(Input::all());
        }                       
                
        $newPassword = crypt($post['password'], "");
                        
        if(Auth::User()->status == 'active'){
            DB::table('users')->where('id',$currUserId)->update(['password' => $newPassword]);
            session()->flash('flash_message', 'Password has been changed successfully...');
            return redirect('/admin/dashboard');
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
