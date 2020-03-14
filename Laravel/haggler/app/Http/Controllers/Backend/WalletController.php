<?php

namespace App\Http\Controllers\Backend;

use \App\Models\Product;
use \App\Models\Deal;
use \App\Models\UserDeal;
use \App\Models\Event;
use \App\Models\Wallet;
use \App\Models\WalletRequest;

class WalletController extends BackendController {

	public function __construct() {
		parent::__construct();
		view()->share(['active_nav' => 'wallet']);
	}

	public function getIndex() {

	     $wallet = Wallet::where("user_id",\Auth::id())->first();
	     if(\Auth::user()->role == "admin"){
           $walletRequests = WalletRequest::all();
         }else{
             $walletRequests =  WalletRequest::where("user_id",\Auth::id())->get();
         }
		$this->layout->content = view('backend.wallet.index',['wallet' => $wallet,'walletRequests' => $walletRequests]);
		return $this->layout;
	}


	public function postRedeemRequest(\Illuminate\Http\Request $request){

	    $wallet = Wallet::where("user_id",\Auth::id())->first();

	    $maxAmount = $wallet->v_amount;

	    $valid = \Validator::make($request->all(),[
	        "redeem_amount" => "required|numeric|max:$maxAmount"
        ]);

	    if($valid->fails()){

            return redirect()->back()->withErrors($valid);
        }

        $walletRequest = new  WalletRequest();

        $walletRequest->user_id = \Auth::id();
        $walletRequest->request_amount = $request->get('redeem_amount');
        $wallet->v_amount = ($wallet->v_amount - $request->get('redeem_amount'));

        if($walletRequest->save() && $wallet->save()){
            return redirect()->back()->with(['message' => $this->alert('Your request has been sent.', 'alert-success')]);
        }

        return redirect()->back()->with(['message' => $this->alert('Unable to send request.', 'alert-danger')]);








    }

    public function postRequestStatus(\Illuminate\Http\Request $request){

	    $wallet = Wallet::where("user_id",$request->get("user_id"))->first();
        $walletRequest = WalletRequest::where("id",$request->get("request_id"))->first();

	    switch ($request->get("status")){
            case "approved" :
                      $wallet->amount = ($wallet->amount - $request->get("request_amount"));
                      $wallet->redeemed = $wallet->redeemed + $request->get("request_amount");
                      $walletRequest->status = $request->get("status");
                      break;

            case "disapproved" :
                $wallet->v_amount = ($wallet->v_amount + $request->get("request_amount"));
                $walletRequest->status = $request->get("status");
                break;

            default:
                break;


        }

        if($wallet->save() && $walletRequest->save()){
             return redirect()->back()->with(['message' => $this->alert('Status updated successfully.', 'alert-success')]);
        }

        return redirect()->back()->with(['message' => $this->alert('Unable to update status.', 'alert-danger')]);


    }


}