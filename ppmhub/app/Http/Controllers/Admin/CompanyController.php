<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inquirynumber_range;
use App\Company;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use DateTime;
use Illuminate\Support\Facades\File;
use App\User;
use App\country;
use DB;
use App\state;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {           
        $country = country::pluck('code','id');                        
        $company = Company::where('id',Auth::User()->company_id)->first();
        $state_list = array();
        if(isset($company->state)){            
            $state_list = state::Where('country_id', $company->country)->pluck('state_name', 'id');
        }
        return view('admin.company.company', compact('company','country', 'state_list'));
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
        //
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
        $get_company = Company::find($id);
        $company = Input::all();            
        
        $validationmessages = [
            'company_name.required' => 'Please enter company name',
            'address.required' => 'Please enter company address', 
            'state.required' => 'Please select the state', 
            'country.required' => 'Please select the country', 
            'logo.mimes' => 'Please select file with valid image extension jpg,png,gif etc.'
        ];

        $validator = Validator::make($company, [
                    'company_name' => 'required',                    
                    'address' => 'required', 
                    'state' => 'required', 
                    'country' => 'required', 
                    'logo' => 'mimes:jpeg,png,jpg,gif,svg',
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/company')->withErrors($validator)->withInput(Input::all());
        } 
        
        if(isset($company['logo'])){ 
            if($get_company['logo'] !== '' && $get_company['logo'] !== null){
                $oldlogo = env('COMPANY_LOGO_PATH', '').$get_company['logo'];            
                unlink($oldlogo); //remove old logo            
            }            
            $image = Input::file('logo');
            $company['logo'] = Company::fileupload($image);
        }
        $get_company->update($company);
        return redirect('admin/company');                        
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
