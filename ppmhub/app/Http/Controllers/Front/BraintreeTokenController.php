<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Braintree_ClientToken;

class BraintreeTokenController extends Controller
{
    public function token()
    {
        return response()->json([
            'data' => [
                'token' => Braintree_ClientToken::generate(),
            ]
        ]);
    }
}
